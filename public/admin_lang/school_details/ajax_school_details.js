// Update School Details 
$(document).ready(function () {
    $(".school-details-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        
        var formData = new FormData(this);
 
        $.ajax({
            url: "/school-details",
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
            success: function (response) 
            {

                if(response.status == "upload sucess")
                {
                    Swal.fire({
                        title: "Update Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      });
                }
                else if(response.status == "failed something error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went Error ! Contact Developer',
                      });
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went Error ! Contact Developer',
                      });
                }
                $(".progress").addClass("d-none");

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});

// Retrive School Details 
$(document).ready(function () {
 
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
 
        $.ajax({
            url: "/school-details",
            method: "GET",
            // Success
            success: function (response) 
            {

             console.log(response.data[0].logo_img);

             var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

             $("#schoolo_logo_preview").attr("src", currentDomainWithProtocol+"/storage/"+response.data[0].logo_img);
             $('input[name="school_name"]').val(response.data[0].school_name);
             $('input[name="phone"]').val(response.data[0].phone);
             $('input[name="email"]').val(response.data[0].email);
             $('input[name="address"]').val(response.data[0].address);
             $('input[name="website"]').val(response.data[0].website);
             $('input[name="pan_no"]').val(response.data[0].pan_no);
             $('input[name="estd_year"]').val(response.data[0].estd_year);


 

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
 
});


