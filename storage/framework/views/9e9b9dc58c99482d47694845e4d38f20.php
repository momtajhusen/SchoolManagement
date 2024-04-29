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
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/parents/ajax-all-parent.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- script image Crope preview img  -->
    <script src="<?php echo e(asset('../admin_lang/common/ImageCrope/Student-Registration-Crope.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('select-menu-class'); ?>
    bg-danger
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Student Parents</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Student Parents</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Update Form Data Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Update Parents</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form  class="parent-update-form">
                    <div class="row">

                        <div class="col-xl-2 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                            <label>Father Image</label>
                            <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                                <img src="http://bit.ly/3IUenmf" id="father_img_preview" class="h-100 w-100" style="position:absolute;">
                                <input type="file" id="father_img_input" name="father_image" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                                <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="father_img_input" style="position:absolute;bottom:0px;width:100px;z-index:100;opacity: 0.5;">UPLOAD</label>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-6 col-12 form-group">
                            <label>Father Name *</label>
                            <input type="text" maxlength="30" required name="father_name" placeholder="Father Name" class="form-control">
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Father Mobile No</label>
                            <input type="number" name="father_phone" id="father_number" placeholder="Father Mobile" class="form-control mobile-number">
                        </div>

                        <input type="hidden" name="parent_id" value=""/>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Email</label>
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
                                <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="father_img_input" style="position:absolute;bottom:0px;width:100px;z-index:100;opacity: 0.5;">UPLOAD</label>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Mother Name</label>
                            <input type="text"  maxlength="30" name="mother_name"  placeholder="Mother Name" class="form-control">
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Mother Mobile No:</label>
                            <input type="number" name="mother_phone" id="mother_number" placeholder="Mother Mobile" class="form-control mobile-number">
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Education</label>
                            <input type="text" maxlength="30" name="mother_education"  placeholder="Education" class="form-control">
                        </div>

                        <div class="col-12 form-group mt-5 ">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">UPDATE</button>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    
    <div class="modal fade" id="fathert-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true" >
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

    
    <div class="modal fade" id="mother-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true" >
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


  
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>All Parents</h3>
            </div>
        </div>

            <div class="row gutters-8">
                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                    <select class="select2 parents-search-select">
                        <option value="father_name">Father Name</option>
                        <option value="father_mobile">Father Mobile</option>
                        <option value="login_email">Father Email</option>
                        <option value="mother_name">Mother Name</option>
                        <option value="id">Parent Id</option>
                        <option value="child_no">Child No</option>
                    </select>
                </div>
                <div class="col-4-xxxl col-xl-7 col-lg-3 col-12 form-group">
                    <input type="text" maxlength="30" placeholder="Enter Parent Name ..." class="form-control parents-input-search py-4" style="height:98%;background:#f0f1f3;">
                </div>
                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                    <div class="fw-btn-fill btn-gradient-yellow w-100 search-parents d-flex justify-content-center align-items-center" style="height:95%">SEARCH</div>
                </div>

                <div class="pl-1">
                    <span>Total Restlt :</span>
                    <span class="result_no"></span>

                </div>
            </div>
    
        <div class="table-responsive">
            <table class="table display data-table text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>father_image</th>
                        <th>father_name</th>
                        <th>Child</th>
                        <th>father_contact</th>
                        <th>mother_name</th>
                        <th>mother_contact</th>
                        <th>Action</th>
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
                <a class="page-link" id="next-page-link" href="http://127.0.0.1:8000/get-all-student?page=3" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
    </div>
    </div>
    <!-- Teacher Table Area End Here -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/student_parents.blade.php ENDPATH**/ ?>