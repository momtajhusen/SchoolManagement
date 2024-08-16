$(document).ready(function () {

    $(".class-subject-table").on("click", ".delete-subject", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


        var subject_id = $(this).attr("subject_id");
 


        $(this).parent().parent().parent().parent().addClass("delete");

        $.ajax({
            url: "/delete-subject",
            method: "POST",
            data: {
                subject_id: subject_id,
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
                if (response.status != "Subject not Found") {
                    $(".delete").remove();
                    $(".delete").removeClass("delete");
                    Swal.fire(
                        "Subject Delete Success !",
                        "You clicked the button!",
                        "success"
                    );
                } else {
                    alert("subject not found");
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});
