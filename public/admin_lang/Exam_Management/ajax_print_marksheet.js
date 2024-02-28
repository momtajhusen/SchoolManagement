$(document).ready(function(){
  $(".marksheet-form").submit(function(e){
      e.preventDefault();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var select_exam = $("#select_exam").val();
      var select_class = $(".class-select").val();
      var select_section = $(".section-select").val();



      var current_year = NepaliFunctions.GetCurrentBsDate().year;
      
      var month = NepaliFunctions.GetCurrentBsDate().month;
      var day = NepaliFunctions.GetCurrentBsDate().day;
      
      

      $.ajax({
          url:  "/get-exam-tabulation",
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

              $(".marksheet-box").html('');

              if(response.data){


                  var students = response.data;
                  students.sort(function(a, b) {
                      var totalMarksA = 0;
                      var totalMarksB = 0;
                      a.exam_marks.forEach(function(marks) {
                          totalMarksA += parseInt(marks.marks_obtained);
                      });
                      b.exam_marks.forEach(function(marks) {
                          totalMarksB += parseInt(marks.marks_obtained);
                      });
                      return totalMarksB - totalMarksA;
                  });

                  var school_name = response.school_details[0].school_name;
                  var school_logo = response.school_details[0].logo_img;
                  var school_phone = response.school_details[0].phone;
                  var school_address = response.school_details[0].address;
                  var school_email = response.school_details[0].email;
                  var school_website = response.school_details[0].website;

                  var exam_name = response.data[0].exam_marks[0].exam;
                  var exam_year = response.data[0].exam_marks[0].exam_year;


      
                  var index = 1;
                  students.forEach(function(item) {
                      var sn = index++;
                      var id = item.id;

                      var st_name = item.first_name + " " + item.middle_name + " " + item.last_name;
                      var student_image = item.student_image;

                      var father_name = item.parent_data.father_name;
  
                      // Total Subject Grade 
                      var obtained_marks = item.exam_grade.obtained_marks;
                      var percentage = item.exam_grade.percentage;
                      var grade_name = item.exam_grade.grade_name;
                      var remarks = item.exam_grade.remarks;
                      var total_subject_mark = 0;
                      var total_minimum_mark = 0;


                      var marks_row = '';
                      item.exam_marks.forEach(function(marks) {

                        total_subject_mark += Number(marks.total_marks);
                        total_minimum_mark += Number(marks.minimum_marks);

                        if (Number(marks.marks_obtained) < Number(marks.minimum_marks))
                        {
                          var check_pass = "Fail";
                        }
                        else{
                          var check_pass = "Pass";
                        }
                        
                        if(marks.remarks == "Very Insufficient")
                        {
                         marks.remarks = "V. Insufi.";   
                        }
                        
                      if(marks.remarks == "Partly Acceptable")
                        {
                         marks.remarks = "P. Accep.";  
                        }
                        
                      if(marks.remarks == "Very Good")
                        {
                         marks.remarks = "V. Good";  
                        }

                          marks_row +=  `<tr>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.subject+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.marks_obtained+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.total_marks+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.minimum_marks+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.grade_name+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.grade_point+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+check_pass+`</td>
                          <td style="border: 1px solid black; padding: 3px; text-align: center;">`+marks.remarks+`</td>
                          <td style="display:none; border: 1px solid black; padding: 3px; text-align: center;">`+marks.attendance+`</td>
                        </tr>`;
                      });



                      var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


                      if(obtained_marks < total_minimum_mark)
                      {
                        var total_check_pass = "Fail";
                      }
                      else{
                        var total_check_pass = "Pass";
                      }


                  //   var SchoolLogo = currentDomainWithProtocol+`/storage/`+school_logo + "?timestamp=" + new Date().getTime();
  
                     $(".marksheet-box").append(`
                     
                     <div class="bill-box" id="my-element" style="background:white; width: 595px; height: 842px; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                        <div style="width: 100%; height: 100%; border: 2px solid black;overflow: hidden;box-sizing: border-box;position: relative;">
                    
                    
                            <!-- Start School Details Header   -->
                    
                            <div  style="display: flex; justify-content: space-between; padding:25px; padding-bottom:15px;">
                    
                     
                                <img id="school_logo" src="`+currentDomainWithProtocol+`/storage/`+school_logo+`" style="height:70px; padding:4px; border:2px solid #ddd; position:absolute; left: 20px;">
                     
                                <div style="line-height: 1.5; width: 100%;">
                                    <div style="width:100%; display: flex; justify-content:center;">
                                      <center id="school_name" style="border:0px solid black; width:70%; text-align: center; font-size: 20px;margin: 0px; ">
                                        <b style="font-family: Helvetica, Arial, sans-serif; ">`+school_name+`</b>
                                      </center>
                                    </div>
                                    <address>
                                    <center><span style="font-size: 13px;margin: 0px;" id="school_address">`+school_address+`</span></center>
                                    <center><span style="font-size: 13px;margin: 13px;" id="school_contact">`+school_phone+` `+school_email+`</span></center>
                                    <center><div style="font-size: 12px;font-family: 'Times New Roman', serif; border:1px solid #ddd; padding:3px; width:200px; border-radius: 10px; margin-top:5px;">PROGRESS REPORT</div></center>
                                    <center><div style="font-size: 13px; font-family: Helvetica, Arial, sans-serif; margin-top: 5px; padding-bottom: 0px; border-bottom:2px solid #ddd; width: fit-content;">`+exam_name+' '+exam_year+`</div></center>
                    
                                </div>
                            </div>
                    
                       <div style=" display: flex; width: 100%; border-top: 1px solid #000; margin-top: 0px; padding-left: 25px;">
                                <img style="display:none; height:50px; padding:2px; margin:5px; border:1px solid  #ccc;" src="`+currentDomainWithProtocol+`/storage/`+student_image+`">
                                 <div class="bg-inf" style=" position: relative; width: 100%; line-height: 1.5; display: flex; justify-content:space-between;">
                                    
                                    <div style="display: flex; margin-left:5px; flex-direction: column; justify-content: center; ">
                                      <div>
                                        <span>Name :</span>
                                        <span>`+st_name+`</span>
                                      </div>
                                      
                                      <div>
                                        <span>Class :</span>
                                        <span>`+item.class+`</span>
                                      </div>
             
                   
                                    </div>
                    
                                    <div style="display: flex; flex-direction: column; justify-content: between; padding-right: 75px;">
                                      <div>
                                        <span>Roll :</span>
                                        <span>`+item.roll_no+`</span>
                                      </div>
                                 
                                      <div>
                                        <span>Section :</span>
                                        <span>`+item.section+`</span>
                                      </div>
                                    </div>
                    
                                 </div>
                            </div>
                    
                            <!-- Result Table  -->
                            <div>
                              <table style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <b style="width:100%;  display: flex; justify-content: center; margin-bottom:8px;">Result Overview</b>
                                  <tr style="background-color: #ebeaea; font-size:15">
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Subject</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Obt. <br> Marks</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Total<br> Marks</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Min.<br> Marks</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Final<br> Grade</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Grade<br> Point</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Result</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Remarks</th>
                                    <th style="display: none; border: 1px solid black; padding: 5px; text-align: center;">Attendance</th>
                                  </tr>
                                </thead>
                                <tbody>


                                   `+marks_row+`
                                   
                                  <!-- Total  -->
                                  <tr style="background-color: #ebeaea; font-size:15px">
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Obtained <br> Marks</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Total Marks</th>
                                    <th style="border: 1px solid black; padding: 5px; text-align: center;">Percent.</th>
                                    <th colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">Position in Class</th>
                                    <th colspan="1" style="border: 1px solid black; padding: 5px; text-align: center;">Grade</th>
                                    <th colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">Status</th>
                                    <th colspan="2" style="display:none; border: 1px solid black; padding: 5px; text-align: center;">Final Result</th>
                                  </tr>
                                  <tr style="font-size:14px">
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">`+obtained_marks+`</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">`+total_subject_mark+`</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">`+percentage+' '+`%</td>
                                    <td colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">`+item.position_rank+`</td>
                                    <td colspan="1" style="border: 1px solid black; padding: 5px; text-align: center;">`+grade_name+`</td>
                                    <td colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">`+remarks+`</td>
                                    <td colspan="2" style="display:none; border: 1px solid black; padding: 5px; text-align: center;">`+total_check_pass+`</td>
                                  </tr>
                                </tbody>
                              </table>

                              <div style="margin-top:15px;margin-left:10px;">
                                 <p>• <b>Final Result :</b> `+total_check_pass+`</p>
                                 <p class="d-none" style="display:none;">• Attendance : </p>
                              </div>
                            </div>


                    
                            <!-- Grading Table  -->
                            <div style="width: 100%; display:none;">
                              <table style="border-collapse: collapse; width: 100%;">
                                <thead>
                                  <b style="width:100%; border-top: 1px solid #000; display: flex; justify-content: center; padding: 10px; ">Grading/GPA System</b>
                                  <tr style="background-color: #ebeaea;">
                                    <th style="width:90px;border: 1px solid black; padding: 8px; text-align: center;">Interval</th>
                                    <th style="width:20px; border: 1px solid black; padding: 8px; text-align: center;">Grading Point</th>
                                    <th style="width:20px; border: 1px solid black; padding: 8px; text-align: center;">Grade</th>
                                    <th style="width:20px; border: 1px solid black; padding: 8px; text-align: center;">Remark</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">90% to 100%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">4.0</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">A+</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Outstanding</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">80% to Below 90%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">3.6</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">A</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Excellent</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">70% to Below 80%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">3.2</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">B+</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Very Good</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">60% to Below 70%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">2.8</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">B</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Good</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">50% to Below 60%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">2.4</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">C+</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Satifaction</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">40% to Below 50%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">2.0</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">C</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Acceptable</td>
                                  </tr>
                                  <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">30% to Below 40%</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">1.2</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">C</td>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">Acceptable</td>
                                  </tr>
                     
                                </tbody>
                              </table>
                            </div>

                            <!-- Signature  -->
                            <div style="width:100%; padding-left:20px;  display:flex; justify-content:space-between; position:absolute; left:0px; bottom:3px; "> 
                                 <div>Date of Issue: `+current_year+`-`+month+`-`+day+`</div>
                                 <div style="width:100px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:5px;">Class Teacher</div>
                                 <div style="width:100px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:5px; margin-right:55px;">Principal</div>
                            </div>
            
                        </div> 
                      </div> 
                     `);
  
    
   
                  });
              }

              else{
                  $(".marksheet-box").html('');
                  alert("Marks Not Entry for this");
              }


           },
           complete: function(response) {
              print_marksheet();
          },
           error: function (xhr, status, error) 
           {
               console.log(xhr.responseText);
           },
      });

  });
});


function print_marksheet(){
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