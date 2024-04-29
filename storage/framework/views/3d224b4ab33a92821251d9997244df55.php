<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <style>
        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button 
        {
          -webkit-appearance: none;
          margin: 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-fee-structure.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Hostel fee -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-set-hostel-fee.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Tuition fee -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-set-tuition-fee.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- script  -->
    <script src="<?php echo e(asset('../admin_lang/fees/script-add-fee.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

    <script>
       const dragArea = document.querySelector(".fee-stracture-body");
       new Sortable(dragArea, {
          animation: 350 
       });
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Class Fees Stracture</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
            
                        <div class="row gutters-8">
                            <div class="col-10 form-group">
                                <select name="class p-4" class="select2 select-class class-select" id="class-select" style="height:50px;width:100%; padding:10px;">
                                    <option value="">Search By Class</option>
                                </select>
                            </div>
                            <div class="col-2 form-group">
                            <button class="btn h-100 w-100 d-flex add-fee-btn btn-fill-lg bg-blue-dark btn-hover-success">
                                <span class="material-symbols-outlined mx-2">add_box</span>
                                <span style="font-size: 15px;">ADD</span>
                            </button>
                            </div>
                        </div>

                    <form class="fee-structure-form" >
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">

                            <tbody class="fee-stracture-body">
                                <tr>
                                    <th>S No</th><th>Trash</th><th>Fee Type</th><th>₹ Baishakh </th><th>₹ Jestha</th><th>₹ Ashadh</th><th>₹ Shrawan</th>
                                    <th>₹ Bhadau</th><th>₹ Asoj</th><th>₹ Kartik</th><th>₹ Mangsir</th><th>₹ Poush</th><th>₹ Magh</th><th>₹ Falgun</th><th>₹ Chaitra</th>
                                </tr>    
                            </tbody> 

                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                         <div class="col-8 form-group mg-t-10 fee-save">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                         </div>
                         <div class="col-4 form-group mg-t-8">
                            <span style="color:#b8b8b8;">Set Same Fee For This Class</span>
                            <select name="class p-4" class="select2 class-select" id="same-fee-class"  style="height:50px;width:100%; padding:10px;">
                                <option value="">Same Fee For This Class</option>
                            </select>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- All Subjects Area End Here -->


        <!-- Hostel Fee Area Start Here -->
        <div class="row">
            <div class="col-8-xxxl col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Set Hostel Fees Stracture</h3>
                            </div>
                        </div>
                        <form class="hostel-fee-structure-form" >
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
    
                                <tbody class="hostel-stracture-body">
                                    <tr>
                                        <th>S No</th><th>Class</th><th>Hostel Fee</th>
                                    </tr>    
                                </tbody> 
    
                            </table>
                        </div>
                        <div class="col-12 form-group mg-t-8  fee-save">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
        <!-- Hostel Fee Area End Here -->


                <!-- Tuition Fee Area Start Here -->
                <div class="row">
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Set Tuition Fees Stracture</h3>
                                    </div>
                                </div>
                                <form class="tuition-fee-structure-form" >
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
            
                                        <tbody class="tuition-stracture-body">
                                            <tr>
                                                <th>S No</th><th>Class</th><th>Tuition Fee</th>
                                            </tr>    
                                        </tbody> 
            
                                    </table>
                                </div>
                                <div class="col-12 form-group mg-t-8  fee-save">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                </form>
            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tuition Fee Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Super_Admin/layouts/Account_management/set-fees.blade.php ENDPATH**/ ?>