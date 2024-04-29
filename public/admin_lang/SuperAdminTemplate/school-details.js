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

             $(".schoolo_logo_preview").attr("src", currentDomainWithProtocol+"/storage/"+response.data[0].logo_img);
             $('.school_name').html(response.data[0].school_name);
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
 
});


