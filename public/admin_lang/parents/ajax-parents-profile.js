// Get parent Profile 
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var parent_id = $("#parent-id").val();

    $.ajax({
        url:  "/get-parent-profile",
        method: 'GET',
        data:{
            pr_id: parent_id,
        },
         // Success 
         success:function(response)
         {

            console.log(response);

            var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


            // Parent Data 
            var father_name = response.parent_data.father_name;
            var mother_name = response.parent_data.mother_name;
            var father_image = response.parent_data.father_image;
            var mother_image = response.parent_data.mother_image;
            var father_mobile = response.parent_data.father_mobile;
            var mother_mobile = response.parent_data.mother_mobile;

            father_image = currentDomainWithProtocol+`/storage/`+father_image;
            mother_image = currentDomainWithProtocol+`/storage/`+mother_image;


            $(".fatherImg").attr("src", father_image);
            $(".motherImg").attr("src", mother_image);
            $(".father-name").html(father_name);
            $(".mother-name").html(mother_name);
            $(".father-contact").html(father_mobile);


            // Parent Login details 
            var login_email = response.parent_data.login_email;
            var login_password = response.parent_data.login_password;


            // Student Data 
             var total_st = response.student_data.length;
             $(".st_no").html(total_st);

             response.student_data.forEach(function (data) {

                var student_name = data.first_name+" "+data.middle_name+" "+data.last_name;
                var st_image = data.student_image;
                var classes = data.class+" "+data.section;
                var roll_no = data.roll_no;
                var st_id = data.id;
 
                $("#student_box").append(`
                <div class="mb-2 d-flex justify-content-between p-3 students" st_id=`+st_id+`>
                    <div class="d-flex">
                        <img src="`+currentDomainWithProtocol+`/storage/`+st_image+`" alt="" style="width:40px;height:40px;border:1px solid black;">
                        <div class="ml-2" style="font-size: 13px;">
                            <div>Name : <span>`+student_name+`</span></div>
                            <div class="d-flex">
                                <div>Class : <span>`+classes+`</span></div>
                                <div class="ml-4">st_id : <span>`+st_id+`</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
             });

            //  if(1 < total_st){
            //   $("#student_box").append(`
            //  <div class="mb-2 d-flex justify-content-between p-3 students" st_id='5'>
            //      <div class="d-flex">
            //          <div class="ml-2" style="font-size: 13px;">
            //              <span>All Select</span>
            //          </div>
            //      </div>
            //     </div>
            // `);
            // }

            $(".students:first").trigger("click");



         },
        error: function (xhr, status, error) 
        {
            console.log(xhr.responseText);
        },
    });


});
