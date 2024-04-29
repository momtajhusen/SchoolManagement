 

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- ajax add student  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-add-student.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- script add student  -->
    <script src="<?php echo e(asset('../admin_lang/student/script-add-student.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Email Check -->
    <script src="<?php echo e(asset('../admin_lang/common/ajax-email-check.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Numer Check -->
    <script src="<?php echo e(asset('../admin_lang/common/ajax-number-check.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all Vehicle Root  -->
    <script src="<?php echo e(asset('../admin_lang/Transport/ajax-vehicle-root.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- script input file image set preview img  -->
    <script src="<?php echo e(asset('../admin_lang/common/image-select.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- script image Crope preview img  -->
    <script src="<?php echo e(asset('../admin_lang/common/ImageCrope/Student-Registration-Crope.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    
    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <style>
    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid white;
    }
    </style>
  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


<div class="modal fade" id="student-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color:#042954;z-index:1000;">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img id="student-sample_image" src="" alt="Crop Image">
                    </div>
                    <div class="col-md-4">
                        <div id="student_preview" class="preview"></div>
                    </div>
           
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark p-4 px-5" id="student-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="student-crop" style="z-index:100">
                    <span style="font-size: 20px;" class="crop-text">CROP</span> 
                    <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                    <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="document-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color:#042954;">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img id="document-sample_image" src="" alt="Crop Image">
                    </div>
                    <div class="col-md-4">
                        <div id="document_preview" class="preview"></div>
                    </div>
           
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark p-4 px-5" id="document-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="document-crop">
                    <span style="font-size: 20px;" class="crop-text">CROP</span> 
                    <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                    <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="fathert-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color:#042954;">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img id="father-sample_image" src="" alt="Crop Image">
                    </div>
                    <div class="col-md-4">
                        <div id="father_preview" class="preview"></div>
                    </div>
           
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark p-4 px-5" id="father-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="father-crop" style="z-index:100">
                    <span style="font-size: 20px;" class="crop-text">CROP</span> 
                    <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                    <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mother-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color:#042954;">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img id="mother-sample_image" src="" alt="Crop Image">
                    </div>
                    <div class="col-md-4">
                        <div id="mother_preview"  class="preview"></div>
                    </div>
           
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark p-4 px-5" id="mother-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="mother-crop">
                    <span style="font-size: 20px;" class="crop-text">CROP</span> 
                    <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                    <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                </button>
            </div>
        </div>
    </div>
</div>


 
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
                            <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                                <img src="http://bit.ly/3IUenmf" id="student_img_preview" class="h-100 w-100" style="position:absolute;">
                                <input type="file" required id="student_img_input" name="student_image" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                                <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="student_img_input" style="position:absolute;bottom:0px;width:100px;z-index:1;opacity: 0.5;">UPLOAD</label>
                            </div>
                        </div>

                
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>First Name *</label>
                            <input type="text" maxlength="20" required name="student_first_name" placeholder="First Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Middle Name</label>
                            <input type="text" maxlength="20" name="student_middle_name"  placeholder="Middle Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Last Name *</label>
                            <input type="text" maxlength="20" required name="student_last_name"  placeholder="Last Name" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Gender *</label>
                            <select name="student_gender" required class="select2">
                                <option value="">Please Select Gender *</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Date Of Birth *</label>
                            <input type="text" maxlength="10" required name="student_dob" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
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
                            <input type="number" name="student_phone" id="student_number" placeholder="Student Number" class="form-control mobile-number">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>E-Mail</label>
                            <input type="email" maxlength="40" id="student-email" name="student_email" placeholder="Student Email" class="form-control">
                        </div>

                        

                        <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                            <label>Upload ID Proof</label>
                            <div class="h-100 position-relative" style="height:80px; width:100px;">
                                <img  src="https://simptionsmartschool.com/school_software_v1//images/blank/blank_document.png" id="document_img_preview" class="h-100 w-100" style="position:absolute;">
                                <input type="file" name="student_id_image" id="document_img_input" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
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
                            <input type="text" maxlength="10" required name="admission_date" placeholder="dd/mm/yyyy" class="form-control admission_date nepali-datepicker">
                            <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" required class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;">

                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Section *</label>
                            <select class="select2 section-select" required name="section">
                                <option value="">Please Select Section *</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Roll No: *</label>
                            <input type="text" required name="roll_no" placeholder="Roll No" class="form-control student_roll">
                        </div>


                        <div class="col-lg-3 col-12 form-group">
                            <label>Hostel or Outi *</label>
                            <select name="hostel_outi" required class="select2 hostel_outi" style="height:50px;width:100%; padding:10px;">
                                <option value="">Choose Option</option>
                                <option value="hostel">Hostel</option>
                                <option value="outi">Outi</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group d-none" id="transport">
                            <label>Transport Use *</label>
                            <select name="transport_use" required class="select2" id="transport_use" style="height:50px;width:100%; padding:10px;">
                                <option value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group d-none" id="transport_root">
                            <label>Select Root *</label>
                            <select name="vehicle_root" class="select2" id="root_select">
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group" id="tuitiont">
                            <label>Tuition *</label>
                            <select name="tuitiont_use" required class="select2" id="tuitiont_use" style="height:50px;width:100%; padding:10px;">
                                <option value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        

                   <div class="heading-layout1 px-4 pt-5" style="width:100%;">
                            <div class="item-title">
                                <h4>Student Address</h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>District *</label>
                            <input type="text" maxlength="20" required name="district" placeholder="District" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Municipality *</label>
                            <input type="text" maxlength="20" required name="municipality" placeholder="Municipality" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Village *</label>
                            <input type="text" maxlength="20" required name="village" placeholder="Village" class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Ward No:</label>
                            <input type="number" maxlength="5" name="ward_no" placeholder="Ward No" class="form-control">
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
                                    
                                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <select class="select2 parents-search-select" name="student_blood_group">
                                            <option value="father_name">Father Name</option>
                                            <option value="father_mobile">Father Mobile</option>
                                            <option value="login_email">Father Email</option>
                                            <option value="mother_name">Mother Name</option>
                                            <option value="id">Parent Id</option>
                                        </select>
                                    </div>
                                    <div class="col-4-xxxl col-xl-7 col-lg-3 col-12 form-group">
                                        <input type="text" maxlength="30" placeholder="Enter Father Name" class="form-control parents-input-search py-4" style="height:98%;background:#f0f1f3;">
                                    </div>

                                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                        <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-parent d-flex justify-content-center align-items-center" style="height:95%">SEARCH</div>
                                    </div>
                                </div>

                             



                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
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
 
                        <nav class="mt-3" aria-label="Page navigation example">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">Previous</span>
                                </a>
                              </li>
                              <div class="d-flex pagnation-box">
            
                              </div>
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </li>
                            </ul>
                          </nav>

                        </div>
                        
                        <div class="tab-pane fade show active" id="tab9" role="tabpanel">
                          <div id="parent-container">
                            <input type="hidden" class="parent-check" name="parent_check'" value="new_parent">
                            <div class="row">

                            <div class="col-xl-2 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                <label>Father Image</label>
                                <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                                    <img src="http://bit.ly/3IUenmf" id="father_img_preview" class="h-100 w-100" style="position:absolute;">
                                    <input type="file" id="father_img_input" name="father_image" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                                    <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="father_img_input" style="position:absolute;bottom:0px;width:100px;z-index:1;opacity: 0.5;">UPLOAD</label>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-6 col-12 form-group">
                                <label>Father Name *</label>
                                <input type="text" maxlength="30" required name="father_name" placeholder="Father Name" class="form-control">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Father Mobile No: </label>
                                <input type="number" name="father_phone" id="father_number" placeholder="Father Mobile" class="form-control mobile-number">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Email </label>
                                <input type="email" name="father_email" id="father_email"  placeholder="Email" class="form-control">
                            </div>

                            <div class="col-xl-2 col-lg-6 col-12 form-group">
                                <label>Education</label>
                                <input type="text" maxlength="30" name="father_education"  placeholder="Education" class="form-control">
                            </div>
                                  
                            <div class="col-xl-2 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                                <label>Mother Photo</label>
                                <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                                    <img src="http://bit.ly/3IUenmf" id="mother_img_preview" class="h-100 w-100" style="position:absolute;">
                                    <input type="file" id="mother_img_input" name="mother_image" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                                    <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="father_img_input" style="position:absolute;bottom:0px;width:100px;z-index:1;opacity: 0.5;">UPLOAD</label>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Mother Name</label>
                                <input type="text"  maxlength="30"  name="mother_name"  placeholder="Mother Name" class="form-control">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Mother Mobile No:</label>
                                <input type="number" name="mother_phone" id="mother_number" placeholder="Mother Mobile" class="form-control mobile-number">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Education</label>
                                <input type="text" maxlength="30" name="mother_education"  placeholder="Education" class="form-control">
                            </div>

                            </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
                        
                <div class="col-12 form-group mg-t-8 d-flex justify-content-end">
                    <button type="submit" class="btn-fill-lg w-md-100 btn-gradient-yellow btn-hover-bluedark">Save</button>
                </div>

                  
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\Gurukul_School\resources\views/Admin_Page/Super_Admin/layouts/Student_Management/add-students.blade.php ENDPATH**/ ?>