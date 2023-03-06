$(document).ready(function () {
    $(".added-subject-form").submit(function (e) {
        e.preventDefault();

        if ($(".class-select").val() != "") {
            if ($(".subject_name").val() != "") {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                var formData = new FormData(this);

                $.ajax({
                    url: "/add-subject",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
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
                                    var percentComplete =
                                        percentComplete.toFixed(2);
                                    $(".progress-bar").width(
                                        percentComplete + "%"
                                    );
                                    $(".progress-bar").html(
                                        percentComplete + " %"
                                    );
                                }
                            },
                            false
                        );
                        return xhr;
                    },
                    // Success
                    success: function (response) {
                        if (response.status != "exists subject") {
                            Swal.fire(
                                "Subject Add Success !",
                                "You clicked the button!",
                                "success"
                            );
                            $(".added-subject-form")[0].reset();
                        } else {
                            Swal.fire(
                                "Already Subject exists !",
                                "Change Subject Nam !",
                                "info"
                            );
                        }
                    },
                });
            } else {
                alert("Enter Subject Name");
            }
        } else {
            alert("Select Class");
        }
    });
});
