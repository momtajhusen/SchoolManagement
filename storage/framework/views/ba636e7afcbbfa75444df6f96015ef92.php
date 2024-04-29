<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax-salaryPayment -->
    <script src="<?php echo e(asset('../admin_lang/TeachersStaffSalary/ajax-salaryPayment.js')); ?>?v=<?php echo e(time()); ?>"></script>\
    
    <!-- ajax-get-all-employee -->
    <script src="<?php echo e(asset('../admin_lang/Employee_Management/ajax-get-all-employee.js')); ?>?v=<?php echo e(time()); ?>"></script> 


    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<div class="card height-auto">
    <div class="card-body" style="overflow: scroll">
  
  <!-- Payment Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark text-light">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="exampleModalLongTitle">Salary Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
            <form class="payment-salary-form w-75">
                <div style="border-bottom:1px solid #888; height:80px;">
                    <div class="d-flex">
                         <img class="p-2" src="http://127.0.0.1:8000/storage/upload_assets/teachers/teacher_image_1697343466.jpg" alt="" style="height:80px; border:1px solid #888;">
                        <div class="px-2 d-flex flex-column">
                            <span class="d-flex">
                                <b>Teacher: </b>
                                <span class="px-2 teacher_name">Momtaj Husen</span>
                            </span>
                            <span class="d-flex">
                                <b>Salary: </b>
                                <span class="px-2 salary">12000</span>
                            </span>
                            <span class="d-flex">
                                <div>
                                    <b>Gen. Salary: </b>
                                    <span class="px-2 genSalary">11500</span>
                                </div>
                                <div class="ml-2">
                                    <b>Bonus: </b>
                                    <span class="px-2 bonus">11500</span>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <input type="hidden" required  maxlength="30" name="month" placeholder="month" class="form-control select2 salary-month">
                    <input type="hidden" required  maxlength="30" name="percent" placeholder="percent" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="periods" placeholder="periods" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="tr_id" placeholder="tr_id" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="salary" placeholder="Salary" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="generate_salary" placeholder="Generate Salary" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="bonus" placeholder="Bonus" class="form-control select2">
                    <input type="hidden" required  maxlength="30" name="epf" placeholder="EPF" class="form-control select2">

                    <div class="col-12 form-group">
                        <label>Net Pay</label>
                        <input type="text" readonly required  maxlength="30" name="net_pay" placeholder="Net Pay" class="form-control select2" style="background-color: #d4d2d2;">
                    </div>
                    <div class="col-12 form-group">
                        <label>Payment</label>
                        <input type="number" min="1" required  maxlength="30" name="payment" placeholder="Payment" class="form-control select2">
                    </div>
                    <div class="col-12 form-group">
                        <label>Payment Date</label>
                        <input type="text" required  maxlength="30" name="payment_date" placeholder="Payment" class="form-control select2 currentDate">
                    </div>
                    <div class="col-12 form-group">
                      <label>Payment Mode</label>
                      <select required name="pay_mode" class="select pay_mode border-0 p-2 w-100" style="height:45px;background:#f8f8f8;border-radius:5px;">
                          <option value="Cash">Cash</option>
                          <option value="Check">Check</option>
                          <option value="Online">Online</option>
                      </select>
                  </div>
                    <div class="col-12 form-group check_number d-none">
                      <label>Check Number</label>
                      <input type="text" maxlength="150" name="check_number" placeholder="check number" class="form-control">
                    </div>
                    <div class="col-12 form-group transaction_id d-none">
                      <label>Transaction id</label>
                      <input type="text"  maxlength="150" name="transaction_id" placeholder="transaction id" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                      <label>Remark</label>
                      <input type="text" maxlength="150" name="remark" placeholder="comment" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                      <button type="submit" id="payment-salary" class="btn btn-primary mb-1 p-3 px-4 w-100" style="font-size:15px;">Payment</button>
                      <button type="button" class="btn btn-secondary p-3 px-4 w-100" style="font-size:15px;" data-dismiss="modal">Cancle</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer" style="font-size: 20px;">
          <button type="button" class="btn btn-secondary p-3 px-4" data-dismiss="modal">Cancle</button>
          <br>
        </div>
      </div>
    </div>
  </div>

  <!-- History Modal -->
  <div class="modal fade" id="salaryHistory" tabindex="-1" role="dialog" aria-labelledby="salaryHistoryTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark text-light" style="width: 800px;">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="exampleModalLongTitle">Salary Paid History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center flex-column" style="overflow: scroll">
          <table class="table table-dark table-hover" style="position: relative; width:800px;">
            <thead>
                <tr style="background-color: #000">
                    <th scope="col">No:</th>
                    <th scope="col">Paid Date</th>
                    <th scope="col">Salary Month</th>
                    <th scope="col">Paid</th>
                    <th scope="col">Remaining</th>
                    <th scope="col">Print Slip</th>
                    <th scope="col">Reset</th>
                </tr>
            </thead>
            <tbody class="history-table">
        
            </tbody>
          </table>
        </div>
        <div class="modal-footer" style="font-size: 20px;">
          <button type="button" class="btn btn-secondary p-3 px-4" data-dismiss="modal">Cancle</button>
          <br>
        </div>
      </div>
    </div>
  </div>

  <!-- Years & Months Selects -->
  <div class="d-flex justify-content-between">
    <div class="d-flex mb-2">
      <select class="p-2 salary-year" id="attendance-year" style="outline:none;border-radius:none;">
        <option value="2079">2079</option>
        <option value="2080">2080</option>
        <option value="2081">2081</option>
        <option value="2082">2082</option>
        <option value="2083">2083</option>
        <option value="2084">2084</option>
        <option value="2085">2085</option>
      </select>
      <select name="teacher" required class="select all-employee teacher-select">
 
      </select>
      <input class="search-btn" type="submit" value="Search" style="cursor: pointer;">
    </div>


    <span></span>
  </div>

  <table class="table table-dark table-hover" style="position: relative; width:1200px;">
    <div class="border d-flex justify-content-between  align-items-cenetr p-3 bg-dark text-light" style="width:1200px;">
        <div class="d-flex align-items-start">
           <img class="border mr-2" id="teacher-image" src="<?php echo e(asset('storage/CommonImg/employee.jpg')); ?>" alt="" style="height:50px;width:50px;">
          <div>
            <div class="d-flex">
              <span>Name : </span>
              <span id="teacher_name"></span>
            </div>
            <div class="d-flex">
              <span>Role : </span>
              <span id="teacher_role"></span>
              <span id="teacher_id" class="ml-3"></span>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center flex-column">
            <div>
                <b class="year-notice">2080</b>
            </div>
            <b>Teachers Salary Payment</b>
        </div>
        <div></div>
    </div>
    <thead>
        <tr style="background-color: #000">
            <th scope="col">SN.</th>
            <th scope="col">Months</th>
            <th scope="col">Attendance</th>
            <th scope="col">Salary</th>
            <th scope="col">Gen. Salary</th>
            <th scope="col">Bonus</th>
            <th scope="col">SSF</th>
            <th scope="col">Net Pay</th>
            <th scope="col">Paid</th>
            <th scope="col">Remaining</th>
            <th scope="col">Status</th>
            <th scope="col">Payment</th>
            <th scope="col">History</th>
        </tr>
    </thead>
    <tbody class="salary-table">

    </tbody>
    <tbody class="payment-table" id="payment-table">

    </tbody>
  </table>

       
       <div class="d-none" id="slip-box" style="width:800px; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
        <img src="3"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
       
         <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
            <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
               <img id="school_logo" src="#" style="height:50px; margin: 15px;border:1px solid #f0f1f3;">
             </div>
             <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                 <h3 style="margin-top: 20px; font-weight: bolder;">Salary Slip</h3>
             </div>
         </div>
        
             <div style="width: 100%;">
                 <center id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                  Gurukul
                 </center>
                 <address>
                 <center><strong style="margin: 10px;" id="school_address">address</strong></center>
                 <center><strong style="margin: 20px;" id="estd_year">Estd</strong></center>
                 <center><strong style="font-size: 13px;margin: 10px;" id="school_contact">phone</strong></center>
                 </address>
             </div>
        

           <div style="border: 0px solid black; display: flex; margin: 10px;">

             <div style="height: 100px; width: 70%; border: 0px solid black; display: flex;">
               <div style="height:100%; align-items: center; margin-left: 10px;">
                   <img id="tr_image" style="border: 3px solid black; padding: 3px;" src="#" alt="teacher" width="80px;">
               </div>
               <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;">
                   <span style="margin-bottom: 5px;margin-top: 5px;"><b>EMPLOYEE</b></span>
                   <div style="margin-bottom: 5px;"><b>Name:</b> <span id="tr_name">studen_name</span></div>
                   <div style="margin-bottom: 5px;"><b>Role:</b> <span id="tr_role">studen_name</span></div>
                   <div style="margin-bottom: 5px;"><b>Salary Month:</b> <span id="salary_month"></span></div>
               </div>
             </div>
   
             <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display: flex; flex-direction: column; align-items: start;">
               <div style="margin-bottom: 5px;"><b>Pay Date:</b> <span id="bill-date"></span></div>
               <div style="margin-bottom: 5px;"><b>Slip No:</b> <span id="slip_no"></span></div>
               <div style="margin-bottom: 5px;"><b>Pan No:</b> <span id="pan_no"></span></div>
             </div>
           </div>
      
          
             <div class="bill-content" style="padding: 0px;margin: 10px;">
             

             <center>
                 <div style="width:330px; margin-left:12px; margin-top:20px;">
                 
                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px dashed black;">
                         <b>Salary :</b>
                         <span class="Billsalary" style="margin-left:100px;">0</span>
                     </div>

                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                      <b>Attentance :</b>
                      <b class="BillAttendance" style="margin-left:100px;">0</b>
                     </div>

                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                      <b>Generate Salary :</b>
                      <b class="BillGenSalary" style="margin-left:100px;">0</b>
                     </div>

                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                         <b>Bonus :</b>
                         <b class="BillBonus" style="margin-left:100px;">0</b>
                     </div>

                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                      <b>SSF :</b>
                      <b class="BillEpf" style="margin-left:100px;">0</b>
                     </div>

                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                      <b>Net Salary :</b>
                      <b class="BillReciveSalary" style="margin-left:100px;">0</b>
                     </div>
                     <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                      <b>Remaining :</b>
                      <b class="BillRemaining" style="margin-left:100px;">0</b>
                     </div>
                 </div>
             </center>


             

         </div>
    




         


       </div>

</div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/salary-payment.blade.php ENDPATH**/ ?>