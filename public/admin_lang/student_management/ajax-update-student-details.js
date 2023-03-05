// Retrive All Student
$(document).ready(function () {
    $(".search-btn").click(function () {
        var classvalue = $(".class-select").val();
        var studentroll = $(".roll-select").val();

        if (classvalue != "" && studentroll != "") {
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
                    class: classvalue,
                    roll: studentroll,
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
                    if (response.message != "data not found") {
                        console.log(response);
                        $(".student_details_cars").removeClass("d-none");

                        // Student Data
                        var student_id = response.Studentdata[0].id;
                        var first_name = response.Studentdata[0].first_name;
                        var middle_name = response.Studentdata[0].middle_name;
                        var last_name = response.Studentdata[0].last_name;
                        var admission_date =
                            response.Studentdata[0].admission_date;
                        var admission_year =
                            response.Studentdata[0].admission_year;
                        var blood_group = response.Studentdata[0].blood_group;
                        var student_class = response.Studentdata[0].class;
                        var district = response.Studentdata[0].district;
                        var email = response.Studentdata[0].email;
                        var gender = response.Studentdata[0].gender;
                        var login_email = response.Studentdata[0].login_email;
                        var login_password =
                            response.Studentdata[0].login_password;
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
                        var student_image =
                            response.Studentdata[0].student_image;
                        var id_image = response.Studentdata[0].id_image;

                        // Parents Data
                        var parents_id = response.Parentsdata[0].id;
                        var father_image = response.Parentsdata[0].father_image;
                        var father_name = response.Parentsdata[0].father_name;
                        var father_mobile =
                            response.Parentsdata[0].father_mobile;
                        var father_education =
                            response.Parentsdata[0].father_education;

                        var mother_image = response.Parentsdata[0].mother_image;
                        var mother_name = response.Parentsdata[0].mother_name;
                        var mother_mobile =
                            response.Parentsdata[0].mother_mobile;
                        var mother_education =
                            response.Parentsdata[0].mother_education;

                        $("#student_img").attr(
                            "src",
                            "http://127.0.0.1:8000/storage/" + student_image
                        );
                        $(".proofimage").attr(
                            "src",
                            "http://127.0.0.1:8000/storage/" + id_image
                        );
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
                        $("#student_blood_group option")
                            .filter(function () {
                                return $(this).text() == blood_group;
                            })
                            .prop("selected", true);
                        $("#section option")
                            .filter(function () {
                                return $(this).text() == section;
                            })
                            .prop("selected", true);
                        $('input[name="student_phone"]').val(phone);
                        $('input[name="student_email"]').val(email);
                        $('input[name="student_id_number"]').val(id_number);
                        $('input[name="admission_date"]').val(admission_date);
                        $("#class option")
                            .filter(function () {
                                return $(this).text() == student_class;
                            })
                            .prop("selected", true);
                        $('input[name="roll_no"]').val(roll_no);
                        $('input[name="district"]').val(district);
                        $('input[name="municipality"]').val(municipality);
                        $('input[name="village"]').val(village);
                        $('input[name="ward_no"]').val(ward_no);

                        $("#father_img").attr(
                            "src",
                            "http://127.0.0.1:8000/storage/" + father_image
                        );
                        $('input[name="parent_id"]').val(parents_id);
                        $('input[name="father_name"]').val(father_name);
                        $('input[name="father_phone"]').val(father_mobile);
                        $('input[name="father_education"]').val(
                            father_education
                        );

                        $("#mother_img").attr(
                            "src",
                            "http://127.0.0.1:8000/storage/" + mother_image
                        );
                        $('input[name="mother_name"]').val(mother_name);
                        $('input[name="mother_phone"]').val(mother_mobile);
                        $('input[name="mother_education"]').val(
                            mother_education
                        );
                    } else {
                        alert("sorry Error");
                    }
                },
            });
        } else {
            alert("Select Class and Roll");
        }
    });
});

// Update Details
$(document).ready(function () {
    $(".student-update-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var formData = new FormData(this);
        // formData.append('admission_year', admission_year);

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
                $(".submit-btn").removeClass("d-none");
                $(".progress").addClass("d-none");
                $(".alert-info").removeClass("d-none");
                setTimeout(function () {
                    $(".alert-info").addClass("d-none");
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
