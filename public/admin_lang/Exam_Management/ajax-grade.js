// Set Exam Grade 
$(document).ready(function(){
    $(".exam-grade-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData(this);

        $.ajax({
            url: "/exam-grade-set",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
             // Success 
            success:function(response)
            {

                console.log(response);

               if(response.status == "Add Successfully")
               {
                Swal.fire({
                    title: "Grade Create Success !",
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

// Retrive Exam Grade 
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-exam-grade",
        method: "GET",
        success: function (response) {
            console.log(response.data);

            $(".exam-grade-table").html(``);
            if (response.message != "data not found") {
                var count = 0;
                response.data.forEach(function (data) {
                    var increase = count++;
                    var id = response.data[increase].id;
                    var exam = response.data[increase].exam;
                    var from = response.data[increase].from;
                    var to = response.data[increase].to;
                    var grade_point = response.data[increase].grade_point;
                    var grade_name = response.data[increase].grade_name;
                    var remarks = response.data[increase].remarks;



                    if(to >= 100)
                    {
                        var to_status = " to ";
                    }
                    else{
                        var to_status = " to Below ";
                    }

                    $(".exam-grade-table").append(
                        `<tr>
                          <td>` + exam + `</td>
                          <td>` + from +'%' + to_status + to +'%'+`</td>
                          <td>` + grade_point + `</td>
                          <td>` + grade_name + `</td>
                          <td>` + remarks + `</td>


                          <td>
                          <div class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="flaticon-more-button-of-three-dots"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item edit-grade" grade_id="`+id+`" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green mx-1"></i>Edit</a>
                                  <a class="dropdown-item delete-grade" grade_id="`+id+`" style="cursor:pointer"><i class="fas fa-trash text-danger mx-1"></i>Delete</a>
                              </div>
                          </div>
                      </td>
                         </tr>`
                    );

                });
            } else {
                $(".exam-grade-table").append(`
             <tr>
             <td>Not Grade Created.</td>
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

// Delete Grade
$(document).ready(function(){
    $(".exam-grade-table").on("click", ".delete-grade", function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var grade_id =  $(this).attr("grade_id");

       $.ajax({
        url: "/delete-exam-grade",
        method: "POST",
        data: {
            grade_id: grade_id,
        },
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
        success: function (response) {
 
            if (response.status == "Delete Success") {
                $(".delete").remove();
                $(".delete").removeClass("delete");

                Swal.fire({
                    title: "Grade Delete Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
                  });

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