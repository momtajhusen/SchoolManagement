// Retrive all Exam Terms 
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-exam-term",
        method: "GET",
        // beforeSend: function () {
        //     // setting a timeout
        //     $(".submit-btn").addClass("d-none");
        //     $(".progress").removeClass("d-none");
        // },
        // Success
        success: function (response) {
            console.log(response.data);

            $(".exam-term-table").html(``);
            if (response.message != "data not found") {
                var count = 0;
                $(".select-exam-term").append(`
                <option class="exam-option" value="">select exam term</option>
               `);
                response.data.forEach(function (data) {
                    var increase = count++;
                    var id = response.data[increase].id;
                    var exam_name = response.data[increase].exam_name;
                    var year = response.data[increase].year;
                    var description = response.data[increase].description;
                    var session = response.data[increase].session;
                    var result_status = response.data[increase].result_status;

                    var status_icon = "";
                    if(result_status == "process"){
                        status_icon = "<span class='material-symbols-outlined'>autorenew</span><span style='font-size:10px;'>process</span>";
                    }
                    if(result_status == "publish"){
                        status_icon = "<span class='material-symbols-outlined'>published_with_changes</span><span style='font-size:10px;'>publish</span>";
                    }

                    if(result_status == "coming"){
                        status_icon = "<span class='material-symbols-outlined'>forward_media</span><span style='font-size:10px;'>next plan</span>";
                    }


                    $(".exam-term-table").append(
                        `<tr>
                          <td>` + increase + `</td>
                          <td>` + exam_name + `</td>
                          <td>` + year + `</td>
                          <td>` + description + `</td>
                          <td>` + session + `</td>
                          <td><div class="d-flex align-items-center flex-column">`+status_icon+`</div></td>

                          <td>
                          <div class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <span class="flaticon-more-button-of-three-dots"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item edit-exam-term" exam_id="`+id+`" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green mx-1"></i>Edit</a>
                                  <a class="dropdown-item delete-exam-term" exam_id="`+id+`" style="cursor:pointer"><i class="fas fa-trash text-danger mx-1"></i>Delete</a>

                                  <a class="dropdown-item d-flex exam_status" status="coming" exam_id="`+id+`" style="cursor:pointer"><span class="material-symbols-outlined">forward_media</span>Next Plan</a>
                                  <a class="dropdown-item d-flex exam_status" status="process" exam_id="`+id+`" style="cursor:pointer"><span class="material-symbols-outlined">autorenew</span>Process</a>
                                  <a class="dropdown-item d-flex exam_status" status="publish" exam_id="`+id+`" style="cursor:pointer"><span class="material-symbols-outlined">published_with_changes</span>Publish</a>
                              </div>
                          </div>
                      </td>
                         </tr>`
                    );

                    $(".select-exam-term").append(`
                       <option class="exam-option" value="`+exam_name+`" exam_id="`+id+`">`+exam_name+' '+year+`</option>
                  `);


                });
            } else {
                $(".exam-term-table").append(`
             <tr>
             <td>Not Any Exam Created.</td>
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

// Retrive Process Exam Terms 
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/process-exam-term",
        method: "GET",
        success: function (response) {
            console.log(response.processTerm);

 
            if (response.message != "data not found") {
                var count = 0;
                $(".select-process-term").append(`
                  <option class="exam-option">Select Exam Term</option>
               `);
                response.processTerm.forEach(function (data) {
                    var increase = count++;
                    var id = response.processTerm[increase].id;
                    var exam_name = response.processTerm[increase].exam_name;
                    var year = response.processTerm[increase].year;


                  $(".select-process-term").append(`
                   <option class="exam-option" value="`+exam_name+`" exam_id="`+id+`">`+exam_name+' '+year+`</option>
                `);

                });
            } else {
                $(".exam-term-table").append(`
             <tr>
             <td>Not Any Exam Created.</td>
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