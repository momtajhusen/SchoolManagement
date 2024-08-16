
// Add and Update Class 
$(document).ready(function(){

    $(".added-class-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData(this);
        formData.append('year', current_year);

        if($("#check_action").val() != "update")
        {
            var url = "/add-class";
        }
        else{
            var url = "/update-class";
        }

    
        $.ajax({
            url: url,
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

                if(response.status == "Add Success"){
                    Swal.fire({
                        title: "Class Add Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                        location.reload();
                      });
                }

                else if(response.status == "Update Success")
                {
                    Swal.fire({
                        title: "Class Update Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                        location.reload();
                      });
                }

              else if(response.status == "exists class")
                {
                    Swal.fire({
                        title: "Class Already Exists !",
                        text: "Change Class Name",
                        icon: "info",
                        confirmButtonText: "OK",
                      });  
                }

                $(".submit-btn").removeClass('d-none');
                $(".progress").addClass('d-none');
      
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });

  
});

// Retrive Class 