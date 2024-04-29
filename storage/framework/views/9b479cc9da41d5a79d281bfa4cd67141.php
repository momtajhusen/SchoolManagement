<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- script-treeview-menu -->
    <script src="<?php echo e(asset('../admin_lang/RoleAndPermission/ajax-sub_admin_list.js')); ?>?v=<?php echo e(time()); ?>"></script>
 
    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>

    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1 pt-3">
            <div class="item-title">
                <h4>Sub Admin List</h4>
            </div>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Number</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody  class="sub-admin-table">
            
        </tbody>
        </table>
    </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/RoleAndPermission/sub_admin_list.blade.php ENDPATH**/ ?>