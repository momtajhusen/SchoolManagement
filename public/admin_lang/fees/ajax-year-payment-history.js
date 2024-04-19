// Year Fee Payment  History 
$(document).ready(function(){
    $("body").on("click", "#year-fee-details", function(){


        alert();
 
        var year =  $(this).attr("year");
        var st_id =  $(this).attr("st_id");

        $("#last-year-model").html(year);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            url: "/year-fee-details",
            method: "GET",
            data: {
                year: year,
                student_id:st_id,
            },
            success: function (response) 
            {
                console.log(response);

                var MonthArry = {
                    "month_0": "Baishakh",
                    "month_1": "Jestha",
                    "month_2": "Ashadh",
                    "month_3": "Shrawan",
                    "month_4": "Bhadau",
                    "month_5": "Asoj",
                    "month_6": "Kartik",
                    "month_7": "Mangsir",
                    "month_8": "Poush",
                    "month_9": "Magh",
                    "month_10": "Falgun",
                    "month_11": "Chaitra"
                  };
 

                var PaymentHistoryLength = response.PaymentHistory.length;

                $(".last-year-history-table").html(``);
                for (var i = 0; i < PaymentHistoryLength; i++) 
                {

                    var history_id = response.PaymentHistory[i].id;
                    var payment = response.PaymentHistory[i].payment;
                    var discount = response.PaymentHistory[i].discount;
                    var dues = response.PaymentHistory[i].dues;
                    var pay_date = response.PaymentHistory[i].pay_date;
                    var pay_month = response.PaymentHistory[i].pay_month;



                    if (typeof pay_month === "string" && pay_month.includes("[") && pay_month.includes("]")) 
                    {
                      var pay_month_array = JSON.parse(pay_month);
                      var month_lenghth = pay_month_array.length;
                      var firstMonth = MonthArry[pay_month_array[0]];
                      var lastMonth = MonthArry[pay_month_array[month_lenghth-1]];
                      var months = `${firstMonth} to ${lastMonth}`;
                    } 
                    else{
                        var months = MonthArry[pay_month];
                    }


                    $(".last-year-history-table").append(`
                    <tr>
                      <td scope="row">`+i+`</td>
                      <td scope="row">`+months+`</td>
                      <td scope="row">`+payment+`</td>
                      <td scope="row">`+discount+`</td>
                      <td scope="row">`+dues+`</td>
                      <td scope="row">`+pay_date+`</td>
                    </tr> 
                `);

                }
 
                 
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);

            },
        });

   });
});