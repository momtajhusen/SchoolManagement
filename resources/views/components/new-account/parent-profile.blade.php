 

    <!-- ajax profile data -->
    <script src="{{ asset('../admin_lang/parents/ajax-parents-profile.js')}}?v={{ time() }}"></script> 

    <!-- ajax-student-fee.js -->
    <script src="{{ asset('../admin_lang/parents/ajax-student-fee.js')}}?v={{ time() }}"></script> 

    <!-- ajax parent wallet -->
    <script src="{{ asset('../admin_lang/parents/ajax-parent-wallet.js')}}?v={{ time() }}"></script> 

    <!-- ajax deal fee save -->
    <script src="{{ asset('../admin_lang/parents/ajax-deal-fee-set.js')}}?v={{ time() }}"></script> 
 

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

      <!-- Select 2 Js -->
      <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

          {{-- Sorting Script  --}}
    <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>

    <style>
        .students{
          background-color:#D9D9D9;
          cursor:pointer;
        }
          .collapse_box{
             background-color:#042954; 
             cursor: pointer;
             color: #ccc;
          }
          /* .month-icon button{
            height: 30px;
          } */
          .student-fee-save{
            overflow: hidden;
          }
          .add-new-fee{
            z-index: 100;
          }
  
          .fee_stracture{
            background-color: #051f3e;
            color: #ccc;
            position: relative;
          }
          .input_fee_name{
            background: none;
            color: #ccc;
            outline: none;
            border:none;
          }
          .input_fee_amount{
            width: 80px;
            text-align: center;
            font-weight: bold;
            outline: none;
          }
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
          }
  
          .checkbox-custom {
              transform: scale(1.1); /* Adjust the scale factor as needed */
              margin-right: 10px; /* Optional: Add some spacing between checkbox and label */
          }
  
          /* Ensure alignment */
          .borders {
              display: inline-flex; /* Ensure the label behaves like a flex container */
              align-items: center; /* Align items vertically in the center */
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
  



<input type="hidden" id="parent-id" value="">


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

 
          <!-- Modal All Students For Parents -->
          <x-new-account.student-add-on-parent />
          

  <div class="row main-content">

 

    <div class="p-3 col-12 col-md-4 ">
      {{--Start partent Detals  --}}
        <div class="w-100 p-2" style="background-color: #ddd;">
          <div class="d-flex">
            <span class="material-symbols-outlined">person</span> Parent
          </div>
          <div class="d-flex justify-content-around ">
              <img class="mr-1 fatherImg border border-dark p-1" src="#" alt="" style="height:70px; width:70px;">
              <img class="motherImg border border-dark p-1" src="#" alt="" style="height:70px; width:70px;">
          </div>
          <div class="px-4">
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
      {{--Start partent Detals  --}}
       {{-- Start students list --}}
          <div class="w-100 mt-3" style="border:1px solid #ccc;">
              <div class="p-2 d-flex justify-content-between" style="border:1px solid #ddd;">
                <div class="d-flex">
                  <span class="material-symbols-outlined">person</span> Students
                </div>
                <div class="d-flex justify-content-center">
                  <span class="st_no">0</span>
                  <span class="material-symbols-outlined ml-2 add-student" style="cursor: pointer;">add</span>
                </div>
                
              </div>
              <div class="p-2" id="student_box" style="border:1px solid #ddd;">

            </div>
          </div>
       {{-- End students list --}}
    </div>


     <div class="p-3 col-12 col-md-8">
         <div class="row">
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
              <!-- Button trigger modal -->

            <!--Add Month Modal -->
            <div class="modal fade" id="yearModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="d-flex">
                        <select class="form-select form-select-sm add-select-month" aria-label=".form-select-sm example">
                          <option value="1">Baishakh</option>
                          <option value="2">Jestha</option>
                          <option value="3">Ashadh</option>
                          <option value="4">Shrawan</option>
                          <option value="5">Bhadau</option>
                          <option value="6">Kartik</option>
                        </select>
    
                        <div class="d-flex">
                          <div class="border d-flex align-items-center fee_stracture">
                            <input type="text required" class="px-2 input_fee_name">
                            <span class="pr-3">₹</span>
                            <input type="number" min="0" required class="input_fee_amount" value="0">
                          </div>
                        </div>
                    </div>
                    
                    
                     </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-model" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add-month"  st_id="#">Save</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Save Deal Fee Modal -->
            <div class="modal fade" id="dealModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fee Deal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <div class="row m-0">
                          <div class="col-6 p-0">
                             <div class="d-flex flex-column">
                                <input type="number" placeholder="₹ 000" class="deal-fee p-2" class="mb-3">
                                <div class="border p-2 d-flex flex-column">
                                <div class="fee-stracture-box" style="height:500px;overflow: auto">
                                  <sapn>Monthly Fee</span>
                                 <label for="feetype1" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" checked id="feetype1" value="tuition_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Tuition Fee</span>
                                 </label>
                                 <label for="feetype2" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype2" value="full_hostel_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Full Hostel Fee</span>
                                 </label>
                                 <label for="feetype3" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype3" value="half_hostel_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Half Hostel Fee</span>
                                 </label>
                                 <label for="feetype4" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype4" value="computer_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Computer Fee</span>
                                 </label>
                                 <label for="feetype5" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype5" value="coaching_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">	Coaching Fee</span>
                                 </label>
                                 <sapn>OneTime Fee</span>
                                 <label for="feetype6" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype6" value="admission_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Admission Fee</span>
                                 </label>
                                 <label for="feetype7" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype7" value="annual_charge" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Annual Charge</span>
                                 </label>
                                 <label for="feetype9" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" id="feetype9"  value="saraswati_puja_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Saraswati Puja</span>
                                 </label>
                                 <sapn>Quarterly Fee</span>
                                 <label for="feetype8" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                   <input type="checkbox" checked id="feetype8"  value="exam_fee" class="checkbox-custom border deal-fee-type" style="cursor: pointer">
                                   <span class="ml-1" style="cursor:pointer;">Exam Fee</span>
                                 </label>
                   
                              </div>
                                </div>
                             </div>
                          </div>
                          <div class="col-6 p-0">
                             <div class="d-flex flex-column border">
                                <div class="d-flex flex-column">
                                  <div class="border p-2 d-flex flex-column">
                                    <div>Select Months</div>
                                      <div class="fee-stracture-box pr-2" style="height:500px;overflow: auto">
                                         <label for="month1" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                           <input type="checkbox" checked id="month1" value="1" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                           <span class="ml-1" style="cursor:pointer;">Baishakh</span>
                                         </label>
                                         <label for="month2" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                           <input type="checkbox" checked id="month2" value="2" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                           <span class="ml-1" style="cursor:pointer;">Jestha</span>
                                         </label>
                                         <label for="month3" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                           <input type="checkbox" checked id="month3" value="3" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                           <span class="ml-1" style="cursor:pointer;">Ashadh</span>
                                         </label>
                                         <label for="month4" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                           <input type="checkbox" checked id="month4" value="4" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                           <span class="ml-1" style="cursor:pointer;">Shrawan</span>
                                         </label>
                                         <label for="month5" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month5" value="5" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Bhadau</span>
                                        </label>
                                        <label for="month6" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month6" value="6" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Asoj</span>
                                        </label>
                                        <label for="month7" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month7" value="7" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Kartik</span>
                                        </label>
                                        <label for="month8" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month8" value="8" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Mangsir</span>
                                        </label>
                                        <label for="month9" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month9" value="9" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Poush</span>
                                        </label>
                                        <label for="month10" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month10" value="10" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Magh</span>
                                        </label>
                                        <label for="month11" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month11" value="11" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Falgun</span>
                                        </label>
                                        <label for="month12" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                                          <input type="checkbox" checked id="month12" value="12" class="checkbox-custom border deal-month-input" style="cursor: pointer">
                                          <span class="ml-1" style="cursor:pointer;">Chaitra</span>
                                        </label>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                  </div>                   
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary p-3 px-4 close-model" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-deal-fee p-3 px-4" st_id='#'>Save</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Save Default Fee Modal -->
            <div class="modal fade" id="defaultFeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Default Fee Set</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <x-new-account.set-default-fee />
                  </div>                   
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary p-3 px-4 close-model" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-default-fee p-3 px-4" st_id='#'>Save</button>
                  </div>
                </div>
              </div>
            </div>


              <div class="col-12">
                    <div class="st_header border p-2 d-flex justify-content-between">
                       <b>Student Fee Stracture <span class="fee-year"> </span></b> <br>
                       <div class="d-flex">
                          <button class="btn material-symbols-outlined border deal-icon mx-2 default-fee-set-btn" data-toggle="modal" data-target="#defaultFeeModal" data-toggle="tooltip" data-placement="bottom" title="Set Default Fee">universal_currency_alt</button>
                          <button class="btn material-symbols-outlined border deal-icon mx-2 deal-fee-set-btn" data-toggle="modal" data-target="#dealModal" data-toggle="tooltip" data-placement="bottom" title="Set Deal Fee">toll</button>
                          <button class="btn material-symbols-outlined border mx-2 add-month-btn" data-toggle="modal" data-target="#yearModal" data-toggle="tooltip" data-placement="bottom" title="Add New Fee">add</button>
                       </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex p-3">
                        <b>Total Fee : </b>
                        <b class="total-fee-student"> 000</b>
                     </div>
                     <div class="d-flex align-items-center">
                        <div class="mx-2"><x-new-account.select-admission-year  /></div>
                        <button class="btn text-light" type="button" id="accordionButton" style="height:30px;background:#042954">
                          Uncollapse All
                        </button>
                     </div>
                    </div>

                    <div class="p-2 d-flex flex-column"  id='month_feestracture'>
                          {{-- Retrive Months  --}}
                    </div>
                    <div class="d-flex p-3" style="border:1px solid #042954">
                        <b>Total Fee : </b>
                        <b class="total-fee-student"> 000</b>
                    </div>
              </div>
         </div>
     </div>


  </div>
 