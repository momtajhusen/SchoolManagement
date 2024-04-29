<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">

     <style>
        .routes-box-body{
            box-shadow:none !important;
            border:1px solid #ddd;
            padding: 10px !important;
        }
     </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- script-treeview-menu -->
    <script src="<?php echo e(asset('../admin_lang/RoleAndPermission/script-treeview-menu.js')); ?>?v=<?php echo e(time()); ?>"></script>
    
    <!-- ajax-role-permission  -->
    <script src="<?php echo e(asset('../admin_lang/RoleAndPermission/ajax-role-permission.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Add New Users</h3>
            </div>
        </div>
        <form class="added-vehicle-form">
            <div class="row">

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Name *</label>
                    <input type="text" required name="name" placeholder="name" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Number *</label>
                    <input type="number" required name="number" placeholder="number" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Email *</label>
                    <input type="email" required name="email" placeholder="email" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Password *</label>
                    <input type="text" required name="password" placeholder="password" class="form-control">
                </div>
            </div>
        </form>
        
    </div>
    </div>
    <!-- Add New Teacher Area End Here -->

    <div class="card height-auto">
        <div class="card-body">
            <b>Permission Page Routes</b>
            <div class="row page-route-box">

    
            </div>
        </div>
        <button class="my-2 btn-fill-lg btn-gradient-yellow btn-hover-bluedark save-route-user">Save</button>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/RoleAndPermission/role_permission.blade.php ENDPATH**/ ?>