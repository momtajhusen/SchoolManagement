@extends('Admin_Page/Super_Admin/admin_template')

@section('script')

    <!-- ajax get all subject  -->
    <script src="{{ asset('../admin_lang/teacher/ajax-teacher-timetable.js')}}?v={{ time() }}"></script> 

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

@endsection

@section('contents')

<div class="card height-auto">
    <div class="card-body">
      <div style="overflow:scroll !important;" id="print-section">
        <div class="py-3 px-3 d-flex justify-content-between align-items-center bg-dark">
            <div>
            </div>
            <div class="py-3 d-flex align-items-center flex-column">
              <h4 class="m-0 text-light" style="font-size:25px;font-family: 'DM Serif Display', serif;">Teachers Time Table</h4>
              <div>
              </div>
            </div>
            <div></div>
        </div>
        <table class="table table-striped table-dark table-sm" id="time-table-view">
          <thead>
              <tr class="period-time">
                  <th>Teacher Name</th>
                  <th>Teacher Name</th>
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
    height: 1123, // A4 height in pixels (approximately 11.69 inches)
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



@endsection
