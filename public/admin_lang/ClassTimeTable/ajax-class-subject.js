// Get Period and subject
$(document).ready(function () {

        
    $("#period-class").on("change", function(){

       var select_class =  $(this).val();
 
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
    
        $.ajax({
            url: "/get-period-subjects",
            method: "GET",
            data:{
                class: select_class,
            },
            // Success
            success: function (response) {
    
                console.log(response);

 
                var option = `
                    <option value=''>Select Subject</option>
                    <option value='<span class="material-symbols-outlined">lunch_dining</span>'>Lunch</option>
                    <option value='<span class="material-symbols-outlined">close</span>'>Holiday</option>

                `;
                if (response.subjects) {
         
                    for (let i = 0; i < response.subjects.length; i++) 
                    {
                      var subject_name = response.subjects[i].subject_name;

                      option += `<option value='`+subject_name+`'>`+subject_name+`</option>`;
                    }
                }



                if (response.data) {
                    var count = 0;
                    var sn = 1;
                    $("#period-box").html(``);

                    response.data.forEach(function (data) {
                        var increase = count++;
                        var index = sn++;
                        var id = response.data[increase].id;
                        var period = response.data[increase].period;
                        var start_time = response.data[increase].start_time;
                        var end_time = response.data[increase].end_time;
    
 
    
                        $("#period-box").append(`
                            <div class="col-lg-3 col-12 form-group">
                                <span>Period-`+index+` Subject</span>
                                <select name="period[]" required class="select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                     `+option+`
                                </select>
                            </div>
                        `);
    
                    });
                } 

                else{
                    $("#period-box").append(`
                      <span>Data not found</span>
                    `);
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });

    });
 

 
});

// Save period subject 
$(document).ready(function() {
    $('.subject-period-form').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serializeArray();

        $.ajax({
            type: 'POST',
            url: "/save-period-subjects",
            data: formData,
            success: function(response) {

                console.log(response);
                alert(response.message);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                // Handle errors
            }
        });
    });
});

// get all period subject 
$(document).ready(function () {
    $(".search-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var classes = $("#search-class").val();
        var section = $("#search-section").val();

        $.ajax({
            url: "/get-subject-period",
            method: "GET",
            data:{
                class:classes,
                section:section
            },
            // Success
            success: function (response) {

                console.log(response);

                if (response.data) {
                    var count = 0;
                    $(".class-time-table").html(``);
                    response.data.forEach(function (data) {
                        var increase = count++;
                        var id = response.data[increase].id;
                        var classes = response.data[increase].class;
                        var section = response.data[increase].section;
                        var day = response.data[increase].day;

                        var period_1 = response.data[increase].period_data.period_1;
                        var period_1_teacher = response.data[increase].period_data.period_1_teacher;

                        var period_2 = response.data[increase].period_data.period_2;
                        var period_2_teacher = response.data[increase].period_data.period_2_teacher;

                        var period_3 = response.data[increase].period_data.period_3;
                        var period_3_teacher = response.data[increase].period_data.period_3_teacher;

                        var period_4 = response.data[increase].period_data.period_4;
                        var period_4_teacher = response.data[increase].period_data.period_4_teacher;

                        var period_5 = response.data[increase].period_data.period_5;
                        var period_5_teacher = response.data[increase].period_data.period_5_teacher;

                        var period_6 = response.data[increase].period_data.period_6;
                        var period_6_teacher = response.data[increase].period_data.period_6_teacher;

                        var period_7 = response.data[increase].period_data.period_7;
                        var period_7_teacher = response.data[increase].period_data.period_7_teacher;

                        var period_8 = response.data[increase].period_data.period_8;
                        var period_8_teacher = response.data[increase].period_data.period_8_teacher;

                        var period_9 = response.data[increase].period_data.period_9;
                        var period_9_teacher = response.data[increase].period_data.period_9_teacher;

                        var period_10 = response.data[increase].period_data.period_10;
                        var period_10_teacher = response.data[increase].period_data.period_10_teacher;

                        $(".class-time-table").append(
                        `<tr class="border">
                            <td class="text-center">`+classes+`</td>
                            <td class="text-center">`+section +`</td>
                            <td class="text-center">`+day+`</td>
                            <td class="text-center">`+period_1+`</td>
                            <td class="text-center">`+period_2+`</td>
                            <td class="text-center">`+period_3+`</td>
                            <td class="text-center">`+period_4+`</td>
                            <td class="text-center">`+period_5+`</td>
                            <td class="text-center">`+period_6+`</td>
                            <td class="text-center">`+period_7+`</td>
                            <td class="text-center">`+period_8+`</td>
                            <td class="text-center">`+period_9+`</td>
                            <td class="text-center">`+period_10+`</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item edit-subject" subject_id="` + id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green px-2"></i>Edit</a>
                                        <a class="dropdown-item delete-day-period" period_id="` + id + `" style="cursor:pointer"><i class="fas fa-trash text-danger px-2"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`
                        );
                    });
                } 
                else{
                    $(".class-time-table").append(`
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
});


// Delete Class Period 
$(document).ready(function(){
    $(".class-time-table").on("click", ".delete-day-period", function () {


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

            var classes = $("#search-class").val();
            var section = $("#search-section").val();
            var subject_period_id = $(this).attr("period_id");
 
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "/delete-subject-period",
                method: "POST",
                data: {
                    classes: classes,
                    section: section,
                    subject_period_id: subject_period_id
                },
                // Success
                success: function (response) {

                    if (response.status == "Delete Success") {
                        Swal.fire(
                            "Class Delete Success !",
                            "You clicked the button!",
                            "success"
                        ).then(function() {
                            $("#search-btn").click();
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
