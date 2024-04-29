

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

      <!-- Include jquery.table2excel.js if available (if not, use Blob.js and FileSaver.js) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-table2excel/1.0.3/jquery.table2excel.min.js"></script>

<!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/Blob.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

  <!-- Include SheetJS library for .xlsx export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


    <style>
.select-dropdown {
	position: relative;
	background-color: #E6E6E6;
	border-radius: 4px;
}
.select-dropdown select {
	font-size: 12px;
	font-weight: normal;
	max-width: 100%;
	padding: 8px 24px 8px 10px;
	border: none;
	background-color: transparent;
		-webkit-appearance: none;
		-moz-appearance: none;
	appearance: none;
}
.select-dropdown select:active, .select-dropdown select:focus {
	outline: none;
	box-shadow: none;
}
.select-dropdown:after {
	content: "";
	position: absolute;
	top: 50%;
	right: 8px;
	width: 0;
	height: 0;
	margin-top: -2px;
	border-top: 5px solid #aaa;
	border-right: 5px solid transparent;
	border-left: 5px solid transparent;
}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/report/fee-collection-report.js')); ?>?v=<?php echo e(time()); ?>"></script> 

 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


  <div class="row">
    <div class="col-12 col-md-6 p-2">
        <div class="w-100 border p-3">

            <!-- Heaader  -->
           <div class="d-flex justify-content-between align-items-center ">
              <span class="d-flex flex-column">
                <b>Today Collection</b>
                <span><b>₹ </b><b class="total-collection"> 2323</b></span>
              </span>
              
              <div  >
              <span class="d-flex flex-column mr-3" style="float: left;">
                <b>Today Invioce</b>
                <span><b class="total-invoice"> 2323</b></span>
              </span>

              <div class="select-dropdown" style="float: left;">
                <select class="select-colection">
                    <option value="today">Today</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
               </div>
              </div>

           </div>

           <!-- Body  -->
           <div class="w-100 border w-100" style="height:400px; overflow-y: scroll;">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Pay Month</th>
                        <th>Pay</th>
                        <th>Disc</th>
                        <th>Free</th>
                        <th>Date</th>
                        <th>Cls Year</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody class="payment-history">
                        
                    </tbody>

                </table>

           </div>

        </div>
    </div>
    
    <div class="col-12 col-md-6 p-2">
        <div class="w-100 border p-2">
sadsad
        </div>
    </div>

  </div>
 
 
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Reports_Area/fee-collection-reports.blade.php ENDPATH**/ ?>