

<?php $__env->startSection('script'); ?>

    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/Transport/ajax-get-transport-student.js')); ?>?v=<?php echo e(time()); ?>"></script> 

<?php $__env->stopSection(); ?>



<?php $__env->startSection('contents'); ?>

    <!-- Transport Student -->
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Transport Students</h3>
                        </div>
                    </div>
                    <form class="mg-b-20 search-transport">
                        <div class="row gutters-8">
                            <div class="col-lg-10 col-12 form-group">
                                
                                    <select name="vehicle_root" required class="select2" id="root_select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                                    </select>
                            <div><span class="root-name"></span> Result : </span><span class="count-student"></span></div>


                                <!-- <select name="vehicle_root" class="select2" id="root_select"> -->
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
                                <th>SN.</th>
                                <th>st_id</th>
                                <th>student name</th>
                                <th>class</th>
                                <th>village</th>
                            </tr>
                        </thead>
                        <tbody class="transport-student-table">

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- All Subjects Area End Here -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Transport/transport-student.blade.php ENDPATH**/ ?>