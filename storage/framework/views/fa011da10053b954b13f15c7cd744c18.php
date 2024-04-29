<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax add subject -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-add-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax get all subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-get-all-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax delete subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-delete-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax Edit subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-update-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- script update subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/script-edit-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
    <!-- All Subjects Area Start Here -->
    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Subject</h3>
                    </div>
                </div>
                <form class="added-subject-form">
                    <div class="row">
                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Class *</label>
                            
                                <select name="class" required class="select class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Subject Name *</label>
                            <input type="text" required  maxlength="30" name="subject_name" placeholder="Subject Name" class="form-control select2 subject_name" style="height:50px;width:100%; padding:10px;background:#f8f8f8;">
                        </div>

                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Code</label>
                            <select name="subject_code" id="subject_code" class="select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                <option value="">Please Select</option>
                                <option value="00524">00524</option>
                                <option value="00525">00525</option>
                                <option value="00526">00526</option>
                                <option value="00527">00527</option>
                                <option value="00528">00528</option>
                            </select>
                        </div>
                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
                            <div class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark update-btn d-none">Update</div>
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Subjects</h3>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-10 col-12 form-group">
                            
                                <select name="class" required class="select2 class-select subject-class"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                            </select>
                        </div>

                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit"
                                class="fw-btn-fill btn-gradient-yellow search-class-subject">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Subject Name</th>
                                <th>Class</th>
                                <th>Subject Teacher</th>
                                <th>Subject Code</th>
                            </tr>
                        </thead>
                        <tbody class="class-subject-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/School_Management/add-subjects.blade.php ENDPATH**/ ?>