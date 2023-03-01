// Retrive All Student
$(document).ready(function(){

    $(".search-btn").click(function(){
        var classvalue =   $(".class-select").val();
        var studentroll =   $(".roll-select").val();

        if(classvalue != "" && studentroll != "")
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax({
                url: "/student-update",
                method: 'GET',
                data:{
                    class : classvalue,
                    roll : studentroll,
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
                 success:function(response)
                 {
                       

                        if(response.message != "data not found")
                        {
                            console.log(response);
                            $(".student_details_cars").removeClass("d-none");

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
                            // var student_image = response.Studentdata[0].student_image;
                            // var student_image = response.Studentdata[0].student_image;



                            // alert(gender);

                             $('#student_img').attr("src", "http://127.0.0.1:8000/storage/"+student_image);
                             $('.proofimage').attr("src", "http://127.0.0.1:8000/storage/"+id_image);
                             $('input[name="student_first_name"]').val(first_name);
                             $('input[name="student_middle_name"]').val(middle_name);
                             $('input[name="student_last_name"]').val(last_name);
                             $('.gender-select option').filter(function() {return $(this).text() == gender;}).prop("selected", true);
                             $('input[name="student_dob"]').val(dob);
                             $('#student_religion option').filter(function() {return $(this).text() == religion;}).prop("selected", true);
                             $('#student_blood_group option').filter(function() {return $(this).text() == blood_group;}).prop("selected", true);
                             $('#section option').filter(function() {return $(this).text() == section;}).prop("selected", true);
                             $('input[name="student_phone"]').val(phone);
                             $('input[name="student_email"]').val(email);
                             $('input[name="student_id_number"]').val(id_number);
                             $('input[name="admission_date"]').val(admission_date);
                             $('#class option').filter(function() {return $(this).text() == student_class;}).prop("selected", true);
                             $('input[name="roll_no"]').val(roll_no);
                             $('input[name="district"]').val(district);
                             $('input[name="municipality"]').val(municipality);
                             $('input[name="village"]').val(village);
                             $('input[name="ward_no"]').val(ward_no);

                            //  $('input[name="student_first_name"]').val(student_name);
                            //  $('input[name="student_first_name"]').val(student_name);
                            //  $('input[name="student_first_name"]').val(student_name);
                            //  $('input[name="student_first_name"]').val(student_name);
                            //  $('input[name="student_first_name"]').val(student_name);

                        }
                        else{
                           alert("sorry Error");
                        }
        
                 }
            });
         
        }
        else{
            alert("Select Class and Roll"); 
        }
    });
 
    

});