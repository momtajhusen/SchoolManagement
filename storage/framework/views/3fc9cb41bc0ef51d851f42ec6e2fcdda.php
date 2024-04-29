

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

    <!-- ajax Set Exam Grade -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax-grade.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>




<?php $__env->startSection('contents'); ?>

                   <!-- Add New Teacher Area Start Here -->
                   <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Manage Exam Grade</h3>
                            </div>
                        </div>
                        <form class="exam-grade-form">
                            <div class="row">

                   

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>From % *</label>
                                        <input type="number" name="from" required placeholder="percentage" style="height:45px;width:100%; padding:10px;">
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>To % *</label>
                                        <input type="number" name="to" required placeholder="percentage" style="height:45px;width:100%; padding:10px;">
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Grade Point *</label>
                                        <input type="text" name="grade_point" required style="height:45px;width:100%; padding:10px;">
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Grade Name *</label>
                                        <input type="text" name="grade_name" requireds style="height:45px;width:100%; padding:10px;">
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Remarks *</label>
                                        <input type="text" name="remarks" required style="height:45px;width:100%; padding:10px;">
                                </div>
 
                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>For Exam *</label>
                                        <select name="exam" required class="select-exam-term" style="height:45px;width:100%; padding:10px;">

                                    </select>
                                </div>
 
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Create</button>
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
                                        <h3>Grade List</h3>
                                    </div>
                                </div>
                        
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Exam</th>
                                                <th>Interval</th>
                                                <th>Grade Point</th>
                                                <th>Grade</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="exam-grade-table">
                                   
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/exam-grade.blade.php ENDPATH**/ ?>