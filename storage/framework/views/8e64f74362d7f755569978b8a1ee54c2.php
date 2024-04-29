<?php $__env->startSection('script'); ?>
    <!-- ajax-registration-list.js  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-registration-list.js')); ?>?v=<?php echo e(time()); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>

<div class="card height-auto">
    <div class="card-body" style="overflow-x: scroll">
        <div class="heading-layout1 pt-3">
            <div class="item-title">
                <h4>New Student</h4>
            </div>
        </div>

        <div class="w-100 table-box">
            <div class="d-flex justify-content-between mb-2">
            <span></span>
              <div>
                <button class='border btn bg-none border-success border-2 all-conform-btn'>All Conform</button>
                <button class='border btn bg-none border-danger border-2 all-delete-btn'>All Delete</button>
              </div>
            </div>
            <table class="table display data-table text-nowrap table-sm exportTable">
                <thead>
                    <tr>
                        <th>St_ID</th>
                        <th>Pr_ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Roll</th>
                        <th>Section</th>
                        <th>Parent Name</th>
                        <th>Parent Contact</th>
                        <th>Address</th>
                        <th>Action</th>
                        <th>
                            <div class="d-flex flex-column align-items-center ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 15px; float: left">
                                <span class="material-symbols-outlined p-1" id="btnCsvExport">file_save</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-body">

                </tbody>
            </table>
        </div>

 
    </div>
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/registration-list.blade.php ENDPATH**/ ?>