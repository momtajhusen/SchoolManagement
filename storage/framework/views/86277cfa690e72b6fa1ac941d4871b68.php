

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
      <!-- ajax CheckClassFee -->
      <script src="<?php echo e(asset('../admin_lang/report/expense-reports.js')); ?>?v=<?php echo e(time()); ?>"></script>

          <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<div class="row">
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <h4>Expense Reports</h4>

               <div class="row gutters-8">
                <div class="col-lg-3 col-12 form-group">
                    <label>Select from date*</label>
                    <input type="text" required maxlength="10" name="expenses_start_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker expenses_start_date">
                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>

                <div class="col-lg-3 col-12 form-group">
                  <label>Select to date*</label>
                  <input type="text" required maxlength="10" name="expenses_end_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker expenses_end_date">
                  <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                  <label>Select Expenditure</label>
                  <select name="student_gender" required class="select2">
                      <option value="all">All</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Others">Others</option>
                  </select>
              </div>

                <div class="col-lg-2 col-12 form-group">
                    <br>
                    <button class="fw-btn-fill btn-gradient-yellow" id="search-btn">SEARCH</button>
                </div>
            </div>

                <table class="table table-bordered">
                    <div><b>Total Expense: </b><b class="total-expense">0</b></div>
                    <thead>
                      <tr>
                        <th scope="col">NO.</th>
                        <th scope="col">Expenditure</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody class="expense-report-table">

                    </tbody>
                    <tbody class="expense-total-report">
                      <tr>
                        <td colspan="2"><b>Total Expense:</b></td>
                        <td><b class="total-expense">0</b></td>
                        </tr>
                    </tbody>
                  </table>
           
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Reports_Area/expense_reports.blade.php ENDPATH**/ ?>