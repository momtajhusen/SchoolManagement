$(document).ready(function(){
     $(".payment-now").click(function(){

        var totalFee = $(".total_amount").html();
        var payment = $("#payment").val();
        var discount = $("#discount").val();
        var class_select = $(".s_class").html();
        var roll = $(".s_roll").html();


        var start_month = $(".start-month").val();
        var end_month = $(".end-month").val();
        var select_year = $(".select-year").val();


        if(payment != "" && payment != "0")
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(discount == "")
            {
                discount = "0";
            }
     
            $.ajax({
                url: "/fee-payment",
                method: 'POST',
                data:{
                    totalFee : totalFee,
                    payment : payment,
                    discount : discount,
                    class : class_select,
                    roll : roll,
                    select_year : select_year,
                    start_month : start_month,
                    end_month : end_month,
                },
                // Success 
                success:function(response)
                {
                  alert(response);
                  $(".search-btn").click();
                }
              });

        }

        else{
            alert("Enter Payment Amount ");
        }

      



     });
}); 