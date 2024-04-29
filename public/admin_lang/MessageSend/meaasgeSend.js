$(document).ready(function() {
    $('#send-mail-form').submit(function(e) {
        e.preventDefault();

            if($("input[name='teachers']").val() == "message" || $("input[name='parents']").val() == "message")
            {
                
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/sendemail/send",
                data: {
                    subject : $("input[name='subject']").val(),
                    message : $("#form-message").val(),
                    teachers : $("input[name='teachers']").val(),
                    parents : $("input[name='parents']").val(),

                },
                beforeSend: function () {
                    // setting a timeout
                    $("#message_send_btn").addClass("d-none");
                },
                success: function(response) 
                {
                    alert('Email sent successfully');
                    $("#message_send_btn").removeClass("d-none");

                },
                error: function(xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                }
            });

        }

        else{
            alert('please select who want you message !');

        }
 
    });
});
