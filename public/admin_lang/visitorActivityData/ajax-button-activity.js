// Get Page Activity
$(document).ready(function(){
    var today = current_year+'-'+current_month+'-'+current_day;
    $(".activity_start_date, .activity_end_date").val(today);

    $("#search-btn").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

         var startDate = $(".activity_start_date").val();
         var endtDate = $(".activity_end_date").val();

         var orderBy = $("#select-spend").val();
         var visitorName = $("#visitor-name").val();

          $.ajax({
              url: "/get-button-activity",
              method: "GET",
              data: {
                startDate:startDate,
                endDate:endtDate,
                orderBy:orderBy,
                visitorName:visitorName,
              },
              success: function (response) {
      
                  console.log(response);
 
                  $(".activity-report-table").html('');
                  var index = 1;
                  response.data.forEach(function(data){
                   var sn = index++;

                    // Calculate ago time using moment.js
                    var lastVisitTime = moment(data.last_time, 'h:mm:ss A');
                    var ago = lastVisitTime.fromNow();
 
                   $(".activity-report-table").append(`
                        <tr>
                            <th>`+sn+`</th>
                            <td>`+data.name+`</td>
                            <td>`+data.button+`</td>
                            <td>`+data.clicking+`</td>
                            <td>`+data.page+`</td>
                            <td>`+data.last_time+`</td>
                            <td>`+ago+`</td>
                            <td>`+data.date+`</td>
                            <td>`+data.device+`</td>
                            <td>`+data.browser+`</td>
                            <td>`+data.address+`</td>
                        </tr>
                   `);

                  });

                //   $("#visitor-name").html(`<option>A-Z</option>`);
                if ($("#visitor-name option").length === 1) {
                    response.VisitorName.forEach(function(data, index){
                        $("#visitor-name").append(`
                            <option>`+ response.VisitorName[index]+`</option>
                        `);
                    });
                }

              },
              error: function (xhr, status, error) 
              {
                  console.log(xhr.responseText);
              },
      
          });

    });   
});

// Onchange Click 
$(document).ready(function(){
    $("#search-btn").click();
    $("#select-spend, #visitor-name").on("change", function(){
        $("#search-btn").click();
    });
});
 

