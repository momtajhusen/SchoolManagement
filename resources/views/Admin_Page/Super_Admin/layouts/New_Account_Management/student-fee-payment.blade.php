@extends('Admin_Page/Super_Admin/admin_template')

@section('script')

    <!-- ajax ajax-student-fee-payment,js  -->
    <script src="{{ asset('../admin_lang/Accounts/ajax-student-fee-payment.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

   <!-- ajax select option all-parents.js -->
   <script src="{{ asset('../admin_lang/SelectOption/StudentsParents/all-parents.js')}}?v={{ time() }}"></script> 

   <!-- ajax select option all-students.js -->
   <script src="{{ asset('../admin_lang/SelectOption/StudentsParents/all-students.js')}}?v={{ time() }}"></script> 

   {{-- School Name Font  --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Rakkas&display=swap" rel="stylesheet">

   
   {{-- Sorting Script  --}}
   <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>
 
   
@endsection

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

     .school-name{
      font-family: "Rakkas", serif;
      font-weight: 400;
      font-style: normal;
     }
     .school-address,.school-phone{
      font-size: 13px;
     }
     .invoice-content{
         background-color: #a7a7a7d3;
         color: rgb(0, 0, 0);
         overflow: hidden;
      }
      .background-water-mark{
         position: absolute;
         top:0px;
         left:0px;
         height: 100%;
         width: 100%;
         z-index: -1;
         color: #807f7f54;
         font-size: 10px;
         text-align: justify;
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
         overflow: hidden;
      }

      .school-logo-watermark{
         position: absolute;
         z-index: -1;
         opacity: 0.1;
         top: 30%;
         left: 20%;
         width: 300px;

         border: 8px solid transparent;
         border-radius: 20px; 
         /* filter: blur(4px);  */
         background: linear-gradient(45deg, transparent 49.5%, white 49.5%, white 50.5%, transparent 50.5%);


      }

 
  </style>
@endsection




@section('contents')
   <div><h5>Student Fee Payment</h5></div>

   <!-- Start Fee Payment  Modal -->
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
                          <div class="border p-2 py-5 d-flex">
                              <img src="#" class="border school-logo" alt="" style="width:40px;height:40px;">
                              <div class="d-flex align-items-center w-100 flex-column">
                                 <h6 class="text-light m-0 school-name">Polar Star Secondary Boarding School</h6>
                                 <span class="text-light school-address">Mirchaiya-5, Sirha, Nepal</span>
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
   <!-- End Fee Payment  Modal -->


    <!-- Start Invoice  Modal -->
    <div class="modal fade" id="feeInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content" style="background: #02142a;">
         <div class="modal-header">
            <h5 class="modal-title text-light" id="exampleModalLabel">Fee Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
             <div class="row m-0 bg-light">
                <div class="col-12 border py-4 invoice-content" style="position:relative;z-index:100;height:675px;">
                  <img class="school-logo-watermark" src="#" alt="">
                    <div class="background-water-mark border">
                        {{-- school name water mark  --}}
                    </div>
                    <div class="signature-box" style="position: absolute; bottom:5px; right:12px;">
                     <div style="width:150px;height:35px;border:1px solid #000;"></div>
                      <div class="text-center">Cashier Signature</div>
                    </div>

                  
                    <div>
                       <div class="border p-2 d-flex justify-content-between align-items-start">
                           <img src="#" class="border school-logo p-1" alt="" style="width:55px;height:55px;">
                           <div class="d-flex align-items-center w-100 flex-column">
                              <h4 class="m-0 school-name ">Polar Star Secondary Boarding School</h4>
                              <span class="school-address">Mirchaiya-5, Sirha, Nepal</span>
                              <span class="school-phone"></span>
                           </div>
                       </div>

                       {{-- Billing Table  --}}
                       <div class="invoice-students"></div>
                       <div class="invoice-particular-table">
                             {{-- table append  --}}
                       </div>
                    </div>

                    {{-- <img src="../storage/invoice-bg.jpg" class="img-fluid rounded-top" alt="" style="position:absolute;top:0;left:0;z-index:-1;"/> --}}

                </div>

             </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary p-3 px-5 payment-model-colose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-secondary">
               <span class="material-symbols-outlined invoice-download">download</span>
            </button>
            <button type="button" class="btn btn-secondary invoice-print">
               <span class="material-symbols-outlined">print</span>
            </button>
            <button type="button" class="btn btn-secondary invoice-share">
               <i class="fa fa-whatsapp p-1" aria-hidden="true" style="font-size:23px;"></i>
            </button>
         </div>
      </div>
      </div>
   </div>
    <!-- End Fee Invoice  Modal -->

   <div class="row border">
      <div class="col-12 col-md-4 py-3 border position-relative bg-light">

         <div class="student-search-box">
            <div class="border p-1 d-flex justify-content-between">
               <span class="px-2">Search</span> 
               <div class="d-flex ml-3" style="font-size: 14px;">
                  <span class="border p-1 mx-1 px-2 select-option ">Students</span>
                  <span class="border p-1 mx-1 px-2 select-option">Parents</span>
                  <span class="material-symbols-outlined refresh-icon border text-center d-flex align-items-center" style="cursor: pointer;font-size:18px;">refresh</span>
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
               <div class="d-flex">
                  <span class="material-symbols-outlined border parent-search-icon" style="cursor:pointer;">person_search</span>
                  <span class="material-symbols-outlined refresh-icon border text-center d-flex align-items-center" style="cursor: pointer;font-size:18px;">refresh</span>
               </div>
            </div>
            <div class="d-flex mt-2">
              {{-- <img class="border p-2 parent-image" src="#" alt="parent" style="width:70px;"> --}}
              <div class="px-2" style="line-height:23px;">
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
                   <span class="all_student_st" st_id='#'></span>
              </div>
            </div>
         </div>
      </div>
      <div class="col-12 col-md-8 py-3 border bg-light">
         <nav>
            <div class="nav nav-tabs bg-light" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Payment</a>
              <a class="nav-item nav-link history-btn" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">History</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <table class="table table-bordered table-sm table-hover table-responsive-md sortable-table">
                  <thead>
                    <tr class="bg-dark text-light text-center">
                        <th scope="col">
                           <div class="d-flex">
                              <span class="ml-2">Students</span> 
                           </div>
                        </th>
                        <th scope="col" nowrap="nowrap" data-column="0">Fee</th>
                        <th scope="col" nowrap="nowrap" data-column="1">Paid</th>
                        <th scope="col" nowrap="nowrap" data-column="2">Disc</th>
                        <th scope="col" nowrap="nowrap" data-column="3">Dues</th>
                    </tr>
                  </thead>
                  <tbody class="students-table sortable-bordy">
                          {{-- hello  --}}
                  </tbody>
                  <tbody class="mult-total-row d-none">
                     <tr class='bg-dark'>
                        <td class='text-center'>   
                           <div class="d-flex align-items-center justify-content-between">
                              {{-- Start chekbox 1 to 12  --}}
                              <div class="d-flex px-1">
                                 @for ($i = 0; $i < 12; $i++)
                                    <div class="checkbox-wrapper-30 d-flex flex-column ml-2 check_month_{{ $i }}">
                                          <span class="checkbox">
                                             <input type="checkbox" value="month_{{ $i }}" class="month-check-input" />
                                             <svg>
                                                <use xlink:href="#checkbox-30" class="checkbox"></use>
                                             </svg>
                                          </span>
                                          <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                                             <symbol id="checkbox-30" viewBox="0 0 22 22">
                                                <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2"/>
                                             </symbol>
                                          </svg>
                                          <span class="check-month">
                                             @php
                                                $monthArray = ['Bai', 'Jes', 'Ash', 'Shr', 'Bha', 'Ash', 'Kar', 'Man', 'Pou', 'Mag', 'Fal', 'Cha'];
                                                $month =  $monthArray[$i];
                                             @endphp
                                             {{ $month }}
                                          </span>
                                    </div>
                                 @endfor
                              </div>
                              {{-- Start chekbox 1 to 12  --}}
                              <div class="p-0 multiple-paid-btn">
                                  {{-- multi paid btn   --}}
                              </div>
                           </div>
                        </td>
                        <td nowrap="nowrap" class='text-center text-light'>₹ <span class="total-fee-multi">0</span></td>
                        <td nowrap="nowrap" class='text-center text-light'>₹ <span class="total-paid-multi">0</span></td>
                        <td nowrap="nowrap" class='text-center text-light'>₹ <span class="total-disc-multi">0</span></td>
                        <td nowrap="nowrap" class='text-center text-light'>₹ <span class="total-dues-multi">0</span></td>
                    </tr>
                  </tbody>
               </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <table class="table table-striped table-sm table-responsive-md">
                  <thead>
                    <tr class="text-center bg-dark text-light">
                      <th scope="col">SN.</th>
                      <th scope="col">Months</th>
                      <th scope="col">Paid</th>
                      <th scope="col">Disc</th>
                      <th scope="col">Dues</th>
                      <th scope="col">Date</th>
                      <th scope="col">Invoice</th>
                      <th scope="col">Reset</th>
                    </tr>
                  </thead>
                  <tbody class="paid-history-table">
                     {{-- payment history  --}}
                  </tbody>
                </table>
            </div>
          </div>


      </div>
   </div>

   <div class="row pt-3 border bg-light" style="overflow:auto;">
       <div class="col-12"  >
            {{-- Start Selectd Student Fee Stracture Month Wize --}}
            <table class="table table-sm table-dark table-hover d-none" style="width:1000px;">
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


            <span>Students Ledger</span>
            <table class="table table-bordered table-responsive-md">
               <thead>
                 <tr class="text-center bg-dark text-light">
                   <th scope="col">#</th>
                   <th scope="col">Student</th>
                   <th scope="col">Year</th>
                   <th scope="col">Fee</th>
                   <th scope="col">Paid</th>
                   <th scope="col">Disc</th>
                   <th scope="col">Dues</th>
                   <th scope="col">Bai</th>
                   <th scope="col">Jes</th>
                   <th scope="col">Ash</th>
                   <th scope="col">Shr</th>
                   <th scope="col">Bha</th>
                   <th scope="col">Ash</th>
                   <th scope="col">Kar</th>
                   <th scope="col">Man</th>
                   <th scope="col">Pou</th>
                   <th scope="col">Mag</th>
                   <th scope="col">Fal</th>
                   <th scope="col">Cha</th>
                 </tr>
               </thead>
               <tbody class="student-month-fee">
                  {{-- Student Month Fee  --}}
               </tbody>
             </table>
       </div>
       <div class="col-12"></div>
   </div>


 
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
$(document).ready(function(){
  $('.invoice-print').click(function(){
    try {
      // Get the target element
      var element = $('.invoice-content')[0];
      
      // Calculate scaled dimensions for canvas
      var scale = 8; // Increase scale for higher resolution
      var canvasWidth = element.offsetWidth * scale;
      var canvasHeight = element.offsetHeight * scale;
      
      // Create a new canvas element
      var canvas = document.createElement('canvas');
      canvas.width = canvasWidth;
      canvas.height = canvasHeight;
      var context = canvas.getContext('2d');

      // Scale the context to match the scaling factor
      context.scale(scale, scale);
      
      // Draw the content of the target element onto the canvas
      html2canvas(element, { 
        scale: scale, 
        useCORS: true, // Enable anti-aliasing
        backgroundColor: null, // Transparent background
        allowTaint: true, // Allow images from different origins
        letterRendering: true // Improve text rendering
      }).then(function(canvas) {
        var imageData = canvas.toDataURL("image/png");

        // Open a new window to print the captured image
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title><style>body {margin: 0; padding: 0;} img {width: 100%; height: auto;}</style></head><body><img src="' + imageData + '"></body></html>');
        printWindow.document.close();

        // Add a delay before triggering print
        setTimeout(function() {
          printWindow.print();
          printWindow.close(); // Close the window after printing
        }, 1000); // Adjust delay time as needed (in milliseconds)
      }).catch(function(error) {
        console.error('Error capturing content: ', error);
        alert('Error capturing content. Please try again.');
      });
    } catch (e) {
      console.error('Error printing: ', e);
      alert('Error printing. Please try again.');
    }
  });
});

// Download 
$(document).ready(function(){
  $('.invoice-download').click(function(){

   try {
      // Get the target element
      var element = $('.invoice-content')[0];
      
      // Calculate scaled dimensions for canvas
      var scale = 8; // Increase scale for higher resolution
      var canvasWidth = element.offsetWidth * scale;
      var canvasHeight = element.offsetHeight * scale;
      
      // Create a new canvas element
      var canvas = document.createElement('canvas');
      canvas.width = canvasWidth;
      canvas.height = canvasHeight;
      var context = canvas.getContext('2d');

      // Scale the context to match the scaling factor
      context.scale(scale, scale);
      
      // Draw the content of the target element onto the canvas
      html2canvas(element, { 
        scale: scale, 
        useCORS: true, // Enable anti-aliasing
        backgroundColor: null, // Transparent background
        allowTaint: true, // Allow images from different origins
        letterRendering: true // Improve text rendering
      }).then(function(canvas) {
        // Convert canvas to data URL
        var imageData = canvas.toDataURL("image/png");
        
        // Create a link element
        var link = document.createElement('a');
        link.href = imageData;
        link.download = 'invoice.png';
        link.click();
      }).catch(function(error) {
        console.error('Error capturing content: ', error);
        alert('Error capturing content. Please try again.');
      });
    } catch (e) {
      console.error('Error downloading: ', e);
      alert('Error downloading. Please try again.');
    }
  });
});

// Share 
$(document).ready(function(){
  $('.invoice-share').click(function(){
    try {
      // Get the target element
      var element = $('.invoice-content')[0];
      
      // Calculate scaled dimensions for canvas
      var scale = 2; // Adjust scale as needed
      var canvasWidth = element.offsetWidth * scale;
      var canvasHeight = element.offsetHeight * scale;
      
      // Create a new canvas element
      var canvas = document.createElement('canvas');
      canvas.width = canvasWidth;
      canvas.height = canvasHeight;
      var context = canvas.getContext('2d');

      // Scale the context to match the scaling factor
      context.scale(scale, scale);
      
      // Draw the content of the target element onto the canvas
      html2canvas(element, { 
        scale: scale, 
        useCORS: true, // Enable anti-aliasing
        backgroundColor: null, // Transparent background
        allowTaint: true, // Allow images from different origins
        letterRendering: true // Improve text rendering
      }).then(function(canvas) {
        // Convert canvas to data URL
        var imageData = canvas.toDataURL("image/png");

        // Send the image data to the server to save in Laravel's public folder
        $.ajax({
          type: 'POST',
          url: '/save-invoice-image', // Change this URL to your Laravel route for saving images
          data: {
            image: imageData
          },
          success: function(response) {
            // Once the image is saved successfully, construct the WhatsApp share URL with the image URL
            var domainName = window.location.origin;
            var imageURL = domainName + response.image_url;

            var shareText = "imageURL";
            var shareURL = "whatsapp://send?text=" + imageURL;
            
            // Open WhatsApp share URL in a new window
            window.open(shareURL, "_blank");
          },
          error: function(xhr, status, error) {
            console.error('Error saving image: ', error);
            alert('Error saving image. Please try again.');
          }
        });
      }).catch(function(error) {
        console.error('Error capturing content: ', error);
        alert('Error capturing content. Please try again.');
      });
    } catch (e) {
      console.error('Error sharing via WhatsApp: ', e);
      alert('Error sharing via WhatsApp. Please try again.');
    }
  });
});










</script>
   

 
@endsection