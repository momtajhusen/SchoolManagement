
//Single Monthly fee payment 
$(document).ready(function () 
{
    $(".monthly_payment").click(function () {

        var payment_date =  $("#payment_date").val();
        if(!NepaliFunctions.ValidateBsDate(payment_date)){
            alert("Invalid Payment Date !");
            return false;
        }

        if($(".monthly_payment").attr("paymode") == "monthly")
        {

            // Comment input check 
            if (!$("#comment_free_fee_box").hasClass("d-none")) {
                var comment = $("#comment_free_fee").val().trim();
                if (comment === "") {
                    alert("Please comment why this fee is free.");
                    return false;
                } else if (comment.length <= 1) {
                    alert("Comment must be more than 1 characters.");
                    return false;
                }
            }
            

            var feeType = $(".monthly_payment").attr("feeType");
            console.log(feeType); // Assuming you want to see the value of feeType in the console
            
 
            var totalFee = $("#actual_dues").val();
            var payment = $("#payment").val();
            var already_pay = $(".already_pay").html();
            var free_fee_pay = $(".free_fee_pay").html();

            var discount = $("#discount").val() || 0;
            var free = $("#free").val() || 0;
            var comment_free_fee = $("#comment_free_fee").val() || "";
            var comment_discount = $("#comment_discount").val() || "";

     
            var class_select = $("#class-select").val();
            var roll = $(".roll-select").val();
    
            var select_month =  $("#select_month").val();
            var select_year = NepaliFunctions.GetCurrentBsDate().year;
            var payment_date =  $("#payment_date").val();
            var student_id = $("#student_id").val();

            var totalClassFee = $("#totalClassFee").html();
            var totalClassPay = $("#totalClassPay").html();
            var totalClassDis = $("#totalClassDis").html();
            var totalFreeFee = $("#totalFreeFee").html();
            var totalClassDue = $("#totalClassDue").html();

            var totalClassDue = $("#totalClassDue").html();
 
      
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
    
                $.ajax({
                    url: "/monthly-fee-collect",
                    method: "POST",
                    data: {
                        totalFee: totalFee,
                        payment: payment,
                        already_pay:already_pay,
                        already_free:free_fee_pay,
                        discount: discount,
                        free_fee: free,
                        comment_free_fee:comment_free_fee,
                        comment_discount:comment_discount,
                        class: class_select,
                        roll: roll,
                        select_year: select_year,
                        payment_date: payment_date,
                        select_month: select_month,
                        feeType: feeType,
                        student_id: student_id,
                        totalClassFee:totalClassFee,
                        totalClassPay:totalClassPay,
                        totalClassDis:totalClassDis,
                        totalFreeFee:totalFreeFee,
                        totalClassDue:totalClassDue,
                    },
                    beforeSend: function() 
                    {
                     // setting a timeout
                       $(".monthly_payment").addClass('d-none');
                       $("#payment-loading").removeClass('d-none');
                    },
                    // Success
                    success: function (response) {

                        console.log(response);

                        // alert(response);
                        // return false;
         
                        $("#payment-cancle").click();
                        $(".search-btn").click();
                        $("#history-btn").click();;

                        Swal.fire({
                            title: 'Payment Success!',
                            text: "Do you want to print the bill?",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#00032e',
                            cancelButtonColor: '#00032e',
                            confirmButtonText: 'Bill Print !',
                            cancelButtonText: 'No Bill Print !',
                          }).then((result) => {
                            if (result.isConfirmed) {
                              $(".last-bill").click();
                              setTimeout(function(){
                                $("#printBtn").click();
                                $("#bill-modal-cancle").click();
                              },500);
                            }
                          });
                          
    
                        $("#actual_dues").val("0");
                        $("#payment").val("0");
                        $("#discount").val("0");
                        $(".monthly_payment").removeClass('d-none');
                        $("#payment-loading").addClass('d-none');
    
    
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });
 
        }
    });
});

 // Multi payment 
$(document).ready(function () 
{
    $(".monthly_payment").click(function () {


        if($(".monthly_payment").attr("paymode") == "multi-pay")
        {

          // Please Unselect Last Month
            var totalPayment = Number($("#actual_dues").val());
            var payment = Number($("#payment").val());
            var discount = Number($("#discount").val());
            var PayableAmount =  payment+discount;
      
            var last_month = $("#last_month").val();
            var due = totalPayment - PayableAmount;
 
            if(Number(last_month) <= Number(due))
            {
               alert("Please Unselect Last Month");
               $("#payment").val(totalPayment);
               $("#payment-cancle").click();

               return false;
            }


            // Comment input check 
            if (!$("#comment_free_fee_box").hasClass("d-none")) 
            {
                var comment = $("#comment_free_fee").val().trim();
                if (comment === "") {
                    alert("Please comment why this fee is free.");
                    return false;
                } else if (comment.length <= 1) {
                    alert("Comment must be more than 1 characters.");
                    return false;
                }
            }

            var feeType = $(".monthly_payment").attr("feeType");
            var totalFee = $("#actual_dues").val();
            var payment = $("#payment").val();
            var already_pay = $(".already_pay").html();
            var discount = $("#discount").val() || 0;
            var comment_free_fee = $("#comment_free_fee").val() || "";
            var comment_discount = $("#comment_discount").val() || "";
            var free = $("#free").val() || 0;
            var select_year = NepaliFunctions.GetCurrentBsDate().year;
            var payment_date =  $("#payment_date").val();
            var student_id = $("#student_id").val();

            var totalClassFee = $("#totalClassFee").html();
            var totalClassPay = $("#totalClassPay").html();
            var totalClassDis = $("#totalClassDis").html();
            var totalClassDue = $("#totalClassDue").html();
 
 
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                var MonthsArray = [];
                var DuesFeeArray = [];
                var AlredyPay = [];

                $(".form-check-input").each(function(){
                    if($(this).val() == "on")
                    {
                       MonthsArray.push($(this).attr("month"));
                       DuesFeeArray.push($(this).attr("dues_fee"));
                       AlredyPay.push($(this).attr("paid"));
                    }
                 });
    
 
                $.ajax({
                    url: "/multy-pay-collect",
                    method: "POST",
                    data: {
                        totalFee: totalFee,
                        payment: payment,
                        already_pay:already_pay,
                        discount: discount,
                        free_fee: free,
                        comment_free_fee: comment_free_fee,
                        comment_discount: comment_discount,
                        year: select_year,
                        payment_date: payment_date,
                        months: JSON.stringify(MonthsArray),
                        dues: JSON.stringify(DuesFeeArray),
                        paid: JSON.stringify(AlredyPay),
                        feeType: feeType,
                        student_id: student_id,
                        totalClassFee:totalClassFee,
                        totalClassPay:totalClassPay,
                        totalClassDis:totalClassDis,
                        totalClassDue:totalClassDue,
                    },
                    beforeSend: function() 
                    {
                     // setting a timeout
                    //    $(".monthly_payment").addClass('d-none');
                       $("#payment-loading").removeClass('d-none');
                    },
                    // Success
                    success: function (response) {

                        console.log(response);


                        // return false;

                        $("#payment-cancle").click();
                        $(".search-btn").click();
                        $("#history-btn").click();
    
                        Swal.fire({
                            title: 'Payment Success!',
                            text: "Do you want to print the bill?",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#00032e',
                            cancelButtonColor: '#00032e',
                            confirmButtonText: 'Bill Print !',
                            cancelButtonText: 'No Bill Print !',
                          }).then((result) => {
                            if (result.isConfirmed) {
                              $(".last-bill").click();
                              setTimeout(function(){
                                $("#printBtn").click();
                                $("#bill-modal-cancle").click();
                              },500);
                            }
                          })
    
                        $("#actual_dues").val("0");
                        $("#payment").val("0");
                        $("#discount").val("0");
                        $("#take-multi-pay").addClass("d-none");
                        $(".monthly_payment").removeClass('d-none');
                        $("#payment-loading").addClass('d-none');
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });
 
        }
    });
});

// Back yearly payment
$(document).ready(function(){
    $(".yearly_payment").click(function(){
      var actual_dues_year =   $("#actual_dues_year").val();
      var payment_year =    $("#payment_year").val();
      var dues_year = $(".dues_year").val();
      var student_select = $(".student-select").val();
      var payment_date =  $("#back_year_paid_date").val();

      var current_year = NepaliFunctions.GetCurrentBsDate().year;
 
      if(payment_year > 0)
      {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/lastyear-fee-collect",
            method: "POST",
            data: {
                student_select:student_select,
                actual_dues_year: actual_dues_year,
                payment_year:payment_year,
                dues_year:dues_year,
                current_year:current_year,
                payment_date:payment_date,
            },
             // Success
             success: function (response) {

                console.log(response);
 
                $("#backYearModal").click();
                $(".search-btn").click();
                $("#history-btn").click();

                Swal.fire({
                    title: 'Payment Success!',
                    text: "Do you want to print the bill?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#00032e',
                    cancelButtonColor: '#00032e',
                    confirmButtonText: 'Bill Print !',
                    cancelButtonText: 'No Bill Print !',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      $(".last-bill").click();
                      setTimeout(function(){
                        $("#printBtn").click();
                        $("#bill-modal-cancle").click();
                      },500);
                    }
                  })

                $("#actual_dues_year").val("0");
                $("#payment_year").val("0");

             },error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });
 
      }
      else{
        alert("please Enter Payment");

      }


    });
});

// class on change 
$(document).ready(function (){
     $("#class-select").on("change", function(){
        $(".payment-table").html('');
        $(".history-table").html('');
        $("#student_image").attr("src","http://bit.ly/3IUenmf");
        $("#name").html("Student Name");
        $("#class").html("");
        $("#roll").html("");
        $("#hostel_outi").html("");
        $("#transport_use").html("")
        $("#root").html("");
        $(".roll-box").addClass("animate__tada");
        setTimeout(function(){
            $(".roll-box").removeClass("animate__tada");
        },800);
     });

     $(".student-select").on("change", function(){
        $(".search-btn").click();
        $("#history-btn").click();
     });
});

$(document).ready(function (){
    $(".roll-select").on("change", function(){
       $(".payment-table").html('');
       $(".history-table").html('');
       $("#student_image").attr("src","http://bit.ly/3IUenmf");
       $("#name").html("Student Name");
       $("#class").html("");
       $("#roll").html("");
       $("#hostel_outi").html("");
       $("#transport_use").html("")
       $("#root").html("");
    //    $(".search-btn").click();
       $(".search-btn").addClass("animate__tada");
       $(".search-btn").html("Click Me");
       setTimeout(function(){
           $(".search-btn").removeClass("animate__tada");
       },800);
    });
});

// Manage backyear fee manualy 
$(document).ready(function(){
     $("#back_year_manage").submit(function(e){
           e.preventDefault();
           
           $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

       var st_id = $("#st_id").html();
       var st_class = $("#class").html();


        var formData = new FormData(this);
        formData.append("st_id", st_id);
        formData.append("st_class", st_class);

        $.ajax({
                url: "/manual-backyear-fee",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,

            success: function (response) {

                alert(response);
     

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });




     });
});

// Manage backyear fee toggle show
$(document).ready(function(){
    $(".arrow-backyear").click(function(){
        if ($("#back_year_manage").hasClass("d-none")){
            $("#back_year_manage").removeClass("d-none");
            $(this).html("keyboard_arrow_down");
        } else {
            $("#back_year_manage").addClass("d-none");
            $(this).html("keyboard_arrow_up");

        }        
    });
});
 