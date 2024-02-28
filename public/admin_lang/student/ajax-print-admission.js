$(document).ready(function(){
    $(".table-body").on("click", "#print", function()
    {
       var st_id = $(this).attr("st_id");

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
                }, 500); // Delay of 0.5 second (1000 ms)
                
  

          },
          error: function (xhr, status, error) 
          {
              console.log(xhr.responseText);
          },

      });
        
    });
});