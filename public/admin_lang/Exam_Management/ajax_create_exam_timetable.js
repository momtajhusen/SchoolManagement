
// Create Exam Timetable 
$(document).ready(function(){

    $(".exam-timetable-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        var formData = new FormData(this);
   
        $.ajax({
            url: "/create-exam-timetable",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            // beforeSend: function() 
            // {
            //  // setting a timeout
            //    $(".submit-btn").addClass('d-none');
            //    $(".progress").removeClass('d-none');
            // },
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

 
               if(response.status == "Add Successfully")
               {
                Swal.fire({
                    title: "Timetable Create Success !",
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


// Retrive Exam Time table
$(document).ready(function () {

    $("#class-timetable").on("change", function(){

        var select_class = $(this).val();
        var select_exam = $("#timetable-list-exam").val();


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
        $.ajax({
            url: "/get-exam-timetable",
            method: "GET",
            data:{
                class:select_class,
                select_exam:select_exam,
            },
            success: function (response) {


                console.log(response);
    
                $(".exam-timetable-table").html(``);
                if (response.message != "data not found") {
                    var count = 0;
                    var number = 1;
                    response.data.forEach(function (data) {
                        var increase = count++;
                        var sn = number++;

                        var id = response.data[increase].id;
                        var exam = response.data[increase].exam;
                        var classes = response.data[increase].class;
                        var subject = response.data[increase].subject;
                        var exam_date = response.data[increase].exam_date;
                        var starting_time = response.data[increase].starting_time;
                        var ending_time = response.data[increase].ending_time;
                        var room_block = response.data[increase].room_block;

                        $(".exam-timetable-table").append(
                            `<tr>
                              <td>` + sn + `</td>
                              <td>` + exam + `</td>
                              <td>` + subject + `</td>
                              <td>` + exam_date + `</td>
                              <td>` + starting_time + `</td>
                              <td>` + ending_time + `</td>
                              <td>` + room_block + `</td>
                              <td>
                              <div class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="flaticon-more-button-of-three-dots"></span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item edit-timetable" timetable_id="`+id+`" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green mx-1"></i>Edit</a>
                                      <a class="dropdown-item delete-timetable" timetable_id="`+id+`" style="cursor:pointer"><i class="fas fa-trash text-danger mx-1"></i>Delete</a>
                                  </div>
                              </div>
                          </td>
                             </tr>`
                        );
    
                    });
                } else {
                    $(".exam-timetable-table").append(`
                 <tr>
                 <td>Not Any Exam Created.</td>
                 </tr>
                 `);
                }
    
                if(response.data[0].notice)
                {
                    alert("no data");
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
    $(".timetable-search-form").on("submit", function(e){
        e.preventDefault();
    });
});

// Delete Exam Timetable
$(document).ready(function(){
    $(".exam-timetable-table").on("click", ".delete-timetable", function () {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

       var timetable_id =  $(this).attr("timetable_id");

       $.ajax({
        url: "/delete-timetable",
        method: "POST",
        data: {
            timetable_id: timetable_id,
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
                Swal.fire({
                    title: "Timetable Delete Success !",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function() {
                    location.reload();
                  });

            } else {
                alert("Exam not found");
            }
        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });

        });
});