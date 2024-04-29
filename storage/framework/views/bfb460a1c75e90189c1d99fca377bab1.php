

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax ItemsCategory -->
    <script src="<?php echo e(asset('../admin_lang/StockStore/ItemsCategory.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax AddItems & Price -->
    <script src="<?php echo e(asset('../admin_lang/StockStore/AddItemsPrice.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- ajax ItemsInStock & Price -->
    <script src="<?php echo e(asset('../admin_lang/StockStore/ItemsInStock.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
    <!-- All Subjects Area Start Here -->
    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add Items In Stock</h3>
                    </div>
                </div>
                <form class="items-in-stock-form">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Category *</label>
                            <select name="categories" required class="select2 select-category" id="categoryOnChangeItems" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Items *</label>
                            <select name="items" required class="select2 category-change-items"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Quantity *</label>
                            <input type="quantity" required  min="1" name="quantity" placeholder="Quantity" class="form-control select2">
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Adding Date *</label>
                            <input type="text" required name="date" placeholder="yyyy-mm-dd" class="form-control select2 currentDate nepali-datepicker">
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <br>
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Stock Add History</h3>
                    </div>
                </div>
 
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="stock-history-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/StockStore/ItemsInStock.blade.php ENDPATH**/ ?>