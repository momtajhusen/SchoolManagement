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

// Check Login Session 
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/check-login-session",
        method: "POST",
        // Success
        success: function (response) {

            // console.log(response);

            if(response == 'already session login'){
                window.location = "/admin/dashboard"; 
            }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

});


// Super Admin Login
$(document).ready(function () {

    if (localStorage.getItem('super-admin-user') !== null) {
        $("#super-admin-user").val(localStorage.getItem('super-admin-user'));
        $("#super-admin-psd").val(localStorage.getItem('super-admin-psd'));

        //   window.location = "/admin/dashboard";
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
                $('.loader').removeClass("d-none");
            },
            // Success
            success: function (response) {


                console.log(response);

                $(".submit-btn").removeClass("d-none");
                $('.loader').addClass("d-none");

                if(response.status == "user match"){


                    var user_name = $("#super-admin-user").val();
                    var user_psd = $("#super-admin-psd").val();

                    if(response.email_verification == "on"){
                        $('.verification-box').removeClass('d-none');
                        $('.login-form-box').addClass('d-none');
    
                        $('.verify-btn').attr('email', user_name);
                        $('.verify-btn').attr('psd', user_psd);
                    } else{

                        localStorage.setItem('super-admin-user', user_name);
                        localStorage.setItem('super-admin-psd', user_psd);
                        localStorage.setItem('admin-role-type', response.role_type);

                        window.location = "/admin/dashboard";
                    }

                }     
                 else {
                        $(".submit-btn").addClass("d-none");
                        $(".alert-danger").removeClass("d-none");
                        $(".alert-text").html(response.status);
    
                        setTimeout(function () {
                            $(".alert-danger").addClass("d-none");
                            $(".submit-btn").removeClass("d-none");
                        }, 2000);
                    }

                // return false;

                // if (response.status == "user match") {
                //     $(".alert-success").removeClass("d-none");

                //    var user_name = $("#super-admin-user").val();
                //    var user_psd = $("#super-admin-psd").val();


                //     localStorage.setItem('super-admin-user', user_name);
                //     localStorage.setItem('super-admin-psd', user_psd);
                //     localStorage.setItem('admin-role-type', response.role_type);

                //     setTimeout(function () {
                //         window.location = "/admin/dashboard";
                //     }, 1000);
                // } else {
                //     $(".submit-btn").addClass("d-none");
                //     $(".alert-danger").removeClass("d-none");
                //     $(".alert-text").html(response.status);

                //     setTimeout(function () {
                //         $(".alert-danger").addClass("d-none");
                //         $(".submit-btn").removeClass("d-none");
                //     }, 2000);
                // }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
                $(".submit-btn").removeClass("d-none");
                $('.loader').addClass("d-none");
            },
        });
    });
});

// Super Admin Verify
$(document).ready(function () {

    $('.verify-btn').click(function(){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var email = $(this).attr('email');
        var psd = $(this).attr('psd');
        var code = $('#super-admin-verification').val();
    
        $.ajax({
            url: "/super-admin-verify",
            method: "POST",
            data: {
                email : email,
                psd: psd,
                code: code,
            },
            beforeSend: function () {
                // setting a timeout
                $(".verify-btn").addClass("d-none");
                $('.loader').removeClass("d-none");
            },
            // Success
            success: function (response) {

                console.log(response);

                $('.loader').addClass("d-none");

                if (response.status == "Verify Success") {
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
                      $('#verify-message').removeClass('d-none');
                }

                setTimeout(function () {
                    $('#verify-message').addClass('d-none');
                    $(".verify-btn").removeClass("d-none");
                }, 2000);
 
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
