// Retrive attendance on date button click 
$(document).ready(function () {

    var current_date = current_year+'-'+current_month+'-'+current_day;
    $("#today-date").val(current_date);

    $("#attendance-date-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        
        var todayDate = $("#today-date").val();
        $(".date-lable").html('Date: '+todayDate);
 
        $(".time-attendance-table").empty();
        if(!NepaliFunctions.ValidateBsDate(todayDate)){
            $(".time-attendance-table").empty();
             alert("Enter valid date");
             return false; 
        }
    
        // Fetch teacher attendance data
        $.ajax({
            url: "/get-teacher-attendance-period",
            data:{
                year:current_year,
                date:todayDate,
            },
            method: "GET",
            success: function (response) {
                console.log(response);
    
                if (response.data) {
                    // Clear the content of the table
                    $(".time-attendance-table").empty();
    
                    // var index = 1;
                    response.data.forEach(function (data, index) {
                        // Extract necessary data
                        var id = data.id;
                        var first_name = data.first_name;
                        var teacher_image = data.teacher_image;
                        var gender = data.gender;
    
                        var SirMam = gender == "Male" ? "Sir" : "Mam";
    
                        var totalPeriods = data.teacherPeriods.length;
                        var teacherPeriods = data.teacherPeriods;
                        var PeriodAttendance = data.PeriodAttendance;
                        var Salary = data.Salary;

                        var teacherPeriodsLength = data.teacherPeriods.length;

                        if (Number(Salary) != 0) {
                            if(teacherPeriodsLength != 0){
                                var SaveBtn = `<button data-tr_id="${id}" class="save-btn btn px-5 py-3" style="cursor:pointer; padding:5px;">Save</button>`;
                            }
                            else{
                                var SaveBtn = '<a class="text-danger" href="/admin/teachers-periods">Set Period<a>';
                            }
                        } else {
                            var SaveBtn = '<a class="text-danger" href="/admin/salary-set">Set Salary</a>';
                        }
                        

                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    
                        var sn = index+1;

                        // Dynamically build the HTML for individual periods
                        var TeacherPeriod = '';
                        for (let i = 0; i < totalPeriods; i++) {
    
                             var persentSelect = "";
                             var absentSelect = "";
                             var backgroundColor = "";
    
    
                             if(PeriodAttendance[i] == 1){
                                persentSelect = "selected";
                                backgroundColor = "#93f56d";
                             }

                             if(PeriodAttendance[i] == 0){
                                absentSelect = "selected";
                                backgroundColor = "#F5816d";
                             }
    
                            var periodIndex = i+1;
                            TeacherPeriod += `
                                <div class="d-flex flex-column ml-1">
                                    <label class="d-flex align-items-center m-0" for="${id}"><span class="material-symbols-outlined mr-1" style="font-size:14px;">chronic</span>${teacherPeriods[i]}</label>
                                    <select required class="teacher_period select_${id}_single" name="${teacherPeriods[i]}" style="background-color:`+backgroundColor+`; cursor:pointer; padding:3px; outline:none;border-radius:5px;">
                                        <option  value="">Select</option>
                                        <option `+persentSelect+` class="alert-success" value="1">Present</option>
                                        <option `+absentSelect+` class="alert-danger" value="0">Absent</option>
                                    </select>
                                </div>`;
                        }


    
                        // Build the table row HTML
                        var tableRow = `
                            <tr>
                         
                                <td>`+sn+`</td>
                                <td>                                        
                                  <img src="`+currentDomainWithProtocol+`/storage/` +teacher_image +`" style="border:1px solid white;height:50px;width:50px">
                                </td>
                                <td >
                                     <div class="d-flex align-items-center mt-3" style="width:150px;">
                                        <b>${first_name} ${SirMam}</b> 
                                     </div>
                                </td>
                                <td class="p-0 pr-1">
                                    <div class="d-flex flex-column ml-1" style="width:100%;">
                                        <label for="${id}" class="m-0">All Period</label>
                                        <select class="select_${id}" name="select_${id}" style="cursor:pointer; padding:3px;outline:none;border-radius:5px;">
                                            <option value="0" style="cursor:pointer; padding:5px;">Attendance</option>
                                            <option class="alert-success" value="1">Present</option>
                                            <option class="alert-danger" value="0">Absent</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="p-0">
                                    <div class="d-flex">
                                        ${TeacherPeriod}
                                    </div>
                                </td>
                                <td>
                                   ${SaveBtn}
                                </td>
                            </tr>`;
    
                        // Append the row to the table
                        $(".time-attendance-table").append(tableRow);
                    });
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });

    // Event delegation for the click event of .save-btn
    $(".time-attendance-table").on("click", ".save-btn", function () {
        var tr_id = $(this).data("tr_id");
        var formData = new FormData();

        // Loop through selects in the same row and append values to formData
        var totalPeriod = 0;
        var totalPresentPeriod = 0;
        var totalAbsentPeriod = 0;


        var todayDate = $("#today-date").val();

         // Convert the date string to a JavaScript Date object
        var dateObject = new Date(todayDate);

        // Extract year and month
        var attendanceYear = dateObject.getFullYear();
        var attendanceMonth = dateObject.getMonth() + 1;

        var totalDayThisMonth = NepaliFunctions.GetDaysInBsMonth(attendanceYear, attendanceMonth);

        $(this).closest("tr").find('.teacher_period').each(function () {
            totalPeriod++;
            totalPresentPeriod += ($(this).val() == 1) ? 1 : 0;
            totalAbsentPeriod += ($(this).val() == 0) ? 1 : 0;

            // alert($(this).val());
            formData.append($(this).attr('name'), $(this).val());
        });

 
        // Append tr_id to formData
        formData.append("tr_id", tr_id);
        formData.append("total_period", totalPeriod);
        formData.append("total_present", totalPresentPeriod);
        formData.append("total_absent", totalAbsentPeriod);
        formData.append("todayDate", todayDate);
        formData.append("totalDayThisMonth", totalDayThisMonth);


        // AJAX request to update data
        $.ajax({
            url: "/teachers-attendance",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

                console.log(response);

                iziToast.success({
                    title: 'Save',
                    message: 'Successfully inserted record!',
                    position: 'topRight', 
                    timeout: 2000,
                });
                
            },
            error: function (xhr, status, error) {
                // Handle error, if needed
                console.log(xhr.responseText);
            },
        });
    });
});

// On inpute Date Click
$(document).ready(function(){
    $("#today-date").on("input", function(){
       $(".time-attendance-table").empty();
       var attendanceDate = $(this).val();

       if(NepaliFunctions.ValidateBsDate(attendanceDate)){
           $("#attendance-date-btn").click();
        }

        $(".all-teacher-attendance option").filter(function () {
            return $(this).text() ==  "Select";
        }).prop("selected", true);

    });
});

$(document).ready(function(){
    $("#attendance-date-btn").click();
});

// All Period Present and Absent
$(document).ready(function () {
    $(".time-attendance-table").on("change", "select", function () {
        var attendanceOption = $(this).find("option:selected").html();
        var attendanceClass = $(this).attr("class");
 
        $("."+attendanceClass+'_single'+" option").filter(function () {
            
            if(attendanceOption == "Present"){
                $("."+attendanceClass+'_single'+"").css("background-color", "#93f56d");
            }
            if(attendanceOption == "Absent"){
                $("."+attendanceClass+'_single'+"").css("background-color", "#F5816d");
            }

            return $(this).text() == attendanceOption;
        }).prop("selected", true);

            if(attendanceOption == "Present"){
                $(this).css("background-color", "#93f56d");
            }
            if(attendanceOption == "Absent"){
                $(this).css("background-color", "#F5816d");
            }
    });
});

// All Teachers Attendance Action 
$(document).ready(function(){
    $(".all-teacher-attendance").on("change", function(){

        var attendanceOption = $(this).find("option:selected").html();

        if(attendanceOption == "Present"){
            $(".teacher_period").css("background-color", "#93f56d");

            $(".teacher_period option").filter(function () {
                return $(this).text() ==  "Present";
            }).prop("selected", true);
        }
        if(attendanceOption == "Absent"){
            $(".teacher_period").css("background-color", "#F5816d");

            $(".teacher_period option").filter(function () {
                return $(this).text() ==  "Absent";
            }).prop("selected", true);
        }

    });
}); 

// Teacher Attendance Save Form Submit 
$(document).ready(function(){


    $(".period-form").on("submit", function(e){
        e.preventDefault();
      
        var allTeachersPeriods = []; // Array to store all teachers' period data
        
        // Iterate over each form with class "period-form"
        $(".period-form").each(function(index, form){
            var formData = {}; // Object to store data of each form
            
            // Get values from the form elements within the current form
            formData.id = $(form).find('td:first').text(); // Example: Getting the id from the first td element
            formData.name = $(form).find('td:eq(1)').text(); // Example: Getting the name from the second td element
            formData.allPeriodAttendance = $(form).find('.select_' + formData.id).val(); // Example: Getting the value from the select element with class 'select_' + id
            
            // Additional logic to get data from all dynamic periods
            formData.periods = [];
            $(form).find('.time-attendance-table select').each(function(index, select){
                var periodData = {};
                periodData.period = $(select).prev('label').text();
                periodData.attendance = $(select).val();
                formData.periods.push(periodData);
            });
            
            // Push the formData object to the allTeachersPeriods array
            allTeachersPeriods.push(formData);
        });
        
        // Output the allTeachersPeriods array to the console (you can replace this with your desired logic)
        console.log(allTeachersPeriods);
    });
});

// Save All 
$(document).ready(function(){
    $(".save-all-btn").click(function(){
         $(".save-btn").each(function(){
            $(this).click();
         });
    });
});

 
 