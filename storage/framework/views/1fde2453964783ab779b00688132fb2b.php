

<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/TeachersAttendance/ajax-teachers-periods.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <style>
    .input-group-text{
        width: 31px;
        height: 31px;

    }
    input[type="checkbox"]{
        cursor:pointer;
    }
  </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
<table class="table table-striped table-dark" id="time-table-view">
    <thead class="period_hearder">
        <!-- ... (unchanged) ... -->
    </thead>
    <tbody class="teachers-periods-table">
        <!-- daynamic period  -->
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-periods.blade.php ENDPATH**/ ?>