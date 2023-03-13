// upload student 
$(document).ready(function () {
    $(".student-added-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var admission_date = $(".admission_date").val();
        var admission_year = admission_date.split("/")[2];
        var parent_check = $(".parent-check").val();


        if($(".parent-check").val() == "existing_parent")
        {
            var selectedParentId = $('input[name="parants_select"]:checked').val();
            if (!selectedParentId) {
                alert('Please select a parent');
                return false;
            }
        }
 
        var formData = new FormData(this);
        formData.append("admission_year", admission_year);
        formData.append("parent_check", parent_check);
        formData.append("parent_existing_id", selectedParentId);

        $.ajax({
            url: "/add-student",
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
            success: function (response) 
            {
                if(response.status == "Add Successfully")
                {
                    Swal.fire({
                        title: "Registration Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                        location.reload();
                      });
                }
                else if(response.status == "Failed Something Error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went Error ! Contact Developer',
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

// Student Roll No  set after class select
$(document).ready(function () {
    $(".class-select").change(function () {
        var classvalue = $(this).val();
        var year = $(".admission_date").val();
        var admission_date = year.split("/")[2];

        $.ajax({
            url: "/roll-generate-admission",
            method: "GET",
            data: {
                class: classvalue,
                admission_date: admission_date,
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
                // alert(response.student);

                $(".student_roll").val(response.student + 1);
            },
        });
    });
});

// Student Roll No  set after Clander date change
$(document).ready(function () {
    $(".admission_date").focusout(function () {
        var classvalue = $(".class-select").val();
        var year = $(".admission_date").val();
        var admission_date = year.split("/")[2];

        if (classvalue != "") {
            $.ajax({
                url: "/roll-generate-admission",
                method: "GET",
                data: {
                    class: classvalue,
                    admission_date: admission_date,
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
                                var percentComplete =
                                    percentComplete.toFixed(2);
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
                    // alert(response.student);

                    $(".student_roll").val(response.student + 1);
                },
            });
        }
    });
});


// Retrive parents Search
$(document).ready(function(){
    $(".search-parent").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       var parents_search_select =  $(".parents-search-select").val();
       var parents_input_search = $(".parents-input-search").val();
        
        $.ajax({
            url: "/get-all-parents",
            method: 'GET',
            data:{
                parents_search_select : parents_search_select,
                parents_input_search : parents_input_search,
            },
            // Success 
            success:function(response)
            {
 
                $(".table-body").html(``);
                if(response.message != "data not found"){
                var count = 0;
                response.data.forEach(function(data){
                var increase = count++
                var id = response.data[increase].id;

                var father_image = response.data[increase].father_image;
                var father_name = response.data[increase].father_name;
                var father_mobile = response.data[increase].father_mobile;
                var father_education = response.data[increase].father_education;

                var mother_image = response.data[increase].mother_image;
                var mother_name = response.data[increase].mother_name;
                var mother_mobile = response.data[increase].mother_mobile;
                var mother_education  = response.data[increase].mother_education;   
                var Kids_id = response.data[increase].Kids_id;

                $(".table-body").append(`  
                <tr>
                <td class="d-flex justify-content-center h-100 align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" value="`+id+`" type="radio" name="parants_select" id="flexRadioDefault1">
                    </div>
                </td>
                <td class="text-center"><a href="student-details/`+id+`"><img src="http://127.0.0.1:8000/storage/`+father_image+`" style="height:50px;width:50px;" alt="father_img"></a></td>
                <td><a  href="father-details/`+id+`" class="text-dark">`+father_name+`</a></td>
                <td>`+father_mobile+`</td>
                <td>`+father_education+`</td>
                <td><a href="father-details/`+id+`"><img src="http://127.0.0.1:8000/storage/`+mother_image+`" style="height:50px;width:50px;" alt="mother_img"></a></td>
                <td>`+mother_name+`</td>
                <td>`+mother_mobile+` </td>
                <td>`+mother_education+`</td>
                <td>`+Kids_id+`</td>
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
            </tr>`);

                });
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
    
    });


});
