// Teacher Details 
$(document).ready(function(){
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
       var teacher_id =  $("#teacher-id").val();

       alert(teacher_id);
       
        $.ajax({
            url: "/get-single-teacher/" + teacher_id,
            method: "GET",
            // Success
            success: function (response) {
                console.log(response);
                var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    
                 var first_name = response.teacher.first_name;
                 var last_name = response.teacher.last_name;
                 var dob = response.teacher.dob;
                 var address = response.teacher.address;
                 var phone = response.teacher.phone;
                 var email = response.teacher.email;
                 var qualification = response.teacher.qualification;
                 var joining_date = response.teacher.joining_date;
                 var salary = response.teacher.salary;
                 var class_teacher = response.teacher.class_teacher;
                 var section = response.teacher.section;
                 var password = response.teacher.password;
                 var treache_img = currentDomainWithProtocol+"/storage/"+response.teacher.image;

                 alert(first_name);

                 $(".teacher_name").html(first_name+' '+last_name);
                 $(".teacher_dob").html(dob);
                 $(".teacher_phone").html(phone);
                 $(".teacher_email").html(email);
                 $(".teacher_salary").html(salary);
                 $(".teacher_address").html(address);
                 $(".teacher_qualification").html(qualification);

                 $(".login-email").html(email);
                 $(".login-psaaword").html(password);

    
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

        $.ajax({
            url: "/get-teacher-subject",
            method: "GET",
            data:{
                tr_id: teacher_id,
            },
 
            // Success
            success: function (response) {
                console.log(response.data);
                $(".teacher-subject-list").html('');
 
                if (response.message != "data not found") {
                    var count = 0;
                    var countNo = 1;
                    response.data.forEach(function (data) {
                        var increase = count++;
                        var index = countNo++;

 
                        var subject_id = response.data[increase].id;
                        var classes = response.data[increase].class;
                        var subject = response.data[increase].subject;
    
                        $(".teacher-subject-list").append(`
                            <li class="list-group-item d-flex justify-content-between" style="width:auto;">
                                <span>`+index+`) `+classes+`</span>
                                <span>`+subject+`</span>
                                <span>8:30 PM to 9:00 PM</span>
                            </li>
                        `);
                    });
                } else {
                    $(".teacher-subject-list").append(`
                      <span>not assign any subject for this teacher</span>
                    `);
                }
    
                // if(response.data[0].notice)
                // {
                //     alert("no data");
                // }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });



    });
});

// Teacher Attendance 
$(document).ready(function(){
    $(".search-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var attendanceYear = $("#attendance-year").val();
        var attendanceMonth = $("#attendance-month").val();
        var tr_id = $("#teacher-id").val();


        $(".th-year").html(attendanceYear+'-');
        $(".th-month").html(attendanceMonth+'-');


        $(".attendance-table").html('');
        $(".totalMonthPeriod").html("0/0");
        $(".percentageText").html('0 %');
        $(".percentageProgress").css("width",'0%');
        
        $.ajax({
            url: "/get-teacher-profile-attendance-report",
            method: "GET",
            data:{
                tr_id:tr_id,
                attendanceYear:attendanceYear,
                attendanceMonth:attendanceMonth,
            },
            success: function (response) {
                
                console.log(response);

                if (response.data.length > 0) {

                    $(".totalMonthPeriod").html(response.totalMonthPeriod);
                    $(".percentageText").html(response.totalMonthPercent+' %');
                    $(".percentageProgress").css("width", response.totalMonthPercent+'%');



                    response.data.forEach(function(record) {

 

                        var PeriodRecord = '';
                        record.forEach(function(period) {

                            var periodName = period.periodName.replace(/period_/g, 'P-');

 
                            if(period.periodAttendance == 1){
                               var bgColor = 'bg-success';
                               var attendanceText = 'P';

                            }
                            if(period.periodAttendance == 0){
                                var bgColor = 'bg-danger';
                                var attendanceText = 'A';
                            }
                            PeriodRecord += `
                                <div class="d-flex flex-column align-items-center p-1">
                                   <span class="px-2 `+bgColor+`" style="font-size:10px;">`+attendanceText+`</span>
                                   <span style="font-size:10px;">`+periodName+`</span>
                                   <span style="font-size:10px;">`+period.periodTime+`</span>
                                </div>
                            `;
                        });



                        var dateString = record[0].date;
                        var dateObject = new Date(dateString);
                        var attendanceYear = dateObject.getFullYear();
                        var attendanceMonth = dateObject.getMonth() + 1;
                        var attendanceDay = dateObject.getDate();

                        var dayName = NepaliFunctions.GetBsFullDay({year:attendanceYear, month:attendanceMonth, day:attendanceDay});
 
                        $(".attendance-table").append(`
                        <tr>
                        <td class="text-center">
                           <div class="d-flex flex-column">
                              <span style="font-size:15px;">`+attendanceDay+`</span>
                              <span class="text-center" style="font-size:10px;">`+dayName+`</span>
                           </div>
                        </td>
                        <td class="p-0">
                           <div class="d-flex">
                             `+PeriodRecord+` 
                           </div>
                        </td>
                     </tr>
                     
                        `);


                        
                    });

                } else {
                    console.log('No records found');
                }

             
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
 
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
     $("#attendance-year, #attendance-month").on("change", function(){
        $(".search-btn").click();
     });

});