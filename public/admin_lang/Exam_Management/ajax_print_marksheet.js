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

                  var school_name = response.school_details.school_name;
                  var school_logo = response.school_details.logo_img;
                  var school_phone = response.school_details.phone;
                  var school_address = response.school_details.address;
                  var school_email = response.school_details.email;
                  var school_website = response.school_details.website;

                  var exam_name = response.data[0].exam_marks[0].exam;
                  var exam_year = response.data[0].exam_marks[0].exam_year;


      
                  var index = 0;
                  students.forEach(function(item) {
                      var sn = index++;
                      var id = item.id;

                      var st_name = item.first_name + " " + item.middle_name + " " + item.last_name;
                      var student_image = item.student_image;

                      var final_grade_point = item.final_grade_point;
                      var final_grade_name = item.final_grade_name;
                      var final_position_rank = item.position_rank;


                      // alert(response.data[index].exam_marks[index]);

                      // Total Subject Grade 
                      var sum_total_th  = 0;
                      var sum_total_pr  = 0;
                      var sum_pass_th = 0;
                      var sum_pass_pr = 0;
                      var sum_obt_th  = 0;
                      var sum_obt_pr  = 0;




                      var marks_row = '';
                      item.exam_marks.forEach(function(marks) {

                        sum_total_th += Number(marks.total_th);
                        sum_total_pr += Number(marks.total_pr);
                        sum_pass_th += Number(marks.pass_th);
                        sum_pass_pr += Number(marks.pass_pr);
                        sum_obt_th += Number(marks.obt_th_mark);
                        sum_obt_pr += Number(marks.obt_pr_mark);




                      //   if (Number(marks.marks_obtained) < Number(marks.minimum_marks))
                      //   {
                      //     var check_pass = "Fail";
                      //   }
                      //   else{
                      //     var check_pass = "Pass";
                      //   }
                        
                      //   if(marks.remarks == "Very Insufficient")
                      //   {
                      //    marks.remarks = "V. Insufi.";   
                      //   }
                        
                      // if(marks.remarks == "Partly Acceptable")
                      //   {
                      //    marks.remarks = "P. Accep.";  
                      //   }
                        
                      // if(marks.remarks == "Very Good")
                      //   {
                      //    marks.remarks = "V. Good";  
                      //   }
                      marks_row += `<tr>
                      <td colspan="2" style="border: 1px solid black; padding: 5px; text-align: center;">${marks.subject}</td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">${removeTrailingZeros(marks.total_th)}</td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">
                        ${removeTrailingZeros(marks.total_pr) !== '0' ? removeTrailingZeros(marks.total_pr) : ''}
                      </td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">${removeTrailingZeros(marks.pass_th)}</td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">
                        ${removeTrailingZeros(marks.pass_pr) !== '0' ? removeTrailingZeros(marks.pass_pr) : ''}
                      </td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">${removeTrailingZeros(marks.obt_th_mark)}</td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">
                        ${removeTrailingZeros(marks.obt_pr_mark) !== '0' ? removeTrailingZeros(marks.obt_pr_mark) : ''}
                      </td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">${marks.grade_name}</td>
                      <td style="border: 1px solid black; padding: 5px; text-align: center;">${marks.grade_point}</td>
                  </tr>`;
                  

                      });

                      marks_row += `<tr style="background-color:#fafafa;">
                      <th colspan="2" style="border: 1px solid black; padding: 10px; text-align: center;">Total : </th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">${removeTrailingZeros(sum_total_th)}</th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">
                        ${removeTrailingZeros(sum_total_pr) !== '0' ? removeTrailingZeros(sum_total_pr) : ''}
                      </th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">${removeTrailingZeros(sum_pass_th)}</th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">
                        ${removeTrailingZeros(sum_pass_pr) !== '0' ? removeTrailingZeros(sum_pass_pr) : ''}
                      </th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">${removeTrailingZeros(sum_obt_th)}</th>
                      <th style="border: 1px solid black; padding: 10px; text-align: center;">
                        ${removeTrailingZeros(sum_obt_pr) !== '0' ? removeTrailingZeros(sum_obt_pr) : ''}
                      </th>
                      <td style="border: 1px solid black; padding: 10px; text-align: center;">${final_grade_name}</td>
                      <td style="border: 1px solid black; padding: 10px; text-align: center;">${final_grade_point}</td>
                     </tr>`;
                  



                      var currentDomainWithProtocol = window.location.protocol + "//" + window.location.host;


                      // if(obtained_marks < total_minimum_mark)
                      // {
                      //   var total_check_pass = "Fail";
                      // }
                      // else{
                      //   var total_check_pass = "Pass";
                      // }


                  //   var SchoolLogo = currentDomainWithProtocol+`/storage/`+school_logo + "?timestamp=" + new Date().getTime();
  
                     $(".marksheet-box").append(`
                     
                     <div class="bill-box" id="my-element" style="background:white; width: 595px; height: 842px; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                        <div style="width: 100%; height: 100%; border: 2px solid black;overflow: hidden;box-sizing: border-box;position: relative;">
                    
                    
                            <!-- Start School Details Header   -->
                    
                            <div  style="display: flex; justify-content: space-between; padding:25px; padding-bottom:15px;">
                    
                     
                                <img id="school_logo" src="/storage/upload_assets/school/school_logo.png" style="height:50px; padding:4px; border:2px solid #ddd; position:absolute; left: 20px;">
                     
                                <div style="line-height: 1.5; width: 100%;">
                                    <div style="width:100%; display: flex; justify-content:end;">
                                      <center id="school_name" style="border:0px solid black; margin-left:20px; width:90%; text-align: center; font-size: 18px;margin: 0px; ">
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
                                <img style="display:none; height:50px; padding:2px; margin:5px; border:1px solid  #ccc;" src="#">
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
                              <thead style="background-color:#fafafa;">
                              <tr style="font-size: 15px;border: 1px solid black;">
                                  <th colspan="2" rowspan="2" class="text-center" style="padding:5px; border: 1px solid black;">Subjects</th>
                                  <th colspan="2" class="text-center" style="padding:5px; border: 1px solid black;">Total Marks</th>
                                  <th colspan="2" class="text-center" style="padding:5px; border: 1px solid black;">Pass Marks</th>
                                  <th colspan="2" class="text-center" style="padding:5px; border: 1px solid black; padding:3px;">Obtained Marks</th>
                                  <th rowspan="2" style="padding:5px; border: 1px solid black;">Final Grade</th>
                                  <th rowspan="2" style="padding:5px; border: 1px solid black;">Grade Point</th>
                              </tr>
                              <tr style="font-size: 13px;border: 1px solid black;">
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">
                                          TH
                                  </th>
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">
                                          PR
                                  </th>
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">
                                          TH
                                  </th>
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">
                                          PR
                                  </th>
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">TH</th>
                                  <th class="text-center" style="border: 1px solid black; padding:5px;">PR</th>
                              </tr>
                          </thead>
                                <tbody>


                                   `+marks_row+`
                                   
 
                                </tbody>
                              </table>

                              <div style="padding:10px;">
                                 <span>Class Position: ${final_position_rank}</span>
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
                                 <div>Date of Issue: `+current_year+`-`+current_month+`-`+current_day+`</div>
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

function removeTrailingZeros(number) {
  return parseFloat(number).toFixed(2).replace(/\.?0+$/, '');
}


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
  }, 1000); // Delay for 1 second (1000 milliseconds)
}
