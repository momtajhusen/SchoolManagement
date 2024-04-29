<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

    <style>
   .reg_no,
   .blood_group,
    .roll_no,
   .hostel_outi,
    .vehicle_root,
    .coaching{
      width: 60px;
    }

    .first_name,
    .middle_name,
    .last_name,
    .district {
        width: 130px;
    }

    .gender,
    .religion {
        width: 70px;
    }

    .admission_date,
    .dob,
    .class {
        width: 90px;
    }
    .section {
        width: 30px;
    }

    .submit-btn{
        border: 1px solid black;
        width: 80px;
        font-size: 15px;
        outline: none;
        cursor: pointer;
        background-color: #042954;
        color: white;
    }
    .save-all-student{
        height: 30px;
        cursor: pointer;
        background-color: #042954;
        color: white;
        position: absolute;
        top:20px;
        left: 25%;
    }

      .student-data{
        width: 100%;
        overflow-x: scroll;
      }
      .header-box{
        position: sticky;
        top: 0;
      }
      .header-column{
        background-color: #042954;
        color: #dddddd;
        outline: none;
      }

      .move-icon{
        position: absolute;
        left: -10%;
        transition: 0.5s;
      }

      .faile-icon{
        position: absolute;
        transition: 0.5s;
        right: -10%;
      }

      .total-sucess-students{
        transition: 1.5s;
      }
    </style>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax add-multiple-students  -->
    <script src="<?php echo e(asset('../admin_lang/student/add-multiple-students.js')); ?>?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>







<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout">
            <div class="item-title d-flex justify-content-between w-100">
                    <h4 class="m-0">Multiple Students Upload</h4>
                    <span class="upload-event">stop</span>
            </div>
        </div>

        <div class=" d-flex justify-content-between mt-2 px-3">
            <div class="d-flex align-items-center">
                <input type="file" id="fileInput" accept=".csv" />
            </div>

            <div class="animation-box position-relative align-items-end d-none mb-2">
                <div class="d-flex align-items-end">
                    <div class="d-flex">
                        <div class="d-flex flex-column align-items-center" style="line-height: 1.5; position:relative;">
                            <b class="mt-2 text-center total-upload-students" style="font-size: 12px; position:absolute; bottom:42px; "></b>
                            <span class="total-icon material-symbols-outlined m-0 d-flex justify-content-center" style="font-size:30px;color:#042954;">id_card</span>
                            <span style="font-size:10px;">STUDENTS</span>
                        </div>
                    </div>
                </div>

                <div class="position-ralative">
                    <div class="animation-root position-relative" style="overflow:hidden;width:300px;height:40px;color:#042954;">
                        <span class="material-symbols-outlined move-icon text-success">send</span>
                    </div>
                    
                    <div class="animation-root-failed position-absolute" style="top:19px;overflow:hidden;width:300px;height:40px;color:#042954;">
                        <span class="material-symbols-outlined faile-icon text-danger">send</span>
                    </div>
                </div>


                <div class="border send-button-box d-none">
                    <div class="d-flex align-items-center">
                        <button class="save-all-student align-items-center">Start Save <span class="material-symbols-outlined ml-3" style="font-size:15px;">
                            send
                            </span></button>
                     </div>
                </div>

                <div class="d-flex align-items-end">
                    <div class="d-flex">
                        <div class="d-flex flex-column align-items-center" style="line-height: 1.5; position:relative;">
                            <b class="mt-2 text-center mr-2 total-sucess-students" style="font-size: 12px; position:absolute; bottom:42px;">0</b>
                            <span class="database-icon material-symbols-outlined m-0 d-flex justify-content-center animate__animated  animate__infinite infinite animate__slow" style="font-size:30px;color:#042954;">database</span>
                            <span style="font-size:10px;">UPLOAD</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="d-flex align-items-center">
                 
                 
                <div class="d-flex flex-column text-center m-2">
                    <b>Failed</b>
                    <b class="total-failed-students">0</b>
                </div>
            </div>
        </div>
        <div class="student-data" style="height: 350px; overflow-y:scroll;"></div>
        

 
    </div>
</div>
 
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/add-multiple-students.blade.php ENDPATH**/ ?>