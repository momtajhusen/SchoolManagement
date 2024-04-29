    <?php $__env->startSection('style'); ?>
        <!-- Select 2 CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
        <!-- Date Picker CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

        <style>
            .card-counter{
                box-shadow: 2px 2px 10px #DADADA;
                margin: 5px;
                padding: 20px 10px;
                background-color: #fff;
                height: 100px;
                border-radius: 5px;
                transition: .3s linear all;
            }
            .card-counter:hover{
                box-shadow: 4px 4px 20px #DADADA;
                transition: .3s linear all;
            }
            .card-counter.primary{
                background-color: #007bff;
                color: #FFF;
            }
            .card-counter.danger{
                background-color: #c26361;
                color: #FFF;
            }  
            .card-counter.success{
                background-color: #66bb6a;
                color: #FFF;
            }  
            .card-counter.info{
                background-color: #26c6da;
                color: #FFF;
            }  
            .card-counter i{
                font-size: 5em;
                opacity: 0.2;
            }
            .card-counter .count-numbers{
                position: absolute;
                right: 35px;
                top: 20px;
                font-size: 25px;
                display: block;
            }
            .card-counter .count-name{
                position: absolute;
                right: 35px;
                top: 65px;
                font-style: italic;
                text-transform: capitalize;
                opacity: 0.5;
                display: block;
                font-size: 18px;
            }
        </style>

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('script'); ?>
        <!-- ajax CheckClassFee -->
        <script src="<?php echo e(asset('../admin_lang/report/salary-report.js')); ?>?v=<?php echo e(time()); ?>"></script>
 
    <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('contents'); ?>
 
 
        <div class="col-8-xxxl col-12 w-100">
            <div class="card height-auto">

                <div class="card-body">
                    <h4>Salary Reports</h4>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="card-counter info">
                            <i class="fa fa-inr"></i>
                            <span class="count-numbers all_salary">599</span>
                            <span class="count-name">All Salary</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter primary">
                            <i class="fa fa-inr"></i>
                            <span class="count-numbers genrate_salary">599</span>
                            <span class="count-name">Generate Salary</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter success">
                            <i class="fa fa-inr"></i>
                            <span class="count-numbers paid_salary">599</span>
                            <span class="count-name">Paid Salary</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-counter danger">
                            <i class="fa fa-inr"></i>
                            <span class="count-numbers remaining_salary">599</span>
                            <span class="count-name">Remaining Salary</span>
                            </div>
                        </div>
                          
                    </div>


                </div>
            </div>
        </div>
 

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Reports_Area/salary-report.blade.php ENDPATH**/ ?>