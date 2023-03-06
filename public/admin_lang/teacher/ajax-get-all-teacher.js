// Retrive All Student
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
                    var salary = response.data[increase].salary;
                    var address = response.data[increase].salary;

                    $(".table-body").append(
                        `
                          <tr>
                          <td>
                              <div class="form-check">
                                  <input type="checkbox" class="form-check-input">
                                  <label class="form-check-label">#0027</label>
                              </div>
                          </td>
                          <td class="text-center"><a href="student-details/` +
                            id +
                            `">
                          <img src="http://127.0.0.1:8000/storage/` +
                            image +
                            `" alt="student" style="height:40px;"></a></td>
                          <td><a  href="student-details/` +
                            id +
                            `" class="text-dark">` +
                            first_name +
                            ` ` +
                            last_name +
                            `</a></td>
                            <td>` +
                            salary +
                            `</td>
                            <td>` +
                            address +
                            `</td>
                          <td>` +
                            gender +
                            `</td>
                          <td>Father Name</td>
 
                          <td>` +
                            phone +
                            `</td>
                           <td>
                              <div class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="flaticon-more-button-of-three-dots"></span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                      <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                      <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
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
    });
});
