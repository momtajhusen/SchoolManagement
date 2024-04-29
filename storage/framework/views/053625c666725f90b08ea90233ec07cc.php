

<?php $__env->startSection('style'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

<?php $__env->startSection('contents'); ?>


<?php $__env->startSection('script'); ?>
    <!-- ajax set class subject -->
    <script src="<?php echo e(asset('../admin_lang/ClassTimeTable/ajax-print-time-table.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
 
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Class Time Table </h3>
            </div>
        </div>
        <form class="mg-b-20 search-form">
            <div class="row gutters-8">
                <div class="col-lg-7 col-12 form-group">
                        <select name="class" required class="select2 class-select" id="search-class" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                           <option value="">Select Class</option> 
                        </select>
                </div>
                <div class="col-lg-3 col-12 form-group">
                        <select name="section" required class="select2 section-select" id="search-section"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                             <option value="">Select Section</option>
                        </select>
                </div>
                <div class="col-lg-2 col-12 form-group">
                    <button type="submit" id="search-btn" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card height-auto">
    <div class="card-body">
      <div style="overflow:scroll !important;" id="print-section">
        <div class="py-3 px-3 d-flex justify-content-between align-items-center bg-dark">
            <div>
            </div>
            <div class="d-flex align-items-center flex-column">
              <h4 class="m-0 text-light" style="font-size:25px;font-family: 'DM Serif Display', serif;">Time Table</h4>
              <div>
                  <span class="m-0 text-light" style="">Class :</span>
                  <span class="m-0 text-light" id="time-table-class"></span>
              </div>
            </div>
            <div></div>
        </div>
        <table class="table table-striped table-dark" id="time-table-view">
          <thead>
              <tr class="period-time">
                  <!-- dynamic data from database -->
              </tr>
          </thead>
          <tbody class="time-table-view">
                  <!-- dynamic data from database -->
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end align-items-center mt-3" id="btn-download">
        <span class="bg-dark text-light p-2 px-5 d-flex justify-content-end align-items-center" id="printBtn" style="cursor:pointer;">Print 
        <span class="material-symbols-outlined pl-2">print</span></span>
      </div>
    </div>
</div>


<script>

// Select the id card div

// Add a click event listener to the download button
document.getElementById("btn-download").addEventListener("click", function() {
  var element = document.getElementById("print-section");
  var default_width = element.style.width;

  element.style.width = "1123px";

  // Use html2canvas to convert the div to an image
  html2canvas(element, {
    width: 1123, // A4 width in pixels (approximately 8.27 inches)
    height: 500, // A4 height in pixels (approximately 11.69 inches)
    backgroundColor: "#ffffff", // Set a white background color
    scale: 1 // Set the scale to 1 for original size
  }).then(function(canvas) {
    // Create an image element with the captured image
    var img = new Image();
    img.src = canvas.toDataURL();

    // Create a new window to display the image
    var printWindow = window.open("", "", "width=800, height=600");
    printWindow.document.open();
    printWindow.document.write("<img src='" + img.src + "' />");
    printWindow.document.close();

    element.style.width = default_width;

    // Wait for the image to load before triggering the print dialog
    img.onload = function() {
      printWindow.print();
      printWindow.close();
    };

  });
});



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/ClassTimeTable/print-time-table.blade.php ENDPATH**/ ?>