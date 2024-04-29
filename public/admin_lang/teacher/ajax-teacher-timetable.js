$(document).ready(function(){
     
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });


    $.ajax({
        url: "/get-teacher-timetable",
        method: "GET",
        // Success
        success: function (response) {

 
            console.log(response);

            // return false;
 
            if (response.data) {
                $(".time-table-view").html('');
                response.data.forEach(function (data) {
                    var teacherInfo = data;
                    var teacherPeriods = teacherInfo.teacherPeriods;
                    var periods = ['period_1', 'period_2', 'period_3', 'period_4', 'period_5', 'period_6', 'period_7', 'period_8', 'period_9', 'period_10'];
            
                    var TeacherPeriod = periods.map(function (period) {
                        var classSection = teacherPeriods[period] || { class: '', section: '' };
                        return `<td class="text-center">
                           

                            <div class="d-flex flex-column align-items-center">
                                <span>${classSection.class} ${classSection.section}</span>
                                <span style="font-size:12px;">${classSection.subject ? classSection.subject : ""}</span>
                           </div>

                        </td>`;
                    }).join('');
            
                    $(".time-table-view").append(`
                        <tr>
                            <td class="text-center">${teacherInfo.first_name} ${teacherInfo.last_name}</td>
                            ${TeacherPeriod}
                        </tr>
                    `);
                });
            }
            
            if (response.ClassPeriod) {
                $(".period-time").html('');
                $(".period-time").append(`<th class="text-center">Teachers ↓ Times →</th>`);
                response.ClassPeriod.forEach(function (data) {
                    var timeArray = data.start_time.split(':');
                    var hours = parseInt(timeArray[0], 10);
                    var minutes = timeArray[1];
                    var period = hours >= 12 ? "PM" : "AM";
                    hours = hours > 12 ? hours - 12 : hours;
                    var amPmTime = hours + ":" + minutes + " " + period;
                    $(".period-time").append(`<th class="text-center">${amPmTime}</th>`);
                });
            }
            
            else{
                $(".period-time").html(``);
                $(".time-table-view").html(`
                    <tr><td class="text-center" scope="row">Time table not create </th></tr>
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