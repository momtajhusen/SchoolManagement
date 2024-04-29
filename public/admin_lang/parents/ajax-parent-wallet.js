// Load Balance 
$(document).ready(function(){
    $(".blance-load-form").submit(function (e) {
        e.preventDefault();
    
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
 
        var parent_id = $("#parent-id").val();

        var formData = new FormData(this);
        formData.append("parent_id", parent_id);
 


        $.ajax({
            url: "/parent-blance-load",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) 
            {
 
               console.log(response);
               if(response.status == "load sucess"){
                  $("#close-load-model").click();
                  $(".blance-load-form")[0].reset();

                  WalletData();

                  Swal.fire({
                    title: "Amount Load success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  });

               }

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            }

        });
    
    });
});

$(document).ready(function(){
    WalletData();
});


function WalletData(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var parent_id = $("#parent-id").val();

    $.ajax({
        url:  "/get-parent-wallet-data",
        method: 'GET',
        data:{
            pr_id: parent_id,
        },
         // Success 
         success:function(response)
         {
 
            console.log(response);
 
            $("#advance_amount").html(response.TotalAdvancePaymentAmount ?? 0);
            $("#hostel_deposite").html(response.TotalHostelDepositeAmount  ?? 0);

         },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
};