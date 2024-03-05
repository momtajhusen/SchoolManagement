// Import Csv File 
$(document).ready(function () {
    $('#fileInput').on('change', function (e) {
        var file = e.target.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#fileInput').addClass('d-none');
                $(".send-button-box").removeClass('d-none');

                $('.animation-box').removeClass('d-none');
                $('.animation-box').addClass('d-flex');


                var csvContent = e.target.result;
                var rows = csvContent.split('\n');

                $('.total-upload-students').html(rows.length-2);

                // Extract header names from the first row
                var headers = rows[0].split(',');

                // Header row Create
                var hasRun = false;
                rows.slice(0).forEach(function (row) {
                    var columnsdata = row.split(',');
                    // Create a form element for each row
                    var forms = $('<div class="d-flex header-box"></div>');
                    // Process each column and append input fields to the form
                    if (!hasRun) {
                    columnsdata.forEach(function (columns, index) {
                        var headerNames = headers[index].trim(); // Get the header name
                        var inputs = $('<input readonly type="text">')
                                    .val(columns)
                                    .addClass(headerNames).addClass('header-column'); // Add class with headerName as its value
                                    forms.append(inputs);
                    });
 
                    // Append the form to the student-data div
                    $('.student-data').append(forms);
                    hasRun = true;
                }
                });
                // Set the flag to true to indicate that the loop has run

                // Process each row
                rows.slice(1, -1).forEach(function (row) {
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

    $('.animation-root').html(`<span class="material-symbols-outlined move-icon">user_attributes</span>`);

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
            // Progress
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener(
                    "progress",
                    function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete =
                                (evt.loaded / evt.total) * 100;
                            var percentComplete = percentComplete.toFixed(2);

                            var $icon = $('.move-icon');
                            // Set the left position using percentage value
                            $icon.css('left', percentComplete + '%');
                            // $icon.css('transition', percentComplete + 's');
                        }
                    },
                    false
                );
                return xhr;
            },
        // Success handler
        success: function (response) {
            console.log(response);

            if (response.status === 'Add Successfully') {
                $('.move-icon').html('');
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
            $('.submit-form').append(`<span error=`+xhr.responseText+` class="material-symbols-outlined mx-1 text-danger" style='cursor:pointer;'>error</span>`);
            updateFailedCount(); 
            if ($('.upload-event').html() === 'multiple') {
                submitNextForm();
            }
        },
    });
});

// Function to update successful upload count
function updateSuccessCount() {
    var totalUpload = Number($('.total-upload-students').html());
    var successStudents = Number($('.total-sucess-students').html());

    $('.total-upload-students').html(totalUpload - 1);
    $('.total-sucess-students').html(successStudents + 1);
    $('.submit-form').remove();

    // var totalCount = Number($('.total-upload-students').html());

    // if(totalUpload == '0'){
    //     alert();
    //    $('#fileInput').removeClass('d-none');
    // }
}

// Function to update failed upload count
function updateFailedCount() {
    var failedStudents = Number($('.total-failed-students').html());
    $('.total-failed-students').html(failedStudents + 1);
    $('.student-form').removeClass('submit-form');

    // Set HTML content
    $('.animation-root-failed').html('<span class="material-symbols-outlined text-danger faile-icon">user_attributes</span>');
    // Select the icon
    var $icon = $('.faile-icon');
    // Delay the animation and then move the icon
    $icon.delay(5).animate({right: '100%'}, 200);
    
}

// function failedAnimation(){
//     // alert();
//     var $icon = $('.faile-icon');
//     $icon.css('right', '100%');
// }

// Function to submit the next form
function submitNextForm() {
    var $nextForm = $('.student-form:not(.submitted):first');
    if ($nextForm.length) {
        $nextForm.addClass('submitted').find('.submit-btn').click();
    }

    var totalUpload = Number($('.total-upload-students').html());

    if(totalUpload == 0){
        $('#fileInput').removeClass('d-none');
        $(".send-button-box").removeClass('d-none');
        $('.database-icon').removeClass(`animate__tada`);
    }
}

// Event listener for saving all students
$(document).ready(function () {
    $(".save-all-student").click(function () {
        submitNextForm(); // Submit the first form
        $('.upload-event').html('multiple');

        $('.send-button-box').addClass('d-none');
        
        var failedno = Number($('.total-failed-students').html());
        if(failedno != 0){
            $('.total-failed-students').html(1);
        }
        $('.database-icon').addClass(`animate__tada`);

    });
});
 
