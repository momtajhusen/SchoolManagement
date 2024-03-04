$(document).ready(function () {
    $('#fileInput').on('change', function (e) {
        var file = e.target.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var csvContent = e.target.result;
                var rows = csvContent.split('\n');

                $('.total-upload-students').html(rows.length);

                // Show loading indicator
                $('.load').show();

                // Extract header names from the first row
                var headers = rows[0].split(',');

                // Process each row
                rows.slice(1).forEach(function (row) {
                    var columns = row.split(',');

                    // Create a form element for each row
                    var form = $('<form class="d-flex student-form"></form>');

                    // Process each column and append input fields to the form
                    columns.forEach(function (column, index) {
                        var headerName = headers[index].trim(); // Get the header name
                        var input = $('<input type="text">')
                                    .val(column)
                                    .attr('name', headerName)
                                    .addClass(headerName); // Add class with headerName as its value
                        form.append(input);
                    });

                    var submitBtn = $('<input type="submit" value="save" class="btn submit-btn">');
                    form.append(submitBtn);

                    // Append the form to the student-data div
                    $('.student-data').append(form);
                });

                // Hide loading indicator after processing is complete
                $('.load').hide();
            };

            reader.readAsText(file);
        }
    });
});

// Event delegation for handling form submissions
$(document).on('submit', '.student-form', function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $(this).addClass('submit-form');

    // Set CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Send AJAX request to upload students
    $.ajax({
        url: "/add-multiple-students",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        // Success handler
        success: function (response) {
            console.log(response);

            if (response.status === 'Add Successfully') {
                updateSuccessCount(); // Update successful upload count

                // If there are more forms to upload, trigger submission of the next form
                if ($('.upload-event').html() === 'multiple') {
                    submitNextForm();
                }
            }
        },
        // Error handler
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            $('.submit-form').append(`<span error=`+xhr.responseText+` class="material-symbols-outlined ml-1 bg-danger" style='cursor:pointer;'>error</span>`);
            updateFailedCount(); 
            if ($('.upload-event').html() === 'multiple') {
                submitNextForm();
            }
        },
    });
});

// Function to update successful upload count
function updateSuccessCount() {
    var successStudents = Number($('.total-sucess-students').html());
    $('.total-sucess-students').html(successStudents + 1);
    $('.submit-form').remove();
}

// Function to update failed upload count
function updateFailedCount() {
    var failedStudents = Number($('.total-failed-students').html());
    $('.total-failed-students').html(failedStudents + 1);
    $('.student-form').removeClass('submit-form');
}

// Function to submit the next form
function submitNextForm() {
    var $nextForm = $('.student-form:not(.submitted):first');
    if ($nextForm.length) {
        $nextForm.addClass('submitted').find('.submit-btn').click();
    }
}

// Event listener for saving all students
$(document).ready(function () {
    $(".save-all-student").click(function () {
        submitNextForm(); // Submit the first form
        $('.upload-event').html('multiple');
    });
});
