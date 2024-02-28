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
            console.log(response.data);

            $(".table-body").html(``);
            if (response.message != "data not found") {
                var count = 0;
                response.data.forEach(function (data) {
                    var increase = count++;
                    var id = response.data[increase].id;
                    var image = response.data[increase].image;
                    var first_name = response.data[increase].first_name;
                    var last_name = response.data[increase].last_name;
                    var gender = response.data[increase].gender;
                    var phone = response.data[increase].phone;
                    var joining_date = response.data[increase].joining_date;
                    var salary = response.data[increase].salary;
                    var address = response.data[increase].address;

                    var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                    $(".table-body").append(
                        `
                          <tr>
                          <td>
                              <div class="form-check">
                                  <input type="checkbox" class="form-check-input">
                                  <label class="form-check-label">`+id+`</label>
                              </div>
                          </td>
                          <td class="text-center"><a href="teacher-profile/`+id+`">
                          <img src="`+currentDomainWithProtocol+`/storage/` +image +`" alt="student" style="height:40px;"></a></td>
                          <td><a   href="teacher-profile/`+id+`" class="text-dark">` + first_name +` ` + last_name + `</a></td>
                          <td>` + joining_date + `</td>
                          <td>` + salary + `</td>
                          <td>` + address + `</td>
                          <td>` + gender + `</td>
                          <td>` + phone + `</td>
                           <td>
                              <div class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="flaticon-more-button-of-three-dots"></span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="/teacher-update/`+id+`"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                      <a class="dropdown-item" href="#"><i class="fas fa-trash text-orange-peel"></i>Delete</a>
                                      <a class="dropdown-item d-flex" href="teacher-profile/`+id+`"><span class="material-symbols-outlined pr-4">person</span>Profile</a>
                                  </div>
                              </div>
                          </td>
                      </tr>`
                    );
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


// Search Teacher
$(document).ready(function () {

    $(".search-teacher").click(function(){

        var teacher_search_select = $(".teacher-search-select").val();
        var teacher_input_search = $(".teacher-input-search").val();

        if(teacher_search_select == ""){
            alert("select search by");
            return false;
        }
        if(teacher_input_search == ""){
            alert("input search");
            return false;
        }


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        
    
    
        $.ajax({
            url: "/get-search-teacher",
            method: "GET",
            data:{
                teacher_search_select : teacher_search_select,
                teacher_input_search : teacher_input_search,
            },
            beforeSend: function () {
                // setting a timeout
                $(".submit-btn").addClass("d-none");
                $(".progress").removeClass("d-none");
            },
            // Success
            success: function (response) {
                console.log(response);

                // alert(response);
                // return false;
                $(".table-body").html(``);
                if (response.message != "data not found") {
                    var count = 0;
                    response.data.forEach(function (data) {
                        var increase = count++;
                        var id = response.data[increase].id;
                        var image = response.data[increase].image;
                        var first_name = response.data[increase].first_name;
                        var last_name = response.data[increase].last_name;
                        var gender = response.data[increase].gender;
                        var phone = response.data[increase].phone;
                        var salary = response.data[increase].salary;
                        var address = response.data[increase].address;
    
                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
    
                        $(".table-body").append(
                            `
                              <tr>
                              <td>
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input">
                                      <label class="form-check-label">`+id+`</label>
                                  </div>
                              </td>
                              <td class="text-center"><a href="#">
                              <img src="`+currentDomainWithProtocol+`/storage/` +image +`" alt="student" style="height:40px;"></a></td>
                              <td><a   href="#" class="text-dark">` + first_name +` ` + last_name + `</a></td>
                              <td>` + salary + `</td>
                              <td>` + address + `</td>
                              <td>` + gender + `</td>
                              <td>` + phone + `</td>
                               <td>
                                  <div class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          <span class="flaticon-more-button-of-three-dots"></span>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right">
                                          <a class="dropdown-item" href="/teacher-update/`+id+`"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                          <a class="dropdown-item" href="#"><i class="fas fa-trash text-orange-peel"></i>Delete</a>
                                          <a class="dropdown-item d-flex" href="teacher-profile/`+id+`"><span class="material-symbols-outlined pr-4">person</span>Profile</a>
                                      </div>
                                  </div>
                              </td>
                          </tr>`
                        );
                    });
                } else {
                    $(".table-body").append(`
                 <tr>
                    <td>Teacher not found</td>
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
