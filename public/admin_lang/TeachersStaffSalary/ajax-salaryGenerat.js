$(document).ready(function(){
    $(".search-btn").click(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var attendanceYear = $("#attendance-year").val();
        var attendanceMonth = $("#attendance-month").val();

        $(".year-notice").html(attendanceYear);
        $(".month-notice").html(MonthsArray[attendanceMonth-1]);

        var date = NepaliFunctions.GetCurrentBsDate();
        var CurrentDate = date.year+'-'+date.month+'-'+date.day;

        $(".attendance-table").empty();
        $.ajax({
            url: "/admin/get-generate-salary",
            data:{
                currentdate:CurrentDate,
                attendanceYear:attendanceYear,
                attendanceMonth:attendanceMonth,
            },
            method: "GET",
            success: function (response) {
                console.log(response);

                // Clear the existing table content

                if (response.Data.length > 0) {
                    var TotalTeachersPeriod = 0;
                    var TotalTeachersPersent = 0;
                    var TotalSalary = 0;
                    var TotalBonus = 0;
                    var TotalPayableAmount = 0;


                    var TotalSalaryGenerate = 0;
                    for (var i = 0; i < response.Data.length; i++) {
                        var item = response.Data[i];
                        var SN = i + 1;
                
                        // Assuming TeacherName is a property in your item object
                        var teacherName = item.TeacherName || '';
                        var TeacherSalary = item.TeacherSalary;
                
                        var tableRow = `<tr>
                                            <td>` + SN + `</td>
                                            <td class='d-flex'>` + teacherName + `</td>
                                        `;

                        
                
                        var TotalPersent = 0;
                        var TotalPeriod = 0;

                        for (var day = 1; day <= 32; day++) {
                            // Assuming day_1, day_2, ..., day_32 are the properties in your item object
                            var dayValue = item["day_" + day] || '';
                            var period = dayValue.split('/');
                
                            // Check if both parts of the split are numbers
                            if (!isNaN(period[0]) && !isNaN(period[1])) {
                                TotalPeriod += parseInt(period[0], 10);
                                TotalPersent += parseInt(period[1], 10);
                            }
                
                            // tableRow += "<td>" + dayValue + "</td>";
                        }
                
                        // Calculate the percentage
                        var percentage = (TotalPersent / TotalPeriod * 100).toFixed(2); 

                        var BonusAmount = 0;
                        if (parseFloat(percentage) >= 90 && parseFloat(percentage) <= 100) {
                            BonusAmount = 4000;
                        }

                        var GenerateSalary = (TeacherSalary / TotalPeriod * TotalPersent).toFixed(2);

                        var totalAmount = Number(GenerateSalary) + Number(BonusAmount);
                
                        // Add the total values and percentage in specific columns (adjust the index accordingly)
                        tableRow += "<td>" + TotalPeriod +'/'+TotalPersent + "</td>";
                        tableRow += "<td>" + percentage + "</td>";
                        tableRow += "<td>"+TeacherSalary+"</td>";
                        tableRow += "<td>"+GenerateSalary+"</td>";
                        tableRow += "<td>"+BonusAmount+"</td>";
                        tableRow += "<td>"+totalAmount+"</td>";


                        tableRow += "</tr>";
                        $(".attendance-table").append(tableRow);

                        TotalTeachersPeriod += TotalPeriod;
                        TotalTeachersPersent += TotalPersent;
                        TotalBonus += BonusAmount;
                        TotalSalary += Number(TeacherSalary);
                        TotalSalaryGenerate += Number(GenerateSalary);
                        TotalPayableAmount += Number(totalAmount);

                    }

                    var AllTeacherpercentage = (TotalTeachersPersent / TotalTeachersPeriod * 100).toFixed(2) + "%";
                    $(".attendance-table").append(`
                    <tr>
                    <td><b>#</b></td>
                    <td><b>Total `+MonthsArray[attendanceMonth-1]+` Month :</b></td>
                    <td><b>`+TotalTeachersPeriod+'/'+TotalTeachersPersent+`</b></td>
                    <td><b>`+AllTeacherpercentage+`</b></td>
                    <td><b>`+TotalSalary+`</b></td>
                    <td><b>`+TotalSalaryGenerate.toFixed(0)+`</b></td>
                    <td><b>`+TotalBonus+`</b></td>
                    <td><b>`+TotalPayableAmount.toFixed(2)+`</b></td>
                    <tr>`);
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

    });
});


// Current Year & Month auto select and search 
$(document).ready(function(){
    $("#attendance-year option").filter(function () {
        return $(this).text() == current_year;
     }).prop("selected", true);

     $("#attendance-month option").filter(function () {
        return $(this).text() == MonthsArray[current_month];
     }).prop("selected", true);

     $(".search-btn").click();
     $("#attendance-year, #attendance-month").on("change", function(){
        $(".search-btn").click();
     });

});