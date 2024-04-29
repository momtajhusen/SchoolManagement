

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

    <!-- ajax Marks Entry -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_student_marks_entry.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Get All Exam Term -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-get-all-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>




 
<?php $__env->startSection('contents'); ?>

                <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Manage Exam Marks</h3>
                                    </div>
                                </div>

                                <form class="mg-b-20 search-student">
                                    <div class="row gutters-8">
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Exam *</label>
                                            <select name="exam" required class="select2 select-process-term" id="select_exam" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

    
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <label>Class *</label>
                                            <select name="class" required class="select2 class-select search-class-subject" id="class-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
    
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <label>Section *</label>
                                            <select name="class" required class="select2 section-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                <option value="">Select Section *</option>
    
                                        </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Subject *</label>
                                            <select name="class" required class="select2 select-subject" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
    
                                        </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group d-flex align-items-end">
                                            <button type="submit" id="search-btn" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="SEARCH">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                        
                                <form class="table-responsive entry-mark-form">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN.</th>
                                                <th>Roll.</th>
                                                <th>Name</th>
                                                
                                                <th>Marks Obtained</th>
                                                <th>Total Marks</th>
                                                <th>Minimum Marks</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody class="marks-entry">
                        
                                        </tbody>
                                    </table>
                                    <div class="col-lg-2 col-12 form-group d-flex align-items-end">
                                        <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="Save Result">Save Result</button>
                                    </div>
                                </form>
                
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/marks-entry.blade.php ENDPATH**/ ?>