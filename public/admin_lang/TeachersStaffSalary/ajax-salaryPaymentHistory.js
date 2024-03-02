$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/admin/all-salary-payment-history",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);


 ;
            $(".payment-history").html(``);

            var TotalReciveSalary = 0;
            var TotalRemaining = 0;

            if (response.EmployeesSalaries) {
                response.EmployeesSalaries.forEach(function (data, index) {
 
                    var employee_name = data.employee_name;
                    var recive_salary = data.recive_salary;
                    var salary_month = data.salary_month;
                    var remaining = data.remaining;
                    var payment_date = data.payment_date;
                    var image = data.employee_image;

                   var monthName = NepaliFunctions.GetBsMonth(salary_month - 1);

                    TotalReciveSalary += Number(recive_salary);
                    TotalRemaining += Number(remaining);

                    $(".payment-history").append(
                        `
                        <tr>
                          <td>`+ index +`</td>
                          <td><img class="p-2" src="/storage/`+image+`" alt="" style="height:40px; border:1px solid #888;"></td>
                          <td>`+ monthName +`</td>
                          <td>`+ employee_name +`</td>
                          <td>`+ recive_salary +`</td>
                          <td>`+ payment_date +`</td>
                        </tr>`
                    );
                });

                $(".payment-history").append(`
                   <tr>
                      <td>#</td>
                      <td colspan="3">Total</td>
                      <td>`+TotalReciveSalary+`</td>
                      <td>`+TotalRemaining+`</td>
                   </tr>
                `);


            } else {
                $(".table-body").append(`
             <tr>
             <td>Fee Not Set For This Class</td>
             </tr>
             `);
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});