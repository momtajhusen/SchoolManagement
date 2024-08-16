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

       {{-- Sorting Script  --}}
   <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>
 

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
 

    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/Accounts/Report_Area/fee-collection-report.js')}}?v={{ time() }}"></script> 
 

 
@endsection


@section('contents')

  <div class="row">
    <div class="col-12 p-2">
      <div class="w-100 border p-3">

       {{-- Tabs Buttons  --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-links active" id="datewize-tab" data-toggle="tab" data-target="#datewize" type="button" role="tab" aria-controls="datewize" aria-selected="false">From Date</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-links" id="studentwize-tab" data-toggle="tab" data-target="#studentwize" type="button" role="tab" aria-controls="studentwize" aria-selected="false">From Student ID</button>
          </li>
        </ul>

        {{-- Tabs Contents  --}}
        <div class="tab-content" id="myTabContent">

 
            {{-- Date Wize  --}}
            <div class="tab-pane fade show active" id="datewize" role="tabpanel" aria-labelledby="datewize-tab">

              {{-- date input  --}}
              <div class="d-flex justify-content-between align-items-center">
                <div class="row m-0">
                  <div class="col-5 p-0">
                    <input type="text" class="currentDate w-100 from-date dateinput" placeholder="from date">
                  </div>
                  <div class="col-5 p-0">
                    <input type="text" class="currentDate w-100 to-date dateinput" placeholder="to date">
                  </div>
                  <div class="col-2 p-0">
                    <button type="btn" id="searchDate" class="w-100">search</button>
                  </div>
                </div>
              </div>

              <!-- Heaader  -->
              <div class="d-flex justify-content-between align-items-center ">
                <span class="d-flex">
                  <div><b class="mr-2">Collection</b></div>
                  <span><b> ₹ </b><b class="collection"> 0</b></span>
                </span>
                <div class="d-flex">
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
                  <span class="material-symbols-outlined border p-1 bg-dark text-light export-excell-btn" btntable="date-wize" style="cursor:pointer;">file_save</span>
                </div>
              </div>
              <!-- Body  -->
              <div class="border" style="height:375px; overflow-y: scroll;">
                <table class="table table-dark table-bordered table-hover table-sm table-responsive-md sortable-table" id="payment-history-date">
                    <thead>
                      <tr>
                        <th nowrap="nowrap" data-column="0">SN.</th>
                        <th nowrap="nowrap" data-column="1">Paid</th>
                        <th nowrap="nowrap" data-column="4">Students Name</th>
                        <th nowrap="nowrap" data-column="5">Parents</th>
                        <th nowrap="nowrap" data-column="7">Pr_Id</th>
                        <th nowrap="nowrap" data-column="7">Date</th>
                        <th nowrap="nowrap" data-column="7">Time</th>
                    </tr>
                    </thead>
                    <tbody class="payment-history-date sortable-bordy">
                        
                    </tbody>

                </table>
              </div>
            </div>

            {{-- Student Wize  --}}
            <div class="tab-pane fade" id="studentwize" role="tabpanel" aria-labelledby="studentwize-tab">
              {{-- date input  --}}
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex m-0">
                      <input type="number" class="w-100 parents-id" placeholder="Enter pr_id">
                      <input type="text" class="currentDate w-100 from-date-student dateinputstudent" placeholder="from date">
                      <input type="text" class="currentDate w-100 to-date-student dateinputstudent" placeholder="to date">
                      <button type="btn" id="searchStudent" class="w-100">search</button>
                </div>
              </div>
              <!-- Heaader  -->
              <div class="d-flex justify-content-between align-items-center ">
                <span class="d-flex">
                  <div><b class="mr-2">Collection</b></div>
                  <span><b> ₹ </b><b class="collection"> 0</b></span>
                </span>
                <span class="material-symbols-outlined border p-1 bg-dark text-light export-excell-btn" btntable="date-wize" style="cursor:pointer;">file_save</span>
              </div>
              <!-- Body  -->
              <div class="border" style="height:375px; overflow-y: scroll;">

                    <table class="table table-dark table-bordered table-hover table-sm table-responsive-md sortable-table" id="payment-history-date">
                        <thead>
                        <tr>
                        <th>SN.</th>
                            <th nowrap="nowrap" data-column="0">Paid</th>
                            <th nowrap="nowrap" data-column="3">Students Name</th>
                            <th nowrap="nowrap" data-column="4">Parents</th>
                            <th nowrap="nowrap" data-column="4">Pr_Id</th>
                            <th nowrap="nowrap" data-column="5">Date</th>
                            <th nowrap="nowrap" data-column="6">Time</th>
                        </tr>
                        </thead>
                        <tbody class="payment-history-date sortable-bordy">
                                
                        </tbody>

                    </table>
              </div>
            </div>
        </div>

      </div>
  </div>

    <div class="col-12  pr-2">
        <b>Collection Months</b>
        <div class="row border pl-3" id="monthsBox">

            
        </div>
    </div>
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
      saveAs(blob, "Fee_Collection_Collection" + ".xls");
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