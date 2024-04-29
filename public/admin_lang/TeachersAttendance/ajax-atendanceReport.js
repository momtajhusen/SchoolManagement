$(document).ready(function(){
    $(".search-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var attendanceYear = $("#attendance-year").val();
        var attendanceMonth = $("#attendance-month").val();
        var attendance_role = $("#attendance-role").val();

        $(".year-notice").html(attendanceYear);
        $(".month-notice").html(MonthsArray[attendanceMonth-1]);


        $(".attendance-table").empty();
        // Day No : & Day Name 
        $(".th-day").empty();
        $(".th-day").append(`<th scope="col">SN.</th><th scope="col"><div style='width: 250px;' class='d-flex border-0'><div class="w-100 h-100 d-flex align-item-center justify-content-center">`+attendance_role+` Name</div></th>`);
        var totalDay = NepaliFunctions.GetDaysInBsMonth(attendanceYear, attendanceMonth);
        for (var th_day = 1; th_day <= totalDay; th_day++) {
             var dayName = NepaliFunctions.GetBsFullDay({year:attendanceYear, month:attendanceMonth, day:th_day});

              $(".th-day").append(`<th scope="col">
                         <div class="d-flex align-items-center flex-column">
                              <span>`+th_day+`</span>
                              <span style="font-size:10px;">`+dayName.substring(0, 3)+`.</span>
                         </div>
                   </th>`);
            };
        $(".th-day").append(`<th scope="col">Total</th><th scope="col">Percent</th>`);


        // Start Teacher Attendance Report Request 
            if(attendance_role == "Teachers"){
                $.ajax({
                    url: "/get-teacher-attendance-report",
                    data:{
                        attendanceYear:attendanceYear,
                        attendanceMonth:attendanceMonth,
                    },
                    method: "GET",
                    success: function (response) {
                        console.log(response);

                        // Clear the existing table content

                        if (response.Data.length > 0) {
                            var TotalPersent = 0;
                            var TotalPeriod = 0;
        
                            for (var i = 0; i < response.Data.length; i++) {
                                var item = response.Data[i];
                                var SN = i + 1;
                        
                                // Assuming TeacherName is a property in your item object
                                var teacherName = item.TeacherName || '';
                        
                                var tableRow = `<tr>
                                                <td>` + SN + `</td>
                                                <td style='width: 250px;' class='d-flex w-100'>` + teacherName + `</td>
                                            `;

                                
                                var period = item.attendance.split('/');
                        
                                // Check if both parts of the split are numbers
                                if (!isNaN(period[0]) && !isNaN(period[1])) {
                                    TotalPeriod += parseInt(period[0], 10);
                                    TotalPersent += parseInt(period[1], 10);
                                }

                                var totalDay = NepaliFunctions.GetDaysInBsMonth(attendanceYear, attendanceMonth);
                                for (var day = 1; day <= totalDay; day++) {

                                    // Assuming day_1, day_2, ..., day_32 are the properties in your item object
                                    var dayValue = item["day_" + day] || '';
        
                                    var dayName = NepaliFunctions.GetBsFullDay({year:attendanceYear, month:attendanceMonth, day:day});
                                    if(dayName != "Saturday"){
                                    tableRow += "<td>" + dayValue + "</td>";
                                    }
                                    else{
                                        tableRow += "<td style='background-color:#FFFAFA;'>" + dayValue + "</td>";
                                    }
                        
                                }
                        
                                // Add the total values and percentage in specific columns (adjust the index accordingly)
                                tableRow += "<td>" + item.attendance + "</td>";
                                tableRow += "<td>" + item.percent + "</td>";
                        
                                tableRow += "</tr>";
                                $(".attendance-table").append(tableRow);

                            }

                            var AllTeacherpercentage = (TotalPersent / TotalPeriod * 100).toFixed(2) + "%";
                            var col = totalDay + 1;
                            $(".attendance-table").append(`<tr>
                                <td><b>#</b></td>
                                <td colspan="`+col+`"><b>Total Teachers Persent `+MonthsArray[attendanceMonth-1]+` Month :</b></td>
                                <td><b>`+TotalPeriod+'/'+TotalPersent+`</b></td>
                                <td><b>`+AllTeacherpercentage+`</b></td><tr>`);
                        }
                        
                        
                        
                        
                        else {
                            // Handle the case when no data is found
                            $('#tableContainer').html('<p>Data not found</p>');
                        }

            
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    },
                });
            }
        // Start Teacher Attendance Report Request 

        // Start Teacher Attendance Report Request 
        if(attendance_role == "Staffs"){
            $.ajax({
                url: "/get-staff-attendance-report",
                data:{
                    attendanceYear:attendanceYear,
                    attendanceMonth:attendanceMonth,
                },
                method: "GET",
                success: function (response) {
                    console.log(response);

                    if (response.Data.length > 0) {
                        var TotalAttendance = 0;
                        var TotalPercentage = 0;

              
    
                        for (var i = 0; i < response.Data.length; i++) {
                            var item = response.Data[i];
                            var SN = i + 1;
                    
                            // Assuming TeacherName is a property in your item object
                            var teacherName = item.TeacherName || '';
                    
                            var tableRow = `<tr>
                                            <td>` + SN + `</td>
                                            <td style='width: 250px;' class='d-flex w-100'>` + teacherName + `</td>
                                        `;

                            
                            var Attendance = item.attendance;
                            var Percent = item.percent;
                            TotalAttendance += Number(Attendance);
                            TotalPercentage += Number(Percent);

                    

                            var totalDay = NepaliFunctions.GetDaysInBsMonth(attendanceYear, attendanceMonth);
                            for (var day = 1; day <= totalDay; day++) {

                                // Assuming day_1, day_2, ..., day_32 are the properties in your item object
                                var dayValue = item["day_" + day] || '';

                                var bgcolor = '';
                                if(dayValue == "FDP"){
                                    bgcolor = 'background-color:#93f56d;'
                                }
                                if(dayValue == "HDP"){
                                    bgcolor = 'background: rgb(147,245,109);background: linear-gradient(90deg, rgba(147,245,109,1) 0%, rgba(245,129,109,1) 100%);'
                                }
                                if(dayValue == "A"){
                                    bgcolor = 'background-color:#F5816d'
                                }
    
                                var dayName = NepaliFunctions.GetBsFullDay({year:attendanceYear, month:attendanceMonth, day:day});
                                if(dayName != "Saturday"){
                                   tableRow += "<td class='text-center text-light' style='"+bgcolor+"'><b>" + dayValue + "</b></td>";
                                }
                                else{
                                    tableRow += "<td class='text-center text-light' style='"+bgcolor+"'><b>" + dayValue + "</b></td>";
                                }
                    
                            }
                    
                            // Add the total values and percentage in specific columns (adjust the index accordingly)
                            tableRow += "<td>" + item.attendance + "</td>";
                            tableRow += "<td>" + item.percent + "</td>";
                    
                            tableRow += "</tr>";
                            $(".attendance-table").append(tableRow);

                        }

                        var AllTeacherpercentage = (TotalPercentage / TotalAttendance * 100).toFixed(2) + "%";

                        var col = totalDay + 1;
                        // $(".attendance-table").append(`<tr>
                        //     <td><b>#</b></td>
                        //     <td colspan="`+col+`"><b>Total Teachers Persent `+MonthsArray[attendanceMonth-1]+` Month :</b></td>
                        //     <td><b>`+TotalAttendance+`</b></td>
                        //     <td><b>`+AllTeacherpercentage+`</b></td><tr>`);
                    }
                    
                    else {
                        // Handle the case when no data is found
                        $('#tableContainer').html('<p>Data not found</p>');
                    }

        
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
        }
        // End Teacher Attendance Report Request 




    });
});


// Current Year & Month auto select and search 
$(document).ready(function(){
    $("#attendance-year option").filter(function () {
        return $(this).text() == current_year;
     }).prop("selected", true);

     $("#attendance-month option").filter(function () {
        return $(this).text() == MonthsArray[decremented_current_month];
     }).prop("selected", true);

     $(".search-btn").click();
     $("#attendance-year, #attendance-month, #attendance-role").on("change", function(){
        $(".search-btn").click();
     });

});