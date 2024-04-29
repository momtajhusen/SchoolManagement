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
 
    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get class student for promotion-->
    <script src="<?php echo e(asset('../admin_lang/promotion_student/ajax-get-student.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax student passout-->
    <script src="<?php echo e(asset('../admin_lang/promotion_student/ajax-pass_out_student.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax student Promotion-->
    <script src="<?php echo e(asset('../admin_lang/promotion_student/ajax-promote.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
 
    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
 
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Promotion Class Student</h3>
                </div>

            </div>
            <div class="row gutters-8">
                <div class="col-3-xxxl col-xl-5 col-lg-5 col-12 form-group">
                    <span>From</span>
                    <select name="class" required class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;">

                    </select>
                </div>
                <div class="col-3-xxxl col-xl-5 col-lg-5 col-12 form-group">
                    <span>Promote Class</span>
                    <select name="class" required class="select2 class-select" id="promote-class" style="height:50px;width:100%; padding:10px;">

                    </select>
                </div>
                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                    <br>
                    <div class="fw-btn-fill btn-gradient-yellow text-center w-100" id="class-student">SEARCH</div>
                </div>
            </div>
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
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="promotion-table">

                    </tbody>
                </table>
            </div>

            <div class="w-100 d-flex justify-content-between ">
                <button class="fw-btn-fill btn btn-gradient-yellow text-center mt-3" id="promotion-btn" style="width:200px;">Promotion</button>
                <button class="fw-btn-fill btn btn-gradient-yellow text-center mt-3" id="passout-btn" style="width:200px;">Pass Out</button>
            </div>

        </div>
    </div>
    <!-- Teacher Table Area End Here -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/student-promotion.blade.php ENDPATH**/ ?>