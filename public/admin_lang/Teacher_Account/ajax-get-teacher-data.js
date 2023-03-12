// Retrive All Student
$(document).ready(function(){
 
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/get-teacher-data",
        method: 'GET',
        beforeSend: function() 
        {
         // setting a timeout
           $(".submit-btn").addClass('d-none');
           $(".progress").removeClass('d-none');
        },
        // Progress 
             xhr: function(){
                 var xhr = new window.XMLHttpRequest();
                 xhr.upload.addEventListener("progress", function(evt) {
                     if (evt.lengthComputable) {
                         var percentComplete = (evt.loaded / evt.total) * 100;
                         var percentComplete =  percentComplete.toFixed(2);
                         $(".progress-bar").width(percentComplete+"%");
                         $(".progress-bar").html(percentComplete+" %");
 
                     }
                 }, false);
                 return xhr;
             },
         // Success 
         success:function(response)
         {
            
          if(response.TecherData != "teacher not available")
          {
            var first_name = response.TecherData.first_name;
            var last_name = response.TecherData.last_name;

            // alert(first_name);


             $("#profile_image").attr("src", "http://127.0.0.1:8000/storage/"+response.TecherData.image);
             $(".teacher_name").html(first_name+" "+last_name);
          }
          else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went Error Your Data not found !',
            })
          }

 

         }
    });


});