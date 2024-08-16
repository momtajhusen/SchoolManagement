// PARENT LOGIN
$(document).ready(function () {
 
    $(".parent-login").submit(function (e) {
        e.preventDefault();


        // return false;

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/parent-login",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
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

                console.log(response);

                // return false;
                if (response.status == "Login success") {
                    $(".alert-success").removeClass("d-none");
                    setTimeout(function () {
                        window.location = "/parent/dashboard";
                    }, 1000);
                } else {
                    $(".submit-btn").addClass("d-none");
                    $(".alert-danger").removeClass("d-none");
                    $(".alert-text").html(response.status);

                    setTimeout(function () {
                        $(".alert-danger").addClass("d-none");
                        $(".submit-btn").removeClass("d-none");
                    }, 2000);
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});

// STUDENT LOGIN
$(document).ready(function () {
 
    $(".student-form").submit(function (e){
        e.preventDefault();


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/student-login",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
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

 
                if (response.status == "Login success") {
                    $(".alert-success").removeClass("d-none");
                    setTimeout(function () {
                        window.location = "/student/dashboard";
                    }, 1000);
                } else {
                    $(".submit-btn").addClass("d-none");
                    $(".alert-danger").removeClass("d-none");
                    $(".alert-text").html(response.status);

                    setTimeout(function () {
                        $(".alert-danger").addClass("d-none");
                        $(".submit-btn").removeClass("d-none");
                    }, 2000);
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});

// TEACHER LOGIN
$(document).ready(function () {

    $(".teacher-form").submit(function (e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/teacher-login",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // setting a timeout
                // $(".submit-btn").addClass("d-none");
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

                console.log(response);
 
                if (response.status == "Login success") {
                    $(".alert-success").removeClass("d-none");
                    setTimeout(function () {
                        window.location = "/teacher/dashboard";
                    }, 1000);
                } else {
                    $(".submit-btn").addClass("d-none");
                    $(".alert-danger").removeClass("d-none");
                    $(".alert-text").html(response.status);

                    setTimeout(function () {
                        $(".alert-danger").addClass("d-none");
                        $(".submit-btn").removeClass("d-none");
                    }, 2000);
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});
 
