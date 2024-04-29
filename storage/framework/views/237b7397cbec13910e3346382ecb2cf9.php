

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

.monthBox{
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    background:white;
    padding:8px;
    width:90%;
}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/report/fee-collection-report.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 

 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>


  <div class="row">
    <div class="col-12 col-md-7 pr-2">
        <b>Collection Months</b>
        <div class="row border pl-3" id="monthsBox">

            
        </div>
    </div>

    <div class="col-12 col-md-5 p-2">
        <div class="w-100 border p-3">

           <!-- Heaader  -->
           <div class="d-flex justify-content-between align-items-center ">
              <span class="d-flex flex-column">
                <div><b class="collection-day">Today</b> </div>
                <span><b>₹ </b><b class="total-collection"> 2323</b></span>
              </span>

              <div>
              <span class="d-flex flex-column mr-3" style="float: left;">
                <div><b class="invoice-day">Today</b></div>
                <span><b class="total-invoice"> 2323</b></span>
              </span>

              <div class="select-dropdown" style="float: left;">
                <select class="select-colection">
                    <option value="today">Today</option>
                    <option value="month">This Month</option>
                    <option value="1">Bai. Month</option>
                    <option value="2">Jes. Month</option>
                    <option value="3">Ash. Month</option>
                    <option value="4">Shr. Month</option>
                    <option value="5">Bha. Month</option>
                    <option value="6">Aso. Month</option>
                    <option value="7">Kar. Month</option>
                    <option value="8">Man. Month</option>
                    <option value="9">Pou. Month</option>
                    <option value="10">Mag. Month</option>
                    <option value="11">Fal. Month</option>
                    <option value="12">Cha. Month</option>
                    <option value="year">This Year</option>
                </select>
               </div>
              </div>

           </div>

           <!-- Body  -->
           <div class="w-100 border w-100" style="height:400px; overflow-y: scroll;">

                <table class="table table-dark table-hover table-sm">
                    <thead>
                    <tr style="background-color: #000;">
                        <th>SN.</th>
                        <th>st_id</th>
                        <th>Pay</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody class="payment-history">
                        
                    </tbody>

                </table>

           </div>

        </div>
    </div>
  </div>
 
 
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Reports_Area/fee-collection-reports.blade.php ENDPATH**/ ?>