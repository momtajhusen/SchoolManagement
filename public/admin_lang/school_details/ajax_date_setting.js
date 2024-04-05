// date setting Update Details 
$(document).ready(function () {
    $(".date-setting-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });



        if($(".use_date").val() == "internet-date")
        {

            var using_date =  $(".use_date").val(); 
            var select_year = current_year;
            var select_month = current_month; 
        }
        else{
            var using_date =  $(".use_date").val();
            var select_year = $(".year").val();
            var select_month = $(".months").val();
        }
        
 
        $.ajax({
            url: "/date-setting",
            method: "POST",
            data: {
                using_date:using_date,
                select_year:select_year,
                select_month:select_month,
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

// Retrive Date Setting
$(document).ready(function () {
 
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/date-setting",
        method: "GET",
        // Success
        success: function (response) 
        {

            if(response.data[0].using_date == "internet-date")
            {
                $(".use_date option").filter(function (){
                    return $(this).val() == response.data[0].using_date;
                }).prop("selected", true);
       
                $(".year option").filter(function (){
                   return $(this).val() == current_year;
               }).prop("selected", true);
       
               $(".months option").filter(function (){
                   return $(this).val() == current_month;
               }).prop("selected", true);
            }

            else{
                $(".use_date option").filter(function (){
                    return $(this).val() == response.data[0].using_date;
                }).prop("selected", true);
       
                $(".year option").filter(function (){
                   return $(this).val() == response.data[0].year;
               }).prop("selected", true);
       
               $(".months option").filter(function (){
                   return $(this).val() == response.data[0].months;
               }).prop("selected", true);
            }
 
 
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

});