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
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/teacher/ajax-get-all-teacher.js')); ?>?v=<?php echo e(time()); ?>"></script> 

        <!-- Select 2 Js -->
        <script src="<?php echo e(asset('../admin_lang/teacher/ajax-add-teacher.js')); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

        <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Teacher</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>All Teachers</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- Teacher Table Area Start Here -->
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Teachers Data</h3>
                            </div>
                        </div>
                        <div class="row gutters-8">
                            
                            <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                <select class="select2 parents-search-select" name="student_blood_group">
                                    <option value="father_name">Teacher Name ...</option>
                                    <option value="father_mobile">Teacher Mobile .. </option>
                                    <option value="login_email">Teacher Email ...</option>
                                </select>
                            </div>
                            <div class="col-4-xxxl col-xl-7 col-lg-3 col-12 form-group">
                                <input type="text" maxlength="30" placeholder="Enter Parent Name ..." class="form-control parents-input-search">
                            </div>

                            <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-parent">SEARCH</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
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
                                        <th>salary</th>
                                        <th>address</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Teacher Table Area End Here -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/layouts/all-teachers.blade.php ENDPATH**/ ?>