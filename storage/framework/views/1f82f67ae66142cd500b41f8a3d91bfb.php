<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>"></script> 

    <!-- ajax get class roll -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-roll.js')); ?>"></script> 
 
    <!-- ajax Update Student Details -->
    <script src="<?php echo e(asset('../admin_lang/student_management/ajax-update-student-details.js')); ?>"></script>

        <!-- script input file image set preview img  -->
        <script src="<?php echo e(asset('../admin_lang/common/image-select.js')); ?>"></script> 

    
    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>

    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Update Student Details</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Update Student Details</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title d-flex justify-content-between w-100">
                            <h3>Select Class</h3>  
                        </div>
                    </div>
                    
                        <div class="row">
                            <div class="col-10-xxxl col-lg-5 col-12 form-group">
                                <label>Select Class *</label>
                                <select name="period" class="class-select select2"  style="height:50px;width:100%; padding:10px;">
                                </select>
                            </div>
                            <div class="col-5-xxxl col-lg-5 col-12 form-group">
                                <label>Roll No *</label>
                                <select name="period" class="roll-select select2"  style="height:50px;width:100%; padding:10px;">
                                </select>
                            </div>
                            <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                                    <br>
                                    <button class="fw-btn-fill btn-gradient-yellow btn search-btn" style="height:50px">SEARCH</button>
                                </div>
                        </div>
                            <!-- <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div> -->
                        </div>
                    
                </div>
            </div>
        </div>


                           <!-- Add New Student Area Start Here -->
                    <div class="card height-auto d-none student_details_cars">
                        <div class="card-body">
                            <div class="heading-layout1 pt-3">
                                <div class="item-title">
                                    <h4>Student Details</h4>
                                </div>
                            </div>
                            <form class="student-update-form" enctype="multipart/form-data">
                                <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                    <label>Student Image *</label>
                                    <div class="h-100 position-relative" style="height:60px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" id="student_img" class="h-100 w-100 imagepreview" style="position:absolute;">
                                        <input type="file" id="student_id_input" name="student_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                    </div>
                                    <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">CHANGE</span>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>First Name *</label>
                                        <input type="hidden" name="student_id">
                                        <input type="text" required name="student_first_name"  class="form-control">
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
                                        <select name="student_gender" required class="select gender-select" style="height:50px;width:100%; padding:10px;">
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
                                        <select class="select" name="student_religion" id="student_religion" style="height:50px;width:100%; padding:10px;">
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
                                        <select class="select" name="student_blood_group" id="student_blood_group" style="height:50px;width:100%; padding:10px;">
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
                                        <input type="number" name="student_phone" placeholder="" class="form-control">
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
                                            <img  src="#" class="h-100 w-100 imagepreview proofimage" style="position:absolute;">
                                            <input type="file" name="student_id_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
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
                                        <select name="class" required class="selec2 class-select" id="class" style="height:50px;width:100%; padding:10px;">
    
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Section *</label>
                                        <select class="select" id="section" required name="section" style="height:50px;width:100%; padding:10px;">
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
                                        <input type="text" readonly required name="roll_no" placeholder="" class="form-control student_roll">
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
                                        <input type="number" name="ward_no" placeholder="" class="form-control">
                                    </div>


                            
                                    <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                                        <div class="item-title">
                                            <h4>Parent Details</h4>
                                        </div>
                                    </div>
    

                                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                        <label>Father Photo</label>
                                        <div class="h-100 position-relative" style="height:50px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" id="father_img" style="position:absolute;">
                                        <input type="file" name="father_image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                        </div>
                                        <span class="border text-center bg-dark text-light" for="student_id_input border" style="width:100px;">UPLOAD</span>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father Name *</label>
                                        <input type="text" required name="father_name" placeholder="" class="form-control">
                                        <input type="hidden" name="parent_id">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father Mobile No: *</label>
                                        <input type="number" required name="father_phone" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Education</label>
                                        <input type="text" name="father_education"  placeholder="" class="form-control">
                                    </div>
            
                                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                        <label>Mother Photo</label>
                                        <div class="h-100 position-relative" style="height:50px; width:100px;">
                                        <img src="http://bit.ly/3IUenmf" class="h-100 w-100 imagepreview" id="mother_img"  style="position:absolute;">
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
                                        <input type="number"  name="mother_phone" placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Education</label>
                                        <input type="text" name="mother_education"  placeholder="" class="form-control">
                                    </div>

                                    <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                                        <div class="item-title">
                                            <h4>Change Parent</h4>
                                        </div>
                                    </div>

                             
                                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <select class="select2 parents-search-select" name="student_blood_group">
                                            <option value="father_name">Father Name ...</option>
                                            <option value="father_mobile">Father Mobile .. </option>
                                            <option value="login_email">Father Email ...</option>
                                            <option value="mother_name">Mother Name ...</option>
                                        </select>
                                    </div>

                                    <div class="col-7-xxxl col-xl-7 col-lg-3 col-12 form-group">
                                        <input type="text" maxlength="30" placeholder="Enter Parent Name ..." class="form-control parents-input-search w-100">
                                    </div>

                                    <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                        <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-parent">SEARCH</div>
                                    </div>
                                  

                                    <div class="table-responsive">
                                        <table class="table display data-table text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th> 
                                                        <div class="form-check">
                                                            
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
                                                </tr>
                                            </thead>
                                            <tbody class="table-body">
                       
                                            </tbody>
                                        </table>
                                     </div>  
                                </div>
          
                                    
                        <div class="col-12 form-group mg-t-8 d-flex justify-content-end">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Update</button>
                        </div>

                         
                         <div class="progress w-100 d-none" style="height:30px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                          </div>

                        <div class="alert alert-success  align-items-center alert-info d-none" role="alert">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            <b>Update Success</b>
                            </div>
                        </div>

                        </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Student Area End Here -->

    </div>
    <!-- All Subjects Area End Here -->
 


    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Student_Management/student_management_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Student_Management/layouts/update_student_details.blade.php ENDPATH**/ ?>