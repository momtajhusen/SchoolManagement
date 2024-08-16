// Retrive All Student
$(document).ready(function(){
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/get-student-data",
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
            console.log(response);
          if(response.StudentData != "student not available")
          {
            var first_name = response.StudentData.first_name;
            var middle_name = response.StudentData.middle_name;
            var last_name = response.StudentData.last_name;


            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

             $("#profile_image").attr("src",  currentDomainWithProtocol+"/storage/"+response.StudentData.student_image);
             $(".student_name").html(first_name+" "+middle_name+" "+last_name);
          }
          else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went Error Your Data not found !',
            })
          }

 

         },
         error: function (xhr, status, error) 
         {
             console.log(xhr.responseText);
         },
    });


});