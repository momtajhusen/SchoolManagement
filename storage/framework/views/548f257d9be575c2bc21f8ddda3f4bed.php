<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

      <!-- Include jquery.table2excel.js if available (if not, use Blob.js and FileSaver.js) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-table2excel/1.0.3/jquery.table2excel.min.js"></script>

<!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/Blob.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

  <!-- Include SheetJS library for .xlsx export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


    <style>
        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button 
        {
          -webkit-appearance: none;
          margin: 0;
        }

.checkbox
{
    background: linear-gradient(to bottom, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    width: 28px;
    height: 28px;
    box-shadow: inset 0px 1px 1px #fff, 0px 1px 3px rgba(0, 0, 0, 0.5);
    margin: 0 auto;
    position: relative;
}
.checkbox label{
    background: linear-gradient(to bottom, #222222 0%, #45484d 100%);
    width: 20px;
    height: 20px;
    box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px #fff;
    position: absolute;
    top: 4px;
    left: 4px;
    cursor: pointer;

}
.checkbox label:after{
    content: "";
    height: 7.5px;
    width: 13px;
    border-left: 3px solid #fff;
    border-bottom: 3px solid #fff;
    transform: rotate(-45deg);
    position: absolute;
    top: 4px;
    left: 3px;
    opacity: 0;
}
.checkbox input[type="checkbox"]:checked+label:after{ opacity: 1; }
.checkbox input[type=checkbox]{
    margin: 0;
    visibility: hidden;
    left: 7px;
    top: 7px;
}
@media only screen and (max-width:767px){
    .checkbox{ margin: 0 0 20px; }
}

.dropdone-selecter{
            background: #ADA996;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            border: 5px solid rgb(146, 141, 141);
       }
       .month-option-box{
         border: 5px solid rgb(146, 141, 141);
         border-top: 0;


       }
       .bill-box{
          background-color: #631a1a;
       }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 
    <!-- ajax get all class -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax dues list  -->
    <script src="<?php echo e(asset('../admin_lang/fees/ajax-dues-list.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>

    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>
    

    <script>
       const dragArea = document.querySelector(".fee-stracture-body");
       new Sortable(dragArea, {
          animation: 350 
       });
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
 

    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1 row d-flex justify-content-between align-items-center">
                        <div class="item-title col-12 col-lg-6">
                            <h3>Check Class Dues</h3>
                        </div>
                   
                        <div class="col-12 col-lg-6 d-flex mt-lg-0 mt-3  justify-content-end">
                        <div class="border position-relative" style="width:215px;">
                            <div class="dropdone-selecter p-2 px-3 d-flex align-items-center position-relative" id="dropdone-selecter" style="cursor: pointer;">
                                <span style="user-select: none;" id="selected-month">Baishah to Sharwan</span>
                                <span class="material-symbols-outlined">arrow_drop_down</span>
                            </div>
        
                            <div class="position-absolute month-option-box bg-dark text-light p-3 flex-column" style="z-index:100;left:0px;bottom:-450px;height:450px;width:100%;display:none">
                                <div class="my-font position-absolute">
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box bg-danger" id="checkbox1" value="month_0">
                                        <label for="checkbox1"></label>
                                        <span style="margin-left:20px;">Baishakh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox2" value="month_1">
                                        <label for="checkbox2"></label>
                                        <span style="margin-left:20px;">Jestha</span>
                                    </div> 
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox3" value="month_2">
                                        <label for="checkbox3"></label>
                                        <span style="margin-left:20px;">Ashadh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox4" value="month_3">
                                        <label for="checkbox4"></label>
                                        <span style="margin-left:20px;">Shrawan</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox5" value="month_4">
                                        <label for="checkbox5"></label>
                                        <span style="margin-left:20px;">Bhadau</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox6" value="month_5">
                                        <label for="checkbox6"></label>
                                        <span style="margin-left:20px;">Asoj</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox7" value="month_6">
                                        <label for="checkbox7"></label>
                                        <span style="margin-left:20px;">Kartik</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox8" value="month_7">
                                        <label for="checkbox8"></label>
                                        <span style="margin-left:20px;">Mangsir</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox9" value="month_8">
                                        <label for="checkbox9"></label>
                                        <span style="margin-left:20px;">Poush</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox10" value="month_9">
                                        <label for="checkbox10"></label>
                                        <span style="margin-left:20px;">Magh</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox11" value="month_10">
                                        <label for="checkbox11"></label>
                                        <span style="margin-left:20px;">Falgun</span>
                                    </div>
                                    <div class="checkbox d-flex mb-2">
                                        <input type="checkbox" class="check-box" id="checkbox12" value="month_11">
                                        <label for="checkbox12"></label>
                                        <span style="margin-left:20px;">Chaitra</span>
                                    </div>
                                </div> 
                                <div class="w-100 d-flex justify-content-start pl-3 text-center position-absolute" style="left:0;bottom:8px;">
                                    <div id="done" style="width:95%;border:2px solid #4d4b47;color:#9c9a97;cursor: pointer;"> Done </div>
                                </div>
                            </div>
                        </div>
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
                                    <button class="fw-btn-fill btn-gradient-yellow btn search-btn" id="search-btn" style="height:50px">GENERATE</button>
                                </div>
                        </div>

 
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap" id="myTable">
                            <thead>
                                <tr>
                                <td>SN.</td>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>st_id</th>
                                <th>Total Fee</th>
                                <th>Prev. Bal.</th>
                                <th>Prev. Year</th>
                                <th>Net Pay</th>
                                </tr>
                            </thead>
                            <tbody class="studnt-table">
 
                                
                            </tbody>
                            <tbody class="total-row d-none">
                                <tr>
                                <th colspan="5"><center>Total</center></th>
                                <th class="totalfee">0</th>
                                <th class="totalpayment">0</th>
                                <th class="totaldiscount">0</th>
                                <th class="totalfreefee">0</th>
                                <th class="totaldues">0</th>
                                <th class="prevyeardues">0</th>
                                </tr>
                            </tbody>
                            </table>
                        </div>

                    <div class="row form-group mg-t-8">
                            <div class="col-12 col-lg-6 mb-3 message-btn-box d-none d-flex justify-content-betwee-center">
                            <button  class="btn-fill-lg bg-dark btn-hover-bluedark d-flex" id="printBtn">
                                <span class="material-symbols-outlined mt-1 mr-2">print</span>
                                <span>Print Dues Bill</span>
                            </button>
                            <button  class="btn-fill-lg ml-1 bg-dark btn-hover-bluedark d-flex" id="export-button">
                                <span class="material-symbols-outlined mt-1 mr-2">download</span>
                                <span>Export</span>
                            </button>
                            </div>

                            

                    </div>
                    <div class="d-flex">
                        <span class="p-2 px-5 text-light" style="background-color: #222222;">Notice :</span>
                        <input id="notice-input" type="text" style="outline: none; border:1px solid #ccc; width:400px;">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- All Subjects Area End Here -->


    <div class="print-section  row m-3 w-100 p-3 bg-light d-none   justify-content-center" style="border:2px solid black;position: absolute;left:0px;top:500px;z-index:100;">

    </div>
 

      
      <script>
$(document).ready(function() {
    $('#printBtn').click(function() {
        var content = '';
        $('.bill-box').each(function(){
            content += $(this).html();
        });
        var printWindow = window.open('', '', 'height=800,width=800');
        var left = (screen.width / 2) - (800 / 2);
        var top = (screen.height / 2) - (800 / 2);
        printWindow.moveTo(left, top);
        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        setTimeout(function() {
            printWindow.print();
            printWindow.close();
            $("#bill-modal-cancle").click();
        }, 500);
    });
});

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
        saveAs(blob, class_name+"_Cls_Dues_List"+".xls");
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

 
      </script>

 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Account_management/dues-list.blade.php ENDPATH**/ ?>