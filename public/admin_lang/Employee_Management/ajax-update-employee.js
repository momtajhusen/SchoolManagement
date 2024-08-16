// Retrive iD Employee For Update
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

   var employee_id =  $("#employee-id").val();
    $.ajax({
        url: "/get-single-employee/" + employee_id,
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);
            localStorage.removeItem("employee_register");


             $('input[name="first_name"]').val(response.employee.first_name);
             $('input[name="last_name"]').val(response.employee.last_name);
             $('input[name="dob"]').val(response.employee.dob);
             $('input[name="address"]').val(response.employee.address);
             $('input[name="phone"]').val(response.employee.phone);
             $('input[name="email"]').val(response.employee.email);
             $('input[name="qualification"]').val(response.employee.qualification);
             $('input[name="joining_date"]').val(response.employee.joining_date);

             var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
             
            $("#employee_img_preview").attr("src",currentDomainWithProtocol+"/storage/"+response.employee.image);

            $(".role option").filter(function () {
                return $(this).text() == response.employee.department_role;
            }).prop("selected", true);

             $(".gender-select option").filter(function () {
                 return $(this).text() == response.employee.gender;
             }).prop("selected", true);

             $(".religion option").filter(function () {
                return $(this).text() == response.employee.religion;
            }).prop("selected", true);

            $(".blood_group option").filter(function () {
                return $(this).text() == response.employee.blood_group;
            }).prop("selected", true);


        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});


// Update Teacher 
$(document).ready(function(){

    $(".employee-update-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var employee_image_name = localStorage.getItem("employee_register");
        var employee_id =  $("#employee-id").val();

        var formData = new FormData(this);
        formData.append("employee_image_name", employee_image_name);
        formData.append("employee_id", employee_id);

        $.ajax({
            url: "/update-employee",
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

               if(response.status == "Update Success")
               {
                Swal.fire({
                    title: "Teacher Update Success !",
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