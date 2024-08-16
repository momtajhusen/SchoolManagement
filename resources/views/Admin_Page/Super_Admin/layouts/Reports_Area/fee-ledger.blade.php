@extends('Admin_Page/Super_Admin/admin_template')



@section('script')
 
    <!-- ajax fee-ledger -->
    <script src="{{ asset('../admin_lang/report/fee-ledger.js')}}?v={{ time() }}"></script> 

    <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <!-- Include SheetJS library for .xlsx export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    {{-- Sorting Script  --}}
    <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>
    
@endsection

@section('contents')

    <h4>Ledger Account</h1>
    <div class='d-flex'>
        <div>
        <label for="cars">select year:</label>
        <select class='fee-ledger-select' name="cars" id="cars" style='width:100px;'>
            <option >select year</option>
            <option value="2081">2081</option>
            <option value="2080">2080</option>
            <option value="2079">2079</option>
        </select>
        <span class="material-symbols-outlined"  id="export-button">download</span>
        </div>
    </div>

    <div class="table-responsive" style='height:500px;'>
       <div class="d-flex">
            <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 0%; box-shadow:none;">
        </div>
        <table class="table table-striped sortable-table" id="myTable">
        <thead class="sticky">
            <tr>
                <th data-column="0">#</th>
                <th data-column="1">Year</th>
                <th data-column="2">St-Id</th>
                <th data-column="3">Class</th>
                <th data-column="4">Total_Fee</th>
                <th data-column="5">Total_Disc</th>
                <th data-column="6">Total_paid</th>
                <th data-column="7">Total_dues</th>
            </tr>
        </thead>
        <tbody class='fee_ledger sortable-bordy'>

        </tbody>
        <tbody class='total_fee_ledger'>
 
        </tbody>
    </table>
    </div>

    <script>
        $(document).ready(function() {
            // Function to handle the export
            function exportToExcel() {
            var class_name = $("#class-select").val();

            // Clone the table to preserve the original data
            let clonedTable = $("#myTable").clone();

            // Remove the "Photo" column (second column) from the cloned table
            clonedTable.find("tr").each(function() {
                $(this).find("td:nth-child(2), th:nth-child(2)").remove();
            });

            // Check if jquery.table2excel.js is available
            if ($.fn.table2excel) {
                // If available, use the plugin to export the table to .xls
                clonedTable.table2excel({
                filename: "exported_table.xls" // Name of the exported file
                });
            } else {
                // If jquery.table2excel.js is not available, use Blob.js and FileSaver.js
                let html = clonedTable[0].outerHTML;
                let blob = new Blob([html], { type: "application/vnd.ms-excel" });
                saveAs(blob,"student_fee"+".xls");
            }
            }

            // Bind the export function to the button click event
            $("#export-button").on("click", function() {
            var class_name = $("#class-select").val();
            if (class_name === "") {
                alert("select_class");
                return false;
            }
            exportToExcel();
            });
        });
    </script>
 

@endsection