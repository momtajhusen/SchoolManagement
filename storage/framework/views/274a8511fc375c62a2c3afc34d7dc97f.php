<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">

    <style>
      .revenu-box{
        background: rgb(92,175,205);
        background: linear-gradient(90deg, rgba(92,175,205,0.196516106442577) 0%, rgba(92,175,205,0.196516106442577) 100%);
        margin-bottom:10px;
        border-radius: 10px;
      }
      .expensive-box{
        background: rgb(220,76,93);
        background: linear-gradient(90deg, rgba(220,76,93,0.19931722689075626) 0%, rgba(220,76,93,0.20211834733893552) 100%);
        margin-bottom:10px;
        border-radius: 10px;
      }
      .profit-box{
        background: rgb(60,173,97);
        background: linear-gradient(90deg, rgba(60,173,97,0.20211834733893552) 0%, rgba(60,173,97,0.196516106442577) 100%);
        margin-bottom:10px;
        border-radius: 10px;
      }

      @import url(https://fonts.googleapis.com/css?family=Roboto);

      body {
        font-family: Roboto, sans-serif;
      }

      #chart {
        max-width: auto;
      }

    </style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <!-- ajax CheckClassFee -->
    <script src="<?php echo e(asset('../admin_lang/report/financial-overview.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


<div class="row d-flex align-items-center justify-content-between w-100 p-3 m-0 mb-3 border bg-light">
  <div class="col-12 col-md-6">
    <h4 class="m-0">Financial Overview</h4>
  </div>
  <div class="col-12 col-md-6">
    <div class="p-2 d-flex justify-content-md-end">
      <input type="text" class="text-center" id="expenses_start_date" style="width:100px;outline:none;">
      <span class="px-2">-</span>
      <input type="text" class="text-center currentDate" id="expenses_end_date" style="width:100px;outline:none;">
      <input type="submit" id="search-btn" value="Search">
    </div>
  </div>
</div>

    <div class="row m-0">



       <div class="col-12 col-md-7">
          <div class="row">
            <div class="col-12 col-md-4 p-1">
               <div class="w-100 border d-flex align-items-center p-4 revenu-box">
                  <img src="<?php echo e(asset('../admin_template_assets/img/revenue.png')); ?>" alt="Admin" style="width:40px ">
                  <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                      <span style="font-size:13px;">REVENUE</span>
                      <b class="revenue" style="color: #5cafcd;font-size:18px;">0</b>
                  </div>
               </div>
            </div>
            <div class="col-12 col-md-4 p-1">
              <div class="w-100 border d-flex align-items-center p-4 expensive-box">
                <img src="<?php echo e(asset('../admin_template_assets/img/expensive.png')); ?>" alt="Admin" style="width:40px ">
                <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                    <span style="font-size:13px;">EXPENSES</span>
                    <b class="expensive" style="color: #dc4c5d;font-size:18px;">0</b>
                </div>
             </div>
            </div>
            <div class="col-12 col-md-4 p-1">
              <div class="w-100 border d-flex align-items-center p-4 profit-box">
                <img src="<?php echo e(asset('../admin_template_assets/img/profit.png')); ?>" alt="Admin" style="width:40px ">
                <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                    <span style="font-size:13px;">NET PROFIT</span>
                    <b class="net-profit" style="color: #3cad61;font-size:18px;">0</b>
                </div>
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-4 p-1">
              <div class="w-100 border d-flex align-items-center p-4 expensive-box">
                <img src="<?php echo e(asset('../admin_template_assets/img/expensive.png')); ?>" alt="Admin" style="width:40px ">
                <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                    <span style="font-size:13px;">Staff Dues</span>
                    <b class="staff-dues" style="color: #dc4c5d;font-size:18px;">0</b>
                </div>
             </div>
            </div>
            <div class="col-12 col-md-4 p-1">
               <div class="w-100 border d-flex align-items-center p-4 revenu-box">
                  <img src="<?php echo e(asset('../admin_template_assets/img/revenue.png')); ?>" alt="Admin" style="width:40px ">
                  <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                      <span style="font-size:13px;">Wallet Balances</span>
                      <b class="wallet-balances" style="color: #5cafcd;font-size:18px;">0</b>
                  </div>
               </div>
            </div>
            <div class="col-12 col-md-4 p-1">
              <div class="w-100 border d-flex align-items-center p-4 profit-box">
                <img src="<?php echo e(asset('../admin_template_assets/img/profit.png')); ?>" alt="Admin" style="width:40px ">
                <div class="ml-2 d-flex flex-column" style="line-height:20px;">
                    <span style="font-size:13px;">Banks Balances</span>
                    <b class="bank-balances" style="color: #3cad61;font-size:18px;">0</b>
                </div>
             </div>
            </div>
          </div>


          <div class="d-flex flex-column bg-light mb-3">
            <span class="px-3">Current year chart overview</span>
            <div id="chart"  class="border w-100 ">

            </div>
          </div>


       </div>

       <div class="col-12 col-md-5">
         <div class="border bg-light p-2 py-4">
              <h5 class="my-0 text-center"> STATEMENT</h5>
              <h6 class="my-0 text-center"><span id="start-date-view">2080-01-01</span> - <span id="end-date-view">2080-10-15</span></h6>
              <div class="d-flex flex-column">      
                <table class="table  table-sm my-0">
                    <thead  >
                      <tr>
                        <th scope="col">Revenue</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody class="revenue-table" style="font-size:14px;">
                         
                    </tbody>
                  </table>
              </div>
 
              <div class="d-flex flex-column">      
                <table class="table table-sm my-0">
                    <thead>
                      <tr>
                        <th scope="col">Expenses</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody class="expensive-table" style="font-size:13px;">
                      <tr>
                        <td>Salaries And Wages</td>
                        <td>₹ 0</td>
                      </tr>
                      <tr>
                        <td>Rent utilities</td>
                        <td>₹ 0</td>
                      </tr>
                      <tr>
                        <td>Vehicle Maintenance</td>
                        <td>₹ 0</td>
                      </tr>
                      <tr>
                        <td>Vehicle Fule</td>
                        <td>₹ 0</td>
                      </tr>
                    </tbody>
                  </table>
              </div>

              <div class="d-flex flex-column">      
                <table class="table table-sm my-0">
                    <thead>
                      <tr>
                        <th scope="col">Net Profit</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody style="font-size:13px;">
                      <tr>
                        <td>Total Revenue</td>
                        <td>₹ <span class="revenue">30990</span></td>
                      </tr>
                      <tr>
                        <td>Total Expenses</td>
                        <td>₹ <span class="expensive">30990</span></td>
                      </tr>
                      <tr>
                        <td>Net Profit (Revenue - Expenses)</td>
                        <td>₹ <span class="net-profit">30990</span></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
         </div>
       </div>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Reports_Area/financialOverview.blade.php ENDPATH**/ ?>