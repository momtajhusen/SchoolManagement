

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

    <!-- ajax Exam Term -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_exam_term.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Get All Exam Term -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

                   <!-- Add New Teacher Area Start Here -->
                   <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Exam Term</h3>
                            </div>
                        </div>
                        <form class="add-exam-form">
                            <div class="row">
 
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Exam Name *</label>
                                    <input type="text" required name="exam_name" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Session</label>
                                    <input type="number" name="session" placeholder="" class="form-control">
                                </div>
 
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
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
                                        <h3>Exam List</h3>
                                    </div>
                                </div>
                        
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN.</th>
                                                <th>Exam Name</th>
                                                <th>Description</th>
                                                <th>Session</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="exam-term-table">
                                   
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/exam-term.blade.php ENDPATH**/ ?>