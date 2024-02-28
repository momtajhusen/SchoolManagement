
$(document).ready(function () {
    $(".update-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

      var subject_id =  $(this).attr('subject_id');
      var subject_name = $(".subject_name").val();
      var class_name =  $(".class-select").val();
      var subject_teacher =  $("#subject_teacher").val();
      var subject_code = $("#subject_code").val();

        $.ajax({
            url: "/update-subject",
            method: "POST",
            data: {
                subject_id: subject_id,
                subject_name: subject_name,
                class_name: class_name,
                subject_teacher: subject_teacher,
                subject_code: subject_code,
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

 
                if (response.status == "Update Success") {
                    $(".delete").remove();
                    $(".delete").removeClass("delete");
                    Swal.fire({
                        title: "Subject Update Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                        location.reload();
                      });

                    $(".update-btn").addClass("d-none");
                    $(".upload-btn").removeClass("d-none");
                } else {
                    alert("subject not found");
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log("Error: " + error);
                console.log("Status: " + status);
                console.log("Response: " + xhr.responseText);
            }
        });
    }); 

});
