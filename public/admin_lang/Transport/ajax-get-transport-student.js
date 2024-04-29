// Transport Student in table
$(document).ready(function(){
    $(".search-transport").submit(function(e){
        e.preventDefault();

        var select_root = $("#root_select").val();

        $.ajax({
            url: "/get-transport-student",
            method: 'GET',
            data:{
               select_root:select_root
            },
            beforeSend: function() 
            {
             // setting a timeout
              $(".loading-th").removeClass("d-none");

              $(".transport-student-table").html(`
              <th colspan="10" class="border">
                    <center class="d-flex justify-content-center">
                        <span>Loading </span>
                        <span class="px-3">
                            <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                        </span>
                    </center>
                </th>
                `);
            },
             // Success 
            success:function(response)
            {
    
                console.log(response);
     

                
                $(".loading-th").addClass("d-none");
                $(".transport-student-table").html(``);

                $(".count-student").html(response.Studentdata.length);

                var root_name = $("#root_select option:selected").html();
                // $(".root-name").html(root_name);
    
                var count = 0;
                response.Studentdata.forEach(function(data){
                var index = count++;
    
                var student_name = data.first_name+' '+data.middle_name+' '+data.last_name;
                var Root_name  =  data.village;
                var classes  =  data.class+' '+data.section;

    
    
                $(".transport-student-table").append(`
                         <tr class="border">
                             <td>`+index+`</td>
                             <td>`+data.id+`</td>
                             <td>`+student_name+`</td>
                             <td>`+classes+`</td>
                             <td>`+Root_name+`</td>
                         </tr>
                    `);
                });
    
            },
            error: function (xhr, status, error) 
            {
                console.log(JSON.parse(xhr.responseText));
            },
        });

    });


});


// Retrive All  Vehicle Root in option 
$(document).ready(function () {

    
    $("#root_select").on("change", function(){

        $("#search-btn").click();
    });

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
          
            $("#root_select").append(`<option value="">Select Root</option>`);
            $("#root_select").append(`<option value="all_roots">All Roots</option>`);
            if (response.message !== "VehicleRoot not found") {
                response.VehicleRoot.forEach(function(vehicle) {
                    // Access the properties of each vehicle object
                    var id = vehicle.vehicle_root.id;
                    var root_name = vehicle.vehicle_root.root_name;
                    var vehicle_name = vehicle.vehicle_root.vehicle;
                    var timing = vehicle.vehicle_root.timing;
                    var amount = vehicle.vehicle_root.amount;
                    var student = vehicle.root_student;

                $("#root_select").append(`
                <option value="`+id+`">`+root_name+' '+student+`</option>
              `);


              });
            }
          },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
});

 