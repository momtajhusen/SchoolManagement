

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
 
 
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('script'); ?>
 

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 
    <!-- ajax get class all student -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-student.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax discount manage js-->
    <script src="<?php echo e(asset('../admin_lang/fees/discount-manage.js')); ?>?v=<?php echo e(time()); ?>"></script> 


    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

 

    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Select Student</h3>
                    </div>
                </div>

                    <div class="row">
                    <div class="col-12-xxxl col-lg-5 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">

                            </select>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-12 form-group">
                                <label>Section *</label>
                                <select class="select2 section-select" required name="section">
                                    <option value="">Please Select Section *</option>
                                </select>
                            </div>
 
                        <input type="hidden" id="student_id" value="0">
                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                            <br>
                            <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group animate__animated" style="height:50px">SEARCH</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-8-xxxl col-12">
    <div class="card height-auto">
    <div class="card-body">
            <div class="item-title">
                <h3>Student Discount Manage</h3>

                <div class="w-1-00 student-box">
                     
                </div>



 
        </div>
    </div>
    <!-- End All Month Payment Table -->
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\Gurukul_School\resources\views/Admin_Page/Super_Admin/layouts/Account_management/discount-manage.blade.php ENDPATH**/ ?>