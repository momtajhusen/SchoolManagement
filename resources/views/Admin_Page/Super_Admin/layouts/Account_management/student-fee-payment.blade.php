@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

  <style>
   .search-select{
      border: 1px solid #888;
      cursor: pointer;
      font-size: 13px;
      background-color: #ccc;
      color: #888;

   }
   .search_input{
      outline: none;
   }
   .submit-btn{
      background-color: #042954;
      color: #ccc;
      cursor: pointer;
   }

   .select-option{
       cursor: pointer;
   }

   .selected-option{
      background-color: #042954;
      color: #ccc;
   }

   .checkbox-wrapper-30 .checkbox {
        --bg: #fff;
        --brdr: #d1d6ee;
        --brdr-actv: #351e1e;
        --brdr-hovr: #e1bbbb;
        --dur: calc((var(--size, 2)/2) * 0.6s);
        display: inline-block;
        width: calc(var(--size, 1) * 15px);
        position: relative;
      }
      .checkbox-wrapper-30 .checkbox:after {
        content: "";
        width: 100%;
        padding-top: 100%;
        display: block;
      }
      .checkbox-wrapper-30 .checkbox > * {
        position: absolute;
      }
      .checkbox-wrapper-30 .checkbox input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -webkit-tap-highlight-color: transparent;
        cursor: pointer;
        background-color: var(--bg);
        border-radius: calc(var(--size, 1) * 4px);
        border: calc(var(--newBrdr, var(--size, 1)) * 1px) solid;
        color: var(--newBrdrClr, var(--brdr));
        outline: none;
        margin: 0;
        padding: 0;
        transition: all calc(var(--dur) / 3) linear;
      }
      .checkbox-wrapper-30 .checkbox input:hover,
      .checkbox-wrapper-30 .checkbox input:checked {
        --newBrdr: calc(var(--size, 1) * 2);
      }
      .checkbox-wrapper-30 .checkbox input:hover {
        --newBrdrClr: var(--brdr-hovr);
      }
      .checkbox-wrapper-30 .checkbox input:checked {
        --newBrdrClr: var(--brdr-actv);
        transition-delay: calc(var(--dur) /1.3);
      }
      .checkbox-wrapper-30 .checkbox input:checked + svg {
        --dashArray: 16 93;
        --dashOffset: 109;
      }
      .checkbox-wrapper-30 .checkbox svg {
        fill: none;
        left: 0;
        pointer-events: none;
        stroke: var(--stroke, var(--border-active));
        stroke-dasharray: var(--dashArray, 93);
        stroke-dashoffset: var(--dashOffset, 94);
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 2px;
        top: 0;
        transition: stroke-dasharray var(--dur), stroke-dashoffset var(--dur);
      }

      .checkbox-wrapper-30 .checkbox svg,
      .checkbox-wrapper-30 .checkbox input {
        display: block;
        height: 100%;
        width: 100%;
      }
      .check-month{
         font-size: 10px;
         color: #fff;
      }

      .bg-paid{
         background-color: rgb(160, 250, 142) !important;
      }
      .bg-dues{
         background-color: rgb(250, 239, 142) !important;
      }
      .bg-feenotset{
         background-color: rgb(149, 142, 250) !important;
      }
 
  </style>
@endsection

@section('script')

    <!-- ajax ajax-student-fee-payment,js  -->
    <script src="{{ asset('../admin_lang/fees/ajax-student-fee-payment.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

   <!-- ajax select option all-parents.js -->
   <script src="{{ asset('../admin_lang/SelectOption/StudentsParents/all-parents.js')}}?v={{ time() }}"></script> 

   <!-- ajax select option all-students.js -->
   <script src="{{ asset('../admin_lang/SelectOption/StudentsParents/all-students.js')}}?v={{ time() }}"></script> 



    
@endsection


@section('contents')
   <div><h5>Student Fee Payment</h5></div>

     <!-- Fee Payment  Modal -->
      <div class="modal fade" id="feePaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content" style="background: #02142a;">
            <div class="modal-header">
               <h5 class="modal-title text-light" id="exampleModalLabel">Fee Payment</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
                <div class="row m-0">
                   <div class="col-lg-6 col-md-12 border py-4">
                       <div>
                          <div class="border p-2 d-flex">
                              <img src="#" class="border school-logo" alt="" style="width:40px;height:40px;">
                              <div class="d-flex align-items-center w-100 flex-column">
                                 <h6 class="text-light m-0 school-name">Polar Star Secondary Boarding School</h6>
                                 <span class="text-light school-address" style="font-size:10px;">Mirchaiya-5, Sirha, Nepal</span>
                              </div>
                          </div>

                          {{-- Billing Table  --}}
                          <div class="modale-table">
                                {{-- table append  --}}
                          </div>

                     
 
                       </div>
                   </div>
                   <div class="col-lg-6 col-md-12 border py-4">
                     <div class="d-flex flex-column align-items-center justify-content-center" style="width:100%;">
                        <div class="w-100 form-group m-1 position-relative">
                           <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                           <div class="d-flex justify-content-between">
                              <label class="text-light">Actual Dues</label>
                              <span class="text-light up-to-month">Up to Baishakh</span>
                           </div>

                            <input type="number" readonly value="0" id="fee_input" name="fee_dues" placeholder="Fee Dues" class="form-control" style="background:#ccc;padding-left:22px;">
                            <input type="hidden" id="last_month" value="0">
                        </div>
                        <div class="w-100 form-group m-1 d-flex">
                             <div class="w-50 position-relative">
                                 <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                                 <label class="text-light">Payment</label>
                                 <input type="number" min="0" name="paid" id="paid_input" placeholder="paid" class="form-control payment" style="padding-left:22px;">
                             </div>
                             <div class="w-50 ml-1 position-relative">
                              <span class="position-absolute" style="top:41px;left:10px;">₹</span>
                              <label class="text-light">Dues</label>
                              <input type="number" readonly value="0" min="0" name="paid" id="dues_input" placeholder="paid" class="form-control payment" style="background:#ccc;padding-left:22px;">
                             </div>

                        </div>
                        <div class="w-100 d-flex">
                            <div class="w-100 form-group m-1">
                                <label class="text-light">Discount %</label>
                                <label class="text-light" style="margin-left: 18%;">Discount ₹</label>
                                <div class="d-flex">
                                <div style="width:40%;position:relative;">
                                     <input type="number" min="0" max="100" value="0" id="percentage" name="percentage" placeholder="Per"  class="form-control px-0 pl-3 w-100" style="border-radius: 10 0 0 0px;" oninput="if (parseInt(this.value) > 100) this.value = '100';">
                                     <div class="d-flex justify-content-center  align-items-center" style="width:40%;height:45px;position:absolute;right:5px;top:0px;">%</div>
                                </div>
                                <div class="position-relative" style="width:60%;">
                                  <span class="position-absolute" style="top:9px;left:11px;">₹</span>
                                 <input type="number" min="0" value="0" id="disc_input" name="disc" placeholder="Discount" class="form-control ml-1" style="width:100%;border-radius: 0 0 10 10px;padding-left:22px;">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 form-group m-1 d-none" id="comment_for_discount">
                            <label class="text-light">Comment for discount</label>
                            <input type="text" required id="comment_disc" name="comment_disc" placeholder="Comment" class="form-control">
                        </div>
                        <div class="w-100 form-group m-1">
                            <label class="text-light">Date</label>
                            <input type="text" value="" required maxlength="10" id="pay_date" name="payment_date" placeholder="yyyy-mm-dd" class="form-control currentDate">
                        </div>
                        <div class="w-100 form-group m-1 d-flex justify-content-center mt-4">
                            <button value="Payment" class="form-control paid_btn bg-success" sing_multi="#" pr_id='#' all_st_id='#' data-fee-particular='#' style="width:100%;cursor:pointer;">Payment</button>
                            <button  class="d-none bg-success payment-loading" style="width:300px;cursor:pointer;">
                                <span class="mr-2"></span> <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
                            </button>
                        </div>
                     </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary p-3 px-5 payment-model-colose" data-dismiss="modal">Cancle</button>
            </div>
         </div>
         </div>
      </div>

   <div class="row border">
      <div class="col-12 col-md-4 py-3 border position-relative bg-light">

         <div class="student-search-box">
            <div class="border p-1 d-flex justify-content-between">
               <span class="px-2">Search</span> 
               <div class="d-flex ml-3" style="font-size: 14px;">
                  <span class="border p-1 mx-1 px-2 select-option ">Students</span>
                  <span class="border p-1 mx-1 px-2 select-option">Parents</span>
               </div>
            </div>
            <div class="col-12 mt-2 p-0 d-none parent-select-box">
               <span>Select Parent</span>
               <select class="select2 admit-parents-select search-select" id="admit-parents-select">
                   {{-- Parents Option Data  --}}
               </select>
            </div>
            <div class="col-12 mt-2 p-0 student-select-box">
               <span>Select Student</span>
               <select class="select2 admit-students-select search-select">
                  {{-- Students Option Data  --}}
               </select>
            </div>
            <button class="fw-btn-fill btn-gradient-yellow btn hidden" id="search-btn" style="height:50px">Search</button>
         </div>

         <div class="parent-details-box d-none">
            <div class="border p-1 d-flex justify-content-between">
               <span>Partent Details</span>
               <span class="material-symbols-outlined border parent-search-icon" style="cursor:pointer;">person_search</span>
            </div>
            <div class="d-flex mt-2">
              <img class="border p-2 parent-image" src="#" alt="parent" style="width:100px;">
              <div class="px-3" style="line-height:23px;">
                  <div class="d-flex">
                     <span>Parent :</span>
                     <span class="father-name">Momtaj Husen</span>
                  </div>
                  <div>
                     <span>Contact :</span>
                     <span class="father-contact">9815759505</span>
                  </div>
                  <div>
                     <span>Address :</span>
                     <span class="father-address">Arang - 8, Siraha, Nepal</span>
                  </div>
                  <div>
                     <span>pr_id :</span>
                     <span class="pr-id">4556</span>
                   </div>
              </div>
            </div>
         </div>
      </div>
      <div class="col-12 col-md-8 py-3 border bg-light" style="overflow:auto;">
         <table class="table table-bordered table-sm table-hover"  style="width:675px;">
            <thead>
              <tr class='text-center'>
                <th scope="col">Students <span class="total-children"></span></th>
                <th scope="col">Fee</th>
                <th scope="col">Paid</th>
                <th scope="col">Disc</th>
                <th scope="col">Dues</th>
                {{-- <th scope="col">Action</th> --}}
              </tr>
            </thead>
            <tbody class="students-table">
                    {{-- hello  --}}
            </tbody>
            <tbody>
               <tr class='bg-secondary'>
                  <td class='text-center'>   
                     <div class="d-flex align-items-center justify-content-between">
                        {{-- Start chekbox 1 to 12  --}}
                        <div class="d-flex px-1">
                           <div class="checkbox-wrapper-30 d-flex flex-column check_month_0">
                              <span class="checkbox">
                              <input type="checkbox" value="month_0" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Bai</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_1">
                              <span class="checkbox">
                              <input type="checkbox" value="month_1" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Jes</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_2">
                              <span class="checkbox">
                              <input type="checkbox" value="month_2" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Ash</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_3">
                              <span class="checkbox">
                              <input type="checkbox" value="month_3" class="month-check-input check-success" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Shr</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_4">
                              <span class="checkbox">
                              <input type="checkbox" value="month_4" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Bha</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_5">
                              <span class="checkbox">
                              <input type="checkbox" value="month_5" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Ash</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_6">
                              <span class="checkbox">
                              <input type="checkbox" value="month_6" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Kar</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_7">
                              <span class="checkbox">
                              <input type="checkbox" value="month_7" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Man</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_8">
                              <span class="checkbox">
                              <input type="checkbox" value="month_8" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Pou</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_9">
                              <span class="checkbox">
                              <input type="checkbox" value="month_9" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Mag</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_10">
                              <span class="checkbox">
                              <input type="checkbox" value="month_10" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Fal</span>
                           </div>
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_11">
                              <span class="checkbox">
                              <input type="checkbox" value="month_11" class="month-check-input" />
                              <svg>
                                 <use xlink:href="#checkbox-30" class="checkbox"></use>
                              </svg>
                              </span>
                              <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                              <symbol id="checkbox-30" viewBox="0 0 22 22">
                                 <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                              </symbol>
                              </svg>
                              <span class="check-month">Cha</span>
                           </div>
                        </div>
                        {{-- Start chekbox 1 to 12  --}}

                        <div class="p-0 multiple-paid-btn">
                           
                        </div>
                     </div>

                  </td>
                  <td class='text-center text-light'>₹ <span class="total-fee-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-paid-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-disc-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-dues-multi">0</span></td>
              </tr>
            </tbody>
          </table>
      </div>
   </div>

   <div class="row pt-3 border bg-light" style="overflow:auto;">
       <div class="col-12"  >
            {{-- Start Selectd Student Fee Stracture Month Wize --}}
            <table class="table table-sm table-dark table-hover" style="width:1000px;">
               <thead>
               <tr class='text-center'>
                  <th scope="col">Month</th>
                  <th scope="col">Fee</th>
                  <th scope="col">Paid</th>
                  <th scope="col">Disc</th>
                  <th scope="col">Dues</th>
                  <th scope="col">Status</th>
                  <th scope="col">Single Pay</th>
                  <th scope="col">Multi. Pay</th>
               </tr>
               </thead>
               <tbody class="students-fee-table">
                  {{-- student month fee  --}}
               </tbody>
            </table>
            {{-- Start Selectd Student Fee Stracture Month Wize --}}
       </div>
       <div class="col-12"></div>
   </div>


 
 


   

 
@endsection