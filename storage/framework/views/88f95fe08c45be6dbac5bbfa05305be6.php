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
    <!-- ajax add class  -->
    <script src="<?php echo e(asset('../admin_lang/classes/ajax-add-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all class  -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax edit-delete-class -->
    <script src="<?php echo e(asset('../admin_lang/classes/ajax-edit-delete-class.js')); ?>?v=<?php echo e(time()); ?>"></script>


    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>

                   <!-- Add New Teacher Area Start Here -->
                   <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Class</h3>
                            </div>
                        </div>
                        <form class="added-class-form">
                            <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Select Class *</label>
                                    <select required name="class" class="select class border-0 p-2 w-100" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
                                    <option value="">Please Select Class *</option>
                                        <option value="NURSERY">NURSERY</option>
                                        <option value="LKG">LKG</option>
                                        <option value="UKG">UKG</option>
                                        <option value="1ST">1ST</option>
                                        <option value="2ND">2ND</option>
                                        <option value="3RD">3RD</option>
                                        <option value="4TH">4TH</option>
                                        <option value="5TH">5TH</option>
                                        <option value="6TH">6TH</option>
                                        <option value="7TH">7TH</option>
                                        <option value="8TH">8TH</option>
                                        <option value="9TH">9TH</option>
                                        <option value="10TH">10TH</option>
                                        <option value="11TH">11TH</option>
                                        <option value="12TH">12TH</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Section *</label>
                                    <select name="section" required class="select section border-0 p-2 w-100" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
                                        <option value="">Please Select Section *</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">G</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Teacher</label>
                                    <select name="class_teacher"  class="select class_teacher border-0 p-2 w-100" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
                                        <option value="">Please Select Class *</option>
                                        <option value="One">One</option>
                                        <option value="One">Two</option>
                                        <option value="One">Three</option>
                                        <option value="One">Four</option>
                                        <option value="One">Five</option>
                                        <option value="One">Six</option>
                                        <option value="One">Seven</option>
                                        <option value="One">Eight</option>
                                        <option value="One">Nine</option>
                                        <option value="One">Ten</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Capacity</label>
                                    <input type="number" name="capacity" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Starting on *</label>
                                    <input type="text" required name="start_date" placeholder="dd/mm/yyyy" class="form-control  nepali-datepicker">
                                    <i class="far fa-calendar-alt" style="position:absolute;top:55px;right:30px;"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Ending on *</label>
                                    <input type="text" required name="end_date" placeholder="dd/mm/yyyy" class="form-control  nepali-datepicker">
                                    <i class="far fa-calendar-alt" style="position:absolute;top:55px;right:30px;"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Location</label>
                                    <input type="text" name="location" placeholder="" class="location form-control">
                                </div>
                                <input type="hidden" id="check_action"  value="add" class="form-control">
                                <input type="hidden" name="class_id"  value="" class="form-control">
            
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <!-- Add New Teacher Area End Here -->

                <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Class</h3>
                                    </div>
                                </div>
                        
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SN.</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Class Teacher</th>
                                                <th>Class Starting on</th>
                                                <th>Class Ending on</th>
                                                <th>Class Capacity</th>
                                                <th>Class Location</th>

                                            </tr>
                                        </thead>
                                        <tbody class="class-table">
                                   
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Sunrise_School/resources/views/Admin_Page/Super_Admin/layouts/School_Management/add-classes.blade.php ENDPATH**/ ?>