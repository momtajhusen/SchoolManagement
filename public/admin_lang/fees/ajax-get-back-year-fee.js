$(document).ready(function(){
     $("#back-year-btn").click(function(){

         if ($(".payment-table").html() != "") 
         {

            var current_year = NepaliFunctions.GetCurrentBsDate().year;
            var st_id = $("#back-year-btn").attr("st_id");

            $.ajaxSetup({
               headers: {
                   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                       "content"
                   ),
               },
           });

           $.ajax({
            url: "/back-year-fee",
            method: "GET",
            data: {
                year: current_year,
                student_id:st_id,
            },
            success: function (response) 
            {
                console.log(response);
                $(".back-year-fee-table").html(``);
                if(response.message != "data not found")
                {
                    var count = 0;
                    response.YearPaymentFee.forEach(function(){
                        var increase = count++



                        // Studenta data 
                        var st_id = response.YearPaymentFee[increase].st_id;
                        var class_year = response.YearPaymentFee[increase].class_year;
                        var classes = response.YearPaymentFee[increase].class;
                        var total_fee = response.YearPaymentFee[increase].total_fee;
                        var total_payment = response.YearPaymentFee[increase].total_payment;
                        var total_discount = response.YearPaymentFee[increase].total_discount;
                        var free_fee = response.YearPaymentFee[increase].free_fee;


                        // var dues = parseFloat(total_fee)-parseFloat(total_payment)+parseFloat(total_discount);
 
                        var dues = Math.abs(Number(total_payment) + Number(total_discount) + Number(free_fee) - Number(total_fee));
 

                        var pay_texts = dues == 0 ? "Paid" : "Unpaid";
                        var pay_bg = dues == 0 ? "bg-success" : "bg-danger";
                        var displ = dues == 0 ? "d-none" : "";
                        
                        
                        $(".back-year-fee-table").append(`  
                        <tr>
                        <td>`+st_id+`</td>
                        <td>`+class_year+`</td>
                        <td>`+classes+`</td>
                        <td>`+total_fee+`</td>
                        <td>`+total_payment+`</td>
                        <td>`+total_discount+`</td>
                        <td>`+dues+`</td>
                        <td>
                          <span class=" bg-none border-0 text-light rounded px-4">`+pay_texts+`</span>
                         </td>
                         <td class="`+displ+`">
                            <button id="year-fee-details" year="`+class_year+`" st_id="`+st_id+`" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Check Fee Detaild" data-toggle="modal" data-target="#lastyearfeedetails">
                               <span style="font-size:15px;">Fee Details</span> 
                            </button>
                         </td>
                       </tr>`);


                    });

                }
                else{
                    $(".back-year-fee-table").html(``); 
                    $(".back-year-fee-table").append(`
                       <th colspan="7" class="border"><center>Data Not Found</center></th>
                    `);
                }
                 
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
 
         }
         else{
            alert("Please Click on Search Btn");
         }
     });
});



$('#YearDetailscloseBtn').click(function() {
    $('#lastyearfeedetails').click();
  });