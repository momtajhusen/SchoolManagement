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
                    </div>
                    <form class="expenses-form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Expenses Name *</label>
                                <input type="text" required maxlength="35" name="expenses_name" placeholder="Expenses Name" class="form-control">
                            </div>
 
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Expenses Date*</label>
                                <input type="text" required maxlength="10" name="expenses_date" id="expenses_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker">
                                <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                            </div>
 
 
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Amount *</label>
                                <input type="number" required maxlength="10" name="amount" placeholder="amount" class="form-control">
                            </div>

                            <input type="hidden" id="check_action"  value="add" class="form-control">
                            <input type="hidden" name="ex_id"  value="" class="form-control">
 
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


            <div class="col-8-xxxl col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Expenses</h3>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>SN.</th>
                                        <th>Expenses Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody class="table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Account_management/add-expenses.blade.php ENDPATH**/ ?>