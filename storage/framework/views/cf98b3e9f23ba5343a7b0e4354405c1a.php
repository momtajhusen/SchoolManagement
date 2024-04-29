<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">
    <!-- Common CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_lang/common/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-student-details.js')); ?>?v=<?php echo e(time()); ?>"></script> 

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<input type="hidden" value="<?php echo e($id); ?>" class="student_id" >
 
                <!-- Student Details Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>About Me</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-info-details">
                            <div class="item-content">
                            <div class="row">
                             <div class="col-xl-5 col-lg-6 col-12 form-group border">
                                <div class="item-img">
                                    <img class="student_image" src="#" alt="student" style="width:200px;">
                                </div>
 
 
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="font-medium text-dark-medium name"> </td>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td class="font-medium text-dark-medium class"> </td>
                                            </tr>
                                            <tr>
                                                <td>Section:</td>
                                                <td class="font-medium text-dark-medium section"> </td>
                                            </tr>
                                            <tr>
                                                <td>Roll:</td>
                                                <td class="font-medium text-dark-medium roll"> </td>
                                            </tr>
                                            <tr>
                                                <td>Admission Date:</td>
                                                <td class="font-medium text-dark-medium admission_date"> </td>
                                            </tr>
                                            <tr>
                                                <td>Religion:</td>
                                                <td class="font-medium text-dark-medium religion"> </td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td class="font-medium text-dark-medium gender"> </td>
                                            </tr>
                                            <tr>
                                                <td>Date Of Birth:</td>
                                                <td class="font-medium text-dark-medium dob"> </td>
                                            </tr>
                                            <tr>
                                                <td>Father Name:</td>
                                                <td class="font-medium text-dark-medium rfather"> </td>
                                            </tr>
                                            <tr>
                                                <td>Mother Name:</td>
                                                <td class="font-medium text-dark-medium mother"> </td>
                                            </tr>
                    
                   
                                            <tr>
                                                <td>Father Occupation:</td>
                                                <td class="font-medium text-dark-medium father_occupation"> </td>
                                            </tr>
                                            <tr>
                                                <td>E-mail:</td>
                                                <td class="font-medium text-dark-medium email"> </td>
                                            </tr>
             
                 
                                            <tr>
                                                <td>Address:</td>
                                                <td class="font-medium text-dark-medium address">House #10, Road #6, Australia</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td class="font-medium text-dark-medium phone">+ 88 98568888418</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </div>

                             <div class="col-xl-7 col-lg-6 col-12 form-group border">

                                    <div class="card ui-tab-card">
                    <div class="card-body">
                        <div class="heading-layout1 mg-b-25">
                    
 
                        <div class="custom-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab4" role="tab" aria-selected="true">Check Fee</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab5" role="tab" aria-selected="false">Payment Bills</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab4" role="tabpanel">
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                        and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                        alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                        It has survived not only five centuries, but also</p>
          
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel">
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                    and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                    alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries, but also</p>
                                </div>
                                <div class="tab-pane fade" id="tab6" role="tabpanel">
                                    <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries,but alsowhen an unknown printer took a galley of type 
                                    and scrambled it to make a type specimen book. It has survived not only five centuries, but 
                                    alsowhen an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    It has survived not only five centuries, but also</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

     
                             </div>


                            
                             </div>






                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Details Area End Here -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/student-details.blade.php ENDPATH**/ ?>