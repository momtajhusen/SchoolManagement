
// Retrive parent and student 
$(document).ready(function() {
    $('.search-parents').click(function() {

      var parent_id = $(".parents-input-search ").val();

      $(".student_box").html('');
      $("#fee_stracture").html('');
      $("#update-btn").addClass("d-none");

         if(parent_id){ 

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                url: "/parent-child-fee",
                data:{
                    parent_id:parent_id,
                },
                method: "GET",
                beforeSend: function () {
                    $(".search-parents").html("Loading...");
                },
                // Success
                success: function (response) {
                    $(".search-parents").html("SEARCH");

                    console.log(response);

                   if(response.parent_data){

                    //  parent details 
                      var father_name = response.parent_data.father_name;
                      var mother_name = response.parent_data.mother_name;
                      var father_image = response.parent_data.father_image;
                      var mother_image = response.parent_data.mother_image;

                    //   student details 
                    var total_child = response.student.length;


                      var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;

                      $("#father_name").html(father_name);
                      $("#mother_name").html(mother_name);
                      $("#father_img").attr("src", currentDomainWithProtocol+"/storage/"+father_image);
                      $("#mother_img").attr("src", currentDomainWithProtocol+"/storage/"+mother_image);
                      $("#total_child").html(total_child);


                    response.student.forEach(function (data) {

 
                        var student_name = data.first_name+" "+data.middle_name+" "+data.last_name;
                        var st_image = data.student_image;
                        var classes = data.class+" "+data.section;
                        var roll_no = data.roll_no;
                        var st_id = data.id;

                        // Free Fee Student check 
                        var FreeStudents = data.FreeStudents;
                        if(FreeStudents == "Yes"){
                             var free_st = "free_student";   
                             var feeExc = "Fee Excep."; 
                         }
                         else{
                            var free_st = ""; 
                            var feeExc = ""; 
                         }

                        // Exception check 
                         var FreeStudents = data.DiscountExc;
                         if(FreeStudents == "Yes"){
                              var discExc = "Dis Excep.";   
                          }
                          else{
                             var discExc = ""; 
                          }
         
                        $(".student_box").append(`
                            <div class="mb-2 d-flex justify-content-between p-3" style="background-color:#D9D9D9;">
                                <div class="d-flex">
                                    <img src="`+currentDomainWithProtocol+`/storage/`+st_image+`" alt="" style="width:40px;height:40px;border:1px solid black;">
                                    <div class="ml-2" style="font-size: 13px;">
                                        <div>Student Name : <span>`+student_name+`</span></div>
                                        <div class="d-flex">
                                            <div>Class : <span>`+classes+`</span></div>
                                            <div class="ml-4">Roll : <span>`+roll_no+`</span></div>
                                            <div class="ml-4">st_id : <span>`+st_id+`</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center pr-3">
                                    <div class="d-flex flex-column ml-2" style="font-size: 10px;">
                                        <span>`+feeExc+`</span>
                                        <span>`+discExc+`</span>
                                    </div>
                                  <input type="radio" st_id="`+st_id+`" class="`+free_st+`" id="st_radion_btn" id="html" name="student" value="HTML" style="cursor:pointer;">
                                </div>
                            </div>
                        `);

                    });


                    $(".free_student").click();  

                   }
                   
                   else{
                    alert(response);
                   }
 
                },
                error: function (xhr, status, error) 
                {
                    console.log(xhr.responseText);
                },
            });

         }
         else{
            alert("please enter parent id");
         }
         
 
    });
});

// Retrive fee stracture 
$(document).ready(function(){
 
    $(".student_box").on("click", "#st_radion_btn", function(){

        var st_id = $(this).attr("st_id");
        $("#fee_stracture").html('');
        $("#discount_stracture").html('');
        $("#discount_stracture").addClass("d-none");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/free-fee-stracture",
            data:{
                st_id:st_id,
            },
            method: "GET",
            beforeSend: function () {
                $(".search-parents").html("Loading...");
            },
            // Success
            success: function (response) {
                $(".search-parents").html("SEARCH");

                console.log(response);
                $("#discount_stracture").removeClass("d-none");

                if (response.SchoolFeeStructure) {
                    $("#update-btn").removeClass("d-none");
                
                    var chec = "";
                    var dic = 0;
                    response.SchoolFeeStructure.forEach(function (data, index) {
 

                        // Check free fee type and than check 
                        if(response.FreeStudentFee != "not free"){
                            if (response.FreeStudentFee.indexOf(data) !== -1) {
                                chec = ""; 
                            } else {
                                chec = "checked"; 
                            }
                        }
                        else{
                            chec = "checked";  
                        }

                        // Check Discount Exception avable than set value 
                        if(response.DiscountExceptions != "not discount"){
                            
                            if(response.DiscountExceptions[index] != undefined){
                              if(response.DiscountExceptions[index].fee_type == data){
                                    dic = response.DiscountExceptions[index].dis;
                              }
                            }
                        }
     
                
                        $("#fee_stracture").append(`
                            <div class="pl-3 mb-2 d-flex justify-content-between" style="padding:7px;background-color:#C5C5C5;">
                                <div>${data}</div>
                                <div class="pr-3">
                                    <input type="checkbox" ${chec} class="fee_type_checkbox" fee_type="${data}" name="fav_language" value="" style="cursor:pointer;">
                                </div>
                            </div>`
                        );

                        $("#discount_stracture").append(`
                            <div class="d-flex mb-2"">
                                <input class="p-2 px-3 dis_feetype" type="text" readonly value="${data}" style="width:150px;outline:none;border:2px solid #CAC9C9;border-left:0px;background:#CAC9C9;"> 
                                <input class="px-2 text-center" readonly type="number" value="" style="width:80px;outline:none;border:2px solid #CAC9C9;background:#CAC9C9;">
                                <input class="px-2 text-center" readonly type="number" value="" style="width:80px;outline:none;border:2px solid #CAC9C9;background:#CAC9C9;">
                                <input class="px-2 text-center percentage" type="number" step="1" value="${dic}" style="width:40px;outline:none;border:2px solid #CAC9C9;border-left:0px;background:none;">
                                <span class="p-2" style="background-color:#CAC9C9">%</span>
                            </div>
                        `);

                        dic = 0;
                    });
                }
                


 

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
        });
 
    });

});

// update 
$(document).ready(function(){

    $("#update-btn").click(function(){
      

        var pr_id = $(".parents-input-search ").val();

        const FreeFee = [];
        const DemotionStudent = [];

        const DisExcFeeType = [];
        const DisExcPerce = [];
 

        $(".fee_type_checkbox").each(function(){
 
           if (!$(this).prop("checked")) {
                FreeFee.push($(this).attr("fee_type"));
            }

        });

        // Discount Exception 
        var total_per = 0;
        $(".percentage").each(function(){
            total_per += Number($(this).val());
        });

        if(total_per != 0){
            $(".percentage").each(function(){
                DisExcFeeType.push($(this).parent().find(".dis_feetype").val());
                DisExcPerce.push($(this).val());
         });
        }

        // Check select student 
        var selectedStudent = $("input[name='student']:checked");
        if (selectedStudent.length > 0) {
            var st_id = selectedStudent.attr("st_id");
        }
        $.ajax({
            url: "/student-free-fee",
            method: 'POST',
            data:{
                pr_id:pr_id,
                st_id:st_id,
                current_year:current_year,
                FreeFee:JSON.stringify(FreeFee),
                DisExcFeeType:JSON.stringify(DisExcFeeType),
                DisExcPerce:JSON.stringify(DisExcPerce),
            },
            success:function(response)
            {

                console.log(response);
                alert(response);

                $('.search-parents').click();

            },
            error: function (xhr, status, error) 
            {
                console.log(xhr.responseText);
            },
            });

    });
});

// percentage condation
// $(document).ready(function(){
 
//     $("#discount_stracture").on("input", ".percentage", function()
//     {  
//         if($(this).val() == ""){
//            $(this).val(0);
//         }
//         if($(this).val() < 0 ){
//             $(this).val(0);
//         }
//         if($(this).val() > 100){
//            $(this).val(100);
//         }

//         if ($(this).val()) {
//             // Check if there are leading zeros followed by non-zero digits and remove them
//             let inputValue = $(this).val().replace(/^0+(?=[1-9])/, '');
        
//             // Set the value to '100' if it's empty
//             $(this).val(inputValue || 100);
//         }

//         if ($(this).val()) {
//             // Check if there are multiple leading zeros and replace them with a single zero
//             let inputValue = $(this).val().replace(/^0+/, '0');
        
//             // Set the value to '100' if it's empty
//             $(this).val(inputValue || 100);
//         }
        
//     });
// });

$(document).ready(function(){
    var parent_id = $("#parent_id").val();

    if(parent_id != ""){
        $(".search-parents").click();
    }

});

