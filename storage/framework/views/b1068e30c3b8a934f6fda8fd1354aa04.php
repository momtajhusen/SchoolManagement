

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

    <!-- ajax Get All Exam Term -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax get exam tabulation sheet -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax-tabulation-sheet.js')); ?>?v=<?php echo e(time()); ?>"></script> 


<?php $__env->stopSection(); ?>




 
<?php $__env->startSection('contents'); ?>

                <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Exam Tabulation Sheet</h3>
                                    </div>
                                </div>

                                <form class="mg-b-20 exam-tabulation-form">
                                    <div class="row gutters-8">
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Exam *</label>
                                            <select name="class" required class="select2 select-exam-term" style="height:45px;width:100%; padding:10px;">
    
                                            </select>
                                        </div>
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
                                        <div class="col-lg-3 col-12 form-group d-flex align-items-end">
                                            <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2">View Tabulation Sheet</button>
                                        </div>
                                    </div>
                                </form>
                        
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead class="exam-tabulation-title">
                     
                                        </thead>
                                        <tbody class="exam-tabulation-table">
 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-3 mt-2 col-12 form-group d-flex align-items-end">
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2">Print Tabulation Sheet</button>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/tabulation-sheet.blade.php ENDPATH**/ ?>