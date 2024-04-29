// Add  or Update Vehicle Root
$(document).ready(function () {
 
    $(".set-vechicle-form").submit(function (e) {
        e.preventDefault();
       
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

 
                var formData = new FormData(this);

                
                if($("#check_action").val() != "update")
                {
                    var url = "/add-vehicle-root";
                }
                else{
                    var url = "/update-vehicle-root";
                }

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        // setting a timeout
                        $(".submit-btn").addClass("d-none");
                        $(".progress").removeClass("d-none");
                    },
                    // Progress
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener(
                            "progress",
                            function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete =
                                        (evt.loaded / evt.total) * 100;
                                    var percentComplete =
                                        percentComplete.toFixed(2);
                                    $(".progress-bar").width(
                                        percentComplete + "%"
                                    );
                                    $(".progress-bar").html(
                                        percentComplete + " %"
                                    );
                                }
                            },
                            false
                        );
                        return xhr;
                    },
                    // Success
                    success: function (response) {
                        
                       
                        
                        if (response.status == "Root Add Sucess") {
                            Swal.fire({
                                title: "Root Add Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });
                        } 
                        else if(response.status == "Root Update Sucess")
                        {
                            Swal.fire({
                                title: "Root Update Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });  
                        }
                        
                        else {
                            Swal.fire(
                                "Exists Root Name !",
                                "Change Root Name !",
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

// Retrive All  Vehicle Root
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-vehicle-root",
        method: "GET",
        // Success
        success: function(response) {
            console.log(response);


            console.log(response.VehicleRoot[0].vehicle_root.root_name);

            // return false;
          
            $(".vehicle-root-table").html(``);
            $(".select-vehicle").html(``);
            $("#root_select").append(`<option value="">Select Root</option>`);
            if (response.message !== "VehicleRoot not found") {
                response.VehicleRoot.forEach(function(vehicle) {
                    // Access the properties of each vehicle object
                    var id = vehicle.vehicle_root.id;
                    var root_name = vehicle.vehicle_root.root_name;
                    var vehicle_name = vehicle.vehicle_root.vehicle;
                    var timing = vehicle.vehicle_root.timing;
                    var amount = vehicle.vehicle_root.amount;
                    var student = vehicle.root_student;

                
                    // Now you can use these variables to construct your HTML elements
                    $(".vehicle-root-table").append(`
                        <tr class="border">
                        <td class="subject-name">` + root_name + `</td>
                        <td class="class-name">` + vehicle_name + `</td>
                        <td class="subject-teacher">` + timing + `</td>
                        <td class="subject-teacher">` + amount + `</td>
                        <td class="subject-teacher">` + student + `</td>
                        <!-- Rest of your HTML generation code -->
                        </tr>`
                    );
                
                    $("#root_select").append(`
                        <option value="` + id + `">` + root_name + ": " + amount + `</option>
                    `);
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


// Edit Vehicle Root For Update 
$(document).ready(function(){
    $(".vehicle-root-table").on("click", ".edit-root", function () {

 

        var root_id = $(this).attr("root_id");
        var root_name = $(this).attr("root_name");
        var vehicle = $(this).attr("vehicle");
        var timing = $(this).attr("timing");
        var amount = $(this).attr("amount");
 
      
        $("#check_action").val("update");
        $(".submit-btn").html("Update");
        $('input[name="root_id"]').val(root_id);

        $('input[name="root_name"]').val(root_name);
        $('input[name="timing"]').val(timing);
        $('input[name="amount"]').val(amount);



        $("#select-vehicle option").filter(function () {
            return $(this).text() == vehicle;
        }).prop("selected", true);
 

  });
});


// Delete Vehicle 
$(document).ready(function(){
    $(".vehicle-root-table").on("click", ".delete-root", function () {

        Swal.fire({
            title: 'Sure you want to Delete ?',
            text: "Do you want to delete root ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#00032e',
            cancelButtonColor: '#00032e',
            confirmButtonText: 'Yes Delete',
            cancelButtonText: 'Cancle ',
          }).then((result) => {
            if (result.isConfirmed) {

                var root_id = $(this).attr("root_id");


                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/delete-vehicle-root",
                    method: "POST",
                    data: {
                        root_id: root_id,
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
                                "Root Delete Success !",
                                "You clicked the button!",
                                "success"
                            ).then(function() {
                                location.reload();
                              }); 
                        } else {
                            alert("root not found");
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