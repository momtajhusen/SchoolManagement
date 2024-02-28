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
 

    <!-- ajax profile data -->
    <script src="{{ asset('../admin_lang/parents/ajax-parents-profile.js')}}?v={{ time() }}"></script> 

    <!-- ajax parent wallet -->
    <script src="{{ asset('../admin_lang/parents/ajax-parent-wallet.js')}}?v={{ time() }}"></script> 

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

        <!-- Select 2 Js -->
        <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

 
@endsection

@section('contents')
<input type="hidden" id="parent-id" value="{{$id}}">


<!-- Load Blance Modal -->
<div class="modal fade" id="LoadBlance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex" id="exampleModalLabel">
            <span class="material-symbols-outlined mr-2">add_card</span> 
            Load Blance
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form class="blance-load-form">
                <div class="form-row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                      <label for="inputEmail4">Load Amount *</label>
                      <input type="number" required name="amount" class="form-control" id="inputEmail4" placeholder="amount" min="1">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                      <label>Load For *</label>
                      <select class="select2" required name="load_for">
                          <option value="">Select</option>
                          <option value="advance_payment">Advance Payment</option>
                          <option value="hostel_deposite">Hostel Deposite</option>
                      </select>
                  </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                      <label for="loader">Load By</label>
                      <input type="text" name="load_by" class="form-control" id="loader" placeholder="your name">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                      <label>Load Date *</label>
                      <input type="text" required maxlength="10"  name="load_date" placeholder="yyyy-mm-dd" class="form-control currentDate">
                      <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                  </div>
                </div>
      </div>
        <div class="modal-footer">
            <button type="button" id="close-load-model" class="btn btn-secondary px-4 p-3" data-dismiss="modal">Cancle</button>
            <button type="submit" id="load-save" class="btn btn-primary px-4 p-3">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="row">

 

     <div class="p-3 col-12 col-md-4 ">
         <div class="w-100" style="background-color: #ddd;">
            <div class="p-2 py-3 d-flex justify-content-around ">
                <img class="mr-1 fatherImg" src="#" alt="" style="height:100px; width:100px;">
                <img class="motherImg" src="#" alt="" style="height:100px; width:100px;">
            </div>


         </div>

         <div class="w-100 mt-3 p-3" style="background-color: #ddd;">
           <h4 class="mb-1">Parent Details</h4>

           <div>
               <div>
                    <span>Father :</span>
                    <span class="father-name"></span>
               </div>
               <div>
                    <span>Mother :</span>
                    <span class="mother-name"></span>
               </div>
               <div>
                    <span>Father Contact :</span>
                    <span class="father-contact"></span>
               </div>
           </div>
 
         </div>
     </div>

     <div class="p-3 col-12 col-md-8">

         <div class="row">
              <div class="col-12 col-md-7 mb-3">
                <div class="w-100" style="border:1px solid #ccc;">
                    <div class="p-2 d-flex justify-content-between" style="border:1px solid #ddd;">
                      <div class="d-flex">
                         <span class="material-symbols-outlined">person</span> Students
                      </div>
                      <div>
                         <span class="st_no">2</span>
                      </div>
                      
                    </div>
                    <div class="p-2" id="student_box" style="border:1px solid #ddd;">

                   </div>
                </div>
              </div>

              <div class="col-12 col-md-5 mb-4">
                <div style="border:1px solid #ccc;">
                    <div class="p-2 d-flex justify-content-between align-items-center " style="border:1px solid #ddd; height:35px; ">
                      <div class="d-flex">
                         <span class="material-symbols-outlined mr-2">account_balance_wallet</span> Wallet
                      </div>
                      <div class="d-flex">
                          <div class="mx-1 d-flex flex-column justify-content-end align-content-end" style="font-size: 10px;">
                            <span>Advance Amount</span>
                            <b id="advance_amount">000</b>
                        </div>
                        <div class="mx-1 d-flex flex-column justify-content-end align-content-end" style="font-size: 10px;">
                          <span>Hostel Deposite</span>
                          <b id="hostel_deposite">000</b>
                        </div>
                      </div>


                    </div>
                    <div class="p-2 d-flex align-items-start " style="border:1px solid #ddd; height:100px; "> 
                        <div class="d-flex flex-column justify-content-center align-items-center" data-toggle="modal" data-target="#LoadBlance" style="cursor:pointer;">
                            <span class="material-symbols-outlined mr-2">add_card</span>
                            <span style="font-size:8px;">Load Blance</span>
                        </div>

                        <div class="ml-3 d-flex flex-column justify-content-center align-items-center" style="cursor:pointer;">
                            <span class="material-symbols-outlined mr-2">history</span>
                            <span style="font-size:8px;">History</span>
                        </div>
                   </div>
                </div>
              </div>

         </div>
     </div>


  </div>
 
@endsection
