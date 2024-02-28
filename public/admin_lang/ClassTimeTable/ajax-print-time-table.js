// get all period subject 
$(document).ready(function () {
    $(".search-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var classes = $("#search-class").val();
        var section = $("#search-section").val();

 

        $.ajax({
            url: "/get-subject-period",
            method: "GET",
            data:{
                class:classes,
                section:section
            },
            // Success
            success: function (response) {

                console.log(response);

                if (response.data) {
                    var count = 0;
                    $(".time-table-view").html('');
                    response.data.forEach(function (data) {
                        var increase = count++;
                        var id = response.data[increase].id;
                        var classes = response.data[increase].class;
                        var section = response.data[increase].section;
                        var day = response.data[increase].day;

                        $("#time-table-class").html(classes+' '+section);


                        var period_data = response.data[increase].period_data;

                        var timeTableHTML = '<tr><td class="text-center" scope="row">' + day + '</td>';
                        
                        for (var i = 1; i <= response.ClassPeriod.length; i++) {
                            var period = period_data['period_' + i];
                            var teacher = period_data['period_' + i + '_teacher'];
                            
                            timeTableHTML += `<td scope="row">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span>`+period+`</span>
                                                    <span class="mt-2" style="font-size:12px;">`+teacher+`</span>
                                                </div>
                                              </td>`;
                        }
                        
                        timeTableHTML += '</tr>';
                        
                        $(".time-table-view").append(timeTableHTML);
                        
                      
                    });
                } 

                if(response.ClassPeriod){
                    $(".period-time").html('');
                    $(".period-time").append(`<th class="text-center">Days ↓ Times →</th>`);
                    response.ClassPeriod.forEach(function (data) {
                        var time = data.start_time;

                        // Split the time into hours and minutes
                        var timeArray = time.split(':');
                        var hours = parseInt(timeArray[0], 10);
                        var minutes = timeArray[1];

                        // Determine whether it's AM or PM
                        var period = hours >= 12 ? "PM" : "AM";

                        // Convert hours to 12-hour format
                        if (hours > 12) {
                            hours -= 12;
                        }

                        // Format the time in AM/PM format
                        var amPmTime = hours + ":" + minutes + " " + period;

                        $(".period-time").append(`<th class="text-center">`+amPmTime+`</th>`);
                    });
                }


                else{
                    $(".period-time").html(``);
                    $(".time-table-view").html(`
                        <tr><td class="text-center" scope="row">Time table not create this class `+classes+' '+section+`</th></tr>
                    `);
                    setTimeout(() => {
                        $(".time-table-view").html('');
                    }, 2000);
                    $("#time-table-class").html('');
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});

 