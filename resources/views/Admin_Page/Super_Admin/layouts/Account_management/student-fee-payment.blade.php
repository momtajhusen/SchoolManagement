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
        --brdr-actv: #1e2235;
        --brdr-hovr: #bbc1e1;
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
                           <div class="checkbox-wrapper-30 d-flex flex-column">
                              <span class="checkbox">
                              <input type="checkbox" disabled value="month_0" class="month-check-input" />
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
                              <span class="checkbox">
                              <input type="checkbox" value="month_3" class="month-check-input" />
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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
                           <div class="checkbox-wrapper-30 d-flex flex-column ml-2">
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

                        <div class="p-0">
                           <button class="bg-info take-pay border-0 text-light btn rounded py-3 px-4" style="cursor:pointer">Payment</button>
                        </div>
                     </div>

                  </td>
                  <td class='text-center text-light'>₹ <span class="total-fee-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-paid-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-disc-multi">0</span></td>
                  <td class='text-center text-light'>₹ <span class="total-dues-multi">0</span></td>
                  <td class='bg-light p-0 d-none'><button class='bg-info btn w-100 h-100 text-light py-3'>Payment</button></td>
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