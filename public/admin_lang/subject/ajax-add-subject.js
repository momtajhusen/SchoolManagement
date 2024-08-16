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
                            Swal.fire({
                                title: "Subject Add Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });
                        } else {
                            Swal.fire(
                                "Already Subject exists !",
                                "Change Subject Nam !",
                                "info"
                            );
                        }
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
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


$(document).ready(function(){
    $(".class-select").on("change", function(){
        var select_class = $(this).val();
        $(".class-select option").filter(function () {
            return $(this).text() == select_class;
        }).prop("selected", true);
        $(".search-class-subject").click();
    });

});