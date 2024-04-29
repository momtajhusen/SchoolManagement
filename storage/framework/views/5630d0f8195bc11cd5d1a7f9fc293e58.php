

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

 
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('script'); ?>

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-reset-payment.js')); ?>"></script> 

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>"></script> 

    <!-- ajax get class all roll for roll-select-->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-roll.js')); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

 
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Reset Payment</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Reset Payment</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

 
 
    <!-- All Payment Table -->
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
                            <select name="class" class="selec2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">

                            </select>
                        </div>

                        <div class="col-12-xxxl col-lg-5 col-12 form-group">
                            <label>Roll *</label>
                            <select name="period" class="select2 roll-select">
                                <option value="">Please Select Roll No:</option>
                            </select>
                        </div>
                        
                        <input type="hidden" id="student_id" value="0">
                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                            <br>
                            <button class="fw-btn-fill btn-gradient-yellow btn search-btn" style="height:50px">SEARCH</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-8-xxxl col-12">
    <div class="card height-auto">
    <div class="card-body">
            <div class="item-title">
                <h3>Student Fee</h3>
                <div class="mb-3 w-100 pl-4 d-flex justify-content-center" style="height:125px;">
                        <div class="d-flex p-2 mx-2 h-100" style="width:370px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <img src="http://bit.ly/3IUenmf" id="student_image" class="h-100">
                        <div class="p-3 w-100">
                            <h6 class="m-0"><b id="name">Student Name</b></h6>
                            <div class="w-100">
                                <div class="d-flex justify-content-between w-100">
                                <div>
                                    <span>Class:</span> 
                                    <span id="class"></span>
                                </div>
                                <div>
                                    <span>Roll:</span> 
                                    <span id="roll"></span>
                                </div>
                                <div>
                                    <span id="hostel_outi"></span>
                                </div>
                                </div>
                                <div>
                                <span>Transport use :</span> 
                                <span id="transport_use"></span>
                                </div>
                                <div>
                                    <span>Root:</span> 
                                    <span id="root"></span>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
            <div>
                <div class="w-100 mx-4" style="overflow:scroll;">
                    <table class="table table-dark table-hover" >
                    <thead>
                        <tr>
                            <th scope="col">SN:</th>
        
                            <th scope="col">Month</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Dues</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody class="payment-history-table" id="payment-table">

                    </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All Payment Table -->



 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Super_Admin/layouts/Account_management/reset-payment.blade.php ENDPATH**/ ?>