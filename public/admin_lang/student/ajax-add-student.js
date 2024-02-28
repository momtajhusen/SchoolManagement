// upload student 
$(document).ready(function () {
    $(".student-added-form").submit(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var student_dob = $(".student_dob").val();
        var admission_date = $(".admission_date").val();
        
        // if(!NepaliFunctions.ValidateBsDate(student_dob)){
        //     alert("Enter Valid Student Dob Date");
        //     return false;
        // }
        // if(!NepaliFunctions.ValidateBsDate(admission_date)){
        //     alert("Enter Valid Admision Date");
        //     return false;
        // }


        if(!NepaliFunctions.ValidateBsDate(admission_date)){
            alert("Invalid Expenses Date !");
            return false;
        }


        var class_year = admission_date.split("-")[0];
        var parent_check = $(".parent-check").val();


        if($(".parent-check").val() == "existing_parent")
        {
            var selectedParentId = $('input[name="parants_select"]:checked').val();
            if (!selectedParentId) {
                alert('Please select a parent');
                return false;
            }
        }

        var student_image_name = localStorage.getItem("student_register");
        var document_image_name = localStorage.getItem("document_register");
        var father_image_name = localStorage.getItem("father_register");
        var mother_image_name = localStorage.getItem("mother_register");


 
        var formData = new FormData(this);
        formData.append("class_year", class_year);
        formData.append("parent_check", parent_check);
        formData.append("parent_existing_id", selectedParentId);
        formData.append("student_image_name", student_image_name);
        formData.append("document_image_name", document_image_name);
        formData.append("father_image_name", father_image_name);
        formData.append("mother_image_name", mother_image_name);

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
                console.log(response);

                // return false;
            
                if(response.status == "Add Successfully")
                {
                    Swal.fire({
                        title: "Registration Success !",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "OK",
                      }).then(function() {
                         print_admision(response.student_id);
                      });
                }
                else if(response.status == "Failed Something Error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went Error ! Contact Developer',
                      })
                }
                else{
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

function print_admision(student_id){
 
    var st_id = student_id;

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url:  "/admin/admission-print",
        method: 'GET',
        data:{
            st_id:st_id,
        },
          // Success 
          success:function(response)
          {
 
                console.log(response);

                var student_image = response.student.student_image;

                var first_name = response.student.first_name;
                var middle_name = response.student.middle_name;
                var last_name = response.student.last_name;

                var gender = response.student.gender;
                var dob = response.student.dob;
                var religion = response.student.religion;
                var blood_group = response.student.blood_group;


                var phone = response.student.phone;
                var student_email = response.student.login_email;
                var student_password = response.student.login_password;

                var admission_date = response.student.class;
                var classes = response.student.class;
                var section = response.student.section;
                var roll_no = response.student.roll_no;

                
                var district = response.student.district;
                var village = response.student.village;
                var municipality = response.student.municipality;
                var ward_no = response.student.ward_no;

                var hostel_outi = response.student.hostel_outi;
                var transport_use = response.student.transport_use;
                var vehicle_root = response.student.vehicle_root;

                var tuition = response.student.tuition;

                // Parents Data 
                var father_name = response.parent.father_name;
                var father_mobile = response.parent.father_mobile;
                var father_education = response.parent.father_education;

                var mother_name = response.parent.mother_name;
                var mother_mobile = response.parent.mother_mobile;
                var mother_education = response.parent.mother_education;

                var father_email = response.parent.login_email;
                var father_password = response.parent.login_password;

                // School Details 
                var school_logo = response.school.logo_img;
                var school_name = response.school.school_name;
                var school_address = response.school.address;
                var school_email = response.school.email;
                var school_website = response.school.website;

                var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


                var content =  `<div id="admission-sucess" style="width: 595px; height: 842px;  position: relative; border:1px solid black;">

                <!-- School Header  -->
                <div style="padding: 10px; box-sizing: border-box; display: flex; height:100px;width:100%;border-bottom:1px solid black;">
        
                    <img src="`+currentDomainWithProtocol+`/storage/`+school_logo+`" style="width:50px; height:50px;">
        
                    <div style="width: 100%; text-align: center; display: flex; flex-direction: column;">
                        <span style="font-size: 30px; margin-bottom: 5px;">`+school_name+`</span>
                        <span style="font-size: 15px; margin-bottom: 5px;">`+school_address+`</span>
                        <span style="font-size: 15px; margin-bottom: 5px;">`+school_website+`</span>
        
                    </div>
        
                </div>
        
                <!-- Admission Sucess Header  -->
                <div style="padding: 10px; box-sizing: border-box; width:100%;border-bottom:1px solid black; display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: black; ">
                      <span style=" font-weight: 600; font-family:Arial, Helvetica, sans-serif; color: aliceblue;"> Admission Successful</span>
                </div>
        
                <hr style="margin-top: 2px;">
        
                <!-- Form Details  -->
                <div style="display: flex; flex-direction: column;">
        
                <!-- Student Details  -->
                <div style=" margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Student Details</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; display: flex; justify-content: start;">
                           <img src="`+currentDomainWithProtocol+`/storage/`+student_image+`" alt="student_img" style=" width:40px; height: 40px; border: 1px solid black;">
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                          <span style="font-weight: 800;">First Name</span><br>
                          <span >`+first_name+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Middle Name</span><br>
                            <span >`+middle_name+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Last Name</span><br>
                            <span >`+last_name+`</span>
                        </div>
                    </div>
        
                    <div style="width:100%; display: flex; margin-top: 2px;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                          <span style="font-weight: 800;">Gender</span><br>
                          <span >`+gender+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Date Of Birth</span><br>
                            <span >`+dob+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Religion</span><br>
                            <span >`+religion+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Blood Group</span><br>
                            <span>`+blood_group+`</span>
                        </div>
                    </div>
        
                    <div style="width:100%; display: flex; margin-top: 2px;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                          <span style="font-weight: 800;">Student Phone</span><br>
                          <span >`+phone+`</span>
                        </div>
                        <div style="width: 50%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Student E-Mail</span><br>
                            <span>`+student_email+`</span>
                        </div>
                        <!-- <div style="width: 25%; padding: 4px; box-sizing: border-box; display: flex; justify-content: start;">
                            <img src="" alt="" style=" width:40px; height: 40px; border: 1px solid black;">
                         </div> -->
                    </div>
        
                </div>
        
                <!-- Admission Details  -->
                <div style="margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Admission Details</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Admission Date</span><br>
                            <span >`+admission_date+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Class</span><br>
                            <span >`+classes+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Section</span><br>
                            <span >`+section+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Roll No</span><br>
                            <span >`+roll_no+`</span>
                        </div>
                    </div>
        
                    <div style="width:100%; display: flex; margin-top: 2px;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Hostel / Outi</span><br>
                            <span >`+hostel_outi+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Transport Use</span><br>
                            <span >`+transport_use+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Transport Root</span><br>
                            <span >`+vehicle_root+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;"> Tuition</span><br>
                            <span >`+tuition+`</span>
                        </div>
                    </div>
                </div>
        
                <!-- Student Address  -->
                <div style="margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Student Address</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">District</span><br>
                            <span >`+district+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Municipality</span><br>
                            <span >`+municipality+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Village</span><br>
                            <span >`+village+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; ">
                            <span style="font-weight: 800;">Ward No</span><br>
                            <span>`+ward_no+`</span>
                        </div>
                    </div>
                </div>
        
                <!-- Parent Details  -->
                <div style="margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Parent Details</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Father Name</span><br>
                            <span >`+father_name+`</span>
                        </div>
                        <div style="width: 20%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Father Mobile</span><br>
                            <span >`+father_mobile+`</span>
                        </div>
                        <div style="width: 30%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Email</span><br>
                            <span>`+father_email+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Education</span><br>
                            <span >`+father_education+`</span>
                        </div>
                    </div>
        
                    <div style="width:100%; display: flex; margin-top: 2px;">
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Mother Name</span><br>
                            <span >`+mother_name+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Mother Mobile</span><br>
                            <span >`+mother_mobile+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Education</span><br>
                            <span >`+mother_education+`</span>
                        </div>
                    </div>
                </div>
        
                <!-- Parent Account Login Details  -->
                <div style="margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Parent Account Login Details</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 45%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Parent Login Url:</span><br>
                            <span >https://sunrise.mustlearn.in/user-login</span><br>
                            <!-- <span>Visit this url than select Parent Login. Than Enter this Login Email Or Login password.</span> -->
                        </div>
                        <div style="width: 30%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Login Email</span><br>
                            <span >`+father_email+`</span>
                        </div>
                        <div style="width: 25%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Login password</span><br>
                            <span >`+father_password+`</span>
                        </div>
                    </div>
        
                </div>
        
                <!-- Admission Fee  -->
                <div style="margin-bottom:10px; width: 100%; padding-left:10px; padding-right:10px; box-sizing: border-box;">
                    <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">Admission Fee</span>
        
                    <div style="width:100%; display: flex;">
                        <div style="width: 45%; padding: 4px; box-sizing: border-box; overflow: hidden;">
                            <span style="font-weight: 800;">Payment</span><br>
                            <span >500</span><br>
                            <!-- <span>Visit this url than select Parent Login. Than Enter this Login Email Or Login password.</span> -->
                        </div>
                    </div>
        
                </div>
        
                </div>
         
                <!-- School Footer  -->
                <div style="padding:10px; text-align: center; box-sizing: border-box; width:100%;border-bottom:1px solid black; background-color: black; position: absolute; bottom: 0px; left: 0px;">
                    <span style="color: rgb(168, 166, 166);">Elevating Dreams, Celebrating Success: With Gratitude, We Welcome Your Child's Admission Triumph, Guiding Them Towards a Bright Future!</span>
                </div>
            </div>`;
                var printWindow = window.open('', '', 'height=800,width=800');
                var left = (screen.width / 2) - (800 / 2);
                var top = (screen.height / 2) - (800 / 2);
                printWindow.moveTo(left, top);
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                printWindow.document.write(content);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
            
                setTimeout(function() {
                  printWindow.print();
                  printWindow.close();
                  $("#bill-modal-cancle").click();
                  location.reload();
                }, 500); // Delay of 0.5 second (1000 ms)
                

          },
          error: function (xhr, status, error) 
          {
              console.log(xhr.responseText);
          },

      });
        
 

}

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

// Student Roll No  set after Clander date change
$(document).ready(function () {
    $(".admission_date").focusout(function () {
        var classvalue = $(".class-select").val();
        var year = $(".admission_date").val();
        var class_year = year.split("/")[2];

        if (classvalue != "") {
            $.ajax({
                url: "/roll-generate-admission",
                method: "GET",
                data: {
                    class: classvalue,
                    class_year: class_year,
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
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });
        }
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
                    <input class="form-check-input" value="`+id+`" type="radio" name="parants_select" id="flexRadioDefault1">
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

$(document).ready(function() {
    $('.parents-search-select').change(function() {
      var selectedOption = $(this).val();
      $(".parents-input-search").val("");
      
      $(".parents-input-search").attr("placeholder", "Enter "+selectedOption);
 
    });
  });
 
