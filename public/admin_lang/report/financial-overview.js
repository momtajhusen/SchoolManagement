$(document).ready(function(){
    var date = NepaliFunctions.GetCurrentBsDate();
    var today = date.year+'-1-1';

    $("#expenses_start_date").val(today);

    $("#search-btn").click(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          var date = NepaliFunctions.GetCurrentBsDate();
          var currentYear = date.year;

         var startDate = $("#expenses_start_date").val();
         var endtDate = $("#expenses_end_date").val();

         $("#start-date-view").html(startDate);
         $("#end-date-view").html(endtDate);


 
          $.ajax({
              url: "/financial-overview",
              method: "GET",
              data: {
                startDate:startDate,
                endDate:endtDate,
                currentYear:currentYear,
              },
              success: function (response) {
      
                  console.log(response);


                 var TotalRevenue = response.NetProfit.TotalRevenue.toLocaleString('en-IN');
                 var TotalExpenses = response.NetProfit.TotalExpenses.toLocaleString('en-IN');
                 var Netprofit = response.NetProfit.NetProfit.toLocaleString('en-IN');

                 $(".revenue").html(TotalRevenue);
                 $(".expensive").html(TotalExpenses);
                 $(".net-profit").html(Netprofit);

                // Start Revenue Type 
                    $(".revenue-table").html('');
                    response.Revenue.forEach(function(data){
                      $(".revenue-table").append(`
                        <tr>
                          <td>`+data.feetype+`</td>
                          <td>₹ `+data.amount.toLocaleString('en-IN')+`</td>
                        </tr>
                      `);
                    });

                  $(".revenue-table").append(`
                    <tr>
                      <td>Total Rev (Disc. + Dues - Colle.)</td>
                      <td>₹ `+response.CollectionRevenue.toLocaleString('en-IN')+`</td>
                    </tr>
                  `);
                // End Revenue Type 

                // Start Expensive Type 
                  $(".expensive-table").html('');
                  response.Expenses.forEach(function(data){
                    $(".expensive-table").append(`
                      <tr>
                        <td>`+data.expensesType+`</td>
                        <td>₹ `+data.amount.toLocaleString('en-IN')+`</td>
                      </tr>
                    `);
                  });
                // End Expensive Type 
                
                ///////////// Start  Char  //////////////
                    var options = {
                      series: [
                      {
                          name: 'REVENUE',
                          data: response.FinancialChart.revenue,
                          color:'#007bff'
                      }, 
                    {
                      name: 'EXPENSES',
                      data: response.FinancialChart.expenses,
                      color:'#dc4c5d'
                    },
                    {
                      name: 'NET PROFIT',
                      data: response.FinancialChart.netprofit,
                      color:'#3cad61'

                    }, 
                  ],
                      chart: {
                      type: 'bar',
                      height: 320
                    },

                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded',
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    xaxis: {
                      categories: ['Bai', 'Jes', 'Ash', 'Shr', 'Bha', 'Aso', 'Kar', '	Man', 'Pou', 'Mag', 'Fal', 'Cha'],
                    },
                    yaxis: {
                      title: {
                        text: '₹ (thousands)'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function (val) {
                          return "₹ " + val  
                        }
                      }
                    }
                    };
                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                ///////////// End  Char /////////////////
                  

              },
              error: function (xhr, status, error) 
              {
                  console.log(xhr.responseText);
              },
      
          });

    });



});

$(window).on('load', function() {
    $("#search-btn").click();
});


