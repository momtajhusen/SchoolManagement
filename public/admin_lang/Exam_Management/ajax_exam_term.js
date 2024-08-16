
// Create Exam Term 
$(document).ready(function(){

    $(".add-exam-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        var formData = new FormData(this);
        formData.append("current_year", current_year);
   
        $.ajax({
            url: "/create-exam-term",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            // beforeSend: function() 
            // {
            //  // setting a timeout
            //    $(".submit-btn").addClass('d-none');
            //    $(".progress").removeClass('d-none');
            // },
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

               if(response.status == "Add Successfully")
               {
                Swal.fire({
                    title: "Exam Create Success !",
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
                    text: response.status,
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

// Delete Exam Term
$(document).ready(function(){
    $(".exam-term-table").on("click", ".delete-exam-term", function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var exam_id =  $(this).attr("exam_id");

       $.ajax({
        url: "/delete-exam-term",
        method: "POST",
        data: {
            exam_id: exam_id,
        },
        beforeSend: function () {
            // setting a timeout
            $(".submit-btn").addClass("d-none");
            $(".progress").removeClass("d-none");
        },
        // Progress
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete =
                            (evt.loaded / evt.total) * 100;
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

            if (response.status == "Delete Success") {
                Swal.fire({
                    title: "Exam Delete Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
                  });

            } else {
                alert("Exam not found");
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

        });
});

// Status update
$(document).ready(function(){

    $(".exam-term-table").on("click", ".exam_status", function () {
 
       var status = $(this).attr("status");
       var exam_id = $(this).attr("exam_id");

 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $.ajax({
            url: "/exam-status",
            method: 'POST',
            data:{
                status:status,
                exam_id:exam_id

            },
             // Success 
            success:function(response)
            {

               if(response.status == "Status Success")
               {
                Swal.fire({
                    title: "Status Success !",
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
                    text: response.status,
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


