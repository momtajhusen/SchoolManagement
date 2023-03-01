@extends('Admin/admin_template')
 

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

    <script>
        // const imageInput = document.getElementById("studentImageInput");
        // const imagePreview = document.getElementById("studentImage");
      
        // imageInput.addEventListener("change", function() {
        //   const file = imageInput.files[0];
        //   const reader = new FileReader();
          
        //   reader.addEventListener("load", function() {
        //     imagePreview.src = reader.result;
        //   }, false);
      
        //   if (file) {
        //     reader.readAsDataURL(file);
        //   }
        // }, false);
      </script>
      
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

                   <!-- Add New Student Area Start Here -->
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
                                    <div class="h-100 position-relative" style="height:60px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                        <input type="file" id="student_id_input" name="student_id_input" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                    </div>
                                    <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>First Name *</label>
                                        <input type="text" required name="student_first_name" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="student_middle_name"  placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Last Name *</label>
                                        <input type="text" required name="student_last_name"  placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Gender </label>
                                        <select name="student_gender" required class="select2">
                                            <option value="">Please Select Gender *</option>
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
                                        <input type="number" maxlength="10" name="student_phone" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>E-Mail</label>
                                        <input type="email" name="student_email" placeholder="" class="form-control">
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>ID Number</label>
                                        <input type="text" name="student_id_number"  placeholder="" class="form-control">
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                        <label>Upload ID Proof *</label>
                                        <div class="h-100 position-relative" style="height:80px; width:100px;">
                                            <img  src="https://simptionsmartschool.com/school_software_v1//images/blank/blank_document.png" class="h-100 w-100 imagepreview" style="position:absolute;">
                                            <input type="file" name="student_id_input" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
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
                                        <input type="text" required name="roll_no" placeholder="" class="form-control student_roll">
                                    </div>
                                    

    
                                    <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                                        <div class="item-title">
                                            <h4>Student Address</h4>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>District</label>
                                        <input type="text" required name="district" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Municipality</label>
                                        <input type="text" required name="municipality" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Village</label>
                                        <input type="text" required name="village" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Ward No:</label>
                                        <input type="number" maxlength="3" name="ward_no" placeholder="" class="form-control">
                                    </div>

                                    <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                                        <div class="item-title">
                                            <h4>Parent Details</h4>
                                        </div>
                                    </div>
    

                                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                        <label>Father Photo</label>
                                        <div class="h-100 position-relative" style="height:50px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                        <input type="file" name="father_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                        </div>
                                        <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father Name *</label>
                                        <input type="text" required name="father_name" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father Mobile No: *</label>
                                        <input type="number" maxlength="10" required name="father_phone" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Education</label>
                                        <input type="text" name="father_education"  placeholder="" class="form-control">
                                    </div>
            
                                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                        <label>Mother Photo</label>
                                        <div class="h-100 position-relative" style="height:50px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" style="position:absolute;">
                                        <input type="file" name="mother_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                        </div>
                                        <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Mother Name *</label>
                                        <input type="text" required name="mother_name"  placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Mother Mobile No:</label>
                                        <input type="number" maxlength="10" name="mother_phone" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Education</label>
                                        <input type="text" name="mother_education"  placeholder="" class="form-control">
                                    </div>
                                    <div class="heading-layout1 px-4 pt-5 py-0" style="width:100%;">
                                        <div class="item-title py-0">
                                            <h4 class="py-0 m-0">Parent / Guardian Login Detail</h4>
                                        </div>
                                    </div>

            

                                    <div class="card ui-tab-card w-100 py-0 my-0">
                        <div class="card-body shadow-none w-100 py-0 px-4">
                            <div class="heading-layout1 mg-b-25">
        
                            <div class="dropdown">
    
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                            </div>
                                        </div>
                            </div>
                            <div class="border-nav-tab">
                                <ul class="nav nav-tabs border-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active shadow-none border" data-toggle="tab" href="#tab7" role="tab" aria-selected="true">Disallow Login ?</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link shadow-none border" data-toggle="tab" href="#tab8" role="tab" aria-selected="false">Existing Parent ?</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link shadow-none border" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">New User ?</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active w-100" id="tab7" role="tabpanel"></div>
                                    <div class="tab-pane fade" id="tab8" role="tabpanel">
                                    <form class="mg-b-20">
                                            <div class="row gutters-8">
                                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                                    <input type="text" placeholder="Search by ID ..." class="form-control">
                                                </div>
                                                <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                                                    <input type="text" placeholder="Search by Name ..." class="form-control">
                                                </div>
                                                <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                                    <input type="text" placeholder="Search by Phone ..." class="form-control">
                                                </div>
                                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table display data-table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th> 
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input checkAll">
                                                                <label class="form-check-label">ID</label>
                                                            </div>
                                                        </th>
                                                        <th>Photo</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Subject</th>
                                                        <th>Phone</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-input">
                                                                <label class="form-label">#0027</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center"><img src="#" alt="student"></td>
                                                        <td>Mark Willy</td>
                                                        <td>Male</td>
                                                        <td>Physics</td>
                                                        <td>9815759505</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <span class="flaticon-more-button-of-three-dots"></span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div>
                                    <div class="tab-pane fade" id="tab9" role="tabpanel">
                                        <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                        and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                        alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries, but also</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    
                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Student Area End Here -->
@endsection