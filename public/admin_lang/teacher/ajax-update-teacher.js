// Retrive All Student
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

   var teacher_id =  $("#teacher-id").val();
 
    $.ajax({
        url: "/get-single-teacher/" + teacher_id,
        method: "GET",
        // Progress
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        var percentComplete = percentComplete.toFixed(2);
                        $(".progress-bar").width(percentComplete + "%");
                        $(".progress-bar").html(percentComplete + " %");
                    }
                },
                false
            );
            return xhr;
        },
        // Success
        success: function (response) {
            console.log(response);


             $('input[name="first_name"]').val(response.teacher.first_name);
             $('input[name="last_name"]').val(response.teacher.last_name);
             $('input[name="dob"]').val(response.teacher.dob);
             $('input[name="address"]').val(response.teacher.address);
             $('input[name="phone"]').val(response.teacher.phone);
             $('input[name="email"]').val(response.teacher.email);
             $('input[name="qualification"]').val(response.teacher.qualification);
             $('input[name="joining_date"]').val(response.teacher.joining_date);
             $('input[name="salary"]').val(response.teacher.salary);
             $('input[name="class_teacher"]').val(response.teacher.class_teacher);
             $('input[name="section"]').val(response.teacher.section);

             var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
             
            $("#teacher_img_preview").attr("src",currentDomainWithProtocol+"/storage/"+response.teacher.image);


             $(".gender-select option").filter(function () {
                 return $(this).text() == response.teacher.gender;
             }).prop("selected", true);

             $(".religion option").filter(function () {
                return $(this).text() == response.teacher.religion;
            }).prop("selected", true);

            $(".blood_group option").filter(function () {
                return $(this).text() == response.teacher.blood_group;
            }).prop("selected", true);


            $("#class_teacher option").filter(function () {
                return $(this).text() == response.teacher.class_teacher;
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

    $(".teacher-update-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var teacher_image_name = localStorage.getItem("teacher_register");
        var teacher_id =  $("#teacher-id").val();


    
        var formData = new FormData(this);
        formData.append("teacher_image_name", teacher_image_name);
        formData.append("teacher_id", teacher_id);


    
        $.ajax({
            url: "/update-teacher",
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