<?php $__env->startSection('script'); ?>
      <!-- ajax CheckClassFee -->
      <script src="<?php echo e(asset('../admin_lang/Expenses/ajax-add-expenses.js')); ?>?v=<?php echo e(time()); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
 
              <!-- Add New Expenses Area Start Here -->
              <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Add New Expenses</h3>
                        </div>
                       <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" 
                            data-toggle="dropdown" aria-expanded="false">...</a>
    
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <form class="expenses-form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Expenses Name *</label>
                                <input type="text" required maxlength="35" name="expenses_name" placeholder="Expenses Name" class="form-control">
                            </div>
 
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Expenses Date*</label>
                                <input type="text" required maxlength="10" name="expenses_date" placeholder="dd/mm/yyyy" value="" class="form-control nepali-datepicker">
                                <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                            </div>
 
 
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Amount *</label>
                                <input type="number" required maxlength="10" name="amount" placeholder="amount" class="form-control">
                            </div>
 
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                            </div>
                            
                            <div class="progress w-100 d-none" style="height:30px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Add New Expenses Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Super_Admin/layouts/Account_management/add-expenses.blade.php ENDPATH**/ ?>