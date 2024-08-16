// Retrive All Teacher
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-teacher",
        method: "GET",
        // Success
        success: function (response) {

            console.log(response);

            $(".table-body").html(``);
            $(".teacher-select").append(`<option value="">Select Teacher</option>`);
            if (response.message != "data not found") {
                var count = 0;
                
                response.data.forEach(function () {
                    var increase = count++;
                    var id = response.data[increase].id;
                    var first_name = response.data[increase].first_name;
                    var last_name = response.data[increase].last_name;
                    var teacher_full_name = first_name+` `+last_name;
                    $(".teacher-select").append(`
                       <option value="`+id+`">`+teacher_full_name +`</option>
                    `);
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

// Save Teacher Subject
$(document).ready(function(){
    $(".added-teacher-subject-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        var teacher_name = $(".teacher-select option:selected").html();
 
        var formData = new FormData(this);
        formData.append("teacher_name", teacher_name);
        $.ajax({
            url: "/assign-teacher-subject",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            // Success
            success: function (response) {
                  if(response.status == "Add Successfully")
                  {
                    $("#teacher-select-btn").click();
                     Swal.fire(
                        "Add Success !",
                        "You clicked the button!",
                        "success"
                    );
                  }

                  if(response.message)
                  {
                    alert(response.message);   
                  }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});

// Retrive Teacher Subject
$(document).ready(function () {


    $("#teacher-select-add").on("change", function(){
        var teacher_name = $("#teacher-select-add option:selected").html();
        $("#teacher-select-search option").filter(function () {
            return $(this).text() == teacher_name;
        }).prop("selected", true);
        $("#teacher-select-btn").click();
    });

    $("#teacher-select-search").on("change", function(){
        $("#teacher-select-btn").click();
    });

    $(".search-teacher-subject-form").submit(function (e)
    {
      e.preventDefault();

      var tr_id = $("#teacher-select-search").val();
      
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
        $.ajax({
            url: "/get-teacher-subject",
            method: "GET",
            data:{
                tr_id: tr_id,
            },
 
            // Success
            success: function (response) {
                console.log(response.data);
                $(".teacher-subject-table").html('');
 
                if (response.message != "data not found") {
                    var count = 0;
                    response.data.forEach(function (data) {
                        var increase = count++;
 
                        var subject_id = response.data[increase].id;
                        var classes = response.data[increase].class;
                        var subject = response.data[increase].subject;
    
                        $(".teacher-subject-table").append(
                            `<tr class="border">
                                <td class="class-name">` + classes + `</td>
                                <td class="subject-name">`+subject +`</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item delete-subject" subject_id="` + subject_id + `" style="cursor:pointer"><i class="px-2 fas fa-trash text-danger"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>`
                        );
                    });
                } else {
                    $(".teacher-subject-table").append(`
                    <tr>
                    <td>not assign any subject for this teacher</td>
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
});

// Delete Teacher Subject
$(document).ready(function () {

    $(".teacher-subject-table").on("click", ".delete-subject", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var subject_id = $(this).attr("subject_id");

        $.ajax({
            url: "/delete-teacher-subject",
            method: "POST",
            data: {
                subject_id: subject_id,
            },
            // Success
            success: function (response) {

                if (response.status != "Subject not Found") {
                    $("#teacher-select-btn").click();
                    Swal.fire(
                        "Subject Delete Success !",
                        "You clicked the button!",
                        "success"
                    );
                } else {
                    alert("subject not found");
                }
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});




