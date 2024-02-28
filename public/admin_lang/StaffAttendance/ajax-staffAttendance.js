
// Retrive attendance on date button click 
$(document).ready(function () {
 
    var dateData = NepaliFunctions.GetCurrentBsDate();
    var current_date = dateData.year+'-'+dateData.month+'-'+dateData.day;
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
            url: "/get-staff-for-attendance",
            data:{
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

                        // alert(data.first_name);
                        var id = data.id;
                        var first_name = data.first_name;
                        var last_name = data.last_name;
                        var role = data.department_role;
                        var teacher_image = data.image;
                        var gender = data.gender;
                        var attendance = data.attendance;
                        var full_name = first_name+' '+last_name;
                        var Salary = data.Salary;

    
                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    
                        var sn = index+1;

                        var fullDayPresent = "";
                        var haffDayPresent = "";
                        var absent = "";
                        var backgroundColor = '';
                        if(attendance == "FDP"){
                            fullDayPresent = 'selected';
                            backgroundColor = "#93f56d";
                        }
                        if(attendance == "HDP"){
                            haffDayPresent = 'selected';
                            backgroundColor =  "#93f56d";
                        }
                        if(attendance == "A"){
                            absent = 'selected';
                            backgroundColor = "#F5816d";
                        }

                        if (Number(Salary) == 0) {
                            var SaveBtn = '<a class="text-danger" href="/admin/salary-set">Set Salary</a>';
                        } else {
                            var SaveBtn = `<button emp_id="${id}" class="save-btn btn px-5 py-3" style="cursor:pointer; padding:5px;">Save</button>`;
                        }

                        // Build the table row HTML
                        var tableRow = `
                            <tr>
                                <td>`+sn+`</td>
                                <td>`+id+`</td>
                                <td>                                        
                                  <img src="`+currentDomainWithProtocol+`/storage/` +teacher_image +`" style="border:1px solid white;height:50px;width:50px">
                                </td>
                                <td >
                                     <div class="d-flex align-items-center mt-3" style="width:150px;">
                                        <b>${full_name}</b> 
                                     </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center mt-3" style="width:150px;">
                                    <b>${role}</b> 
                                    </div>
                               </td>
                                <td class="p-0 pr-1">
                                    <div class="mt-3" style="width:100%;">
                                        <select name="attendance" id="${id}" class="staff_attendance" style="background-color:`+backgroundColor+`; cursor:pointer; padding:3px;outline:none;border-radius:5px;">
                                            <option value="0" style="cursor:pointer; padding:5px;">Attendance</option>
                                            <option class="alert-success" `+fullDayPresent+` value="FDP">Full Day Present</option>
                                            <option class="alert-success" `+haffDayPresent+` value="HDP">Haff Day Present</option>
                                            <option class="alert-danger" `+absent+` value="A">Absent</option>
                                        </select>
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
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    // Event delegation for the click event of .save-btn
    $(".time-attendance-table").on("click", ".save-btn", function () {
        var emp_id = $(this).attr("emp_id");
        var attendance = $('#'+emp_id).val();


        var todayDate = $("#today-date").val();

        // Convert the date string to a JavaScript Date object
        var dateObject = new Date(todayDate);
        var attendanceYear = dateObject.getFullYear();
        var attendanceMonth = dateObject.getMonth() + 1;
        var totalDayThisMonth = NepaliFunctions.GetDaysInBsMonth(attendanceYear, attendanceMonth);
 
        // Append tr_id to formData
        var formData = new FormData();
        formData.append("emp_id", emp_id);
        formData.append("attendance", attendance);
        formData.append("todayDate", todayDate);
        formData.append("totalDayThisMonth", totalDayThisMonth);


        // AJAX request to update data
        $.ajax({
            url: "/staff-attendance",
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

// window load click date search btn 
$(document).ready(function(){
    $("#attendance-date-btn").click();
});
 
// On inpute Date Click
$(document).ready(function(){
    $("#today-date").on("input", function(){
       $(".time-attendance-table").empty();
       var attendanceDate = $(this).val();

       if(NepaliFunctions.ValidateBsDate(attendanceDate)){
           $("#attendance-date-btn").click();
        }
        $(".all-staff-attendance option").filter(function () {
            return $(this).text() ==  "Select";
        }).prop("selected", true);
    });
});

// All Staff Attendance Action 
$(document).ready(function(){
    $(".all-staff-attendance").on("change", function(){
        var attendanceOption = $(this).find("option:selected").html();

        if(attendanceOption == "Full Day Present"){
            $(".staff_attendance").css("background-color", "#93f56d");

            $(".staff_attendance option").filter(function () {
                return $(this).text() ==  "Full Day Present";
            }).prop("selected", true);
        }
        if(attendanceOption == "Haff Day Present"){
            $(".staff_attendance").css("background-color", "#93f56d");

            $(".staff_attendance option").filter(function () {
                return $(this).text() ==  "Haff Day Present";
            }).prop("selected", true);
        }
        if(attendanceOption == "Absent"){
            $(".staff_attendance").css("background-color", "#F5816d");

            $(".staff_attendance option").filter(function () {
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

 
 