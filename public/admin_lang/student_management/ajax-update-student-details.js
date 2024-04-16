// Retrive  Student For Update
$(document).ready(function () {
 
        var student_id = $("#student_id").val();
 
        if (student_id != "") {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/single-student-details",
                method: "GET",
                data: {
                    year:current_year,
                    student_id: student_id,
                },
                // beforeSend: function()
                // {
                //  // setting a timeout
                //    $(".submit-btn").addClass('d-none');
                //    $(".progress").removeClass('d-none');
                // },
                // Progress
                //  xhr: function(){
                //      var xhr = new window.XMLHttpRequest();
                //      xhr.upload.addEventListener("progress", function(evt) {
                //          if (evt.lengthComputable) {
                //              var percentComplete = (evt.loaded / evt.total) * 100;
                //              var percentComplete =  percentComplete.toFixed(2);
                //              $(".progress-bar").width(percentComplete+"%");
                //              $(".progress-bar").html(percentComplete+" %");

                //          }
                //      }, false);
                //      return xhr;
                //  },
                // Success
                success: function (response) {
                    $(".existing-parent").click();

                    console.log(response);

 
                    if (response.message != "data not found") {
                        console.log(response);
                        $(".student_details_cars").removeClass("d-none");

                        // Student Data
                        var student_id = response.Studentdata[0].id;
                        var parents_id = response.Studentdata[0].parents_id;
                        var first_name = response.Studentdata[0].first_name;
                        var middle_name = response.Studentdata[0].middle_name;
                        var last_name = response.Studentdata[0].last_name;
                        var admission_date = response.Studentdata[0].admission_date;
                        var admission_year = response.Studentdata[0].admission_year;
                        var blood_group = response.Studentdata[0].blood_group;
                        var student_class = response.Studentdata[0].class;
                        var district = response.Studentdata[0].district;
                        var email = response.Studentdata[0].email;
                        var gender = response.Studentdata[0].gender;
                        var login_email = response.Studentdata[0].login_email;
                        var login_password = response.Studentdata[0].login_password;
                        var municipality = response.Studentdata[0].municipality;
                        var phone = response.Studentdata[0].phone;
                        var religion = response.Studentdata[0].religion;
                        var village = response.Studentdata[0].village;
                        var dob = response.Studentdata[0].dob;
                        var id_number = response.Studentdata[0].id_number;
                        var section = response.Studentdata[0].section;
                        var village = response.Studentdata[0].village;
                        var district = response.Studentdata[0].district;
                        var ward_no = response.Studentdata[0].ward_no;
                        var roll_no = response.Studentdata[0].roll_no;
                        var student_image = response.Studentdata[0].student_image;
                        var id_image = response.Studentdata[0].id_image;
                        var coaching = response.Studentdata[0].coaching;
                        var hostel_outi = response.Studentdata[0].hostel_outi;
                        var transport_use = response.Studentdata[0].transport_use;
                        var root_name = response.Studentdata.TransportRoot.root_name;
                        var root_amount = response.Studentdata.TransportRoot.root_amount;

                        if (response.TotalPayment.total_payment != "0") {
                            // Disable the click event and display alert
                            $('.paymode').on('mousedown', function(event) {
                                event.preventDefault();
                                alert('This student has paid the fees of this class for a few months, now it cannot be change.');
                                });
 
                          } else {
                            // Enable the click event
                            $('.paymode').on('click', function() {
                            // Handle the click event
                            });
                          }

                          $('.class-paymode').on('mousedown', function(event) {
                            event.preventDefault();
                            alert('If you want to change class then you can change from student promotion page.');
                            }); 

                        localStorage.setItem('parents_id', parents_id);

                        // Parents Data
                        var parents_id = response.Parentsdata[0].id;
                        var father_image = response.Parentsdata[0].father_image;
                        var father_name = response.Parentsdata[0].father_name;
                        var father_mobile = response.Parentsdata[0].father_mobile;
                        var father_education = response.Parentsdata[0].father_education;
                        var father_email = response.Parentsdata[0].login_email;

                        var mother_image = response.Parentsdata[0].mother_image;
                        var mother_name = response.Parentsdata[0].mother_name;
                        var mother_mobile = response.Parentsdata[0].mother_mobile;
                        var mother_education = response.Parentsdata[0].mother_education;

                        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                        var studentImageWithCacheBust = currentDomainWithProtocol + "/storage/" + student_image + "?timestamp=" + new Date().getTime();
                        $("#student_img_preview").attr("src", studentImageWithCacheBust);
                        $("#document_img_preview").attr("src", currentDomainWithProtocol+"/storage/" + id_image);
                        $('input[name="student_id"]').val(student_id);
                        $('input[name="student_first_name"]').val(first_name);
                        $('input[name="student_middle_name"]').val(middle_name);
                        $('input[name="student_last_name"]').val(last_name);
                        $(".gender-select option")
                            .filter(function () {
                                return $(this).text() == gender;
                            })
                            .prop("selected", true);
                        $('input[name="student_dob"]').val(dob);
                        $("#student_religion option")
                            .filter(function () {
                                return $(this).text() == religion;
                            })
                            .prop("selected", true);

                        $("#student_blood_group option").filter(function () {
                                return $(this).text() == blood_group;
                        }).prop("selected", true);

                        $("#section option").filter(function () {
                                return $(this).text() == section;
                            }).prop("selected", true);

                            $("#coaching_use option").filter(function () {
                                return $(this).text() == coaching;
                            }).prop("selected", true);

                            
                            $("#hostel_outi option").filter(function () {
                                return $(this).text() == hostel_outi;
                            }).prop("selected", true);

                            if(hostel_outi != "hostel"){
                                // $("#transport").removeClass("d-none");
                            $("#transport_use option").filter(function () {
                                return $(this).text() == transport_use;
                            }).prop("selected", true);
                           }
                           else{
                            // $("#transport").addClass("d-none");
                           }

                        if(transport_use != "No"){
                            setTimeout(function(){
                               $("#root_select option").filter(function () {
                                return $(this).text() == root_name+": "+root_amount;
                            }).prop("selected", true);
                            //  $("#loader-content").addClass("d-none");
                            },1000);
                        }
                        else{
                            setTimeout(function(){
                            //   $("#transport_root").addClass("d-none");
                            //   $("#loader-content").removeClass("d-none");
                            },1000);
                        }

                        

                        $('input[name="student_phone"]').val(phone);
                        $('input[name="student_email"]').val(email);
                        $('input[name="student_id_number"]').val(id_number);
                        $('input[name="admission_date"]').val(admission_date);

                        $('input[name="class"]').val(student_class);
                        // $("#class option")
                        //     .filter(function () {
                        //         return $(this).text() == student_class;
                        //     })
                        //     .prop("selected", true);
                        $('input[name="roll_no"]').val(roll_no);
                        $('input[name="district"]').val(district);
                        $('input[name="municipality"]').val(municipality);
                        $('input[name="village"]').val(village);
                        $('input[name="ward_no"]').val(ward_no);

                        // $("#father_img_preview").attr("src", currentDomainWithProtocol+"/storage/" + father_image);
                        // $('input[name="parent_id"]').val(parents_id);
                        // $('input[name="father_name"]').val(father_name);
                        // $('input[name="father_phone"]').val(father_mobile);
                        // $('input[name="father_email"]').val(father_email);
                        // $('input[name="father_education"]').val(father_education);

                        // $("#mother_img_preview").attr("src", currentDomainWithProtocol+"/storage/" + mother_image);
                        // $('input[name="mother_name"]').val(mother_name);
                        // $('input[name="mother_phone"]').val(mother_mobile);
                        // $('input[name="mother_education"]').val(
                        //     mother_education
                        // );
                    } else {
                        $(".student_details_cars").addClass("d-none");
                        alert("sorry Error");
                    }
                },
                error: function(xhr, status, error) {
                    var errors = JSON.parse(xhr.responseText);
                    console.log(errors.ErrorMessage);
                    // Display error messages to user
                }
            });
        } else {
            alert("Select Class and Student");
        }
 
});

// New Parent ? and Existing Parent ? 
$(document).ready(function() {
    // remove the form when the "Remove Form" button is clicked
    $('.existing-parent').click(function() {
        $(".parent-check").val("existing_parent");
        $('input[name="father_name"]').attr('required', false);
        $('input[name="father_phone"]').attr('required', false);
        $('input[name="mother_name"]').attr('required', false);
        $('input[name="father_email"]').attr('required', false);
        $(".search-parent").click();
    });
    // add the form again when the "Return Form" button is clicked
    $('.new-parent').click(function() {
      $(".parent-check").val("new_parent");
        $('input[name="father_name"]').attr('required', true);
        $('input[name="father_phone"]').attr('required', false);
        $('input[name="mother_name"]').attr('required', false);
        $('input[name="father_email"]').attr('required', false);
    });
});


$(document).ready(function(){
    $(".student-select").on("change",function(){
        $(".search-btn").click();
    })
});

  $(document).ready(function() {
    $('.parents-search-select').change(function() {
      var selectedOption = $(this).val();
      $(".parents-input-search").val("");
      
      $(".parents-input-search").attr("placeholder", "Enter "+selectedOption);
 
    });
  });

// Update Details
$(document).ready(function () {
    $(".student-update-form").submit(function (e) {
        e.preventDefault();

        alert();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var parent_check = $(".parent-check").val();

        if($(".parent-check").val() == "existing_parent")
        {
               var selectedParentId = $('input[name="parants_select"]:checked').val();
            if (!selectedParentId) {
                var selectedParentId = localStorage.getItem('parents_id'); 

            }
        }

        var student_image_name = localStorage.getItem("student_register");
        var document_image_name = localStorage.getItem("document_register");
        var father_image_name = localStorage.getItem("father_register");
        var mother_image_name = localStorage.getItem("mother_register");

        var formData = new FormData(this);
        formData.append("parent_check", parent_check);
        formData.append("parent_existing_id", selectedParentId);
        formData.append("student_image_name", student_image_name);
        formData.append("document_image_name", document_image_name);
        formData.append("father_image_name", father_image_name);
        formData.append("mother_image_name", mother_image_name);
        formData.append("current_year", current_year);



        $.ajax({
            url: "/update-student",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
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

                console.log(response);
 
                $(".submit-btn").removeClass("d-none");
                $(".progress").addClass("d-none");
                $(".alert-info").removeClass("d-none");
                setTimeout(function () {
                    $(".alert-info").addClass("d-none");
                }, 3000);
                Swal.fire(
                    "Update Success !",
                    "You clicked the button!",
                    "success"
                );
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});


// Student Roll No  set after section select
$(document).ready(function () {
    $(".section-select").change(function () {
 
        var classvalue = $(".class-select").val();
        var sectionvalue = $(this).val();
        var year = $(".admission_date").val();
        var admission_date = year.split("/")[2];

        $.ajax({
            url: "/roll-generate-admission",
            method: "GET",
            data: {
                class: classvalue,
                admission_date: admission_date,
                sectionvalue:sectionvalue,
            },
            beforeSend: function () {
                // setting a timeout
                //    $(".submit-btn").addClass('d-none');
                //    $(".progress").removeClass('d-none');
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

                    $(".student_roll").val(response.student_count+1);
 
            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
    });
});

// Get Section Class change
$(document).ready(function(){
    $(".class-select").change(function () {
        var classvalue = $(this).val();

        $.ajax({
            url: "/class-section",
            method: "GET",
            data: {
                class: classvalue,
                current_year: current_year,
            },
            // Success
            success: function (response) {

       // Access the class data from the response
       var classes = response.data;

       // Loop through the classes and do something with each class object
       $(".section-select").html('');
       $(".section-select").append(`<option value="">Please Select Section *</option>`);
       $(".student_roll").val(``);
       for (var i = 0; i < classes.length; i++) {
           var classObj = classes[i];
           console.log(classObj.class);
           console.log(classObj.section);
           console.log(classObj.capacity);
           // ... and so on

           $(".section-select").append(`<option value="`+classObj.section+`">`+classObj.section+`</option>`);
       }

        },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
        });

    }); 
});

// Retrive parents Search
$(document).ready(function(){
    $(".search-parent").click(function(){
        var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
       AllParents(currentDomainWithProtocol+"/get-all-parents?page=1");
    });
});
 

function AllParents(url){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var parents_search_select =  $(".parents-search-select").val();
    var parents_input_search = $(".parents-input-search").val();
     
  

    $.ajax({
        url: url,
        method: 'GET',
        data:{
            parents_search_select : parents_search_select,
            parents_input_search : parents_input_search,
        },
        // Success 
        success:function(response)
        {

            console.log(response);

        
            // show pagination number 
            var start = response.parent_data.from;
            var end = response.parent_data.per_page;

            var links = response.parent_data.links.length-2;
 
            var i; 
            var ul = document.createElement("UL");
            ul.className = "pagination";
            for(i=start;i<=links;i++)
            {
                $(".pagnation-box").html("");

               var li = document.createElement("LI");
               li.className = "page-item";
               $(ul).append(li);

               var a = document.createElement("a");
               a.className = "page-link";
               a.innerHTML = i;
               var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
               a.href = currentDomainWithProtocol+"/get-all-parents?page=" + i;
               $(li).append(a);

            //    get data on click 

            $(a).click(function(e){
               e.preventDefault();
               $(this).attr("href");
               AllParents($(this).attr("href"));
            });
               
            }
            if($(".pagnation-box").html() == "")
            {
                $(".pagnation-box").append(ul);
            }
            ////// 


            $(".table-body").html(``);
            if(response.message != "data not found"){
            var count = 0;
            response.parent_data.data.forEach(function(data){
            var increase = count++
            var id = response.parent_data.data[increase].id;
           

            var father_image = response.parent_data.data[increase].father_image;
            var father_name = response.parent_data.data[increase].father_name;
            var father_mobile = response.parent_data.data[increase].father_mobile;
            var father_education = response.parent_data.data[increase].father_education;

            var mother_image = response.parent_data.data[increase].mother_image;
            var mother_name = response.parent_data.data[increase].mother_name;
            var mother_mobile = response.parent_data.data[increase].mother_mobile;
            var mother_education  = response.parent_data.data[increase].mother_education;   

            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


            $(".table-body").append(`  
            <tr>
            <td>`+id+`</td>
            <td class="d-flex justify-content-center h-100 align-items-center">
                <div class="form-check">
                    <input class="parents_radio" value="`+id+`" type="radio" name="parants_select" id="flexRadioDefault1">
                </div>
            </td>
            <td class="text-center"><a href="student-details/`+id+`"><img src="`+currentDomainWithProtocol+`/storage/`+father_image+`" style="height:40px; padding:2px;border:1px solid  #ccc;" alt="father_img"></a></td>
            <td><a  href="father-details/`+id+`" class="text-dark">`+father_name+`</a></td>
            <td>`+father_mobile+`</td>
            <td>`+father_education+`</td>
            <td><a href="father-details/`+id+`"><img src="`+currentDomainWithProtocol+`/storage/`+mother_image+`" style="height:40px; padding:2px;border:1px solid  #ccc;" alt="mother_img"></a></td>
            <td>`+mother_name+`</td>
            <td>`+mother_mobile+` </td>
            <td>`+mother_education+`</td>
        </tr>`);

            });

            // Check the radio button that matches the `parents_id` value from `localStorage`
            var parents_id = localStorage.getItem('parents_id');
            $(".parents_radio[value='" + parents_id + "']").prop("checked", true);

            }
            else{
            $(".table-body").append(`
            <tr>
             <td class="text-danger">Parent Not Found !</td>
            </tr>
            `);
            }

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });
}
 
 

