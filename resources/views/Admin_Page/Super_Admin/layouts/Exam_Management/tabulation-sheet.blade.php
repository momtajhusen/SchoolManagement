@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
@endsection



@section('script')

    <!-- ajax Get All Exam Term -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script>

    <!-- ajax get exam tabulation sheet -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax-tabulation-sheet.js')}}?v={{ time() }}"></script> 

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <!-- Include jquery.table2excel.js if available (if not, use Blob.js and FileSaver.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-table2excel/1.0.3/jquery.table2excel.min.js"></script>

  <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/Blob.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

  <!-- Include SheetJS library for .xlsx export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<!-- use version 0.20.2 -->
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>

@endsection




 
@section('contents')

                <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Exam Tabulation Sheet</h3>
                                    </div>
                                </div>

                                <form class="mg-b-20 exam-tabulation-form">
                                    <div class="row gutters-8">
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Exam *</label>
                                            <select name="class" required class="select2 select-process-term" id="select_exam" style="height:45px;width:100%; padding:10px;">
    
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Class *</label>
                                            <select name="class" required class="select2 class-select" id="class-select" style="height:45px;width:100%; padding:10px;">
    
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Section *</label>
                                            <select name="class" required class="select2 section-select" style="height:45px;width:100%; padding:10px;">
    
                                        </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group d-flex align-items-end">
                                            <button type="submit" id="view-tablution-btn" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="View Tabulation Sheet">View Tabulation Sheet</button>
                                        </div>
                                    </div>
                                </form>
                        {{-- 
                                <div class="table-responsive d-none"  id="print-section">
                                    <table class="table display text-nowrap table-sm exportTable" id="myTable">
                                        <thead class="exam-tabulation-title">
                     
                                        </thead>
                                        <tbody class="exam-tabulation-table">
 
                                        </tbody>
                                    </table>
                                </div> --}}

                                {{-- Export Table  --}}
                                <div class="table-responsive"  id="print-section">
                                <table class="table table-sm text-nowrap table-bordered text-center table-responsive-md exportTable" id="myTable">
                                  <thead class="exam-tabulation-thead">

                                  </thead>
                                  <tbody class="exam-tabulation-body">
 
                                  </tbody>
                                </table>
                              </div>


                                <div class="d-flex align-items-end mt-2">
                                    <button id="btn-download" class="fw-btn-fill btn-gradient-yellow py-2 w-25" visitorbtn="btn" btnName="Print Tabulation Sheet">Print Tabulation Sheet</button>
                                    <button  id="export-button" class="fw-btn-fill btn-gradient-yellow py-2 w-25 mx-2" visitorbtn="btn" btnName="Export Excell">Export Excell</button>
                                </div>

  
                            </div>
                        </div>
                    </div>

                    <script>

// Select the id card div

// Add a click event listener to the download button
document.getElementById("btn-download").addEventListener("click", function() {
  var element = document.getElementById("print-section");
  var default_width = element.style.width;

  element.style.width = "1223px";

  // Use html2canvas to convert the div to an image
  html2canvas(element, {
    width: 1223, // A4 width in pixels (approximately 8.27 inches)
    height: 2823, // A4 height in pixels (approximately 11.69 inches)
    backgroundColor: "#ffffff", // Set a white background color
    scale: 1 // Set the scale to 1 for original size
  }).then(function(canvas) {
    // Create an image element with the captured image
    var img = new Image();
    img.src = canvas.toDataURL();

    // Create a new window to display the image
    var printWindow = window.open("", "", "width=800, height=600");
    printWindow.document.body.appendChild(img); // Append the image to the body of the new window

    element.style.width = default_width;

    // Wait for the image to load before triggering the print dialog after a delay of 3 seconds
    setTimeout(function() {
      printWindow.print();
      printWindow.close();
    }, 3000); // 3000 milliseconds = 3 seconds

  });
});


$(document).ready(function() {
        // Function to handle the export
        function exportToExcel() {
            var class_name = $("#class-select").val();
            var class_section = $(".section-select").val();

            // Select the table
            var table = document.getElementById("myTable");

            // Convert table to worksheet
            var ws = XLSX.utils.table_to_sheet(table);

            // Create a new workbook
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1"); // Add worksheet to workbook

            // Convert the workbook to an Excel file
            var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

            // Convert the binary string to a Blob
            var blob = new Blob([s2ab(wbout)], { type: "application/octet-stream" });

            // Trigger file download
            saveAs(blob, class_name + "_" + class_section + "_ExamTabulation.xlsx");
        }

        // Bind the export function to the button click event
        $("#export-button").on("click", function() {
            var class_name = $("#class-select").val();
            if (class_name === "") {
                alert("Please select a class");
                return false;
            }
            exportToExcel();
        });

        // Function to convert string to ArrayBuffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }
    });


</script>
@endsection
