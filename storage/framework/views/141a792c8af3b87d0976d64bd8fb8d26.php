<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/Transport/ajax-add-driver.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Email Check -->
    <script src="<?php echo e(asset('../admin_lang/common/ajax-email-check.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- script input file image set preview img  -->
    <script src="<?php echo e(asset('../admin_lang/common/image-select.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Numer Check -->
    <script src="<?php echo e(asset('../admin_lang/common/ajax-number-check.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- script image Crope preview img  -->
    <script src="<?php echo e(asset('../admin_lang/common/ImageCrope/Driver-img-Crope copy.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    

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
 
    
    <div class="modal fade" id="driver-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color:#042954;">
                <div class="modal-header">
                    <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="driver_sample_image" src="" alt="Crop Image">
                        </div>
                        <div class="col-md-4">
                            <div id="driver_preview" class="preview"></div>
                        </div>
            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark p-4 px-5" id="driver-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                    <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="driver-crop">
                        <span style="font-size: 20px;" class="crop-text">CROP</span> 
                        <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                        <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Add New Driver</h3>
            </div>
        </div>
        <form class="driver-added-form" enctype="multipart/form-data">
            <div class="row">

                <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                    <label>Driver Image *</label>
                    <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                        <img src="http://bit.ly/3IUenmf" id="driver_img_preview" class="h-100 w-100" style="position:absolute;">
                        <input type="file" required id="drive_img_input" name="image" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                        <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="teacher_upload_img_input" style="position:absolute;bottom:0px;width:100px;z-index:1;opacity: 0.5;">UPLOAD</label>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>First Name *</label>
                    <input type="text" required maxlength="20" name="first_name" placeholder="First Name" class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Last Name</label>
                    <input type="text" required maxlength="20" name="last_name"  placeholder="Last Name" class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Gender </label>
                    <select name="gender" id="gender" required class="select border-0 p-2" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
                        <option value="">Please Select Gender *</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Date Of Birth *</label>
                    <input type="text" required maxlength="10" name="dob" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Religion *</label>
                    <select required name="religion" id="religion" class="select border-0 p-2" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
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
                    <select  name="blood_group" id="blood" class="select border-0 p-2" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
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
                    <label>Address *</label>
                    <input type="text" required maxlength="50" name="address" placeholder="Address" class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Phone *</label>
                    <input type="number" required id="driver_number" name="phone" placeholder="phone" class="form-control mobile-number">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>E-Mail *</label>
                    <input type="email" required maxlength="50" name="email" placeholder="email" id="driver-email" class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Qualification</label>
                    <input type="text" maxlength="50" name="qualification"   class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Joining Date *</label>
                    <input type="text" required maxlength="10" name="joining_date" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Salary *</label>
                    <input type="number" max="100000" required name="salary" placeholder="0000" class="form-control">
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Licence No: *</label>
                    <input type="number" required name="licence_no"   class="form-control">
                </div>
                <input type="hidden" id="check_action"  value="add" class="form-control">
                <input type="hidden" name="driver_id"  value="" class="form-control">


 

                <div class="col-12 form-group mg-t-8" style="z-index: 1">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                </div>
                
                <div class="progress w-100 d-none" style="height:30px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </form>
    </div>
    </div>
    <!-- Add New Teacher Area End Here -->




    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Driver</h3>
                    </div>
                </div>
        
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Driver Image</th>
                                <th>Driver Name</th>
                                <th>Gender</th>
                                <th>Dob</th>
                                <th>Religion</th>
                                <th>Blood</th>
                                <th>Address</th>
                                <th>Phone</th>
            
                                <th>Qualification</th>
                                <th>Joining Date</th>
                                <th>Salary</th>
                                <th>Licence No</th>
                                <th>E-Mail</th>
            
                            </tr>
                        </thead>
            
                        <tbody class="driver-table">
            
                        </tbody>
            
                    </table>
                </div>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/layouts/Transport/add-driver.blade.php ENDPATH**/ ?>