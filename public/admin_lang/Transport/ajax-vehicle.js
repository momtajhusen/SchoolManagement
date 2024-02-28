
// Add or Update Vehicle
$(document).ready(function () {
 
    $(".added-vehicle-form").submit(function (e) {
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
                    var url = "/add-vehicle";
                }
                else{
                    var url = "/update-vehicle";
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

                        console.log(response);

      
                        if (response.status == "vehicle Add Sucess") {
                            Swal.fire({
                                title: "Vehicle Add Success !",
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
                                title: "Vehicle Update Success !",
                                text: "You clicked the button!",
                                icon: "success",
                                confirmButtonText: "OK",
                              }).then(function() {
                                location.reload();
                              });
                        }
                        
                        else {
                            Swal.fire(
                                "Already Vehicle exists !",
                                "Change Vehicle Number !",
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

// Retrive All Vehicle
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-vehicle",
        method: "GET",
        beforeSend: function () {
            // setting a timeout
            // $(".submit-btn").addClass("d-none");
            // $(".progress").removeClass("d-none");
        },
        // Progress
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        var percentComplete = percentComplete.toFixed(2);
                        $(".progress-bar").width(percentComplete + "%");
                        $(".progress-bar").html(percentComplete + " %");
                    }
                },
                false
            );
            return xhr;
        },
        // Success
        success: function(response) {
            console.log(response);
 
            $(".vehicle-table").html(``);
            $(".select-vehicle").html(``);
            $("#select-vehicle").append(`<option value="">Select Vehicle</option>`);
            if (response.message !== "vehicle not found") {
             var count = 1;
              response.vehicle.forEach(function(vehicle) {
               var sn = count++;


                $(".vehicle-table").append(
                    `  
          <tr class="border">
          <td>`+sn+`</td>
          <td class="subject-name">` +
          vehicle.vehicle_type +
                        `</td>
          <td class="class-name">` +
                        vehicle.vehicle_number +
                        `</td>
          <td class="subject-teacher">` +
          vehicle.driver_name+
                        `</td>
           <td>
              <div class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="flaticon-more-button-of-three-dots"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item edit-vehicle" vehicle_id="` +vehicle.id +`" vehicle_type="` +vehicle.vehicle_type +`" vehicle_no="` +vehicle.vehicle_number +`" driver_name="` +vehicle.driver_name +`" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                      <a class="dropdown-item delete-vehicle d-none" vehicle_id="` +
                      vehicle.id +
                        `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i> Delete</a>
                  </div>
              </div>
          </td>
      </tr>`
                );


                $("#select-vehicle").append(`
                <option value="`+vehicle.vehicle_type+": "+vehicle.vehicle_number+`">`+vehicle.vehicle_type+": "+vehicle.vehicle_number+`</option>
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


// Edit Vehicle For Update 
$(document).ready(function(){
    $(".vehicle-table").on("click", ".edit-vehicle", function () {

 
        var vehicle_id = $(this).attr("vehicle_id");
        var vehicle_type = $(this).attr("vehicle_type");
        var vehicle_no = $(this).attr("vehicle_no");
        var driver_name = $(this).attr("driver_name");
       
        $("#check_action").val("update");
        $(".submit-btn").html("Update");
        $('input[name="vehicle_id"]').val(vehicle_id);

        $('input[name="vehicle_type"]').val(vehicle_type);
        $('input[name="vehicle_number"]').val(vehicle_no);


        $("#driver option").filter(function () {
            return $(this).text() == driver_name;
        }).prop("selected", true);
 

  });
});


// Delete Vehicle 
$(document).ready(function(){
    $(".vehicle-table").on("click", ".delete-vehicle", function () {

        Swal.fire({
            title: 'Sure you want to Delete ?',
            text: "Do you want to delete vehicle ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#00032e',
            cancelButtonColor: '#00032e',
            confirmButtonText: 'Yes Delete',
            cancelButtonText: 'Cancle ',
          }).then((result) => {
            if (result.isConfirmed) {

                var vehicle_id = $(this).attr("vehicle_id");

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/delete-vehicle",
                    method: "POST",
                    data: {
                        vehicle_id: vehicle_id,
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
                                "Vehicle Delete Success !",
                                "You clicked the button!",
                                "success"
                            ).then(function() {
                                location.reload();
                              }); 
                        } else {
                            alert("vehicle not found");
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
