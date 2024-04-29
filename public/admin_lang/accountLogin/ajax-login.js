// Student Management Login
$(document).ready(function () {
    $(".student-management-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/student-management-login",
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
                        window.location = "/student-management/dashboard";
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

// Super Admin Login
$(document).ready(function () {

    if (localStorage.getItem('super-admin-user') !== null) {
        $("#super-admin-user").val(localStorage.getItem('super-admin-user'));
        $("#super-admin-psd").val(localStorage.getItem('super-admin-psd'));
      }



    $(".super-admin-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/super-admin-login",
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

                   var user_name = $("#super-admin-user").val();
                   var user_psd = $("#super-admin-psd").val();


                    localStorage.setItem('super-admin-user', user_name);
                    localStorage.setItem('super-admin-psd', user_psd);
                    localStorage.setItem('admin-role-type', response.role_type);

                    setTimeout(function () {
                        window.location = "/admin/dashboard";
                    }, 1000);
                } else {
                    $(".submit-btn").addClass("d-none");
                    $(".alert-danger").removeClass("d-none");
<<<<<<< HEAD
                    // $(".alert-text").html(response.status);
=======
                    $(".alert-text").html(response.status);
>>>>>>> 0981ca2f451b75d53f172842175003e92a932ce3

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

// Account Management Login
$(document).ready(function () {
    $(".account-management-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/account-management-login",
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
                        window.location = "/account-management";
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

// Account Management Login
$(document).ready(function () {
    $(".school-management-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/school-management-login",
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
                        window.location = "/school-management";
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
