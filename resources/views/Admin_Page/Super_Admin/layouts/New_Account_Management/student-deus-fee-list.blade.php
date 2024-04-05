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
    <table class="table display data-table table-bordered text-nowrap table-sm sortable-table" id="myTable">
    <thead>
        <tr>
        <th  data-column="0">SN.</th>
        <th  data-column="1">Photo</th>
        <th  data-column="2">Student Name</th>
        <th  data-column="3">Class</th>
        <th  data-column="4">st_id</th>
        <th  data-column="5">Total Fee</th>
        <th  data-column="8">Dues Pay</th>
        <th  data-column="9">Parents Contact</th>
        <th  data-column="10">Phone</th>
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

</div>
</div>
</div>
</div>

@endsection
