// Retrive Teacher Details
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
             var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    
             var first_name = response.TecherData.first_name;
             var last_name = response.TecherData.last_name;
             var dob = response.TecherData.dob;
             var address = response.TecherData.address;
             var phone = response.TecherData.phone;
             var email = response.TecherData.email;
             var qualification = response.TecherData.qualification;
             var joining_date = response.TecherData.joining_date;
             var salary = response.TecherData.salary;
             var class_teacher = response.TecherData.class_teacher;
             var section = response.TecherData.section;
             var password = response.TecherData.password;
             var treache_img = currentDomainWithProtocol+"/storage/"+response.TecherData.image;

             $(".teacher_name").html(first_name+' '+last_name);
             $(".teacher_dob").html(dob);
             $(".teacher_phone").html(phone);
             $(".teacher_email").html(email);
             $(".teacher_salary").html(salary);
             $(".teacher_address").html(address);
             $(".teacher_qualification").html(qualification);

             $(".login-email").html(email);
             $(".login-psaaword").html(password);

             $("#profile_image").attr("src", treache_img);

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