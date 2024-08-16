// Save Setting 
$(document).ready(function(){
    $(".bonus-attendance-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var formData = new FormData(this);
        $.ajax({
            url: "/admin/save-bonus-ssf-setting",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
             // Success 
            success:function(response)
            {
               if(response.status == "Update Sucess")
               {
                Swal.fire({
                    title: "Update Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  });
                  
               }
               else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                  })
               }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
});
 
// Get Setting 
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    $.ajax({
        url: "/admin/get-bonus-ssf-setting",
        method: 'GET',
         // Success 
        success:function(response)
        {

            console.log(response);;

           $('input[name="ssf_per"]').val(response.data.ssf_per);
           $('input[name="bouns_attend"]').val(response.data.bouns_attend);
           $('input[name="bouns_per"]').val(response.data.bouns_per);
           $('input[name="leave_per"]').val(response.data.leave_per);
           $('input[name="leave_salary"]').val(response.data.leave_salary);

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
        url: "/get-all-employee-bonus-setting",
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
                    var department_role = data.department_role;

                    var ssf = data.ssf;
                    var ba = data.ba;
                    var ls = data.ls;

                    var ssfcheck = '';
                    var bacheck = '';
                    var lscheck = '';
                    if(ssf == 'true'){
                        ssfcheck = 'checked'
                    }
                    if(ba == 'true'){
                        bacheck = 'checked'
                    }
                    if(ls == 'true'){
                        lscheck = 'checked'
                    }

                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
 
                    $(".table-body").append(
                        `
                        <tr>
                          <td class="text-center"><a href="teacher-profile/`+id+`">
                          <img src="`+currentDomainWithProtocol+`/storage/` +image +`" alt="student" style="height:30px;"></a></td>
                          <td class="text-center"><a   href="teacher-profile/`+id+`" class="text-dark">` + first_name +` ` + last_name + `</a></td>
                          <td class="text-center">` + department_role + `</td>
                          <td class="text-center">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" `+ssfcheck+` ssf_id='`+id+`' aria-label="Checkbox for following text input">
                                </div>
                            </div>
                          </td>
                          <td>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" `+bacheck+` ba_id='`+id+`' aria-label="Checkbox for following text input">
                                </div>
                            </div>
                          </td>
                          <td>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" `+lscheck+` ls_id='`+id+`' aria-label="Checkbox for following text input">
                                </div>
                            </div>
                          </td>
                          <td>
                           <button class="save-ssf-emp" emp_id='`+id+`'>save</button>
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

// Save Employee ssf,bs,ls
$(document).ready(function(){
    $(".table-body").on("click", ".save-ssf-emp", function () {
        // Find the closest row to the clicked button
        var row = $(this).closest('tr');
        
        // Get the values using input element IDs or other attributes
        var emp_id = $(this).attr('emp_id');
 
        // Retrieve checkbox values
        var isSsfChecked = row.find('[ssf_id]').prop('checked');
        var isBaChecked = row.find('[ba_id]').prop('checked');
        var isLsChecked = row.find('[ls_id]').prop('checked');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/save-epm-bonus-setting",
            method: "POST",
            data: {
                emp_id: emp_id,
                ssf: isSsfChecked,
                ba: isBaChecked,
                ls: isLsChecked,
            },
            // Success
            success: function (response) {
                console.log(response);

                if(response.message == "Save successful"){
                    iziToast.success({
                        title: 'Save',
                        message: 'Successfully inserted record!',
                        position: 'topRight', 
                        timeout: 2000,
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

$(document).ready(function(){
    $("#save-all-emp").click(function(){
            $(".save-ssf-emp").each(function(){
                $(this).click();
            });
    });
});



