

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <style>
       .class-box{
          width: 100%;
          /* height:100px; */
          border: 5px solid rgb(146, 141, 141);
          /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
          background: #ADA996;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

       }

       .total-box{
            background: #ADA996;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 5px solid rgb(146, 141, 141);
            /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
            font-family: 'Russo One', sans-serif;
       }

       .dropdone-selecter{
            background: #ADA996;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 5px solid rgb(146, 141, 141);
       }
       .month-option-box{
         border: 5px solid rgb(146, 141, 141);
         border-top: 0;


       }

       .my-font{
          font-family: 'Russo One', sans-serif;
       }


       .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button 
        {
          -webkit-appearance: none;
          margin: 0;
        }

.checkbox
{
    /* background: linear-gradient(to bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%); */
    width: 28px;
    height: 28px;
    box-shadow: inset 0px 1px 1px #fff, 0px 1px 3px rgba(0, 0, 0, 0.5);
    margin: 0 auto;
    position: relative;
    color: #b1afac;
    background-color: #9c9a97;

}
.checkbox label{
    background: linear-gradient(to bottom, #222222 0%, #45484d 100%);
    width: 20px;
    height: 20px;
    box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px #fff;
    position: absolute;
    top: 4px;
    left: 4px;
    cursor: pointer;

}
.checkbox label:after{
    content: "";
    height: 7.5px;
    width: 13px;
    border-left: 3px solid #fff;
    border-bottom: 3px solid #fff;
    transform: rotate(-45deg);
    position: absolute;
    top: 4px;
    left: 3px;
    opacity: 0;
}
.checkbox input[type="checkbox"]:checked+label:after{ opacity: 1; }
.checkbox input[type=checkbox]{
    margin: 0;
    visibility: hidden;
    left: 7px;
    top: 7px;
}
@media only screen and (max-width:767px){
    .checkbox{ margin: 0 0 20px; }
}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 
    <!-- ajax dues list  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-all-class-fee.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 

    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 row d-flex justify-content-between align-items-center">
                        <div class="item-title col-12 col-lg-6">
                            <h3>Class Fee</h3>
                        </div>
                   
                        <div class="col-12 col-lg-6 d-flex mt-lg-0 mt-3  justify-content-end">
                        <div class="border position-relative" style="width:215px;">
                            <div class="dropdone-selecter p-2 px-3 d-flex align-items-center position-relative" id="dropdone-selecter" style="cursor: pointer;">
                                <span id="selected-month" style="user-select: none;">Baishah to Sharwan</span>
                                <span class="material-symbols-outlined">arrow_drop_down</span>
                            </div>
        
                            <div class="position-absolute d-none month-option-box bg-dark text-light p-3 flex-column" style="z-index:100;left:0px;bottom:-450px;height:450px;width:100%;">
                                <div class="my-font position-absolute">
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box bg-danger" id="checkbox1" value="month_0">
                                        <label for="checkbox1"></label>
                                        <span style="margin-left:20px;">Baishakh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox2" value="month_1">
                                        <label for="checkbox2"></label>
                                        <span style="margin-left:20px;">Jestha</span>
                                    </div> 
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox3" value="month_2">
                                        <label for="checkbox3"></label>
                                        <span style="margin-left:20px;">Ashadh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox4" value="month_3">
                                        <label for="checkbox4"></label>
                                        <span style="margin-left:20px;">Shrawan</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox5" value="month_4">
                                        <label for="checkbox5"></label>
                                        <span style="margin-left:20px;">Bhadau</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox6" value="month_5">
                                        <label for="checkbox6"></label>
                                        <span style="margin-left:20px;">Asoj</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox7" value="month_6">
                                        <label for="checkbox7"></label>
                                        <span style="margin-left:20px;">Kartik</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox8" value="month_7">
                                        <label for="checkbox8"></label>
                                        <span style="margin-left:20px;">Mangsir</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox9" value="month_8">
                                        <label for="checkbox9"></label>
                                        <span style="margin-left:20px;">Poush</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox10" value="month_9">
                                        <label for="checkbox10"></label>
                                        <span style="margin-left:20px;">Magh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox11" value="month_10">
                                        <label for="checkbox11"></label>
                                        <span style="margin-left:20px;">Falgun</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2" style="">
                                        <input type="checkbox" class="check-box" id="checkbox12" value="month_11">
                                        <label for="checkbox12"></label>
                                        <span style="margin-left:20px;">Chaitra</span>
                                    </div>
                                </div> 
                                <div class="w-100 done d-flex justify-content-start pl-3 text-center position-absolute" style="left:0;bottom:8px;">
                                    <div id="search-btn" style="width:95%;border:2px solid #4d4b47;color:#9c9a97;cursor: pointer;"> Done </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>

                    <div class="w-100 mp-0 total-box d-flex flex-column mt-4">
                        <div class="w-100 p-3 d-flex justify-content-center" id="show-month">0000000</div>
                        <div class="row">
                            <div class=" py-3 col-12 col-lg-1"></div>
                            <div class="py-3 col-12 col-lg-2">
                                <div class="d-flex flex-column align-items-center">
                                    <span>Total Student</span>
                                    <span class="total-student">0</span>
                                 </div>
                            </div>
                            <div class="py-3 col-12 col-lg-2">
                                <div class="d-flex flex-column align-items-center">
                                    <span>Total Fee</span>
                                    <span class="total-fee">0</span>
                                 </div>
                            </div>
                            <div class="py-3 col-12 col-lg-2">
                                 <div class="d-flex flex-column align-items-center">
                                    <span>Total Payment</span>
                                    <span class="total-payment">0</span>
                                 </div>
                            </div>
                            <div class="py-3 col-12 col-lg-2">
                                <div class="d-flex flex-column align-items-center">
                                    <span>Total Discount</span>
                                    <span class="total-discount">0</span>
                                 </div>
                            </div>
                            <div class=" py-3 col-12 col-lg-2">
                                <div class="d-flex flex-column align-items-center">
                                    <span>Total Dues</span>
                                    <span class="total-dues">0</span>
                                 </div>
                            </div>
                            <div class=" py-3 col-12 col-lg-1"></div>
                            
                      </div>
                    </div>

                    <div class="class-container w-100 px-0 mx-0 row py-4 d-none">


                    </div>
                    <div class="table-responsive">
    <table class="table display data-table text-nowrap" id="myTable">
      <thead>
        <tr>
          <th>Class</th>
          <th>Section</th>
          <th>Total Fee</th>
          <th>Payment</th>
          <th>Discount</th>
          <th>Free</th>
          <th>Dues</th>
        </tr>
      </thead>
      <tbody class="class-fee-table">
 
      </tbody>
      <tbody class="total-row d-none">
        <tr>
          <th colspan="4"><center>Total</center></th>
          <th class="totalfee">0</th>
          <th class="totalpayment">0</th>
          <th class="totaldiscount">0</th>
          <th class="totalfreefee">0</th>
          <th class="totaldues">0</th>
          <th class="prevyeardues">0</th>
        </tr>
      </tbody>
    </table>
  </div>

                    

                </div>
            </div>
        </div>
    </div>
    <!-- All Subjects Area End Here -->


    <script>


    </script>

 
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\Gurukul_School\resources\views/Admin_Page/Super_Admin/layouts/Account_management/all-class-fee.blade.php ENDPATH**/ ?>