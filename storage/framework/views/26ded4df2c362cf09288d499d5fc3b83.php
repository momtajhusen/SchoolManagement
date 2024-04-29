



    <?php $__env->startSection('script'); ?>

        <!-- ajax Get Monthly Fee -->
        <script src="<?php echo e(asset('../admin_lang/Parent_Account/monthly_fee/ajax-payment-bill.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 

    <?php $__env->stopSection(); ?>   




<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Payment Bills</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Payment Bills</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

            
            <div class="card ui-tab-card w-100 py-0 my-0" id="payment-history">
                <div class="card-body shadow-none w-100 py-4 px-4">
                    <div class="border-nav-tab">
                        <ul class="nav nav-tabs border-0" role="tablist" style="margin-bottom: 0px; !important">
                            <li class="nav-item">
                                <a class="nav-link shadow-none border active d-flex" id="history-btn" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">
                                    Payment History
                                    <span class="material-symbols-outlined mt-1 mx-2">history</span>
                                </a>
                            </li>
                            <li class="nav-item existing-parent" id="back-year-btn" st_id="#">
                                <a class="nav-link shadow-none border d-flex" data-toggle="tab" href="#tab8" role="tab" aria-selected="false">
                                    Back year Fee
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-1">
                            <div class="tab-pane fade" id="tab8" role="tabpanel">
                                <table class="table table-dark table-hover" >
                                    <thead>
                                        <tr style="background-color: #000">
                                            <th scope="col">SN:</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Total Fee</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Dues</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody class="back-year-fee-table">
            
                                    </tbody>
                                </table>
            
                            </div>
                            
                            <div class="tab-pane fade show active " id="tab9" role="tabpanel">
                                <table class="table table-dark table-hover" >
                                    <thead>
                                        <tr style="background-color: #000">
                                            <th scope="col">SN:</th>
                                            <th scope="col">Pay Month</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Dues</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Bill Print</th>
                                        </tr>
                                    </thead>
                                    <tbody class="history-table">
                    
                                    </tbody>
                                </table>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            
    

 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Parent_Account/parent_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Parent_Account/layouts/PaymentBill.blade.php ENDPATH**/ ?>