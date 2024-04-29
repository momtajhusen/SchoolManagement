

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

    <!-- ajax get all subject  -->
    <script src="<?php echo e(asset('../admin_lang/subject/ajax-get-all-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax create exam time table  -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_create_exam_timetable.js')); ?>?v=<?php echo e(time()); ?>"></script> 


<?php $__env->stopSection(); ?>




<?php $__env->startSection('contents'); ?>

                   <!-- Add New Teacher Area Start Here -->
                   <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Exam Timetable</h3>
                            </div>
                        </div>
                        <form class="exam-timetable-form">
                            <div class="row">
 
                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Select Exam *</label>
                                        <select name="exam" required class="select2 select-exam-term" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                                    </select>
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Select Class *</label>
                                        <select name="class" required class="select2 class-select subject-class" id="class-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                                    </select>
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Select Subject *</label>
                                        <select name="subject" required class="select2 select-subject" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                            <option value="">Select Subject</option>
                                    </select>
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Exame Date *</label>
                                    <input type="text" maxlength="10" required name="exam_date" placeholder="dd/mm/yyyy" class="form-control admission_date nepali-datepicker">
                                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Starting Time *</label>
                                        <input type="time" name="starting_time" required class="class-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                </div>

                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Ending Time *</label>
                                        <input type="time" name="ending_time" required style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                </div>

                                
                                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                    <label>Room/Block *</label>
                                        <input type="text" name="room_block" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                </div>
 
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Create</button>
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
                                        <h3>Exam Timeable</h3>
                                    </div>
                                </div>
                                <form class="mg-b-20">
                                    <div class="row gutters-8">
                                        <div class="col-lg-5 col-12 form-group">
                                            <select name="exam" required class="select2 select-exam-term" id="timetable-list-exam" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-12 form-group">
                                                <select name="class" required class="select2 class-select" id="class-timetable"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                                            </select>
                                        </div>
 
                                        <div class="col-lg-2 col-12 form-group">
                                            <button type="submit"
                                                class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                        
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN.</th>
                                                <th>Exam</th>
                                                <th>Subject</th>
                                                <th>Exam Date</th>
                                                <th>Starting Time</th>
                                                <th>Ending Time</th>
                                                <th>Room/Block</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="exam-timetable-table">
                                   
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/exam-timetable.blade.php ENDPATH**/ ?>