

<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/TeachersSalary/ajax-bonus-epf-setting.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<div class="card height-auto">
    <div class="card-body">
         <div class="row">
            <div class="col-12 col-md-6">
                <h4 class="mb-1">Bonus & EPF Setting</h4>
               <div class="border p-2 mb-5">
                <form class="bonus-form">
                    <div class="col-12 form-group">
                        <label>(%) From *</label>
                        <input type="number" min="1" max="99" required maxlength="20" name="from_percent" placeholder="percent" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label>(%) To *</label>
                        <input type="number" min="1" max="100" required name="to_percent" placeholder="percent" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label>Bonus Amount *</label>
                        <input type="text" required maxlength="20" name="bonus_amount" placeholder="Amount" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label>(%) EPF *</label>
                        <input type="number" required min="1" max="99" name="epf_percent" placeholder="percent" class="form-control">
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                    </div>
                </form>
               </div>
            </div>
            </div>
         </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Teachers_Salary/bonus-epf-setting.blade.php ENDPATH**/ ?>