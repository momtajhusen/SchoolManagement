@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
@endsection



@section('script')

    <!-- ajax Get All Exam Term -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script>

    <!-- ajax get exam ajax_print_marksheet data -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_print_marksheet.js')}}?v={{ time() }}"></script> 

@endsection

@section('contents')

<div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Print Student Marksheets</h3>
                    </div>
                </div>

                <form class="mg-b-20 marksheet-form">
                    <div class="row gutters-8">

                        <div class="col-lg-3 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" required class="select2 class-select" id="class-select" style="height:45px;width:100%; padding:10px;">

                            </select>
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <label>Section *</label>
                            <select name="class" required class="select2 section-select" style="height:45px;width:100%; padding:10px;">

                        </select>
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <label>Exam *</label>
                            <select name="class" required class="select2 select-process-term" id="select_exam" style="height:45px;width:100%; padding:10px;">

                            </select>
                        </div>
                        <div class="col-lg-3 col-12 form-group d-flex align-items-end">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="Generate Marksheets">Generate Marksheets</button>
                        </div>
                    </div>
                </form>
                {{-- <button class="fw-btn-fill btn-gradient-yellow py-2" id="print-marksheet-btn">Print</button> --}}


            </div>
        </div>
    </div>

    <div class="col-8-xxxl col-12 d-none">
        <div class="card height-auto">
            <div class="card-body">
                <div class="row gutters-8 marksheet-box">

                      
                    <div class="bill-box" id="my-element" style="background:white; width: 595px; height: 842px; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                        <div style="width: 100%; height: 100%; border: 2px solid black;overflow: hidden;box-sizing: border-box;position: relative;">
                    
                    
                            <!-- Start School Details Header   -->
                    
                            <div  style="display: flex; justify-content: space-between; padding:25px; padding-bottom:15px;">
                    
                     
                                <img id="school_logo" src="`+currentDomainWithProtocol+`/storage/`+school_logo+`" style="height:70px; padding:4px; border:2px solid #ddd; position:absolute; left: 20px;">
                     
                                <div style="line-height: 1.5; width: 100%;">
                                    <div style="width:100%; display: flex; justify-content:center;">
                                      <center id="school_name" style="border:0px solid black; width:70%; text-align: center; font-size: 20px;margin: 0px; ">
                                        <b style="font-family: Helvetica, Arial, sans-serif; ">Polar Star Secondary English Boarding School</b>
                                      </center>
                                    </div>
                                    <address>
                                    <center><span style="font-size: 13px;margin: 0px;" id="school_address">Mirchaiya, 6 sirha, neplal</span></center>
                                    <center><span style="font-size: 13px;margin: 13px;" id="school_contact">033550611 mumtaz666raza@gmail.com</span></center>
                                    <center><div style="font-size: 12px;font-family: 'Times New Roman', serif; border:1px solid #ddd; padding:3px; width:200px; border-radius: 10px; margin-top:5px;">PROGRESS REPORT</div></center>
                                    <center><div style="font-size: 13px; font-family: Helvetica, Arial, sans-serif; margin-top: 5px; padding-bottom: 0px; border-bottom:2px solid #ddd; width: fit-content;">Third Term 2080</div></center>
                    
                                </div>
                            </div>
                    
                       <div style=" display: flex; width: 100%; border-top: 1px solid #000; margin-top: 0px; padding-left: 25px;">
                                <img style="display:none; height:50px; padding:2px; margin:5px; border:1px solid  #ccc;" src="`+currentDomainWithProtocol+`/storage/`+student_image+`">
                                 <div class="bg-inf" style=" position: relative; width: 100%; line-height: 1.5; display: flex; justify-content:space-between;">
                                    
                                    <div style="display: flex; margin-left:5px; flex-direction: column; justify-content: center; ">
                                      <div>
                                        <span>Name :</span>
                                        <span> Momtaj Husen</span>
                                      </div>
                                      
                                      <div>
                                        <span>Class :</span>
                                        <span>1ST</span>
                                      </div>
             
                   
                                    </div>
                    
                                    <div style="display: flex; flex-direction: column; justify-content: between; padding-right: 75px;">
                                      <div>
                                        <span>Roll :</span>
                                        <span>34</span>
                                      </div>
                                 
                                      <div>
                                        <span>Section :</span>
                                        <span> A</span>
                                      </div>
                                    </div>
                    
                                 </div>
                            </div>
                    
                            <!-- Result Table  -->
                            <div>
                              <table class="text-center" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th colspan="2" rowspan="2" class="text-center" style="font-size: 12px; border: 1px solid black;">Subjects</th>
                                        <th colspan="2" class="text-center" style="font-size: 12px; border: 1px solid black;">Total Marks</th>
                                        <th colspan="2" class="text-center" style="font-size: 12px; border: 1px solid black;">Pass Marks</th>
                                        <th colspan="2" class="text-center" style="font-size: 12px; border: 1px solid black; padding:3px;">Obtained Marks</th>
                                        <th rowspan="2" style="font-size: 12px; border: 1px solid black;">Final Grade</th>
                                        <th rowspan="2" style="font-size: 12px; border: 1px solid black;">Grade Point</th>
                                    </tr>
                                    <tr style="font-size: 12px;border: 1px solid black;">
                                        <th class="text-center" style="border: 1px solid black;">
                                                TH
                                        </th>
                                        <th class="text-center" style="border: 1px solid black;">
                                                PR
                                        </th>
                                        <th class="text-center" style="border: 1px solid black;">
                                                TH
                                        </th>
                                        <th class="text-center" style="border: 1px solid black;">
                                                PR
                                        </th>
                                        <th class="text-center" style="border: 1px solid black;">TH</th>
                                        <th class="text-center" style="border: 1px solid black;">PR</th>
                                    </tr>
                                </thead>
                                                                
                                <tbody>


                                    <tr>
                                        <td colspan="2" style="border: 1px solid black; padding: 3px; text-align: center;">Momtaj Husen</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">100</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">20</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">89</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">90</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">A</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">34.4</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">pass</td>
                                        <td style="border: 1px solid black; padding: 3px; text-align: center;">Good</td>
                                        <td style="display:none; border: 1px solid black; padding: 3px; text-align: center;">`+marks.attendance+`</td>
                                      </tr>
                                   
                                  <!-- Total  -->
 
                                </tbody>
                              </table>

                              <div style="margin-top:15px;margin-left:10px;">
                                 <p>• <b>Final Result :</b> Pass</p>
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
                                 <div>Date of Issue: 2080-12-1</div>
                                 <div style="width:100px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:5px;">Class Teacher</div>
                                 <div style="width:100px; text-align:center; border-top:1px solid #888; padding-top:5px; padding-bottom:5px; margin-right:55px;">Principal</div>
                            </div>
            
                        </div> 
                      </div> 
                    


                </div>
            </div>
        </div>
    </div>

    
@endsection
