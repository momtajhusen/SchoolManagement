// Retrive All Subject
$(".search-class-subject").click(function(e){
    e.preventDefault();

    var select_class = $(".class-select").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/get-all-subject",
        method: "GET",
        data:{
            class: select_class,
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
        success: function (response) {
            // alert(response);
            // return false;
            $(".class-subject-table").html('');
            $(".select-subject").html('');
            $(".select-subject-option").html('');
            $(".select-subject").append(`
               <option value="">Select Subject </option>
           `);
            if (response.message != "data not found") {
                var count = 0;
                response.data.forEach(function (data) {
                    var increase = count++;
                    var subject_id = response.data[increase].id;
                    var classes = response.data[increase].class;
                    var subject_name = response.data[increase].subject_name;
                    var subject_teacher =
                        response.data[increase].subject_teacher;
                    var subject_code = response.data[increase].subject_code;

                    $(".class-subject-table").append(
             `<tr class="border">
              <td>
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input">
                      <label class="form-check-label">#0027</label>
                  </div>
              </td>
              <td class="subject-name">`+subject_name +`</td>
              <td class="class-name">` + classes + `</td>
              <td class="subject-teacher">` + subject_teacher + `</td>
              <td class="subject-code">` + subject_code + `</td>
               <td>
                  <div class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="flaticon-more-button-of-three-dots"></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item edit-subject" subject_id="` + subject_id + `" style="cursor:pointer"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                          <a class="dropdown-item delete-subject" subject_id="` + subject_id + `" style="cursor:pointer"><i class="fas fa-trash text-danger"></i>Delete</a>
                      </div>
                  </div>
              </td>
          </tr>`
         );

                    
                $(".select-subject").append(`
                  <option class="exam-option" value="`+subject_name+`" sub_id="`+subject_id+`">`+subject_name+`</option>
               `);

               $(".select-subject-option").append(`
                 <option class="exam-option" value="`+subject_id+`" sub_id="`+subject_id+`">`+subject_name+`</option>
              `);


                });
            } else {
                $(".class-subject-table").append(`
             <tr>
             <td>Subject Not Set For This Class</td>
             </tr>
             `);

             $(".select-subject").html('');
             $(".select-subject").append(`
             <option value="">No subject in this class </option>
            `);


            $(".select-subject-option").html('');
            $(".select-subject-option").append(`
              <option value="">No subject in this class </option>
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
