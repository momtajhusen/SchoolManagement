$(document).ready(function(){
    $('.fee-ledger-select').on('change', function(){
         var fee_year = $(this).val();
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
 
         $.ajax({
             url: "/admin/get-fee-ledger",
             method: "GET",
             data: {
                 fee_year: fee_year,
             },
             success: function (response) {
                 console.log(response);
                 
                 
                 $('.fee_ledger').html('');
 
                 var total_fee = 0;
                 var total_discount = 0;
                 var total_payment = 0;
                 var total_dues = 0;
 
                 response.FeeLedger.forEach((element, index) => {
                     total_fee += Number(element.total_fee);
                     total_discount += Number(element.total_discount);
                     total_payment += Number(element.total_payment);
                     total_dues += Number(element.total_dues) ?? 0;
 
                     $('.fee_ledger').append(`
                         <tr>
                             <th scope="row">${index + 1}</th>
                             <td>${element.class_year}</td>
                             <td>${element.st_id}</td>
                             <td>${element.class}</td>
                             <td>${element.total_fee}</td>
                             <td>${element.total_discount}</td>
                             <td>${element.total_payment}</td>
                             <td>${element.total_dues ?? 0}</td>
                         </tr>
                     `);
                 });
 
                 $('.total_fee_ledger').html(`
                     <tr>
                         <th colspan='4'>Total : ${fee_year}</th>
                         <td>${total_fee}</td>
                         <td>${total_discount}</td>
                         <td>${total_payment}</td>
                         <td>${total_dues}</td>
                     </tr>
                 `);
             },
             error: function (xhr, status, error) {
                 console.log(xhr.responseText);
             },
         });
    });
 });
 