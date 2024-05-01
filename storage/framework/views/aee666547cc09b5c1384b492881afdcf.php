<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }


 
        /* Large screens */
        @media (min-width: 992px) {
            #joining-modal{
                background-color: blue;
                max-width: 45% !important;
            }
        }

    </style>
 
 
<?php $__env->stopSection(); ?>   

<?php $__env->startSection('script'); ?>
    <!-- ajax Reset Payment -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-reset-payment.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Biil  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-bill-data.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax Get Back Year Fee -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-get-back-year-fee.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-year-payment-history.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-fee-payment.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Payment monthly -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-fee-payment-monthly.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Multi Pay -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-multi-pay.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get class all roll for roll-select-->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-roll.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get class all student -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-student.js')); ?>?v=<?php echo e(time()); ?>"></script> 
   
    <!-- ajax joining -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-joining.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax priv month invoice -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-prev-invoice.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

 
  <!-- Payment Fee  Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: #02142a;">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="exampleModalLabel">Take Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row px-4">
                <div class="p-2 col-lg-6 col-md-12">
                   
                  <div class="d-flex justify-content-center">
                   <div class="p-5" style="background:#d39b7b;width:100%;">
                    <table class="table table-sm" style="width:100%;">
                        <div class="mb-2" style="border-top:1px solid black;border-bottom:1px solid black;">
                            
                            <div class="name p-0 m-0 d-flex justify-content-between" style="text-size:5px;">
                                <div><span>Class: </span><span class="s_class">1ST</span></div>
                                <div><span>Roll: </span><span class="s_roll">1ST</span></div>
                            </div>
                            <div class="name p-0 m-0 d-flex justify-content-between" style="text-size:5px;">
                                <div><span>Name: </span><span class="s_name">Momtaj Husen</span></div>
                            </div>
                        <div>
                        <thead class="border-dark text-dark font-weight-bold">
                            <tr>
                                <td class="border-dark" scope="col">Particulars</td>
                                <td class="border-dark" scope="col">Amount</td>
                                <!-- <td class="border-dark" scope="col">Excep.</td> -->
                            </tr>
                        </thead>
                        <tbody class="fee_stracture">
                            
                            

                        </tbody>
                        <tbody>
                            <tr class="d-none">
                                <td  colspan="1">Already Pay -</td>
                                <td class="already_pay">0</td>
                            </tr>
                            <tr style="background-color: #dba382">
                                <td colspan="1">Total Fee :</td>
                                <td class="total_amount" id="total_amount">0</td>
                            </tr>
                            <input type="hidden" id="select_month">
                        </tbody>
                        </table>

                        <div class="d-none  p-2" id="hostel_deposite_box"> 
                            <b class="text-dark">Hostel Deposite</b>
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="deposite_check" style="background: #d39b7b;cursor: pointer;">
                                  <input type="checkbox" id="deposite_check" aria-label="Checkbox for following text input" style="cursor: pointer;">
                                </label>
                                <div class="pl-2 pr-5 d-flex border" style="background: #d39b7b"><b class="pr-1" id="deposite-amount">0</b> <span>Check for clear</span></div>
                            </div>
                        </div>
                       </div>
                   </div>

                   
                   </div>
                 <div class="p-2 col-lg-6 col-md-12 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center justify-content-center" style="width:80%;">
                        <div class="w-100 form-group m-1">
                            <label class="text-light">Actual Dues</label>
                            <input type="number" readonly value="0" id="actual_dues" name="actual_dues" placeholder="Actual Dues" class="form-control" style="background:#ccc;">
                            <input type="hidden" id="last_month" value="0">
                        </div>
                        <div class="w-100 form-group m-1">
                            <label class="text-light">Payment</label>
                            <input type="number" name="payment" id="payment" placeholder="Payment" class="form-control payment">
                        </div>
                        <div class="w-100 d-flex">
                            <div class="w-100 form-group m-1">
                                <label class="text-light">Discount %</label>
                                <label class="text-light" style="margin-left: 25%;">Discount ₹</label>
                                <div class="d-flex">
                                <div style="width:40%;position:relative;">
                                     <input type="number" value="0" id="percentage" name="percentage" placeholder="Per"  class="form-control px-0 pl-3 w-100" style="border-radius: 10 0 0 0px;">
                                     <div class="d-flex justify-content-center  align-items-center" style="width:40%;height:45px;position:absolute;right:5px;top:0px;">%</div>
                                </div>
                                <input type="number" value="0" id="discount" name="discount" placeholder="Discount" class="form-control" style="width:60%;border-radius: 0 0 10 10px;">
                                </div>
                            </div>
                            <div class="w-50 form-group m-1 d-none">
                                <label class="text-light">Free</label>
                                <input type="number" readonly value="0" id="free" name="free" placeholder="Free" class="form-control" style="background:#ccc;">
                            </div>
                        </div>
                        <div class="w-100 form-group m-1 d-none" id="comment_for_discount">
                            <label class="text-light">Comment for discount</label>
                            <input type="text" required id="comment_discount" name="comment_discount" placeholder="Comment" class="form-control">
                        </div>
                        <div class="w-100 form-group m-1 d-none" id="comment_free_fee_box">
                            <label class="text-light">Comment for fee free.</label>
                            <input type="text" required id="comment_free_fee" name="comment_free_fee" placeholder="Comment" class="form-control">
                        </div>
                        <div class="w-100 form-group m-1">
                            <label class="text-light">Date</label>
                            <input type="text" value="2080/07/06" required maxlength="10" id="payment_date" name="payment_date" placeholder="yyyy-mm-dd" class="form-control">
                        </div>
                        <div class="w-100 form-group m-1 d-flex justify-content-center mt-4">
                            <button value="Payment" class="form-control monthly_payment bg-success" feeType="#" paymode="#" style="width:300px;cursor:pointer;">Payment</button>
                            <button  class="d-none bg-success payment-loading" style="width:300px;cursor:pointer;">
                                <span class="mr-2">Payment</span> <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
                            </button>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary p-3 px-5" id="payment-cancle" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    <!-- Start Last Years Dues Payment Fee  Modal -->
    <div class="modal fade" id="backYearModal" tabindex="-1" aria-labelledby="backYearModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="background: #454647;">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="backYearModalLabel">Last Years Dues Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2 d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center justify-content-center" style="width:80%;">
                    <div class="w-100 form-group m-1">
                        <label class="text-light">Actual Dues</label>
                        <input type="number" readonly value="0" id="actual_dues_year" name="actual_dues" placeholder="Actual Dues" class="form-control">
                        <input type="hidden" id="last_month" value="0">
                    </div>
                    <div class="w-100 form-group m-1">
                        <label class="text-light">Payment</label>
                        <input type="number" name="payment" id="payment_year" placeholder="Payment" class="form-control payment">
                    </div>
                    <div class="w-100 form-group m-1">
                        <label class="text-light">Discount</label>
                        <input type="number" min="0" value='0' name="discount" id="previus_discount" placeholder="Discount" class="form-control discount">
                    </div>

                    <input type="hidden" class="dues_year">

                    <div class="w-100 form-group m-1">
                        <label class="text-light">Date</label>
                        <input type="text" required maxlength="10" id="back_year_paid_date" name="payment_date" placeholder="yyyy-mm-dd" class="form-control currentDate">
                    </div>
                    <div class="w-100 form-group m-1 d-flex justify-content-center mt-4">
                        <button value="Payment" class="form-control yearly_payment bg-success" style="width:300px;cursor:pointer;">Payment</button>
                        <button  class="d-none bg-success payment-loading" style="width:300px;cursor:pointer;">
                            <sapn class="mr-2">Payment</sapn> <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
                        </button>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary p-3 px-5" id="payment-cancle" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Start Last Years Dues Payment Fee  Modal -->


    <!-- Joining Month  -->
    <div class="modal fade" id="JoiningMonths" tabindex="-1" aria-labelledby="exampleJoiningMonths" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="joining-modal">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleJoiningMonths">Services Join Month</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Monthly Fee</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">One Time Fee</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Quarterlies Fee</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <!-- Start Tabs Monthly Fee  -->
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">
                        <div class="d-flex align-content-center">
                            <span class="material-symbols-outlined">school </span>Tuit.
                        </div>
                    </th>

                    <th class="" scope="col">
                        <div class="d-flex align-content-center">
                           <span class="material-symbols-outlined">airport_shuttle </span>Tran.
                        </div>
                    </th>
                    <th scope="col">
                      <div class="d-flex align-content-center">
                         <span class="material-symbols-outlined">night_shelter </span>F Hos.
                      </div>
                    </th>
                    <th scope="col">
                        <div class="d-flex align-content-center">
                           <span class="material-symbols-outlined">night_shelter </span> H Hos.
                        </div>
                    </th>
                    <th scope="col">
                       <div class="d-flex align-content-center">
                          <span class="material-symbols-outlined">computer </span> Com.
                       </div>
                    </th>
                    <th scope="col">
                       <div class="d-flex align-content-center">
                          <span class="material-symbols-outlined">sauna </span> Coa.
                       </div>
                    </th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Baishakh 1  -->
                    <tr class="month_0">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-1" value="" id="tuition-1">
                                <label class="form-check-label" for="tuition-1" style='padding-left:20px;'>
                                    Bai.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-1" value="" id="transport-1">
                                <label class="form-check-label" for="transport-1" style='padding-left:20px;'>
                                Bai.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fullhostel-1" value="" id="fullhostel-1">
                                <label class="form-check-label" for="fullhostel-1" style='padding-left:20px;'>
                                Bai.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="halfhostel-1" value="" id="halfhostel-1">
                                <label class="form-check-label" for="halfhostel-1" style='padding-left:20px;'>
                                Bai.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-1">
                                <label class="form-check-label" for="computer-1" style='padding-left:20px;'>
                                Bai.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-1">
                                <label class="form-check-label" for="coaching-1" style='padding-left:20px;'>
                                Bai.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Jestha 2  -->
                    <tr class="month_1">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-2" value="" id="tuition-2">
                                <label class="form-check-label" for="tuition-2" style='padding-left:20px;'>
                                  Jes.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-2" value="" id="transport-2">
                                <label class="form-check-label" for="transport-2" style='padding-left:20px;'>
                                 Jes.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-2">
                                <label class="form-check-label" for="fullhostel-2" style='padding-left:20px;'>
                                Jes.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-2">
                                <label class="form-check-label" for="halfhostel-2" style='padding-left:20px;'>
                                Jes.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-2">
                                <label class="form-check-label" for="computer-2" style='padding-left:20px;'>
                                Jes.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-2">
                                <label class="form-check-label" for="coaching-2" style='padding-left:20px;'>
                                Jes.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Ashadh 3  -->
                    <tr class="month_2">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-3" value="" id="tuition-3">
                                <label class="form-check-label" for="tuition-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-3" value="" id="transport-3">
                                <label class="form-check-label" for="transport-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-3">
                                <label class="form-check-label" for="fullhostel-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-3">
                                <label class="form-check-label" for="halfhostel-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-3">
                                <label class="form-check-label" for="computer-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-3">
                                <label class="form-check-label" for="coaching-3" style='padding-left:20px;'>
                                Ash.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Shrawan 4  -->
                    <tr class="month_3">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-4" value="" id="tuition-4">
                                <label class="form-check-label" for="tuition-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-4" value="" id="transport-4">
                                <label class="form-check-label" for="transport-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-4">
                                <label class="form-check-label" for="fullhostel-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-4">
                                <label class="form-check-label" for="halfhostel-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-4">
                                <label class="form-check-label" for="computer-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-4">
                                <label class="form-check-label" for="coaching-4" style='padding-left:20px;'>
                                Shr.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Bhadau 5  -->
                    <tr class="month_4">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-5" value="" id="tuition-5">
                                <label class="form-check-label" for="tuition-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-5" value="" id="transport-5">
                                <label class="form-check-label" for="transport-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-5">
                                <label class="form-check-label" for="fullhostel-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-5">
                                <label class="form-check-label" for="halfhostel-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-5">
                                <label class="form-check-label" for="computer-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-5">
                                <label class="form-check-label" for="coaching-5" style='padding-left:20px;'>
                                Bha.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Asoj 6  -->
                    <tr class="month_5">
                    <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-6" value="" id="tuition-6">
                                <label class="form-check-label" for="tuition-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-6" value="" id="transport-6">
                                <label class="form-check-label" for="transport-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-6">
                                <label class="form-check-label" for="fullhostel-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-6">
                                <label class="form-check-label" for="halfhostel-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-6">
                                <label class="form-check-label" for="computer-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-6">
                                <label class="form-check-label" for="coaching-6" style='padding-left:20px;'>
                                Aso.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Kartik 7  -->
                    <tr class="month_6">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-7" value="" id="tuition-7">
                                <label class="form-check-label" for="tuition-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-7" value="" id="transport-7">
                                <label class="form-check-label" for="transport-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-7">
                                <label class="form-check-label" for="fullhostel-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-7">
                                <label class="form-check-label" for="halfhostel-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-7">
                                <label class="form-check-label" for="computer-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-7">
                                <label class="form-check-label" for="coaching-7" style='padding-left:20px;'>
                                Kar.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Mangsir 8  -->
                    <tr class="month_7">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-8" value="" id="tuition-8">
                                <label class="form-check-label" for="tuition-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-8" value="" id="transport-8">
                                <label class="form-check-label" for="transport-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-8">
                                <label class="form-check-label" for="fullhostel-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-8">
                                <label class="form-check-label" for="halfhostel-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-8">
                                <label class="form-check-label" for="computer-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-8">
                                <label class="form-check-label" for="coaching-8" style='padding-left:20px;'>
                                Man.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Poush 9  -->
                    <tr class="month_8">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-9" value="" id="tuition-9">
                                <label class="form-check-label" for="tuition-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-9" value="" id="transport-9">
                                <label class="form-check-label" for="transport-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-9">
                                <label class="form-check-label" for="fullhostel-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-9">
                                <label class="form-check-label" for="halfhostel-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-9">
                                <label class="form-check-label" for="coaching-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-9">
                                <label class="form-check-label" for="coaching-9" style='padding-left:20px;'>
                                Pou.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Magh 10  -->
                    <tr class="month_9">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-10" value="" id="tuition-10">
                                <label class="form-check-label" for="tuition-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transport-10" value="" id="transport-10">
                                <label class="form-check-label" for="transport-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-10">
                                <label class="form-check-label" for="fullhostel-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-10">
                                <label class="form-check-label" for="halfhostel-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-10">
                                <label class="form-check-label" for="computer-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-10">
                                <label class="form-check-label" for="coaching-10" style='padding-left:20px;'>
                                Mag.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Falgun 11  -->
                    <tr class="month_10">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-11" value="" id="tuition-11">
                                <label class="form-check-label" for="tuition-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="transport-11" id="transport-11">
                                <label class="form-check-label" for="transport-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="fullhostel-11">
                                <label class="form-check-label" for="fullhostel-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="halfhostel-11">
                                <label class="form-check-label" for="halfhostel-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="computer-11">
                                <label class="form-check-label" for="computer-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coaching-11">
                                <label class="form-check-label" for="coaching-11" style='padding-left:20px;'>
                                Fal.
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!-- Chaitra 12  -->
                    <tr class="month_11">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tuition-12" value="" id="tuition-12">
                                <label class="form-check-label" for="tuition-12" style='padding-left:20px;'>
                                Cha.
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="transport-12" id="transport-12">
                                <label class="form-check-label" for="transport-12" style='padding-left:20px;'>
                                Cha.
                                </label>
                            </div>
                        </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fullhostel-12">
                                    <label class="form-check-label" for="fullhostel-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="halfhostel-12">
                                    <label class="form-check-label" for="halfhostel-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="computer-12">
                                    <label class="form-check-label" for="computer-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="coaching-12">
                                    <label class="form-check-label" for="coaching-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                    </tr>
                </tbody>
            </table>
            </div>
          <!-- End Tabs Monthly Fee  -->

            <!-- Start Tabs One Time Fee  -->
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">
                              <div class="d-flex align-content-center">
                                <span class="material-symbols-outlined">other_admission </span> Adms.	
                              </div>
                            </th>
                            <th scope="col">
                               <div class="d-flex align-content-center">
                                <span class="material-symbols-outlined">stress_management </span> Annu.
                              </div>
                            </th>
                            <th scope="col">
                               <div class="d-flex align-content-center">
                                <span class="material-symbols-outlined">festival </span> Sara puja
                              </div>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!-- Baishakh 1  -->
                        <tr class="month_0">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-1" value="" id="admission-1">
                                    <label class="form-check-label" for="admission-1" style='padding-left:20px;'>
                                        Bai.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-1" value="" id="annual-1">
                                    <label class="form-check-label" for="annual-1" style='padding-left:20px;'>
                                    Bai.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="saraswati-1" value="" id="saraswati-1">
                                    <label class="form-check-label" for="saraswati-1" style='padding-left:20px;'>
                                    Bai.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Jestha 2  -->
                        <tr class="month_1">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-2" value="" id="admission-2">
                                    <label class="form-check-label" for="admission-2" style='padding-left:20px;'>
                                    Jes.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-2" value="" id="annual-2">
                                    <label class="form-check-label" for="annual-2" style='padding-left:20px;'>
                                    Jes.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-2">
                                    <label class="form-check-label" for="saraswati-2" style='padding-left:20px;'>
                                    Jes.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Ashadh 3  -->
                        <tr class="month_2">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-3" value="" id="admission-3">
                                    <label class="form-check-label" for="admission-3" style='padding-left:20px;'>
                                    Ash.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-3" value="" id="annual-3">
                                    <label class="form-check-label" for="annual-3" style='padding-left:20px;'>
                                    Ash.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-3">
                                    <label class="form-check-label" for="saraswati-3" style='padding-left:20px;'>
                                    Ash.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Shrawan 4  -->
                        <tr class="month_3">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-4" value="" id="admission-4">
                                    <label class="form-check-label" for="admission-4" style='padding-left:20px;'>
                                    Shr.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-4" value="" id="annual-4">
                                    <label class="form-check-label" for="annual-4" style='padding-left:20px;'>
                                    Shr.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-4">
                                    <label class="form-check-label" for="saraswati-4" style='padding-left:20px;'>
                                    Shr.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Bhadau 5  -->
                        <tr class="month_4">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-5" value="" id="admission-5">
                                    <label class="form-check-label" for="admission-5" style='padding-left:20px;'>
                                    Bha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-5" value="" id="annual-5">
                                    <label class="form-check-label" for="annual-5" style='padding-left:20px;'>
                                    Bha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-5">
                                    <label class="form-check-label" for="saraswati-5" style='padding-left:20px;'>
                                    Bha.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Asoj 6  -->
                        <tr class="month_5">
                        <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-6" value="" id="admission-6">
                                    <label class="form-check-label" for="admission-6" style='padding-left:20px;'>
                                    Aso.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-6" value="" id="annual-6">
                                    <label class="form-check-label" for="annual-6" style='padding-left:20px;'>
                                    Aso.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-6">
                                    <label class="form-check-label" for="saraswati-6" style='padding-left:20px;'>
                                    Aso.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Kartik 7  -->
                        <tr class="month_6">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-7" value="" id="admission-7">
                                    <label class="form-check-label" for="admission-7" style='padding-left:20px;'>
                                    Kar.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-7" value="" id="annual-7">
                                    <label class="form-check-label" for="annual-7" style='padding-left:20px;'>
                                    Kar.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-7">
                                    <label class="form-check-label" for="saraswati-7" style='padding-left:20px;'>
                                    Kar.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Mangsir 8  -->
                        <tr class="month_7">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-8" value="" id="admission-8">
                                    <label class="form-check-label" for="admission-8" style='padding-left:20px;'>
                                    Man.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-8" value="" id="annual-8">
                                    <label class="form-check-label" for="annual-8" style='padding-left:20px;'>
                                    Man.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-8">
                                    <label class="form-check-label" for="saraswati-8" style='padding-left:20px;'>
                                    Man.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Poush 9  -->
                        <tr class="month_8">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-9" value="" id="admission-9">
                                    <label class="form-check-label" for="admission-9" style='padding-left:20px;'>
                                    Pou.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-9" value="" id="annual-9">
                                    <label class="form-check-label" for="annual-9" style='padding-left:20px;'>
                                    Pou.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-9">
                                    <label class="form-check-label" for="saraswati-9" style='padding-left:20px;'>
                                    Pou.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Magh 10  -->
                        <tr class="month_9">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-10" value="" id="admission-10">
                                    <label class="form-check-label" for="admission-10" style='padding-left:20px;'>
                                    Mag.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="annual-10" value="" id="annual-10">
                                    <label class="form-check-label" for="annual-10" style='padding-left:20px;'>
                                    Mag.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-10">
                                    <label class="form-check-label" for="saraswati-10" style='padding-left:20px;'>
                                    Mag.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Falgun 11  -->
                        <tr class="month_10">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-11" value="" id="admission-11">
                                    <label class="form-check-label" for="admission-11" style='padding-left:20px;'>
                                    Fal.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="annual-11" id="annual-11">
                                    <label class="form-check-label" for="annual-11" style='padding-left:20px;'>
                                    Fal.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="saraswati-11">
                                    <label class="form-check-label" for="saraswati-11" style='padding-left:20px;'>
                                    Fal.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Chaitra 12  -->
                        <tr class="month_11">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="admission-12" value="" id="admission-12">
                                    <label class="form-check-label" for="admission-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="annual-12" id="annual-12">
                                    <label class="form-check-label" for="annual-12" style='padding-left:20px;'>
                                    Cha.
                                    </label>
                                </div>
                            </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="saraswati-12">
                                        <label class="form-check-label" for="saraswati-12" style='padding-left:20px;'>
                                        Cha.
                                        </label>
                                    </div>
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Tabs One Time Fee  -->

            <!-- Start Tabs Quarterlies Fee  -->
            <div class="tab-pane" id="tabs-3" role="tabpanel">
            <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col" style="width:150px !important">
                              <div class="d-flex align-content-center">
                                <span class="material-symbols-outlined">edit_document </span> Exam Fee	
                              </div>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!-- Baishakh 1  -->
                        <tr class="month_0">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-1" value="" id="exam-1">
                                    <label class="form-check-label" for="exam-1" style='padding-left:20px;'>
                                        Baishakh
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Jestha 2  -->
                        <tr class="month_1">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-2" value="" id="exam-2">
                                    <label class="form-check-label" for="exam-2" style='padding-left:20px;'>
                                    Jestha
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Ashadh 3  -->
                        <tr class="month_2">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-3" value="" id="exam-3">
                                    <label class="form-check-label" for="exam-3" style='padding-left:20px;'>
                                    Ashadh
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Shrawan 4  -->
                        <tr class="month_3">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-4" value="" id="exam-4">
                                    <label class="form-check-label" for="exam-4" style='padding-left:20px;'>
                                    Shrawan
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Bhadau 5  -->
                        <tr class="month_4">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-5" value="" id="exam-5">
                                    <label class="form-check-label" for="exam-5" style='padding-left:20px;'>
                                    Bhadau
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Asoj 6  -->
                        <tr class="month_5">
                        <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-6" value="" id="exam-6">
                                    <label class="form-check-label" for="exam-6" style='padding-left:20px;'>
                                    Asoj
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Kartik 7  -->
                        <tr class="month_6">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-7" value="" id="exam-7">
                                    <label class="form-check-label" for="exam-7" style='padding-left:20px;'>
                                    Kartik
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Mangsir 8  -->
                        <tr class="month_7">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-8" value="" id="exam-8">
                                    <label class="form-check-label" for="exam-8" style='padding-left:20px;'>
                                    Mangsir
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Poush 9  -->
                        <tr class="month_8">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-9" value="" id="exam-9">
                                    <label class="form-check-label" for="exam-9" style='padding-left:20px;'>
                                    Poush
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Magh 10  -->
                        <tr class="month_9">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-10" value="" id="exam-10">
                                    <label class="form-check-label" for="exam-10" style='padding-left:20px;'>
                                    Magh
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Falgun 11  -->
                        <tr class="month_10">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-11" value="" id="exam-11">
                                    <label class="form-check-label" for="exam-11" style='padding-left:20px;'>
                                    Falgun
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!-- Chaitra 12  -->
                        <tr class="month_11">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="exam-12" value="" id="exam-12">
                                    <label class="form-check-label" for="exam-12" style='padding-left:20px;'>
                                    Chaitra
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Tabs Quarterlies Fee  -->

        </div>
           

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close_joinmonths" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="join-month-save">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1 d-flex justify-content-between">
                    <div class="item-title">
                        <h3>Select Student</h3>
                    </div>
                    <div>
                         <div class="flex flex-column">
                            <button type="button" class="btn btn-secondary class_student" visitorbtn="btn" btnName="Class Student">Class Student</button>
                            <button type="button" class="btn btn-secondary student_id" visitorbtn="btn" btnName="Student Id">Student Id</button>
                         </div>
                    </div>
                </div>

                    <div class="row" id="class_student_row">
                        <div class="col-12-xxxl col-lg-5 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">

                            </select>
                        </div>

                        <div class="col-12-xxxl roll-box col-lg-5 col-12 form-group animate__animated">
                            <label>Select Student *</label>
                            <select name="period" class="select2 student-select" id="student-select">
                                <option value="">Please Select Student :</option>
                            </select>
                        </div>
 
                        <input type="hidden" id="student_id" value="0">
                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                            <br>
                            <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group animate__animated" style="height:50px">SEARCH</button>
                        </div>
                    </div>

                    <div class="row d-none" id="student_id_row">
                       <div class="col-xl-10 col-lg-10 col-12 form-group">
                            <label>Student Id *</label>
                            <input type="number" maxlength="20" required name="student_id" placeholder="Student Id" class="form-control student-id">
                        </div>
 
                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                            <br>
                            <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group" visitorbtn="btn" btnName="SEARCH" style="height:50px">SEARCH</button>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <div class="col-8-xxxl col-12">
    <div class="card height-auto">
    <div class="card-body px-3 px-md-5">
            <div class="item-title">
                <h3>Student Fee</h3>
                <div class="row px-4">

                    <div class="col-12 col-md-3 order-2 order-md-1">
                        <div class="p-3 mb-3 d-none invoice-box" style="width:100%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                            <div class="d-flex justify-content-between">
                               <div class="invoice-month" style="font-size: 13px;">up to <span id="selected-month">Asoj</span></div>
                        <div class="d-flex">
                               <button id="printInvoice" class="d-flex align-items-center" visitorbtn="btn" btnName="Print Invoice Bill" style="font-size:10px; border:none; outline:none; cursor:pointer;">invoice  
                                 <span class="material-symbols-outlined pl-2" style="font-size: 10px;">print</span>
                              </button>
                              <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="outline: 0% !important; background-color: #f0f0f0; border:none; border-radius:0% !important;">
                                    </button>

                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton" style="width:50px !important; outline:none;">
                                        <input class="check-box" type="checkbox" id="checkbox1" value="month_0">
                                        <label for="checkbox1"> Bai</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox2" value="month_1">
                                        <label for="checkbox2"> Jes</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox3" value="month_2">
                                        <label for="checkbox3"> Ash</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox4" value="month_3">
                                        <label for="checkbox4"> Shr</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox5" value="month_4">
                                        <label for="checkbox5"> Bha</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox6" value="month_5">
                                        <label for="checkbox6"> Aso</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox7" value="month_6">
                                        <label for="checkbox7"> Kar</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox8" value="month_7">
                                        <label for="checkbox8"> Man</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox9" value="month_8">
                                        <label for="checkbox9"> Pou</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox10" value="month_9">
                                        <label for="checkbox10"> Mag</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox11" value="month_10">
                                        <label for="checkbox11"> Fal</label><br>
                                        <input class="check-box" type="checkbox" id="checkbox12" value="month_11">
                                        <label for="checkbox12"> Cha</label><br>
                                    </div>
                               </div>
                         </div>
                            </div>
                            <div style="display:flex; justify-content: space-between; font-size:10px; margin-bottom:5px; border-bottom: 2px dashed black;">
                                <b>Total :</b>
                                <span style="margin-left:100px;" id="total_invoice">0</span>
                            </div>

                            <div class="prev_blan" style=" justify-content: space-between; font-size:10px; margin-bottom:5px; border-bottom: 2px inset black;">
                                <b>Prev. Bal. :</b>
                                <span style="margin-left:100px;" id="prev_blan">0</span>
                            </div>

                            <div class="prev_year" style="display:flex; justify-content: space-between; font-size:10px; margin-bottom:5px; border-bottom: 2px inset black;">
                                <b>Prev. Year :</b>
                                <span style="margin-left:100px;" id="prev_year">0</span>
                            </div>

                            <div style="display:flex; justify-content: space-between; font-size:10px; margin-bottom:5px; border-bottom: 2px double black;">
                                <b>Net Payable :</b>
                                <b style="margin-left:100px;" id="netpay">0</b>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-6 order-1 order-md-2 px-0 mb-2" style="height:125px;">
                      <div class="d-flex p-2 h-100 w-100" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <img src="http://bit.ly/3IUenmf" id="student_image" class="h-100">
                        <div class="p-3 w-100" style="position: relative;">
                            <h6 class="m-0 d-flex justify-content-between">
                                <b id="name">Student Name</b>
                                <div class="dropdown dropdown_menu d-none">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                    </a>
                                
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    
                                    <div class="dropdown-item d-flex align-items-center" id="joining-btn" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#JoiningMonths"  data-bs-toggle="tooltip" data-bs-placement="top" title="Joining Months">
                                        <span class="material-symbols-outlined pr-2">join</span>
                                        Joining
                                    </div>
                                    <a id="fee_exception" href="#" target="_blank" class="dropdown-item d-flex align-items-center" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Fee & Disc Exceptions">
                                        <span class="material-symbols-outlined pr-2">toll</span>
                                        Fee Exceptions
                                    </a>
                                    <a id="student_update_id" href="#" target="_blank" class="dropdown-item d-flex align-items-center" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Joining Months">
                                        <span class="material-symbols-outlined pr-2">person</span>
                                        Student Update
                                    </a>
                                    </div>
                                </div>
                            </h6>
                            <div class="w-100">
                                <div class="d-flex justify-content-between w-100">
                                <div>
                                    <span>Class:</span> 
                                    <span id="class"></span>
                                </div>
                                <div>
                                    <span>Roll:</span> 
                                    <span id="roll"></span>
                                </div>
                                <div class="d-none">
                                    <span id="hostel_outi"></span>
                                </div>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span>st_id :</span> 
                                        <span id="st_id"></span>
                                    </div>
                                    <div>
                                        <span>pr_id :</span> 
                                        <span id="pr_id"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-3 order-1 order-md-2 px-0 mb-2 d-none" id="exception-column">
                        <div class="p-3 mb-3 ml-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;height:125px; overflow-y: scroll;">
                             <b>Exceptions Student</b>
                             <div class="d-none free_fee_box" style="font-size: 13px;">
                                <b>Free Fee</b>
                                 <div id="free_fee_exception">

                                 </div>
                             </div>
                             <div class="d-none discount_fee_box" style="font-size: 12px;">
                                <b>Discount Fee</b>
                                 <div id="discount_fee_exception">

                                 </div>
                             </div>
                        </div>
                    </div>

                <div id="invoice-box" style="position:absolute; z-index:-1; background:white; width: 148mm; height: 250mm; border : 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">

                </div>

            </div>
            <div>
                <div class="w-100" style="overflow-x:scroll;">
                  <table class="table table-dark table-bordered text-center table-hover table-sm">
                    <thead>
                        <tr style="background-color: #000">
                            <th scope="col">SN:</th>
                            <th scope="col">Month</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Disc.</th>
                            <th scope="col">Dues</th>
                            <th scope="col">Status</th>
                            <th scope="col">Single Pay</th>
                            <th scope="col">Multi Pay</th>
                        </tr>
                    </thead>
                    <tbody class="last-year-payment-table">

                    </tbody>
                    <tbody class="payment-table" id="payment-table">

                    </tbody>
                    <tbody class="total-table" id="payment-table">
                        <tr style="background-color: #000">
                            <th scope="row" style="width:10px;">
                                <div class="d-flex">
                                    <span class="material-symbols-outlined arrow-backyear" id="down-year-arrow"  style="cursor: pointer">
                                        keyboard_arrow_up
                                    </span>
                                </div>
                            </th>
                            <th scope="row" style="width:10px;">Total</th>
                            <th scope="row" id="totalClassFee" style="width:10px;"></th>
                            <th scope="row" id="totalClassPay" style="width:10px;"></th>
                            <th scope="row" id="totalClassDis" style="width:10px;"></th>
                            
                            <th scope="row" id="totalClassDue" style="width:10px;"></th>
                            <th colspan="3">
                                 <div class="w-100 d-flex justify-content-end">
                                    <button class="bg-info take-multi-pay-0 text-light rounded p-2 px-4 d-none" id="take-multi-pay" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer">Multi Payment</button>
                                 </div>
                            </th>
                           </tr>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <form id="back_year_manage" class="p-2 w-100 text-light d-none" style="background-color: rgb(0, 0, 0); overflow:scroll;">
                        <div class="d-flex">
                            <div class="d-flex flex-column">
                               <span>Year</span>
                                <select name="year" style="height:34px;">
                                  <option value="2079">2079</option>
                                  <option value="2080">2080</option>
                                  <option value="2081">2081</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column">
                                <span>Class</span>
                                 <select name="class" style="height:34px;">
                                    <option value="PG">PG</option>
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
                                 </select>
                             </div>
                             <div class="d-flex flex-column" style="width:155px;">
                                <span>Total Fee</span>
                                <input type="number" value="0" name="total">
                            </div>
                            <div class="d-flex flex-column" style="width:155px;">
                                <span>Total Payment</span>
                                <input type="number" value="0" name="payment">
                            </div>
                            <div class="d-flex flex-column" style="width:155px;">
                                <span>Total Discount</span>
                                <input type="number" value="0" name="discount">
                            </div>
                            <div class="d-flex flex-column" style="width:155px;">
                                <span>Total Dues</span>
                                <input type="number" name="dues">
                            </div>
                            <div class="d-flex flex-column">
                                <span>.</span>
                                <input type="submit" class="px-4">
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Month Payment Table -->

    




    <!-- Start Bill Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center">
        <div class="modal-content" style="width: 149mm; background: #02142a;">
            <div class="modal-header">
            <h5 class="modal-title text-light" id="staticBackdropLabel">Student Bill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-0 d-flex justify-content-center" >
            
                    <div class="bill-box" id="my-element" style="background:white; width: 100%; height: 100%; border : 1px solid black; overflow: hidden;">
                        <div style="width: 100%; height: 100%; border : 2px solid black; overflow: hidden;box-sizing:-box;position: relative;">
                
                            <!-- Start Bill Header  -->
                            <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                                <div style="width:50%; height: 100%;border-radius: 0px 200px 200px 0px;float:left;">
                                <img  class="school_logo" src="#" style="height:50px; margin: 15px;border:1px solid #f0f1f3;">
                                </div>
                                <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                                    <h3 style="margin-top: 25px; color:#000;">INVOICE</h3>
                                </div>
                            </div>
                            <!-- End Bill Header  --> 
                
                            <!-- Start School Details Header   -->
                                <div style="width: 100%;">
                                    <center class="school_name" id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                                       School Name
                                    </center>
                                    <address>
                                    <center><strong style="margin: 10px;" class="school_address" id="school_address">address</strong></center>
                                    <center><strong style="margin: 10px;" class="estd_year" id="estd_year"></strong></center>
                                    <center><strong style="font-size: 13px;margin: 10px;" class="school_contact" id="school_contact"></strong></center>

                                    </address>
                                </div>
                            <!-- End School Details Header  -->
                
                            
                            <div style="border: 0px solid black; display: flex;">
                
                                <div style="height: 100px; width: 70%; border : 0px solid black; display: flex;">
                                <img src="#" id="bill-bg-image"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">

                                <div style="height:100%; display: flex; align-items: center; margin-left: 10px;">
                                    <img class="st_image" id="st_image" style="border: 3px solid black; padding: 3px;" src="https://www.pngkit.com/png/full/25-258694_cool-avatar-transparent-image-cool-boy-avatar.png" alt="student" width="80px;">
                                </div>
                                <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;">
                                    <span style="margin-bottom: 5px;margin-top: 5px;"><b>STUDENT</b></span>
                                    <div style="margin-bottom: 5px;"><b>Name:</b> <span class="st_name" id="st_name">name</span></div>
                                    <div style="margin-bottom: 5px;"><b>Class:</b> <span class="st_class" id="st_class">1ST</span> <span class="st_section" id="st_section"></span></div>
                                    <div style="margin-bottom: 5px;"><b>St_id:</b> <span class="bill_st_id" id="bill_st_id">0</span></div>
                                </div>
                                </div>
                    
                                <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display : flex; flex-direction : column; align-items: start;">
                                <div style="margin-bottom: 5px;"><b>Date:</b> <span class="bill-date"></span></div>
                                <div style="margin-bottom: 5px;"><b>Receipt No: </b><span class="bill_no" id="bill_no">0</span></div>
                                <div style="margin-bottom: 5px;"><b>Pan No: </b><span class="pan_no" id="pan_no">0</span></div>


                                
                                </div>
                            </div>
                            
                
                            <!-- Start Bill Content  -->
                            <div class="bill-content" style="padding: 0px;margin: 10px;">
                                <table style="border:1px solid black;font-family: arial, sans-serif;margin-top:15px;border-collapse: collapse;width: 100%;">
                                <tr style="border: 1px solid #000000;text-align: left;padding: 15px; color: #black;">
                                    <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">SN:</th>
                                    <th style="border-right: 1px solid #747373;padding: 8px;font-size:11px;">Particulars</th>
                                    <th style="-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Amount</th>
                                </tr>
                
                                
                                <div class="bill-particular-data" id="bill-particular-data"> 
                                    <tr class="particular_tr" id="particular_0" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_1" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_2" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_3" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_4" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_5" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_6" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_7" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_8" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                    <tr class="particular_tr" id="particular_9" style="width:100%;border: 1px solid #000000;text-align: left;padding: 15px;display:none;">
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">1</td>
                                        <td style="border: 1px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">Mojasd sadhsadgy</td>
                                        <td style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;">400</td>
                                    </tr>
                                </div>

                                
                                <div>
                                    <tr style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                    <td colspan="2" style="border: 1px solid #000000; font-size:13px;">
                                        <div style="width:100%; display:flex; align-items:center;">
                                            <div style="margin-bottom: 5px; padding-left:5px; margin-top:5px;width:80%;"><b>Payment Month :</b> <span id="bill_month">0</span></div>
                                            <b style="height:100%; width: 20%; display: flex; justify-content: end; padding-right:5px;">
                                                Total Fee :
                                            </b>
                                        </div>
                                    </td>
                                    <th class="bill-totalfee" colspan="1" style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-totalfee">Momtaj</th>
                                    </tr>

                                    <tr id="discount_tr" style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                    <td colspan="2" style="border: 0px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">
                                        <b style="height:100%; width: 100%; display: flex; justify-content: end; padding-right:10px;">
                                            Discount :
                                        </b>
                                    </td>
                                    <th colspan="1" style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-discount">0</th>
                                    </tr>

                                    <tr style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                    <td colspan="2" style="border: 0px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">
                                        <b style="height:100%; width: 100%; display: flex; justify-content: end; padding-right:10px;">
                                        Paid :
                                        </b>
                                    </td>
                                    <th colspan="1" style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-payment">0</th>
                                    </tr>
                                    <tr style="border: 0px solid #000000;text-align: left;padding: 15px;">
                                    <td colspan="2" style="border: 0px solid #000000;text-align: left;padding: 5px;padding-left: 15px;font-size:13px;">
                                        <b style="height:100%; width: 100%; display: flex; justify-content: end; padding-right:10px;">
                                            Dues :
                                        </b>
                                    </td>
                                    <th colspan="1" style="border: 1px solid #000000;text-align: center;padding: 5px;padding-left: 15px;font-size:13px;" id="bill-dues">0</th>
                                    </tr>
                                </div>

                                </table>

                            </div>
                            <!-- End Bill Content  -->

                
                            <div style="position: absolute;bottom:85px; right: 10px; border: 1px solid black; height: 40px;width: 35%;box-sizing:-box;">
                                
                            </div>
                            <div style="text-align: center; position: absolute;bottom:60px; right: 10px; border : 0px solid black; width: 35%;box-sizing:-box;">
                                Cashier Signature
                            </div>
                
                            <div style="position: absolute;bottom:0px; color:#000; border-top:1px solid black; height: 50px;width: 100%; display:flex; justify-content:center; align-items:center; ">
                                <span style="text-align:center;font-size:12px;">Thank you for your prompt payment. <br> Your support enables us to continue providing quality education.</span>
                            </div>
                
                
                        </div> 
                    </div>  

            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary px-5 p-4" id="bill-modal-cancle" data-dismiss="modal" style="font-size: 20px;">Cancle</button>
            <button type="button" class="btn btn-primary px-5 p-4" id="printBtn" style="font-size: 20px;">Bill Print</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Bill Modal -->

    

    
    <div class="card ui-tab-card w-100 py-0 my-0 d-none" id="payment-history">
    <div class="card-body shadow-none w-100 py-4 px-4">
        <div class="border-nav-tab">
            <ul class="nav nav-tabs-0" role="tablist" style="margin-bottom: 0px !important;">
                <li class="nav-item">
                    <a class="nav-link shadow-none active d-flex" id="history-btn" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">
                        Payment History
                        <span class="material-symbols-outlined mt-1 mx-2">history</span>
                    </a>
                </li>
                <li class="nav-item existing-parent" id="back-year-btn" st_id="#">
                    <a class="nav-link shadow-none d-flex" data-toggle="tab" href="#tab8" role="tab" aria-selected="false">
                        Back year Fee
                    </a>
                </li>
            </ul>
            <div class="tab-content py-1" style="overflow-x: scroll;">
                <div class="tab-pane fade" id="tab8" role="tabpanel">
                    <table class="table table-dark table-hover table-sm" >
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
                    <table class="table table-dark table-hover table-sm" >
                        <thead>
                            <tr style="background-color: #000; position:relative;">
                                <th scope="col">SN:</th>
                                <th scope="col">Month</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Dues</th>
                                <th scope="col">Date</th>
                                <th scope="col">Bill Print</th>

                              <button class="btn m-3" id="all_reset" st_id="#" style="font-size:15px; top:0px; right:0px; position:absolute;" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset all payment">
                                <span class="material-symbols-outlined" style="font-size:15px;margin-top:2px;">restart_alt</span> 
                              </button>

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
    
    
    <!-- Start Last Year Fee Details Modal -->
    <div class="modal fade" id="lastyearfeedetails" tabindex="-1" aria-labelledby="lastyearfeedetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content"  >
            <div class="modal-header">
            <h5 class="modal-title" id="lastyearfeedetailsLabel"><span id="last-year-model">2032</span> Payment History & Month Fee Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card ui-tab-card w-100 py-0 my-0">
                    <div class="card-body shadow-none w-100 py-4 px-4" >
                        <div class="border-nav-tab">
                            <ul class="nav nav-tabs-0 my-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link shadow-none active d-flex" data-toggle="tab" href="#tab10" role="tab" aria-selected="false">
                                        Payment History
                                        <span class="material-symbols-outlined mt-1 mx-2">history</span>
                                    </a>
                                </li>
                                <li class="nav-item existing-parent" st_id="#">
                                    <a class="nav-link shadow-none d-flex" data-toggle="tab" href="#tab11" role="tab" aria-selected="false">
                                        Month Fee
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-1">
                                <div class="tab-pane fade show active" id="tab10" role="tabpanel">
                                    <table class="table table-dark table-hover table-sm" >
                                        <thead>
                                            <tr style="background-color: #000">
                                                <th scope="col">SN:</th>
                                                <th scope="col">Pay Month</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Dues</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="last-year-history-table">
                        
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="tab-pane fade" id="tab11" role="tabpanel">

                                    <table class="table table-dark table-hover table-sm" >
                                        <thead>
                                            <tr style="background-color: #000">
                                                <th scope="col">SN:</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Dues</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Particular</th>
                                            </tr>
                                        </thead>
                                        <tbody class="year-fee-table">
                                
                                        </tbody>
                                    </table>
                
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary p-3 px-5" id="YearDetailscloseBtn" data-bs-dismiss="modals">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Last Year Fee Details Modal -->
 
 
<script>
    $(document).ready(function() {
    $('#printBtn').click(function() {
        var content = $('#my-element').html();
        var printWindow = window.open('', '', 'height=800,width=800');
        var left = (screen.width / 2) - (800 / 2);
        var top = (screen.height / 2) - (800 / 2);
        printWindow.moveTo(left, top);
        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        setTimeout(function() {
        printWindow.print();
        printWindow.close();
        $("#bill-modal-cancle").click();
        }, 500); // Delay of 0.5 second (1000 ms)
    });
    });


$(document).ready(function() {
   $(".option_menu").hover(function(){
     $(".option_menu_box").removeClass("d-none");
   });

      $(".option_menu_box").mouseout(function(){
       $(".option_menu_box").addClass("d-none");
   });
});


 

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Account_management/fee-payment.blade.php ENDPATH**/ ?>