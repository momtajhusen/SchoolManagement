// Retrive All Student
$(document).ready(function () {

 

   $('#roll_update').click(function(){
    
       var st_id = $(this).attr('st_id');

       var st_roll = $('#roll').val();

       $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        });

    $.ajax({
        url: "/roll-upddate",
        method: "POST",
        data:{
           st_id:st_id,
           st_roll:st_roll,
        },
        // Success
        success: function (response) {
            if(response == 'update saucess'){
                 alert(response);
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
   });
 


    
});