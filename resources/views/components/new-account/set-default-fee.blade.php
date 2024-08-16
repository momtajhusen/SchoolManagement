   <!-- ajax Default fee save -->
   <script src="{{ asset('../admin_lang/parents/ajax-default-fee-set.js')}}?v={{ time() }}"></script>
   
       <!-- ajax get all Vehicle Root  -->
       <script src="{{ asset('../admin_lang/Transport/ajax-vehicle-root.js')}}?v={{ time() }}"></script>
 

<div class="row m-0">
    <div class="col-6 p-0">
       <div class="d-flex flex-column">
 
        <div class="border p-2 d-flex flex-column">
           <div class="fee-stracture-box" style="height:630px;overflow: auto">
               <sapn>Monthly Fee</span>
                <label for="feetype1" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                  <div>
                    <input type="checkbox" checked id="feetype1" value="tuition_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Tuition Fee</span>
                   </div>
                      <div class='d-flex flex-column'>
                        <span style='font-size:10px;'>Disc</span>
                        <input type="number" fee='tuition_disc' min="0" max="100" value='0' style='width:35px;height:20px;'>
                      </div>
                </label>
              <div>
                <label for="feetype2" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                 <div>
                  <input type="checkbox" id="feetype2" value="transport_fee" class="checkbox-custom border default-fee-type transport_fee" style="cursor: pointer">
                  <span class="ml-1" style="cursor:pointer;">Transport Fee</span>
                  </div>
                     <div class='d-flex flex-column'>
                        <span style='font-size:10px;'>Disc</span>
                        <input type="number" fee='transport_disc' min="0" max="100" value='0' style='width:35px;height:20px;'>
                      </div>
                </label>
                <select name="vehicle_root" class="select" id="root_select" style=" width:100%; padding:10px; "></select>
              </div>
              <label for="feetype2" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
              <div> 
                <input type="checkbox" id="feetype2" value="full_hostel_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                <span class="ml-1" style="cursor:pointer;">Full Hostel Fee</span>
              </div> 
                  <div class='d-flex flex-column'>
                        <span style='font-size:10px;'>Disc</span>
                        <input type="number" fee='full_hostel_disc' min="0" max="100" value='0' style='width:35px;height:20px;'>
                  </div>
              </label>
               <label for="feetype3" class="borders d-flex justify-content-between w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                <input type="checkbox" id="feetype3" value="half_hostel_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                <span class="ml-1" style="cursor:pointer;">Half Hostel Fee</span>
                </div>
                <div class='d-flex flex-column'>
                        <span style='font-size:10px;'>Disc</span>
                        <input type="number" fee='half_hostel_disc' min="0" max="100" value='0' style='width:35px;height:20px;'>
                  </div>
              </label>
              <label for="feetype4" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                <input type="checkbox" id="feetype4" value="computer_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                <span class="ml-1" style="cursor:pointer;">Computer Fee</span>
                </div>
                <div class='d-flex flex-column'>
                        <span style='font-size:10px;'>Disc</span>
                        <input type="number" fee='computer_disc' min="0" max="100" value='0' style='width:35px;height:20px;'>
                  </div>
              </label>
              <label for="feetype5" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                <input type="checkbox" id="feetype5" value="coaching_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                <span class="ml-1" style="cursor:pointer;">	Coaching Fee</span>
                </div>
                <div class='d-flex flex-column'>
                      <span style='font-size:10px;'>Disc</span>
                      <input type="number" fee='computer_disc' class='disc_input' min="0" max="100" value='0' style='width:35px;height:20px;'>
                  </div>
              </label>
              <sapn>OneTime Fee</span>
              <label for="feetype6" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                 <div>
                  <input type="checkbox" id="feetype6" value="admission_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                  <span class="ml-1" style="cursor:pointer;">Admission Fee</span>
                </div>
                <div class='d-flex flex-column'>
                    <span style='font-size:10px;'>Disc</span>
                    <input type="number" fee='admission_disc' class='disc_input' min="0" max="100" value='0' style='width:35px;height:20px;'>
                </div>
              </label>
              <label for="feetype7" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                  <input type="checkbox" id="feetype7" value="annual_charge" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                  <span class="ml-1" style="cursor:pointer;">Annual Charge</span>
                </div>
                <div class='d-flex flex-column'>
                    <span style='font-size:10px;'>Disc</span>
                    <input type="number" fee='annual_disc' class='disc_input' min="0" max="100" value='0' style='width:35px;height:20px;'>
                </div>
              </label>
              <label for="feetype9" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                <input type="checkbox" id="feetype9"  value="saraswati_puja_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                <span class="ml-1" style="cursor:pointer;">Saraswati Puja</span>
                </div>
                <div class='d-flex flex-column'>
                    <span style='font-size:10px;'>Disc</span>
                    <input type="number" fee='exam_disc' class='disc_input' min="0" max="100" value='0' style='width:35px;height:20px;'>
                </div>
              </label>
              <sapn>Quarterly Fee</span>
              <label for="feetype8" class="borders d-flex justify-content-between align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                <div>
                  <input type="checkbox" checked id="feetype8"  value="exam_fee" class="checkbox-custom border default-fee-type" style="cursor: pointer">
                  <span class="ml-1" style="cursor:pointer;">Exam Fee</span>
                </div>
                <div class='d-flex flex-column'>
                    <span style='font-size:10px;'>Disc</span>
                    <input type="number" fee='exam_disc' class='disc_input' min="0" max="100" value='0' style='width:35px;height:20px;'>
                </div>
              </label>

           </div>
        </div>
       </div>
    </div>
    <div class="col-6 p-0">
       <div class="d-flex flex-column border">
          <div class="d-flex flex-column">
            <div class="border p-2 d-flex flex-column">
              <span>Select Months</span>
                <div class="fee-stracture-box pr-2" style="height:500px;overflow: auto">
                   <label for="month1" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                     <input type="checkbox" checked id="month1" value="1" class="checkbox-custom border default-month-input" style="cursor: pointer">
                     <span class="ml-1" style="cursor:pointer;">Baishakh</span>
                   </label>
                   <label for="month2" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                     <input type="checkbox" checked id="month2" value="2" class="checkbox-custom border default-month-input" style="cursor: pointer">
                     <span class="ml-1" style="cursor:pointer;">Jestha</span>
                   </label>
                   <label for="month3" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                     <input type="checkbox" checked id="month3" value="3" class="checkbox-custom border default-month-input" style="cursor: pointer">
                     <span class="ml-1" style="cursor:pointer;">Ashadh</span>
                   </label>
                   <label for="month4" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                     <input type="checkbox" checked id="month4" value="4" class="checkbox-custom border default-month-input" style="cursor: pointer">
                     <span class="ml-1" style="cursor:pointer;">Shrawan</span>
                   </label>
                   <label for="month5" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month5" value="5" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Bhadau</span>
                  </label>
                  <label for="month6" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month6" value="6" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Asoj</span>
                  </label>
                  <label for="month7" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month7" value="7" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Kartik</span>
                  </label>
                  <label for="month8" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month8" value="8" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Mangsir</span>
                  </label>
                  <label for="month9" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month9" value="9" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Poush</span>
                  </label>
                  <label for="month10" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month10" value="10" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Magh</span>
                  </label>
                  <label for="month11" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month11" value="11" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Falgun</span>
                  </label>
                  <label for="month12" class="borders d-flex align-items-center w-100 border py-1 px-3" style="cursor: pointer">
                    <input type="checkbox" checked id="month12" value="12" class="checkbox-custom border default-month-input" style="cursor: pointer">
                    <span class="ml-1" style="cursor:pointer;">Chaitra</span>
                  </label>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 