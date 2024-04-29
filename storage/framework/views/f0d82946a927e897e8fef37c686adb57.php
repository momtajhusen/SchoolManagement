

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
    <!-- ajax all teacher -->
    <script src="<?php echo e(asset('../admin_lang/teacher/ajax-teacher-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax teacher salary -->
    <script src="<?php echo e(asset('../admin_lang/TeachersSalary/ajax-teacherSalary.js')); ?>?v=<?php echo e(time()); ?>"></script> 

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
                        <h3>Add Teachers Salary</h3>
                    </div>
                </div>
                <form class="salary-add-form">
                    <div class="row">
                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Teacher *</label>
                            <select name="teacher" required class="select teacher-select" id="teacher-select-add" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Salary Amount *</label>
                            <input type="number" required  min="500" name="salary_amount" placeholder="Amount" class="form-control select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8;">
                        </div>

                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Salary Join Date *</label>
                            <input type="text" required maxlength="10" name="salary_join_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker salary_join_date">
                            <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                        </div>

                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
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
                        <h3>Check Teachers Salary</h3>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-10 col-12 form-group">
                            <select name="teacher" required class="select teacher-select" id="teacher-select-add" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                            </select>
                        </div>

                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit"
                                class="fw-btn-fill btn-gradient-yellow search-class-subject">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Salary Date</th>
                                <th>Salary Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="salary-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Teachers_Salary/teachers-salary.blade.php ENDPATH**/ ?>