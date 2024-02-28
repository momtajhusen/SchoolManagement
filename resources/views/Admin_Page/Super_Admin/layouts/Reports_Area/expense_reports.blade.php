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
      <!-- ajax CheckClassFee -->
      <script src="{{ asset('../admin_lang/report/expense-reports.js')}}?v={{ time() }}"></script>

          <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- Include SheetJS library for .xlsx export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


@endsection

@section('contents')

<div class="row">
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <h4>Expense Reports</h4>

               <div class="row gutters-8">
                <div class="col-lg-5 col-12 form-group">
                    <label>Select from date*</label>
                    <input type="text" required maxlength="10" name="expenses_start_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker expenses_start_date currentSatrtDate">
                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>

                <div class="col-lg-5 col-12 form-group">
                  <label>Select to date*</label>
                  <input type="text" required maxlength="10" name="expenses_end_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker expenses_end_date">
                  <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>


                <div class="col-lg-2 col-12 form-group">
                    <br>
                    <button class="fw-btn-fill btn-gradient-yellow" id="search-btn">SEARCH</button>
                </div>
            </div>

                <table class="table table-bordered table-sm exportTable" id="myTable">

                    <div class="d-flex justify-content-between">
                        <div><b>Total Expense: </b><b class="total-expense">0</b></div>

                        <div>
                            <div class="d-flex flex-column align-items-center bg-dark ml-1" id="export-button" style="cursor:pointer;font-size: 17px; float: left">
                                <span class="material-symbols-outlined text-light p-1 text-light">file_save</span>
                                <span class="text-light" style="font-size: 8px;">xls</span>
                              </div>
                            <div class="d-flex flex-column align-items-center bg-dark ml-1" id="btnCsvExport" style="cursor:pointer;font-size: 17px; float: left">
                                <span class="material-symbols-outlined text-light p-1 text-light">file_save</span>
                                <span class="text-light" style="font-size: 8px;">csv</span>
                              </div>
                        </div>
                    </div>


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

<script>
$(document).ready(function() {
 
 // Bind the export function to the button click event
 $("#export-button").on("click", function() {


   // Clone the table to preserve the original data
     var clonedTable = $("#myTable").clone();

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
     saveAs(blob, "Expensive" + ".xls");
   } else {
     // If jquery.table2excel.js is not available, use Blob.js and FileSaver.js
     let html = clonedTable[0].outerHTML;
     let blob = new Blob([html], { type: "application/vnd.ms-excel" });
     saveAs(blob, "Expensive" + ".xls");
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
