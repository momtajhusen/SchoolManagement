// Add Salary 
$(document).ready(function () {
    $(".salary-add-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var salary_join_date = $(".salary_join_date").val();

        if(!NepaliFunctions.ValidateBsDate(salary_join_date)){
            alert("Enter Valid Salary Join Date !");
          return false;
        }

        var formData = new FormData(this);
        $.ajax({
            url: "/admin/add-employee-salary",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {

                if (response.status == "Salary Add Sucess") {
                    Swal.fire({
                        title: "Salary Add Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                        });
                } else {
                    Swal.fire(
                        "Already Salary exists !",
                        "Change Subject Nam !",
                        "info"
                    );
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
            
    });
});

// Get Salary 
$(document).ready(function () {
    $(".all-employee").on("change", function(){

        var selectedOptionText = $(this).find('option:selected').text();
        $(".all-employee option").filter(function () {
            return $(this).text() == selectedOptionText;
        }).prop("selected", true);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var emp_id = $(this).val();
        $(".salary-table").html('');
        $.ajax({
            url: "/admin/get-employees-salary",
            method: "GET",
            data:{
               emp_id: emp_id
            },
            // Success
            success: function (response) {
              console.log(response);

              if(response.data){
                response.data.forEach((item, index) => {
 
                    console.log(item.salary_date);
                    // var sn = index+1;

                    var sn = response.data.length - index;

                    $(".salary-table").append(`
                    <tr class="border">
                    <td class="subject-name">`+sn+`</td>
                    <td class="subject-name">`+item.salary_date +`</td>
                    <td class="class-name">` + item.salary + `</td>
                     <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit-salary" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item delete-salary" style="cursor:pointer"><i class="fas fa-trash text-danger"></i>Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>`); 
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