


<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/TeachersAttendance/ajax-teachersAttendance.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
   <style>
    .presentColor{
      background-color:#93f56d;
    }
    .absentColor{
      background-color:#F5816d;
    }
   </style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('contents'); ?>

<div class="card height-auto">
    <div class="card-body">
      <div style="overflow:scroll !important;" id="print-section">
        <div class="px-3 d-flex justify-content-between align-items-center bg-dark" id="content-box"  style="width:100%;">



             <div class="d-flex">
                <div class="d-flex flex-column">
                  <span class="text-light">Attendance Date</span>
                  <div class="d-flex">
                      <input type="text" id="today-date" style="width:110px;text-align:center;border-radius:0px;border:0px;outline:none;">
                      <button class="btn attendance-date-btn" style="border-radius:0px;" id="attendance-date-btn">Search</button>
                  </div>
                </div>

                <div class="d-flex flex-column ml-1">
                  <label class="d-flex align-items-center m-0 text-light">All Teachers Attendance</label>
                  <select required class="all-teacher-attendance" style="cursor:pointer; padding:3px; outline:none;border-radius:5px;">
                      <option  value="">Select</option>
                      <option class="alert-success" value="1">Present</option>
                      <option class="alert-danger" value="0">Absent</option>
                  </select>
                </div>
             </div>



 
             <div class="d-flex flex-column align-items-center txt-light">
               <h4 class="m-0 text-light" style="font-size:25px;font-family: 'DM Serif Display', serif;">Take Teachers Attendance</h4>
               <b class="date-lable text-light">2080-8-29</b>
             </div>

              

              <span></span>


 
        </div>
        <table class="table table-striped table-dark mb-0" id="time-table-view">
          <thead>
              <tr class="period-time">
                  <th>SN</th>
                  <th>Images</th>
                  <th>Names</th>
                  <th>All Periods</th>
                  <th>Period Wize</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody class="time-attendance-table">
              <!-- daynamic period  -->
          </tbody>
        </table>
        <div class="bg-dark d-flex justify-content-end p-3" style="width:100%;">
          <button  class="save-all-btn btn px-5 py-3" style="cursor:pointer;">Save All</button>
        </div>

      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-attendance.blade.php ENDPATH**/ ?>