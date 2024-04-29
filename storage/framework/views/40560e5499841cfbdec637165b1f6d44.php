<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/TeachersAttendance/ajax-atendanceReport.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <!-- Include jquery.table2excel.js if available (if not, use Blob.js and FileSaver.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-table2excel/1.0.3/jquery.table2excel.min.js"></script>

  <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/Blob.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

  <!-- Include SheetJS library for .xlsx export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<div class="card height-auto">
    <div class="card-body" style="overflow: scroll">

      <div class="d-flex justify-content-between">
        <div class="d-flex mb-2">
          <select class="p-2" id="attendance-year" style="outline:none;border-radius:none;">
            <option value="2079">2079</option>
            <option value="2080">2080</option>
            <option value="2081">2081</option>
            <option value="2082">2082</option>
            <option value="2083">2083</option>
            <option value="2084">2084</option>
            <option value="2085">2085</option>
          </select>
          <select class="p-2" id="attendance-month" style="outline:none;border-radius:none;">
            <option value="1">Baishakh</option>
            <option value="2">Jestha</option>
            <option value="3">Ashadh</option>
            <option value="4">Shrawan</option>
            <option value="5">Bhadau</option>
            <option value="6">Asoj</option>
            <option value="7">Kartik</option>
            <option value="8">Mangsir</option>
            <option value="9">Poush</option>
            <option value="10">Magh</option>
            <option value="11">Falgun</option>
            <option value="12">Chaitra</option>
          </select>
          <select class="p-2" id="attendance-role" style="outline:none;border-radius:none;">
            <option value="Teachers">Teacher</option>
            <option value="Staffs">Staff</option>
          </select>
          <input class="search-btn" type="submit" value="Search" style="cursor: pointer">
          <input class="excell-export ml-2" type="submit" value="CSV Export" id="btnCsvExport" style="cursor: pointer">
        </div>

        <div>
          <b class="year-notice">2080</b>
          <b class="month-notice">SHRAWAN</b>
       </div>
       <span></span>
      </div>
      <table class="table table-bordered exportTable" style="width:100%">
        <thead>
          <tr class="th-day">
 
          </tr>
        </thead>
        <tbody class="attendance-table" style=" height:100px !important; overflow:scroll;">
 
        </tbody>
      </table>

    </div>
</div>

<script>
 
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-attendance-report.blade.php ENDPATH**/ ?>