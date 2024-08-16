
// Add Class Period 
$(document).ready(function () {
    $(".added-class-period-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var formData = new FormData(this);
        $.ajax({
            url: "/add-class-period",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {

                if (response.status == "Period Add Sucess") {
                    Swal.fire({
                        title: "Period Add Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                        location.reload();
                      });
                } else {
                    Swal.fire(
                        "Already Subject exists !",
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


// Get Class Period 
$(document).ready(function () {
 
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });

    $.ajax({
        url: "/get-class-period",
        method: "GET",
        // Success
        success: function (response) {

            console.log(response);
            if (response.data) {
                var count = 0;
                $(".period-table").html(``);
                response.data.forEach(function (data) {
                    var increase = count++;
                    var id = response.data[increase].id;
                    var period = response.data[increase].period;
                    var start_time = response.data[increase].start_time;
                    var end_time = response.data[increase].end_time;


                    $(".period-table").append(
                    `<tr class="border">
                        <td>`+period+`</td>
                        <td>`+start_time +`</td>
                        <td>`+end_time+`</td>
                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit-period" period_id="` + id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green pr-2"></i>Edit</a>
                                    <a class="dropdown-item delete-period" period_id="` + id + `" style="cursor:pointer"><i class="fas fa-trash text-danger pr-2"></i>Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>`
                    );
                });
            } 
            else{
                $(".period-table").append(`
                  <td>Data not found</td>
                `);
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });
 
});

// Delete Class Period 
$(document).ready(function(){
    $(".period-table").on("click", ".delete-period", function () {


      Swal.fire({
        title: 'Sure you want to Delete ?',
        text: "Do you want to delete ?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#00032e',
        cancelButtonColor: '#00032e',
        confirmButtonText: 'Yes Delete',
        cancelButtonText: 'Cancle ',
      }).then((result) => {
        if (result.isConfirmed) {

            var period_id = $(this).attr("period_id");


            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "/delete-period",
                method: "POST",
                data: {
                    period_id: period_id,
                },
                // Success
                success: function (response) {

                    if (response.status == "Delete Success") {
                        Swal.fire(
                            "Class Delete Success !",
                            "You clicked the button!",
                            "success"
                        ).then(function() {
                            location.reload();
                          }); 
                    } else {
                        alert("class not found");
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