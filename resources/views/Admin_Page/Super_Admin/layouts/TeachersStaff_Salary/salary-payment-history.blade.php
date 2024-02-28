@extends('Admin_Page/Super_Admin/admin_template')

@section('style')

    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- Include SheetJS library for .xlsx export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

        <!-- ajax get all class -->
        <script src="{{ asset('../admin_lang/TeachersSalary/ajax-salaryPaymentHistory.js')}}?v={{ time() }}"></script> 
 


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

input{
  outline: none;
}
    </style>
@endsection


@section('script')
    <!-- ajax-salaryPayment -->
    <script src="{{ asset('../admin_lang/TeachersStaffSalary/ajax-salaryPaymentHistory.js')}}?v={{ time() }}"></script>\
 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>
@endsection

 


@section('contents')
<div class="p-3 border">
    <b>Salary Payment History</b> 
</div>
 <!-- Heaader  -->
 <div class="d-flex justify-content-end align-items-center">
    <span class="d-none">
      <div><b class="collection-day mr-2">Today</b></div>
      <span><b> ₹ </b><b class="total-collection"> 0</b></span>
    </span>
  <div>
    <div class="select-dropdown m-0 p-0 d-none" style="float: left;">
      <select class="select-colection bg-dark text-light">
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

    <div class="d-flex flex-column align-items-center bg-dark ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 17px; float: left">
      <span class="material-symbols-outlined text-light p-1 text-light">file_save</span>
      <span class="text-light" style="font-size: 8px;">xls</span>
    </div>


    <div class="d-flex flex-column align-items-center bg-dark ml-1" style="cursor:pointer;font-size: 17px; float: left">
      <span class="material-symbols-outlined text-light p-1 text-light">file_save</span>
      <span class="text-light" style="font-size: 8px;">csv</span>
    </div>

 </div>
</div>
  <!-- Body  -->
  <div class="border" style="height:400px; overflow-y: scroll;">

        <table class="table table-dark table-hover table-sm" id="payment-history-table">
            <thead>
            <tr>
                <th>SN.</th>
                <th>images</th>
                <th>Paid Months</th>
                <th>Teachers/Staff</th>
                <th>Paid Salary</th>
                <th>Paid Date</th>
            </tr>
            </thead>
            <tbody class="payment-history">
                
            </tbody>
        </table>



      

  </div>
 
<script>
$(document).ready(function() {
 
  // Bind the export function to the button click event
  $(".export-excell-btn").on("click", function() {
 

    // Clone the table to preserve the original data

    var btn = $(this).attr('btntable');
    if(btn == "month-wize"){
      var clonedTable = $("#payment-history-table").clone();
    }
    if(btn == "date-wize"){
      var clonedTable = $("#payment-history-date").clone();
    }
    
    // Check if jquery.table2excel.js is available
    if ($.fn.table2excel) {
      // If available, use the plugin to export the table to .xls
      clonedTable.table2excel({
        filename: "exported_table.xls", // Name of the exported file
        exclude: ".no-export", // Exclude elements with the class "no-export"
        exclude_img: true, // Exclude images
        exclude_links: true // Exclude links
      });

      // Manipulate the exported content to fix any skipped columns
      let exportContent = clonedTable.find('.no-export').text();
      let modifiedContent = fixSkippedColumns(exportContent);

      // Save the modified content as a blob
      let blob = new Blob([modifiedContent], { type: "application/vnd.ms-excel" });
      saveAs(blob, "Fee_Collection" + ".xls");
    } else {
      // If jquery.table2excel.js is not available, use Blob.js and FileSaver.js
      let html = clonedTable[0].outerHTML;
      let blob = new Blob([html], { type: "application/vnd.ms-excel" });
      saveAs(blob, "Salary_Payment_History" + ".xls");
    }
  });

  // Function to fix skipped columns in exported content
  function fixSkippedColumns(content) {
    // Perform any necessary modifications to the content here
    // For example, you can replace or adjust content as needed

    // Return the modified content
    return content;
  }
});



</script>
@endsection
