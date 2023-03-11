@extends('Super_Admin/admin_template')
 

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

@endsection

@section('script')
    <!-- ajax add student  -->
    <script src="{{ asset('../admin_lang/student/ajax-add-student.js')}}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}"></script> 

    <!-- script input file image set preview img  -->
    <script src="{{ asset('../admin_lang/common/image-select.js')}}"></script> 
    
    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
  
@endsection


@section('contents')
 
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
        <h3>Student</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Add New Student</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

         <!-- Add New Teacher Area Start Here -->
         <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1 pt-3">
                    <div class="item-title">
                        <h4>Student Details</h4>
                    </div>
                </div>
                <form class="student-added-form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                            <label>Student Image *</label>
                            <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black">
                                <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                <input type="file" id="student_id_input" name="student_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="student_id_input" style="position:absolute;bottom:0px;width:100px;z-index:100;opacity: 0.5;">UPLOAD</label>
                            </div>
                            </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>First Name *</label>
                            <input type="text" required name="student_first_name" placeholder="First Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Middle Name</label>
                            <input type="text" name="student_middle_name"  placeholder="Middle Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Last Name *</label>
                            <input type="text" required name="student_last_name"  placeholder="Last Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Gender *</label>
                            <select name="student_gender" required class="select2">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Date Of Birth *</label>
                            <input type="text" required name="student_dob" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
                            <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Religion</label>
                            <select class="select2" name="student_religion">
                                <option value="">Please Select Religion *</option>
                                <option value="Islam">Islam</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Christian">Christian</option>
                                <option value="Buddish">Buddish</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Blood Group</label>
                            <select class="select2" name="student_blood_group">
                                <option value="">Please Select Group *</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Phone</label>
                            <input type="number" name="student_phone" placeholder="Student Number" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>E-Mail *</label>
                            <input type="email" required name="student_email" placeholder="Student Email" class="form-control">
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>ID Number</label>
                            <input type="text" name="student_id_number"  placeholder="Id Proof Number" class="form-control">
                        </div>


                        <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                            <label>Upload ID Proof *</label>
                            <div class="h-100 position-relative" style="height:80px; width:100px;">
                                <img  src="https://simptionsmartschool.com/school_software_v1//images/blank/blank_document.png" class="h-100 w-100 imagepreview" style="position:absolute;">
                                <input type="file" required name="student_id_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                            </div>
                            <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                        </div>

                        <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                            <div class="item-title">
                                <h4>Admission Details</h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Admission Date *</label>
                            <input type="text" required name="admission_date" placeholder="dd/mm/yyyy" class="form-control admission_date nepali-datepicker">
                            <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" required class="selec2 class-select" style="height:50px;width:100%; padding:10px;">

                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Section *</label>
                            <select class="select2" required name="section">
                                <option value="">Please Select Section *</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Roll No: *</label>
                            <input type="text" readonly required name="roll_no" placeholder="Roll No" class="form-control student_roll">
                        </div>
                        

                   <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                            <div class="item-title">
                                <h4>Student Address</h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>District *</label>
                            <input type="text" required name="district" placeholder="District" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Municipality *</label>
                            <input type="text" required name="municipality" placeholder="Municipality" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Village *</label>
                            <input type="text" required name="village" placeholder="Village" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Ward No:</label>
                            <input type="number" name="ward_no" placeholder="Ward No" class="form-control">
                        </div>

                        <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                            <div class="item-title">
                                <h4>Parent Details</h4>
                            </div>
                        </div>


                        <div class="card ui-tab-card w-100 py-0 my-0">
                    <div class="card-body shadow-none w-100 py-0 px-4">
                        <div class="heading-layout1 mg-b-25">
                </div>
                <div class="border-nav-tab">
                    <ul class="nav nav-tabs border-0" role="tablist">
                        <li class="nav-item new-parent">
                            <a class="nav-link shadow-none border active" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">New Parent ?</a>
                        </li>
                        <li class="nav-item existing-parent">
                            <a class="nav-link shadow-none border" data-toggle="tab" href="#tab8" role="tab" aria-selected="false">Existing Parent ?</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab8" role="tabpanel">
                                <div class="row gutters-8">
                                    {{-- <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <input type="text" placeholder="Search by ID ..." class="form-control">
                                    </div> --}}
                                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <select class="select2 parents-search-select" name="student_blood_group">
                                            <option value="father_name">Father Name ...</option>
                                            <option value="father_mobile">Father Mobile .. </option>
                                            <option value="login_email">Father Email ...</option>
                                            <option value="mother_name">Mother Name ...</option>
                                        </select>
                                    </div>
                                    <div class="col-4-xxxl col-xl-7 col-lg-3 col-12 form-group">
                                        <input type="text" placeholder="Enter Parent Name ..." class="form-control parents-input-search">
                                    </div>
 
                                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                        <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-parent">SEARCH</div>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> 
                                                <div class="form-check">
                                                    {{-- <input type="checkbox" class="form-check-input checkAll"> --}}
                                                    <span class="form-check-label">Select Parent</span>
                                                </div>
                                            </th>
                                            <th>father_image</th>
                                            <th>father_name</th>
                                            <th>father_mobile</th>
                                            <th>father_education</th>
                                            <th>mother_image</th>
                                            <th>mother_name</th>
                                            <th>mother_mobil</th>
                                            <th>mother_education</th>
                                            <th>Kids_id</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
               
                                    </tbody>
                                </table>
                             </div>  
                        </div>
                        <div class="tab-pane fade show active" id="tab9" role="tabpanel">
                          <div id="parent-container">
                            <input type="hidden" class="parent-check" name="parent_check'" value="new_parent">
                            <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                <label>Father Photo *</label>
                                <div class="h-100 position-relative" style="height:50px; width:100px;">
                                <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                <input type="file" required name="father_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                </div>
                                <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Father Name *</label>
                                <input type="text" required name="father_name" placeholder="Father Name" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Father Mobile No: *</label>
                                <input type="number" required name="father_phone" placeholder="Father Mobile" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Education</label>
                                <input type="text" name="father_education"  placeholder="Education" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                <label>Mother Photo *</label>
                                <div class="h-100 position-relative" style="height:50px; width:100px;">
                                <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                <input type="file" required name="mother_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                </div>
                                <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Mother Name *</label>
                                <input type="text" required name="mother_name"  placeholder="Mother Name" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Mother Mobile No:</label>
                                <input type="number"  name="mother_phone" placeholder="Mother Mobile" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Education</label>
                                <input type="text" name="mother_education"  placeholder="Education" class="form-control">
                            </div>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
                        
                <div class="col-12 form-group mg-t-8 d-flex justify-content-end">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                    {{-- <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button> --}}
                </div>

                <div class="progress w-100 d-none" style="height:30px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>

                  {{-- progress bar with alert --}}
                  <div class="progress w-100 d-none" style="height:30px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                  </div>
                  
                  <div class="alert alert-success  align-items-center alert-info d-none" role="alert">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                      <b>Upload Success</b>
                    </div>
                  </div>

          
                    </div>
                </form>
            </div>
        </div>
        <!-- Add New Teacher Area End Here -->


        <script>
            $(document).ready(function() {
 
                // remove the form when the "Remove Form" button is clicked
                $('.existing-parent').click(function() {
                    $(".parent-check").val("existing_parent");
                    $('input[name="father_image"]').attr('required', false);
                    $('input[name="father_name"]').attr('required', false);
                    $('input[name="father_phone"]').attr('required', false);
                    $('input[name="mother_image"]').attr('required', false);
                    $('input[name="mother_name"]').attr('required', false);

                });
                
                // add the form again when the "Return Form" button is clicked
                $('.new-parent').click(function() {
                  $(".parent-check").val("new_parent");
                  $('input[name="father_image"]').attr('required', true);
                    $('input[name="father_name"]').attr('required', true);
                    $('input[name="father_phone"]').attr('required', true);
                    $('input[name="mother_image"]').attr('required', true);
                    $('input[name="mother_name"]').attr('required', true);
                });

                });
        </script>
@endsection