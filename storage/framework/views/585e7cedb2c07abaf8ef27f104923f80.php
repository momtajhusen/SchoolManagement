<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
        <!-- Common CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('../admin_lang/common/style.css')); ?>">

    <style>
      .a4-page {
        width: 210mm;
        height: 297mm;
        background-color: white;
      }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax CheckClassFee -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-CheckClassFee.js')); ?>"></script>
    <!-- ajax Payment -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-fee-payment.js')); ?>"></script>
    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>"></script> 
    
    <!-- ajax get class all roll for  roll-select-->
    <script src="<?php echo e(asset('../admin_lang/classes/get-class-roll.js')); ?>"></script> 


    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 
                    <!-- All Subjects Area Start Here -->
                    <div class="row">
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title d-flex justify-content-between w-100">
                                        <h3>Select Class</h3>  
                                        <div>
                                            <div class="col-6-xxxl col-lg-6 col-12 form-group d-flex" >
                                                <select name="period" class="select-year px-3 mr-2"  style="height:30px; ">
                        
                                                </select>
                                                <select name="period" class="start-month px-3 hide"  style="height:30px; ">
                                                    <option value="0" class="bg-dark text-light p-4">Baishakh</option>
                                                    
                                                </select>
                                                <span class="px-3">To</span>
                                                <select name="period" class="end-month px-3"  style="height:30px;">
                                                    <option value="0" class="bg-dark text-light p-4">Baishakh</option>
                                                    <option value="1" class="bg-dark text-light">Jestha</option>
                                                    <option value="2" class="bg-dark text-light">Ashadh</option>
                                                    <option value="3" class="bg-dark text-light">Shrawan</option>
                                                    <option value="4" class="bg-dark text-light">Bhadau</option>
                                                    <option value="5" class="bg-dark text-light">Asoj</option>
                                                    <option value="6" class="bg-dark text-light">Kartik</option>
                                                    <option value="7" class="bg-dark text-light">Mangsir</option>
                                                    <option value="8" class="bg-dark text-light">Poush</option>
                                                    <option value="9" class="bg-dark text-light">Magh</option>
                                                    <option value="10" class="bg-dark text-light">Falgun</option>
                                                    <option value="11" class="bg-dark text-light">Chaitra</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                               
                                    <div class="row">

                                        <div class="col-10-xxxl col-lg-5 col-12 form-group">
                                            <label>Select Class *</label>
                                            <select name="period" class="class-select select2" id="class-select"  style="height:50px;width:100%; padding:10px;">
                                            </select>
                                        </div>
                                        <div class="col-5-xxxl col-lg-5 col-12 form-group">
                                            <label>Roll No *</label>
                                            <select name="period" class="roll-select select2"  style="height:50px;width:100%; padding:10px;">

                                            </select>
                                        </div>
                                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                                               <br>
                                              <button class="fw-btn-fill btn-gradient-yellow btn search-btn" style="height:50px">SEARCH</button>
                                         </div>

                                        <div class="w-100 mx-4">
                                        <table class="table table-dark table-hover">
                                        <thead>
                                            
                                            <tr>
                                              <td colspan="9" scope="col">
                                                <center>
                                                    <sapn>CLASS :</span> <sapn class="preview-class"></span>
                                                </center>
                                                <center>
                                                   <div><b class="start-month-tex"></b> <span>TO</span> <b class="end-month-tex"></b></div>
                                                </center>
                                              </td>
                                            </tr>

                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Student</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Roll No</th>
                                                <th scope="col">Total Fees</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Previous Dues</th>
                                                
                                                <th scope="col">Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody class="class-table">
 
                                        </tbody>
                                        </table>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background:#042954;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            </div>
                                        
                                    <div class="modal-body">

                                        <div class="p-5" style="background:#f3b38f;">
                                        <table class="table" style=";width:90%;">
                                            <div class="mb-2" style="border-top:1px solid black;border-bottom:1px solid black;">
                                                <h3 class="my-3 p-0 m-0"><b>INVOICE</b></h3>
                                                <div class="name p-0 m-0 d-flex justify-content-between" style="text-size:5px;">
                                                    <div><span>Class: </span><span class="s_class">1ST</span></div>
                                                    <div><span>Roll: </span><span class="s_roll">1ST</span></div>
                                                </div>
                                                <div class="name p-0 m-0 d-flex justify-content-between" style="text-size:5px;">
                                                    <div><span>Name: </span><span class="s_name">Momtaj Husen</span></div>
                                                    <div><span>Date: </span><span>2079/01/11</span></div>
                                                </div>
                                            <div>
                                            <thead class="border-dark text-dark font-weight-bold">
                                                <tr>
                                                    <td class="border-dark" scope="col">Particulars</td>
                                                    <td class="border-dark" scope="col">Amount (Rs.)</td>
                                                </tr>
                                            </thead>
                                            <tbody class="fee_stracture">
                                                
                                                

                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td  colspan="1">Previous Dues +</td>
                                                    <td class="previous_dues">0</td>
                                                </tr>
                                                <tr>
                                                    <td  colspan="1">Already Pay -</td>
                                                    <td class="already_pay">0</td>
                                                </tr>
                                                <tr style="background-color: #dba382">
                                                    <td colspan="1">Total Fee :</td>
                                                    <td class="total_amount">0</td>
                                                </tr>
                                                <tr style="background-color: #dba382">
                                                    <td colspan="1">Discount :</td>
                                                    <td class="discount">0</td>
                                                </tr>
                                                <tr style="background-color: #dba382">
                                                    <td colspan="1">Payment :</td>
                                                    <td class="payment">0</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            </div>
                                             </div>
                                                <div class="p-2 d-flex">
                                                    <div class="w-50 form-group m-1">
                                                        <label class="text-light">Discount</label>
                                                        <input type="number" value="0" id="discount" name="discount" placeholder="Discount" class="form-control">
                                                    </div>
                                                    <div class="w-50 form-group m-1">
                                                        <label class="text-light">Payment</label>
                                                        <input type="number" name="payment" id="payment" placeholder="Payment" class="form-control payment">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary p-3 px-4 text-lg" id="payment-cancle" data-bs-dismiss="modal">Cancle</button>
                                                    <button type="button" class="btn btn-success p-3 px-4 text-lg payment-now">Pay Now</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
 

                                            <!-- <div class="col-12 form-group mg-t-8">
                                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                            </div> -->
                                        </div>
                              
                            </div>
                        </div>
                    </div>
            
                </div>
                <!-- All Subjects Area End Here -->

                



            
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Super_Admin/layouts/Account_management/check-class-fee.blade.php ENDPATH**/ ?>