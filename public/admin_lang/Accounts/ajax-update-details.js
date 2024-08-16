
// Parents Details update 
$(document).ready(function(){

    // on change input visable update btn 
    $('.parent-details-box input').on('input', function(){
        $('.parent-update-btn').removeClass('d-none');
    });

    $(".parents-details-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var formData = new FormData(this);
        $.ajax({
            url: "/manual-update-parent",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {
 
                 if(response == 'Update Sucess'){
                    $('.parent-update-btn').addClass('d-none');

                    Swal.fire({
                        title: "Update Sucess !",
                        text: "You clicked the button!",
                        icon: "success"
                      });
                 }

                $('.parent-update-btn').addClass('d-none');

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });



});

// student update 
$(document).ready(function(){
  $('.students-table').on('input', '.student-name-input', function(){


     $(this).parent().find('.save-student-btn').removeClass('d-none');

  })  
  
  // Save Change Name 
  $('.students-table').on('click', '.save-student-btn', function(){

       var st_id = $(this).parent().parent().find('.st_id').html();

       var student_name =  $(this).parent().find('.student-name-input').val();

       
       $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $.ajax({
        url: "/manual-update-student",
        method: "POST",
        data:{
            st_id:st_id,
            student_name:student_name,
        },
        // Success
        success: function (response) {


            if(response == 'save sucess'){
                Swal.fire({
                    title: "Update Sucess !",
                    text: "You clicked the button!",
                    icon: "success"
                  });

                  $('.save-student-btn').addClass('d-none');

                  $('.refresh-icon').click();
            }

       

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

 

   });


});