
// Get All Employee For Select Option 
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-employee",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);
 
            // All Staff 
            if (response.Staffs){
                $('.staff-select').append(`<option>Select Staffs</option>`);
                response.Staffs.forEach(function (staff) {
                    $('.staff-select').append(`<option value='`+staff.id+`'>`+staff.first_name+' '+staff.last_name+`</option>`);
                });
            } 
            // All Teachers 
            if (response.Teachers){
                $('.all-teachers').append(`<option>Select Teacher</option>`);
                response.Teachers.forEach(function (teacher) {
                    $('.all-teachers').append(`<option value='`+teacher.id+`'>`+teacher.first_name+' '+teacher.last_name+`</option>`);
                });
            } 
            // All Employee 
            if (response.AllEmployee){
                $('.all-employee').append(`<option>Select Teacher/Staff</option>`);
                response.AllEmployee.forEach(function (employee) {
                    $('.all-employee').append(`<option value='`+employee.id+`'>`+employee.first_name+' '+employee.last_name+`</option>`);
                });
            } 
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });


});

// Retrive All Employee
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-employee",
        method: "GET",
        // Success
        success: function (response) {
            console.log(response);

            $(".table-body").html(``);
            if (response.AllEmployee) {
 
                response.AllEmployee.forEach(function (data) {

                    var id = data.id;
                    var image = data.image;
                    var first_name = data.first_name;
                    var last_name = data.last_name;
                    var gender = data.gender;
                    var phone = data.phone;
                    var department_role = data.department_role;
                    var joining_date = data.joining_date;
                    // var salary = data.salary;
                    var address = data.address;

                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                    $(".table-body").append(
                        `
                          <tr>
                          <td>
                              <div class="form-check">
                                  <input type="checkbox" class="form-check-input">
                                  <label class="form-check-label">`+id+`</label>
                              </div>
                          </td>
                          <td class="text-center"><a href="teacher-profile/`+id+`">
                          <img src="`+currentDomainWithProtocol+`/storage/` +image +`" alt="student" style="height:40px;"></a></td>
                          <td><a   href="teacher-profile/`+id+`" class="text-dark">` + first_name +` ` + last_name + `</a></td>
                          <td>` + department_role + `</td>
                          <td>` + joining_date + `</td>
                          <td>` + address + `</td>
                          <td>` + gender + `</td>
                          <td>` + phone + `</td>
                           <td>
                              <div class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="flaticon-more-button-of-three-dots"></span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="/update_employee/`+id+`"><i class="fas fa-cogs text-dark-pastel-green"></i>Update</a>
                                      <a class="dropdown-item" id="delete_employee" emp_id="`+id+`" href="#"><i class="fas fa-trash text-orange-peel"></i>Delete</a>
                                      <a class="dropdown-item d-flex" href="teacher-profile/`+id+`"><span class="material-symbols-outlined pr-4">person</span>Profile</a>
                                  </div>
                              </div>
                          </td>
                      </tr>`
                    );
                });
            } else {
                $(".table-body").append(`
             <tr>
             <td>Fee Not Set For This Class</td>
             </tr>
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