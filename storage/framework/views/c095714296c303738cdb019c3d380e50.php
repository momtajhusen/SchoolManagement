<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">

    <style>
        /* Hide the arrow buttons */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield; /* Firefox */
        }

        .item-alert-message{
          font-size: 13px;
        }

        .sticky {
      position: -webkit-sticky; /* For Safari */
      position: sticky;
      top: 0; /* Stick to the top */
      z-index: 1000; /* Optional: Adjust z-index as needed */
      background-color: white; /* Optional: Add background color */
    }
        </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax ItemsInStock & Price -->
    <script src="<?php echo e(asset('../admin_lang/StockStore/ItemsInStock.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <script src="<?php echo e(asset('../admin_lang/StockStore/SellItems.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <script src="<?php echo e(asset('../admin_lang/StockStore/AddItemsPrice.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <script src="<?php echo e(asset('../admin_lang/StockStore/History.js')); ?>?v=<?php echo e(time()); ?>"></script> 




    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>

       <!-- ajax select option all-students.js -->
   <script src="<?php echo e(asset('../admin_lang/SelectOption/StudentsParents/all-students.js')); ?>?v=<?php echo e(time()); ?>"></script> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


 <!-- Start Fee Payment  Modal -->
   <div class="modal fade" id="feePaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #02142a;">
       <div class="modal-header">
          <h5 class="modal-title text-light" id="exampleModalLabel">Fee Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
       </div>
       <div class="modal-body">
           <div class="row m-0">
              <div class="col-lg-6 col-md-12 border py-4">
                  <div>
                     

                     
                     <div class="modale-table">
                        <table class="table table-bordered my-1 table-sm text-light" style="font-size:12px;">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">SN.</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Quantity </th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="text-center item-particular-table">
                                 
                            </tbody>
                            <tbody class="text-center">
                                <tr class="text-center">
                                    <th colspan="3">Total:</th>
                                    <th class="total-amount-items">0</th>
                                </tr>
                            </tbody>
                         </table>
                     </div>

                

                  </div>
              </div>
              <div class="col-lg-6 col-md-12 border py-4">
                <div class="d-flex flex-column align-items-center justify-content-center" style="width:100%;">
                   <div class="w-100 form-group m-1 position-relative">
                      <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                      <div class="d-flex justify-content-between">
                         <label class="text-light">Total Items Amount</label>
                      </div>
                       <input type="number" readonly value="0" id="fee_input" name="fee_dues" placeholder="Fee Dues" class="form-control" style="background:#ccc;padding-left:22px;">
                   </div>
                   <div class="w-100 form-group m-1 d-flex">
                        <div class="w-50 position-relative">
                            <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                            <label class="text-light">Payment</label>
                            <input type="number" min="0" name="paid" id="paid_input" placeholder="paid" class="form-control payment" style="padding-left:22px;">
                        </div>
                        <div class="w-50 ml-1 position-relative">
                         <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                         <label class="text-light">Dues</label>
                         <input type="number" readonly value="0" min="0" name="paid" id="dues_input" placeholder="paid" class="form-control payment" style="background:#ccc;padding-left:22px;">
                        </div>

                   </div>
                   <div class="w-100 d-flex">
                       <div class="w-100 form-group m-1">
                           <label class="text-light">Discount %</label>
                           <label class="text-light" style="margin-left: 18%;">Discount ₹</label>
                           <div class="d-flex">
                           <div style="width:40%;position:relative;">
                                <input type="number" min="0" max="100" value="0" id="percentage" name="percentage" placeholder="Per"  class="form-control px-0 pl-3 w-100" style="border-radius: 10 0 0 0px;" oninput="if (parseInt(this.value) > 100) this.value = '100';">
                                <div class="d-flex justify-content-center  align-items-center" style="width:40%;height:45px;position:absolute;right:5px;top:0px;">%</div>
                           </div>
                           <div class="position-relative" style="width:60%;">
                             <span class="position-absolute" style="top:9px;left:11px;">₹</span>
                            <input type="number" min="0" value="0" id="disc_input" name="disc" placeholder="Discount" class="form-control ml-1" style="width:100%;border-radius: 0 0 10 10px;padding-left:22px;">
                           </div>
                           </div>
                       </div>
                   </div>
                   <div class="w-100 form-group m-1 d-none" id="comment_for_discount">
                       <label class="text-light">Comment for discount</label>
                       <input type="text" required id="comment_disc" name="comment_disc" placeholder="Comment" class="form-control">
                   </div>
                   <div class="w-100 form-group m-1">
                       <label class="text-light">Date</label>
                       <input type="text" value="" required maxlength="10" id="pay_date" name="payment_date" placeholder="yyyy-mm-dd" class="form-control currentDate">
                   </div>
                   <div class="w-100 form-group m-1 d-flex justify-content-center mt-4">
                       <button value="Payment" class="form-control paid_btn bg-success" sing_multi="#" pr_id='#' all_st_id='#' data-fee-particular='#' style="width:100%;cursor:pointer;">Payment</button>
                       <button  class="d-none bg-success payment-loading" style="width:300px;cursor:pointer;">
                           <span class="mr-2"></span> <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
                       </button>
                   </div>
                </div>
              </div>
           </div>
       </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-secondary p-3 px-5 payment-model-colose" data-dismiss="modal">Cancle</button>
       </div>
    </div>
    </div>
  </div>
 <!-- End Fee Payment  Modal -->


    <div class="row">
        <div class="col-12 col-md-5 border p-2">
 
                <div class="border bg-light w-100 p-5">
                    <div class="student-select-box">
                        <span>Select Student</span>
                        <select class="select2 admit-students-select search-select">
                           
                        </select>
                     </div>


                     <div class="p-2 px-3 mt-2 d-flex justify-content-between align-items-center">
                         <span>Purchase Items</span>
                     </div>

                     <div class="table-responsive">
                     <table class="table text-nowrap">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Items <span class="total-items-count font-italic" style="font-size: 13px;">1</span></th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity <span class="total-qauantity-count font-italic" style="font-size: 13px;">0</span></th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="items-body-table">
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex flex-column">
                                        <select id='items-options' class="select-items" style="height:50px;width:200px; padding:10px; background:#f8f8f8; outline: none; border:none;">
                                            
                                        </select>
                                        <span class='item-alert-message'></span>
                                    </div>
                                </td>
                                <td class="text-center pt-4">₹ <span class="item-price">0</span></td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" required  class="form-control item-quantity" value="0" min="1" style="width:80px;">
                                    </div>
                                </td>
                                <td class="text-center pt-4">₹ <span class="item-amount">0</span></td>
                                <td class="text-center pt-4">
                                    <span class="material-symbols-outlined border add-items-btn" style="cursor:pointer">add</span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td colspan="3">
                                    Total Items Amount :
                                </td>
                                <td class="text-center pt-4 total-amount">₹ 0</td>
                              </tr>
                          </tbody>
                         
                      </table>
                       </div>
                      <div class="d-flex justify-content-end">
                        <button type="submit" class="btn-fill-lg w-md-100 btn-gradient-yellow btn-hover-bluedark billing-sell-item" visitorbtn="btn" btnName="Villing">Billing</button>
                      </div>


                </div>

        
        </div>


        
        <div class="col-12 col-md-5 bg-light p-3">
             <div class="border p-3">Sell History</div>
             <div class="table-responsive" style="height: 500px;">
                <table class="table text-nowrap table-striped">
                    <thead class="sticky">
                    <tr>
                        <th scope="col">SN.</th>
                        <th scope="col">Id</th>
                        <th scope="col">Students</th>
                        <th scope="col">Purchase Items</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Dues</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="history-body-table">
                        
                    </tbody>
                    
                    
                </table>
             </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="p-2 border bg-light">
                 <div class="font-weight-bold text-center">Items In Stock</div>
                 <div class="itemsstock">
 
                 </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

 

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/StockStore/sellItems.blade.php ENDPATH**/ ?>