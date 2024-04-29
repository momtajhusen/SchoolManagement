

<?php $__env->startSection('script'); ?>

    <!-- ajax Result Announcement -->
    <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax-result-announcement.js')); ?>?v=<?php echo e(time()); ?>"></script> 

        <!-- ajax Get All Exam Term -->
        <script src="<?php echo e(asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


<div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <!-- <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Exam Timeable</h3>
                                    </div>
                                </div> -->
                                <form class="mg-b-20 search-form">
                                    <div class="row gutters-8">
                                    <div class="col-lg-2 col-12 form-group">
                                            <select name="exam-year" required class="select2 exam-year" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                 <option value="">Exam Year</option> 
                                                 <option value="2080">2080</option>
                                                 <option value="2081">2081</option>
                                                 <option value="2082">2082</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-12 form-group">
                                            <select name="exam" required class="select2 select-process-term" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <select name="position_no" required class="select2 position_no" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                 <option value="">Number of Position</option> 
                                                 <option value="1">1</option>
                                                 <option value="2">2</option>
                                                 <option value="3">3</option>
                                                 <option value="4">4</option>
                                                 <option value="5">5</option>
                                                 <option value="6">6</option>
                                                 <option value="9">7</option>
                                                 <option value="8">8</option>
                                                 <option value="9">9</option>
                                                 <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <button type="submit"
                                                class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                        
                                <div class="table-responsive  position-table">
                                   <!-- Dynamic Table  -->
                                </div>
                            </div>
                        </div>
                    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Exam_Management/result-announcement.blade.php ENDPATH**/ ?>