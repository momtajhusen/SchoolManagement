

$(document).ready(function(){
    var today = current_year+'-'+current_month+'-'+current_day;

    $(".expenses_start_date, .expenses_end_date").val(today);


    $("#search-btn").click(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

         var startDate = $(".expenses_start_date").val();
         var endtDate = $(".expenses_end_date").val();

 
          $.ajax({
              url: "/get-expense-reports",
              method: "GET",
              data: {
                startDate:startDate,
                endDate:endtDate
              },
              success: function (response) {
      
                  console.log(response);

                  $(".expense-report-table").html('');
                  var totalExpense = 0;
                  var count = 0;
                  var index = 1;
                  var length = response.data.length;
                  response.data.forEach(function(data){
                   var increase = count++
                   var sn = length--;

                   totalExpense += Number(data.amount);
                   $(".expense-report-table").append(`
                        <tr>
                        <th nowrap="nowrap">`+sn+`</th>
                        <td nowrap="nowrap">`+data.expenses_name+`</td>
                        <td nowrap="nowrap">`+Number(data.amount)+`</td>
                        <td nowrap="nowrap">`+data.expenses_date+`</td>
                        </tr>
                   `);

                  });

                  $(".total-expense").html(totalExpense);

              },
              error: function (xhr, status, error) 
              {
                  console.log(xhr.responseText);
              },
      
          });

    });
});

setTimeout(function(){
    $("#search-btn").trigger('click');

},1000);

 