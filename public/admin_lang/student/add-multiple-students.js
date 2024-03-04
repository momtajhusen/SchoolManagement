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

    // Event delegation for handling form submissions
    $(document).on('submit', '.student-form', function (e) {
        e.preventDefault();
        var formData = new FormData(this);


          $('.student-form:first').addClass('upload-form');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        
        var formData = new FormData(this);
 
        $.ajax({
            url: "/add-multiple-students",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) 
            {
                console.log(response);

                var sucess_students = Number($('.total-sucess-students').html());
                if(response.status = 'Add Successfully')
                {
                    $('.upload-form').remove();
                    $('.student-form:first').addClass('upload-form');
                    sucess_students++;
                    $(this).remove();
                } 
                $('.total-sucess-students').html(sucess_students);
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
                var failed_students = Number($('.total-failed-students').html());
                failed_students++;
                $('.total-failed-students').html(failed_students);
            },
        });
      });
});

// Save all Students
$(document).ready(function(){
    $(".save-all-student").click(function(){
        $('.submit-btn').each(function(){
             $(this).click();
        });
    });
});