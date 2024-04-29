// Add OR Update Driver
$(document).ready(function(){

    $(".driver-added-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var driver_image_name = localStorage.getItem("driver_register");


        var formData = new FormData(this);
        formData.append("driver_image_name", driver_image_name);


        if($("#check_action").val() != "update")
        {
            var url = "/add-driver";
        }
        else{
            var url = "/update-driver";
        }
    
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() 
            {
             // setting a timeout
               $(".submit-btn").addClass('d-none');
               $(".progress").removeClass('d-none');
            },
            // Progress 
                 xhr: function(){
                     var xhr = new window.XMLHttpRequest();
                     xhr.upload.addEventListener("progress", function(evt) {
                         if (evt.lengthComputable) {
                             var percentComplete = (evt.loaded / evt.total) * 100;
                             var percentComplete =  percentComplete.toFixed(2);
                             $(".progress-bar").width(percentComplete+"%");
                             $(".progress-bar").html(percentComplete+" %");
                         }
                     }, false);
                     return xhr;
                 },
             // Success 
            success:function(response)
            {

                console.log(response);

                // return false;

               if(response.status == "Add Successfully")
               {
                Swal.fire({
                    title: "Driver Add Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
                  }); 
               }

               else if(response.status == "updated successfully")
               {
                Swal.fire({
                    title: "Driver Update Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
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

// Retrive Driver
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        
    $.ajax({
        url: "/retrive-driver",
        method: 'GET',
        beforeSend: function() 
        {
         // setting a timeout
        //    $(".submit-btn").addClass('d-none');
        //    $(".progress").removeClass('d-none');
        },
         // Success 
        success:function(response)
        {

            console.log(response);

            $(".driver-table").html(``);
            if (response.message !== "VehicleRoot not found") {
                var count = 1;
              response.data.forEach(function(data) {
                var sn = count++;

                var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
 
                $(".driver-table").append(`  
                    <tr class="border">
                    <td>`+sn+`</td>
                    <td>
                    <center>
                        <img src="`+currentDomainWithProtocol+`/storage/`+data.image+`" alt="driver" style="height:40px;padding:2px;border:1px solid  #ccc;">
                    </center>
                    </td>
                    <td>` +data.first_name+" "+data.last_name+`</td>
                    <td>` +data.gender +`</td>
                    <td>` +data.dob+`</td>
                    <td>` +data.religion+`</td>

                    <td>` +data.blood_group+`</td>
                    <td>` +data.address+`</td>
                    <td>` +data.phone+`</td>
                    <td>` +data.qualification+`</td>
                    <td>` +data.joining_date+`</td>
                    <td>` +data.salary+`</td>
                    <td>` +data.licence_no+`</td>
                    <td>` +data.email+`</td>
                    <td>
                        <div class="dropdown" style="z-index:100;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit-driver" 
                                    driver_id="`+ data.id +`" 
                                    driver_img="`+ data.image +`" 
                                    first_name="`+data.first_name+`" 
                                    last_name="`+data.last_name+`" 
                                    gender="`+data.gender+`" 
                                    dob="`+data.dob+`" 
                                    religion="`+data.religion+`" 
                                    blood="`+data.blood_group+`" 
                                    address="`+data.address+`" 
                                    phone="`+data.phone+`" 
                                    qualification="`+data.qualification+`" 
                                    joining_date="`+data.joining_date+`" 
                                    salary="`+data.salary+`" 
                                    licence_no="`+data.licence_no+`" 
                                    email="`+data.email+`" 
                                    style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i> 
                                    Edit
                                </a>
                                <a class="dropdown-item delete-driver" driver_id="` + data.id + `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>`
                );
 
              });
            } else {
              $(".table-body").append(`
                <tr>
                  <td>Subject Not Set For This Class</td>
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

// Edit Drive For Update 
$(document).ready(function(){
    $(".driver-table").on("click", ".edit-driver", function () {
        var driver_id = $(this).attr("driver_id");
        var driver_img = $(this).attr("driver_img");
        var first_name = $(this).attr("first_name");
        var last_name = $(this).attr("last_name");
        var gender = $(this).attr("gender");
        var dob = $(this).attr("dob");
        var religion = $(this).attr("religion");
        var blood = $(this).attr("blood");
        var address = $(this).attr("address");
        var phone = $(this).attr("phone");
        var qualification = $(this).attr("qualification");
        var joining_date = $(this).attr("joining_date");
        var salary = $(this).attr("salary");
        var licence_no = $(this).attr("licence_no");
        var email = $(this).attr("email");

        $('input[name="image"]').removeAttr("required");
        $("#check_action").val("update");
        $(".submit-btn").html("Update");

        $('input[name="driver_id"]').val(driver_id);
        $('input[name="first_name"]').val(first_name);
        $('input[name="last_name"]').val(last_name);
        $('input[name="dob"]').val(dob);
        $('input[name="address"]').val(address);
        $('input[name="phone"]').val(phone);

        $('input[name="email"]').val(email);
        $('input[name="qualification"]').val(qualification);
        $('input[name="joining_date"]').val(joining_date);
        $('input[name="salary"]').val(salary);
        $('input[name="licence_no"]').val(licence_no);

        $("#gender option").filter(function () {
            return $(this).text() == gender;
        }).prop("selected", true);

        $("#religion option").filter(function () {
            return $(this).text() == religion;
        }).prop("selected", true);

        $("#blood option").filter(function () {
            return $(this).text() == blood;
        }).prop("selected", true);

        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
        $("#driver_img_preview").attr("src",currentDomainWithProtocol+"/storage/"+driver_img);

 

  });
});

// Delete Driver 
$(document).ready(function(){
    $(".driver-table").on("click", ".delete-driver", function () {

        Swal.fire({
            title: 'Sure you want to Delete ?',
            text: "Do you want to delete driver ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#00032e',
            cancelButtonColor: '#00032e',
            confirmButtonText: 'Yes Delete',
            cancelButtonText: 'Cancle ',
          }).then((result) => {
            if (result.isConfirmed) {

                var driver_id = $(this).attr("driver_id");

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/delete-driver",
                    method: "POST",
                    data: {
                        driver_id: driver_id,
                    },
                    beforeSend: function () {
                        // setting a timeout
                        // $(".submit-btn").addClass("d-none");
                        // $(".progress").removeClass("d-none");
                    },
                    // Success
                    success: function (response) {

                        if (response.status == "Delete Success") {
                            Swal.fire(
                                "Driver Delete Success !",
                                "You clicked the button!",
                                "success"
                            ).then(function() {
                                location.reload();
                              }); 
                        } else {
                            alert("driver not found");
                        }
                    },
                    error: function (xhr, status, error) 
                    {
                        console.log(xhr.responseText);
                    },
                });


 
            }
          })

    });
});