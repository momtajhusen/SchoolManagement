<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

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
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-manage-free-student.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>?v=<?php echo e(time()); ?>"></script>

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('select-menu-class'); ?>
    bg-danger
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Student Fee Exceptions</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Account Management</li>
            <li>Fee Exceptionss</li>

        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
 
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
 

            <div class="row gutters-8">
                <!-- <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                    <select class="select2 parents-search-select">
                        <option value="father_name">Father Name</option>
                        <option value="father_mobile">Father Mobile</option>
                        <option value="login_email">Father Email</option>
                        <option value="mother_name">Mother Name</option>
                        <option value="id">Parent Id</option>
                    </select>
                </div> -->
                <div class="col-12 col-md-10 form-group">
                    <input type="number" maxlength="30" placeholder="Enter Parent id" class="form-control parents-input-search py-4" style="height:98%;background:#f0f1f3;">
                </div>
                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                    <div class="fw-btn-fill btn-gradient-yellow w-100 search-parents d-flex justify-content-center align-items-center" style="height:95%">SEARCH</div>
                </div>
            </div>

  
                  <!-- main box  -->
                <div style="background-color:#C5C5C5;">

                    <!-- parents details box -->
                    <div class="d-flex justify-content-between " style="height:80px;background-color:#D9D9D9;">
                        <div class="d-flex">
                            <div class="d-flex p-3">
                                <img class="mr-2" src="#" id="father_img" style="width:60px;height:60px;border:1px solid black;">
                                <img src="#" id="mother_img"  style="width:60px;height:60px;border:1px solid black;">
                            </div>
                            <div class="pt-2" style="font-size: 13px;">
                                 <div>Father Name :  <span id="father_name"></span></div>
                                 <div>Mother Name :  <span id="mother_name"></span></div>
                                 <div>Address :  <span></span></div>
                            </div>
                        </div>
                        <div class="d-flex px-5 flex-column p-2  " style="font-size: 13px;">
                            <!-- <div>pr_id : <span>12</span></div> -->
                            <div>total child : <span id="total_child">0</span></div>
                        </div>
                    </div>
                    <!-- parents details box -->

                    <!-- student details box -->
                    <div class="p-3 w-100 h-100 student_box">
                        
                    </div>
                    <!-- student details box -->

                    <!-- fee stracture box  -->
                    <div class="row p-4">
                          <div class="p-4 col-12 col-md-6" id="fee_stracture" style="background-color:#D9D9D9;">
                           
                           </div>

                           <div class="p-4 col-12 col-md-6 d--none" id="discount_stracture" style="background-color:#D9D9D9;">

                           </div>
                    </div>
       
                    <!-- fee stracture box  -->

                </div>

                <div class="fw-btn-fill d-none btn-gradient-yellow w-25 mt-2 text-center" id="update-btn" style="height:95%">Update</div>

 
 
 
    </div>
    </div>
    <!-- Teacher Table Area End Here -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/manage_free_student.blade.php ENDPATH**/ ?>