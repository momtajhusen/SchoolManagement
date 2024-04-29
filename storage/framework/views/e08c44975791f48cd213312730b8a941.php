

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax generate_id_card -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-generate_id_card.js')); ?>?v=<?php echo e(time()); ?>"></script> 


    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>

    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Generate Student Id Card</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Generate Id Card</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Select Class Area Start Here -->
    <div class="row mb-5">
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title d-flex justify-content-between w-100">
                            <h3>Select Class</h3>  
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-5 col-12 form-group">
                                <label>Class *</label>
                                <select name="class" required class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;">
    
                                </select>
                            </div>
                            <div class="col-xl-5 col-lg-6 col-12 form-group">
                                <label>Section *</label>
                                <select class="select2 section-select" required name="section">
                                    <option value="">Please Select Section *</option>
                                </select>
                            </div>
                            <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                                    <br>
                                    <button class="fw-btn-fill btn-gradient-yellow btn search-btn" style="height:50px">SEARCH</button>
                                </div>
                        </div>
                        </div>
                        

                        <div class="print-section row d-none" id="print-section" style="padding-left:20px;padding-top:40px;width:1123px;height:797px;border:2px solid black; background-color:rgb(255, 255, 255);">

                            <div class="bill-box border m-3 bg-danger" id="my-element" style="color: white;background:white; margin-bottom:10px; padding-top:5px; width: 54mm; height: 85.6mm; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                                <div style="width: 100%; height: 100%;  position: relative; background-image: url('http://127.0.0.1:8000/storage/Idcard/id1.jpg'); background-size: 100% 100%;">
                                     <div class="student-details" style="padding-left:12px;width:100%; position: absolute;top:20%;">

                                        <center>
                                        <div style="border-radius:100px;overflow:hidden;width:80px;height:80px; border:3px solid #888; ">
                                           <img src="http://127.0.0.1:8000/storage/upload_assets/students/profile_1679571382.jpg" alt="">
                                        </div>
                                        </center>
                                        
                                        <div style="width:100%;text-align:center;">
                                           <span style="font-size:20px; font-weight:bold; ">Gulsad Husen 2</span> 
                                        </div>

                                        <div style="font-size:15px;">
                                            <span>Father :</span>
                                            <span>Momtaj Husen</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Class :</span>
                                            <span>1ST</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Address :</span>
                                            <span>Arang 8, Sirha</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Mobile :</span>
                                            <span>9815759505</span>
                                        </div>

                                     </div>
                                </div>
                            </div>

                            <div class="bill-box border m-3" id="my-element" style="color: white;background:white; margin-bottom:10px; padding-top:5px; width: 54mm; height: 85.6mm; border: 1px solid black;  padding: 0px; margin: 0px;overflow: hidden; ">
                                <div style="width: 100%; height: 100%;overflow: hidden;box-sizing: border-box;position: relative; background-image: url('http://127.0.0.1:8000/storage/Idcard/id1.jpg'); background-size:cover;">


                                     <div class="student-details" style="padding-left:12px;width:100%; position: absolute;top:20%;">

                                        <center>
                                        <div style="border-radius:100px;overflow:hidden;width:80px;height:80px; border:3px solid #888; ">
                                           <img src="http://127.0.0.1:8000/storage/upload_assets/students/profile_1679571382.jpg" alt="">
                                        </div>
                                        </center>
                                        
                                        <div style="width:100%;text-align:center;">
                                           <span style="font-size:20px; font-weight:bold; ">Gulsad Husen 3</span> 
                                        </div>

                                        <div style="font-size:15px;">
                                            <span>Father :</span>
                                            <span>Momtaj Husen</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Class :</span>
                                            <span>1ST</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Address :</span>
                                            <span>Arang 8, Sirha</span>
                                        </div>
                                        <div style="font-size:15px;">
                                            <span>Mobile :</span>
                                            <span>9815759505</span>
                                        </div>

                                     </div>
                                </div>
                            </div>
 

                        </div>


                        <button onclick="generatePDF()" class="btn-fill-lg bg-dark mt-2 btn-hover-bluedark pdf-download-btn d-none" style="width:250px;" id="printBtn">
                            
                            <span>Download PDF</span>
                            <span id="processing-percentage"></span>
                        </button>


                        <div class="d-flex justifuy-content-center align-items-center">


                              <div class="card-pagnation"></div>
    
                            <button class="btn-fill-lg bg-dark m-2 btn-hover-bluedark" id="btn-download" style="width:250px;">
                                
                                <span>Download Image</span>
                                <span id="processing-percentage"></span>
                            </button>

                        </div>


                        


                        
                        

                        
                </div>
            </div>
        </div>
    </div>
    <!-- Select Class Area End Here -->


    <script>

function generatePDF() {

  $(".pdf-download-btn").addClass("d-none");
  $(".progress-box").removeClass("d-none");

  // Create a new jsPDF instance with mm as the unit of measurement
  var doc = new jsPDF({
    unit: 'mm',
    format: [54, 85.6],
    orientation: 'portrait',
    dpi: 300
  });

  // Get all the elements with class name "bill-box"
  var elements = document.getElementsByClassName('bill-box');

  // Initialize the progress counter
  var progress = 0;

  // Start updating the processing percentage every 100 milliseconds
  var intervalId = setInterval(function() {
    var percentage = Math.round(progress / elements.length * 100);
    document.getElementById('progress-bar').innerHTML = percentage + '%';
    document.getElementById('progress-bar').style.width = percentage + '%';
  }, 100);

  // Loop through each element
  Array.prototype.forEach.call(elements, function(element, index) {
    // Use html2canvas to render the element as an image with a higher scale
    html2canvas(element, {
      scale: 4
    }).then(function(canvas) {

      // Get the data URL of the image and delete the variable to free up memory
      var imgData = canvas.toDataURL('image/jpeg', 0.8);
      canvas = null;

      // Add the image to the PDF with a higher DPI
      doc.addImage(imgData, 'JPEG', 0, 0, 54, 85.6);

      // If this is not the last element, add a new page to the PDF
      if (index < elements.length - 1) {
        doc.addPage();
      }

      // If this is the last element, save the PDF
      if (index == elements.length - 1) {
        var classes = $(".class-select").val();
        var section = $(".section-select").val();

        document.getElementById('progress-bar').innerHTML = '100 %';
        document.getElementById('progress-bar').style.width = '100 %';

        clearInterval(intervalId); // Stop updating the processing percentage
        doc.save(classes+"-"+section+'_IDCARD.pdf');

        // Free up memory used by the doc and imgData variables
        doc = null;
        imgData = null;

        setTimeout(() => {
            document.getElementById('progress-bar').innerHTML = '% 0';
            document.getElementById('progress-bar').style.width = '0 %';

            $(".pdf-download-btn").removeClass("d-none");
            $(".progress-box").addClass("d-none"); 
        }, 1000);

      }

      // Increment the progress counter
      progress++;
    });
  });
}

 

// select the id card div
var element = document.getElementById("print-section");

// add a click event listener to the download button
document.getElementById("btn-download").addEventListener("click", function() {
  // use html2canvas to convert the div to an image
  html2canvas(element, {
    width: 1123, // set the width to 1123
    height: 797, // set the height to 797
    backgroundColor: "#ffffff", // set a white background color
    scale: 5 // set the scale to 5 for higher resolution
  }).then(function(canvas) {

    // create a new canvas element with the desired size of 1123 x 797
    var newCanvas = document.createElement("canvas");
    newCanvas.width = 1123 * 5;
    newCanvas.height = 797 * 5;

    // draw the image from the original canvas onto the new canvas
    var ctx = newCanvas.getContext("2d");
    ctx.drawImage(canvas, 0, 0, 1123 * 5, 797 * 5);

    // create a link to download the image
    var link = document.createElement("a");
    link.download = "id-card.png";
    link.href = newCanvas.toDataURL();

    // click the link to start download
    link.click();
  });
});





// $(document).ready(function() {
//   // select the id card div
//   var element = $("#print-section-1");



//   // add a click event listener to the download button
//   document.getElementById("btn-download").addEventListener("click", function() {

//   console.log(element);

//     // use html2canvas to convert the div to an image
//     html2canvas(element[0], {
//       width: 1298, // set the width to 1298
//       height: 779, // set the height to 779
//       backgroundColor: "#ffffff", // set a white background color
//       scale: 5 // set the scale to 4 for higher resolution
//     }).then(function(canvas) {
//       // create a link to download the image
//       var link = document.createElement("a");
//       link.download = "id-card.png";
//       link.href = canvas.toDataURL();
//       // click the link to start download
//       link.click();
//     });
//   });
// });


















 






        
         
              </script>
    
 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Super_Admin/layouts/Student_Management/generate_id_card.blade.php ENDPATH**/ ?>