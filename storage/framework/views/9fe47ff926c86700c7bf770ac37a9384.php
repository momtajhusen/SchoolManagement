

<?php $__env->startSection('style'); ?>
 
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <style>
/* Hide the up and down arrows on number input */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
    margin: 0; /* Optional: You can also add padding or other styles here */
}

/* Optional: Style the number input field as needed */
input[type="number"] {
    /* Add your custom styles here */
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    height:33px;
    width:60px;
}

input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    height:33px;
    width:60px;
    background-color: #ddd;
    text-align: center;
    font-weight: bold;
}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-manage-fee.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

    <script>
       const dragArea = document.querySelector(".fee-stracture-body");
       new Sortable(dragArea, {
          animation: 350 
       });
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Manage Fee Stracture</h3>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" style="outline:none;cursor:pointer" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Monthly fee</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" style="outline:none;cursor:pointer" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">One time fee</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" style="outline:none;cursor:pointer" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Quarterly fee</button>
                        </li>
                    </ul>

                        <div class="tab-content" id="myTabContent">
                       <!-- Monthly Fee table tab  -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                         <form class="feestracture-form" feetype="monthly-feestracture">
                            
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr style="width:50px;">
                                    <th style="width:50px;" scope="col">Class</th>
                                        <th style="width:50px;" scope="col">Tuition Fee</th>
                                        <th style="width:50px;" scope="col">Full Hostel Fee</th>
                                        <th style="width:50px;" scope="col">Half Hostel Fee</th>
                                        <th style="width:50px;" scope="col">Computer Fee</th>
                                        <th style="width:50px;" scope="col">Coaching Fee</th>
                                    </tr>
                                </thead>
                                <tbody class="monthly-fee-table">
    
                                </tbody>
                            </table>
                            <input type="submit" value="Update Monthly Fee">
                        </form>
                        </div>


                        <!-- One time Fee table tab  -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form class="feestracture-form" feetype="onetime-feestracture">    
                          <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">Class</th>
                                    <th scope="col">Admission Fee</th>
                                    <th scope="col">Annual Charge</th>
                                    <th scope="col">Saraswati Puja</th>
                                    </tr>
                                </thead>
                                <tbody class="one-time-fee-table">
                                </tbody>
                            </table>
                            <input type="submit" value="Update OneTime Fee">
                        </form>
                        </div>
                        
                        <!-- Quarterly Fee table tab  -->
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <form class="feestracture-form" feetype="quarterly-feestracture">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">Class</th>
                                    <th scope="col">Exam Fee</th>
                                    </tr>
                                </thead>
                                <tbody class="quarterly-fee-table">
                                </tbody>
                            </table>
                            <input type="submit" value="Update Quarterly Fee">
                        </form>

                        </div>

                        </div>
                
                
                    </div>
            </div>
            <button class="px-2 d-none" id="joining-set" style="cursor: pointer;">Joining</button>

        </div>
    </div>
    <!-- All Subjects Area End Here -->

 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Account_management/manage-stracture.blade.php ENDPATH**/ ?>