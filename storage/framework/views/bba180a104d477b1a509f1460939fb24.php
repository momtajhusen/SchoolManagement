

<?php $__env->startSection('style'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
<?php $__env->startSection('contents'); ?>


<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/ClassTimeTable/ajax-class-subject.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>


<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Class Subject Period</h3>
            </div>
        </div>
        <form class="subject-period-form">

            <div class="row">
 
                <div class="col-lg-4 col-12 form-group">
                    <span>Class</span>
                    <select name="class" required class="select2 class-select" id="period-class" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                        <option value="">Select Class</option> 
                    </select>
                </div>

                <div class="col-lg-4 col-12 form-group">
                   <span>Section</span>
                    <select name="section" required class="select2 section-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                          <option value="">Select Section</option>
                    </select>
                </div>

                <div class="col-lg-4 col-12 form-group">
                    <label>Day</label>
                    <select name="day" required id="subject_code" class="select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                        <option value="">Please Select</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                </div>

                <div class="row mx-2" id="period-box">
                    <!-- Period Subjects  -->
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
                <h3>Class Time Table </h3>
            </div>
        </div>
        <form class="mg-b-20 search-form">
            <div class="row gutters-8">
                <div class="col-lg-7 col-12 form-group">
                        <select name="class" required class="select2 class-select" id="search-class" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                           <option value="">Select Class</option> 
                        </select>
                </div>
                <div class="col-lg-3 col-12 form-group">
                        <select name="section" required class="select2 section-select" id="search-section"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                             <option value="">Select Section</option>
                        </select>
                </div>
                <div class="col-lg-2 col-12 form-group">
                    <button type="submit" id="search-btn" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table display data-table text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">Class</th>
                        <th class="text-center">Section</th>
                        <th class="text-center">Day</th>
                        <th class="text-center">Period-1</th>
                        <th class="text-center">Period-2</th>
                        <th class="text-center">Period-3</th>
                        <th class="text-center">Period-4</th>
                        <th class="text-center">Period-5</th>
                        <th class="text-center">Period-6</th>
                        <th class="text-center">Period-7</th>
                        <th class="text-center">Period-8</th>
                        <th class="text-center">Period-9</th>
                        <th class="text-center">Period-10</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="class-time-table">

                </tbody>
            </table>
        </div>
    </div>
</div>

 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/ClassTimeTable/class-subjects.blade.php ENDPATH**/ ?>