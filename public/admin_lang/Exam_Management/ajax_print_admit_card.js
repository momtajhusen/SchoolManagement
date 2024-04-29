$(document).ready(function(){
    $(".admit-card-form").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var select_exam = $(".select-exam-term").val();
        var select_class = $(".class-select").val();
        var select_section = $(".section-select").val();


        $.ajax({
            url:  "/get-admit-card",
            method: 'GET',
            data:{
                select_exam:select_exam,
                select_class : select_class,
                select_section : select_section,
                current_year:current_year,
            },
             // Success 
             success:function(response)
             {

                console.log(response);

                var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;
               
                var table_row = '';
                if (response.examTimetableData) {
                    response.examTimetableData.forEach(function (timetable) {
                        table_row += `<tr>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">`+timetable.exam_date+`</td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">`+timetable.subject+`</td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">`+timetable.starting_time+`</td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">`+timetable.ending_time+`</td>
                          </tr>`;
                    });
                }
                

                $(".admit-card-box").html('');
                if(response.studentData){
                    response.studentData.forEach(function(student) {
                        //    alert(student.first_name);

                           $(".admit-card-box").append(`
                           
                           <div class="bill-box" id="my-element" style="background:white; width: 297 mm; height: 210 mm; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                           <div style="height: 100%;  border: 2px solid black;overflow: hidden;box-sizing: border-box;position: relative;">
                       
                       
                               <!-- Start School Details Header   -->
                       
                               <div  style="display: flex; justify-content: space-between; padding:25px; padding-bottom:8px;">
                       
                        
                                   <img id="school_logo" src="`+currentDomainWithProtocol+`/storage/`+response.school[0].logo_img+`" style="height:50px; position:absolute; left: 15px;">
                        
                                   <div style="line-height: 1.5; width: 100%;">
                                      <div style="width:100%; display: flex; justify-content:center;">
                                        <center id="school_name" style="width:80%; text-align: center; font-size: 20px;margin: 0px; ">
                                           <b style="font-family: Helvetica, Arial, sans-serif; ">`+response.school[0].school_name+`</b>
                                         </center>
                                      </div>

                                       <address>
                                       <center><span style="font-size: 15px;margin: 0px;" id="school_address">`+response.school[0].address+`</span></center>
                                       <center><span style="font-size: 15px;margin: 10px;" id="school_contact">`+response.school[0].phone+` `+response.school[0].email+`</span></center>
                                       <center><div style="font-family: 'Times New Roman', serif; border:2px solid #858484; padding:5px; width:250px; border-radius: 10px; margin-top:10px;">ADMIT CARD</div></center>
                                       <center><div style="font-family: Helvetica, Arial, sans-serif; margin-top: 10px; padding-bottom: 0px;  width: fit-content;"> Third Term Exam `+current_year+`</div></center>
                       
                                   </div>
                               </div>
                       
                               <div style=" display: flex; width: 100%; border-top: 1px solid #000; padding-left: 5px;">
                                   <img style="height:40px; padding:2px; margin:5px; border:1px solid  #ccc;" src="`+currentDomainWithProtocol+`/storage/`+student.student_image+`">
                                    <div style=" position: relative; width: 100%; line-height: 1.5; display: flex; justify-content:space-between;">
                                       
                                       <div style="display: flex; flex-direction: column; justify-content: center; ">
                                         <div>
                                           <span>Name :</span>
                                           <span>`+student.first_name+` `+student.middle_name+` `+student.last_name+`</span>
                                         </div>
                                         <div>
                                           <span>Class :</span>
                                           <span>`+student.class+`</span>
                                         </div>
                                       </div>
                       
                       
                                       <div style="display: flex; flex-direction: column; justify-content: center; padding-right: 25px;">
                                         <div>
                                           <span>Section :</span>
                                           <span>`+student.section+`</span>
                                         </div>
                                         <div>
                                           <span>Roll :</span>
                                           <span>`+student.roll_no+`</span>
                                         </div>
                                       </div>
                       
                                    </div>
                               </div>
                       
                               <!-- Result Table  -->
                               <div>
                                 <table style="border-collapse: collapse; width: 100%;">
                                   <thead>
                                       <b style="width:100%; border-top: 1px solid #000; display: flex; justify-content: center; padding: 10px; ">Exam Timetable</b>
                                     <tr style="background-color: #ebeaea;">
                                       <th style="border: 1px solid black;  border-left: 0px; padding: 8px; text-align: center;">Date</th>
                                       <th style="border: 1px solid black; border-left: 0px; padding: 8px; text-align: center;">Subject</th>
                                       <th style="border: 1px solid black; border-left: 0px; padding: 8px; text-align: center;">Starting</th>
                                       <th style="border: 1px solid black; border-left: 0px; padding: 8px; text-align: center;">Ending</th>
                                     </tr>
                                   </thead>
                                   <tbody>
                                          `+table_row+`
                                   </tbody>
                                 </table>
                               </div>

                               <!-- Signature  -->
                               <div style="width:100%; padding-left:20px;  display:flex; justify-content:space-between; position:absolute; left:0px; bottom:10px; "> 
                                  <div style="width:100px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:10px;">Accountant</div>
                                  <div style="width:150px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:10px; margin-right:55px;">Exam Co-ordinator</div>
                              </div>
                       
                           </div> 
                         </div> 
                           `);
                    });
                }
                else{
                    alert(response.status);
                }

             },
             complete: function() {
              print_admit_card();
            },
             error: function (xhr, status, error) 
             {
                 console.log(xhr.responseText);
             },
        });

    });
});


function print_admit_card(){
    var content = '';
    $('.bill-box').each(function(){
        content += $(this).html();
    });
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
    }, 500);
}