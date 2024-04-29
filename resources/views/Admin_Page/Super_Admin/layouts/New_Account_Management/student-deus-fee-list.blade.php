@extends('Admin_Page/Super_Admin/admin_template')

  @section('style')

      <!-- Select 2 CSS -->
      <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
      <!-- Date Picker CSS -->
      <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
  
      <!-- Include Blob.js and FileSaver.js (if jquery.table2excel.js is not available) -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
  
      <!-- Include SheetJS library for .xlsx export -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
  

 
@endsection

@section('script')

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 


    {{-- Sorting Script  --}}
    <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>

    
    {{-- ajax-student-dues-list.js  --}}
    <script src="{{ asset('../admin_lang/Accounts/ajax-student-dues-list.js')}}?v={{ time() }}"></script>

@endsection


@section('contents')

<div class="row d-flex justify-content-center">
  <div class="col-10-xxxl col-12">
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
                              <input type="checkbox" class="check-box bg-danger" id="checkbox1" value="1">
                              <label for="checkbox1"></label>
                              <span style="margin-left:20px;">Baishakh</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox2" value="2">
                              <label for="checkbox2"></label>
                              <span style="margin-left:20px;">Jestha</span>
                          </div> 
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox3" value="3">
                              <label for="checkbox3"></label>
                              <span style="margin-left:20px;">Ashadh</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox4" value="4">
                              <label for="checkbox4"></label>
                              <span style="margin-left:20px;">Shrawan</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox5" value="5">
                              <label for="checkbox5"></label>
                              <span style="margin-left:20px;">Bhadau</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox6" value="6">
                              <label for="checkbox6"></label>
                              <span style="margin-left:20px;">Asoj</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox7" value="7">
                              <label for="checkbox7"></label>
                              <span style="margin-left:20px;">Kartik</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox8" value="8">
                              <label for="checkbox8"></label>
                              <span style="margin-left:20px;">Mangsir</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox9" value="9">
                              <label for="checkbox9"></label>
                              <span style="margin-left:20px;">Poush</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox10" value="10">
                              <label for="checkbox10"></label>
                              <span style="margin-left:20px;">Magh</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox11" value="11">
                              <label for="checkbox11"></label>
                              <span style="margin-left:20px;">Falgun</span>
                          </div>
                          <div class="checkbox d-flex mb-2">
                              <input type="checkbox" class="check-box" id="checkbox12" value="12">
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
    <div class="col-lg-4 col-12 form-group p-0 pr-1">
        <label>Class *</label>
        <select name="class" required class="select2 class-select" id="class-select" style="height:50px;width:100%;">

        </select>
    </div>
    <div class="col-xl-4 col-lg-6 col-12 form-group p-0 pr-1">
        <label>Section *</label>
        <select class="select2 section-select" required name="section">
            <option value="">Please Select Section *</option>
        </select>
    </div>
    <div class="col-xl-2 col-lg-3 col-12 form-group p-0 pr-1">
            <br>
            <button class="fw-btn-fill btn-gradient-yellow btn search-btn" id="search-btn" style="height:50px">Search</button>
        </div>
  </div>

  <div class="d-flex">
    <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 0%; box-shadow:none;">
  </div>
  <div class="table-responsive">
    <table class="table display data-table table-bordered text-nowrap table-sm sortable-table text-center" id="myTable">
        <thead>
            <tr>
              <th class='tabel-header-show' colspan="7"></th>
            </tr>
        </thead>
    <thead>
        <tr>
        <th  data-column="0">Pr_Id</th>
        <th  data-column="1">Parent Name</th>
        <th  data-column="2">Students</th>
        <th  data-column="3">Prev. Year</th>
        <th  data-column="4">Total Dues</th>
        <th  data-column="5">Parents Contact</th>
        <th  data-column="6">Phone</th>
        </tr>
    </thead>
    <tbody class="student-dues-table sortable-bordy">
         
    </tbody>
    <tbody class="total-row d-none">
        <tr>
            <th colspan="5"><center>Total</center></th>
            <th class="totalfee">0</th>
            <th class="prevBlanc">0</th>
            <th class="preYear">0</th>
            <th class="netPay">0</th>
        </tr>
    </tbody>
    </table>
  </div>

  <div class="row form-group mg-t-8">
    <div class="col-12 col-lg-6 mb-3 message-btn-box d-none d-flex justify-content-betwee-center">
    <button  class="btn-fill-lg bg-dark btn-hover-bluedark d-flex" visitorbtn="btn" btnName="Print Dues Bill" id="printBtn">
        <span class="material-symbols-outlined mt-1 mr-2">print</span>
        <span>Print Dues Bill</span>
    </button>
    <button  class="btn-fill-lg ml-1 bg-dark btn-hover-bluedark d-flex" id="export-button">
        <span class="material-symbols-outlined mt-1 mr-2">download</span>
        <span>Export</span>
    </button>
    </div>

    {{-- <div class="col-12 col-lg-6 message-btn-box d-none d-flex justify-content-center">
        <button  class="btn-fill-lg bg-dark btn-hover-bluedark message-send-btn d-flex">
            <span class="material-symbols-outlined mt-1 mr-2">sms</span>
            <span>Dues Message</span>
            <span class="material-symbols-outlined mt-1"> send</span>
        </button>
    </div> --}}

</div>


  <div class="print-section d-none row m-3 w-100 p-3 bg-light  justify-content-center" style="border:2px solid black;position: absolute;left:0px;top:500px;z-index:100;">
    <div class="bill-box" id="my-element" style="background:white; width: 100mm; height: 250mm;  overflow: hidden; ">
        <div style="width: 100%; height: 100%; overflow: hidden;box-sizing: border-box;position: relative;">
            <img src="/storage/invoice-bg.jpg"  style="width:100%; height:100%; position:absolute;top:0px;z-index: -1;">
            
            <div style="height: 80px;width: 100%; border-bottom:1px solid black;">
                <div style="width:50%; height: 90%;border-radius: 0px 200px 200px 0px;float:left;">
                    <img id="school_logo" src=" img" style="height:50px; margin: 15px;border:1px solid #f0f1f3;">
                </div>
                <div style="width:50%; height: 100%; display:flex; justify-content:center; align-items:center; ">
                    <h3 style="margin-top: 20px; font-weight: bolder;">INVOICE</h3>
                </div>
            </div>
            
                <div style="width: 100%;">
                    <center id="school_name" style="text-align: center;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-size: 23px;margin: 8px;">
                        Polar Star English Boarding School
                    </center>
                    <address>
                    <center><strong style="margin: 10px;" id="school_address">Nepal Sirha Nepal</strong></center>
                    <center><strong style="margin: 20px;" id="estd_year">Estd : 2080</strong></center>
                    <center><strong style="font-size: 13px;margin: 10px;" id="school_contact">Tel : 9815759505</strong></center>
                    </address>
                </div>
            

                <div style="border: 0px solid black; display: flex; margin: 10px;">

                <div style="height: 100px; width: 70%; border: 0px solid black; display: flex;">
                    <div style="height:100%; align-items: center; margin-left: 10px;">
                        <img id="st_image" style="border: 3px solid black; padding: 3px;" src="img" alt="student" width="80px;">
                    </div>
                    <div style="border: 0px solid black;margin-left: 10px; padding-top: 0px; display: flex;flex-direction: column;">
                        <span style="margin-bottom: 5px;margin-top: 5px;"><b>STUDENT</b></span>
                        <div style="margin-bottom: 5px;"><b>Name:</b> <span id="st_name">Momtaj Husen</span></div>
                        <div style="margin-bottom: 5px;"><b>Class:</b> <span id="st_class">1ST A</span> <span id="st_section"></span></div>
                        <div style="margin-bottom: 5px;"><b>Roll:</b> <span id="st_roll">34</span></div>
                    </div>
                </div>
        
                <div style="height: 100px; width: 30%; border: 0px solid black; padding-top: 0px; display: flex; flex-direction: column; align-items: start;">
                    <div style="margin-bottom: 5px;"><b>Date:</b> <span id="bill-date">2080-11-1</span></div>
                    <div style="margin-bottom: 5px;"><b>Bill No: </b><span id="bill_no">45</span></div>
                    <span style="margin-bottom: 5px;"><b>Pan No:</b>5656</span>
                </div>
                </div>
        
            
                <div class="bill-content" style="padding: 0px;margin: 10px;">
                <table style="border:1px solid black;font-family: arial, sans-serif;margin-top:15px;border-collapse: collapse;width: 100%;">
                <tr style="border: 1px solid #000000;text-align: left;padding: 15px;">
                    <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">SN:</th>
                    <th style="border-right: 1px solid #747373;padding: 8px;font-size:11px;">Particulars</th>
                    <th style="width:10px;border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Mo.</th>
                    <th style="border-right: 1px solid #747373;text-align: center;padding: 8px;font-size:11px;">Amount</th>
                </tr>

                
                <div><b>Months : </b> <span>up to Baishakh</span></div>
                <div class="bill-particular-data" id="bill-particular-data">
                    
                </div>

                </table>

                <center>
                    <div style="width:290px; margin-left:12px; margin-top:20px;">
                    
                        <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px dashed black;">
                            <b>Total :</b>
                            <span style="margin-left:100px;">4556</span>
                        </div>

                        <div style="d-flex justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px inset black;">
                            <b>Prev. Bal. :</b>
                            <span style="margin-left:100px;">435</span>
                        </div>

                        <div style="d-flex justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px inset black;">
                            <b>Prev. Year :</b>
                            <span style="margin-left:100px;">324</span>
                        </div>

                        <div style="display:flex; justify-content: space-between; font-size:20px; padding-bottom:2px; margin-bottom:5px; border-bottom: 2px double black;">
                            <b>Net Payable :</b>
                            <b style="margin-left:100px;">324</b>
                        </div>
                    </div>
                </center>


                <div style="margin-top:20px;">
                    <b>Amount in words :</b>
                    <span>ertret</span><br>
                </div>

                <div style="margin-top:10px;">
                    <b>Notice :</b>
                    <span>noticed</span><br>
                </div>


            </div>
        




            <div style="position: absolute; bottom:20px; height: 50px;width: 100%; display:flex; justify-content:center; align-items:center; ">
                <span style="text-align:center;font-size:12px;">Thank you for your prompt payment. <br> Your support enables us to continue providing quality education.</span>
            </div>


        </div> 
    </div>  
  </div>

</div>
</div>
</div>
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

@endsection
