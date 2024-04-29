

<?php $__env->startSection('script'); ?>
    <!-- ajax class period -->
    <script src="<?php echo e(asset('../admin_lang/ClassTimeTable/ajax-class-period.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Create Time Table</h3>
            </div>
        </div>
        <form class="added-class-period-form">
            <div class="row">
 
                <div class="col-12-xxxl col-lg-3 col-12 form-group">
                    <label>Select Period</label>
                    <select name="period" required id="class_period" class="select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                        <option value="">Please Select</option>
                        <option value="Period_1">Period_1</option>
                        <option value="Period_2">Period_2</option>
                        <option value="Period_3">Period_3</option>
                        <option value="Period_4">Period_4</option>
                        <option value="Period_5">Period_5</option>
                        <option value="Period_6">Period_6</option>
                        <option value="Period_7">Period_7</option>
                        <option value="Period_8">Period_8</option>
                        <option value="Period_9">Period_9</option>
                        <option value="Period_10">Period_10</option>
                    </select>
                </div>

                <div class="col-12-xxxl col-lg-2 col-12 form-group">
                    <label>Start Time</label>
                    <input type="time" required  name="start_time" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                </div>

                <div class="col-12-xxxl col-lg-2 col-12 form-group">
                    <label>End Time</label>
                    <input type="time" required name="end_time" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                </div>

                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Class Period </h3>
            </div>
        </div>
 
        <div class="table-responsive">
            <table class="table display data-table text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="period-table">

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/ClassTimeTable/class-period.blade.php ENDPATH**/ ?>