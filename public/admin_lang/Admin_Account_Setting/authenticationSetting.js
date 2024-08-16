$(document).ready(function() {
    // Common AJAX setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Function to handle initial verification check on page load
    function initialVerificationCheck() {
        $.ajax({
            url: "/email-verification-check",
            method: "POST",
            beforeSend: function() {
                $('.email-verification-btn').html("<i class='fa fa-circle-o-notch fa-spin' style='font-size:15px'></i>");
                $('.email-verification-btn').prop('disabled', true); // Button disable kar rahe hain
            },
            success: function(response) {
                if (response.verification == 'off') {
                    $('.email-verification-btn').html('Enable');
                } else {
                    $('.email-verification-btn').html('Disable');
                }
                console.log(response);
            },
            complete: function() {
                $('.email-verification-btn').prop('disabled', false); // Button enable kar rahe hain
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    }

    // Function to handle email verification update with alerts
    function updateEmailVerification() {
        $.ajax({
            url: "/email-verification-enable",
            method: "POST",
            beforeSend: function() {
                $('.email-verification-btn').html("<i class='fa fa-circle-o-notch fa-spin' style='font-size:15px'></i>");
                $('.email-verification-btn').prop('disabled', true); // Button disable kar rahe hain
            },
            success: function(response) {
                if (response.verification == 'off') {
                    $('.email-verification-btn').html('Enable');
                    Swal.fire({
                        title: 'Disable Success Email Verification',
                        text: "Now you login than dont ask verification code",
                        icon: 'success',
                        confirmButtonColor: '#00032e',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    $('.email-verification-btn').html('Disable');
                    Swal.fire({
                        title: 'Enable Success Email Verification',
                        text: "Now you login than ask verification code",
                        icon: 'success',
                        confirmButtonColor: '#00032e',
                        confirmButtonText: 'Ok',
                    });
                }
                console.log(response);
            },
            complete: function() {
                $('.email-verification-btn').prop('disabled', false); // Button enable kar rahe hain
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    }

    // Initial verification check on page load (without alerts)
    initialVerificationCheck();

    // Handle button click to update verification status (with alerts)
    $('.email-verification-btn').click(function() {
        updateEmailVerification();
    });
});
