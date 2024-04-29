$(document).ready(function(){

    $(".employee-added-form").submit(function(e){
        e.preventDefault();



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var employee_image_name = localStorage.getItem("employee_register");

    
        var formData = new FormData(this);
        formData.append("employee_image_name", employee_image_name);

    
        $.ajax({
            url: "/admin/add_new_employee",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
               if(response.status == "Add Successfully")
               {
                Swal.fire({
                    title: "Employee Add Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
                  });
                  
               }
               else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                  })
               }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });

  
});