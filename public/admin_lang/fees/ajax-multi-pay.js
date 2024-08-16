// Take Payment Click Open Model
$(document).ready(function()
{
    $("#take-multi-pay").click(function(){

    $(".monthly_payment").attr("paymode","multi-pay");
        var monthsArray = [];
        var DuesFeeArray = [];
        var AlreadyPay = [];

        $(".form-check-input").each(function()
        {
            if($(this).val() == "on")
            {
                monthsArray.push($(this).attr("month"));
                DuesFeeArray.push($(this).attr("dues_fee"));
                AlreadyPay.push($(this).attr("paid"));

            }
        });

        if(monthsArray != "")
        {
 
 
        var student_id = $("#st_id").html();
        var select_month = $(this).attr("month");


        var totalDues = 0;
        var alreadyPay = 0;
        var withoutLastAmount = 0;
        for (var i = 0; i < DuesFeeArray.length; i++)
        {
            totalDues += parseFloat(DuesFeeArray[i]);
            alreadyPay += parseFloat(AlreadyPay[i]);
            if (i < DuesFeeArray.length) {
                withoutLastAmount =+ parseFloat(DuesFeeArray[i]);
            }
        }

            $("#last_month").val(withoutLastAmount);
            $("#actual_dues").val(totalDues);
            $("#payment").val(totalDues);
            $("#total_amount").html(totalDues);
            $("#discount").val("0");
            $("#percentage").val('0');
            $("#free").val("0");
            $("#comment_free_fee_box").addClass("d-none");
            $("#comment_for_discount").addClass("d-none");
            $(".already_pay").html(alreadyPay);

        $.ajax({
            url: "/get-multi-monthly-fee",
            method: "GET",
            data: {
                student_id: student_id,
                year: current_year,
                months: JSON.stringify(monthsArray),
            },
            beforeSend: function () {
                $(".fee_stracture").html(`<tr><td colspan='2' class='text-center'>
                    <span class="material-symbols-outlined">clock_loader_10</span>
                </td></tr>`);
              },
            success: function (response) {
                console.log(response);
                $(".fee_stracture").html("");
                var feeTypeWithAmount = response.FeeTypeWithAmount;
                var feeTypeMonth = [];

                var already_pay = Number($(".already_pay").html());

                if(already_pay != "0"){
                    var feetype_visible = 'd-none';
                    }
                    else{
                    var feetype_visible = '';
                    }

                for (const [feeType, feeAmount] of Object.entries(
                    feeTypeWithAmount
                )) {
                    $(".fee_stracture").append(`
                        <tr>
                        <td class="d-none"><input id="feetype_checkbox" class="`+feetype_visible+`" fee="`+feeAmount+`" type="checkbox" checked style="cursor:pointer;"> `+feeType +`</td>
                        <td>`+feeType+`</td>
                        <td>` +feeAmount +`</td></tr>
                    `);

                    feeTypeMonth.push(feeType+": "+feeAmount);
                }

                $(".monthly_payment").attr("feeType",feeTypeMonth);
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

        }
        else{
        alert("Please Select Month");
        }

    });
});


// checkbox click val set on or "" 
$(document).ready(function(){
    $(".payment-table").on("click", ".form-check-input", function () {
       
        var checkboxAbove = $(this).closest("tr").prev().find(".form-check-input");
        // if (checkboxAbove.length > 0 && !checkboxAbove.is(':checked')) {
        //     alert("Please select the above month before select this month.");
        //     $(this).prop("checked", false);
        // }
        // else{
            // Check if the first checkbox is checked
            if ($(this).is(":checked"))
            { 
                $(this).val("on");
            }
            else{
                $(this).val("");  
            }
        // }
        
        // Get all the checked checkboxes
        var checkedBoxes = $(".form-check-input:checked");
        // Check if any checkbox is unchecked in the middle
        // for (var i = 0; i < checkedBoxes.length - 1; i++) {
        //     var currentBox = checkedBoxes.eq(i);
        //     var nextBox = checkedBoxes.eq(i + 1);
        //     var currentBoxRow = currentBox.closest("tr").index();
        //     var nextBoxRow = nextBox.closest("tr").index();
        //     if (nextBoxRow - currentBoxRow > 1) {
        //         alert("Please unselect the below month before unselect this month.");
        //         $(this).prop("checked", true);
        //         // Prevent the value from changing
        //         $(this).prop("value", "on");
        //         break;
        //     }
        // }

        // Count the number of checked checkboxes
        var checkedCount = checkedBoxes.length;
        // Check if the number of checked checkboxes is less than 2
        if (checkedCount < 2) 
        {
           $("#take-multi-pay").addClass("d-none");
        }
        else{
            $("#take-multi-pay").removeClass("d-none");
        }
        
    });
});


// payment checkbox remove 
$(document).ready(function(){

    $(".search-btn").click(function(){
        setTimeout(function(){
            $(".form-check").each(function(){
                if($(this).hasClass('d-none')){
                    $(this).remove();
                }
            });
        },500);
    });
});



 

