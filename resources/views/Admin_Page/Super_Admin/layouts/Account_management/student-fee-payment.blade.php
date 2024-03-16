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
 
  </style>
@endsection

@section('script')

    <!-- ajax ajax-student-fee-payment,js  -->
    <script src="{{ asset('../admin_lang/fees/ajax-student-fee-payment.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

   <!-- ajax get all class -->
   <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

   <!-- ajax get class all student -->
   <script src="{{ asset('../admin_lang/classes/get-class-student.js')}}?v={{ time() }}"></script> 


    
@endsection


@section('contents')
   <div><h5>Student Fee Payment</h5></div>

   <div class="row border py-3">
      <div class="col-12 col-md-5 py-3 border position-relative bg-light">

         <div class="student-search-box">
            <div class="border p-1 d-flex justify-content-between">
               <span class="px-2">Search</span> 
               <div class="d-flex ml-3" style="font-size: 14px;">
                  <span class="border p-1 mx-1 px-2 select-option">pr_name</span>
                  <span class="border p-1 mx-1 px-2 select-option">st_name</span>
                  <span class="border p-1 mx-1 px-2 select-option">pr_id</span>
                  <span class="border p-1 px-2 select-option">st_id</span>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-5">
                  <select name="class" class="select2 class-select" id="class-select" style="height:50px;background:#f0f1f3;border:0px;">
                  </select>
               </div>
               <div class="col-7 pl-0">
                     <select name="period" class="select2 student-select">
                        <option value="">Please Select Student :</option>
                     </select>
               </div>
            </div>
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
                     <span>Children :</span>
                     <span class="total-children">2</span>
                  </div>
              </div>
            </div>
         </div>
      </div>
      <div class="col-12 col-md-7 py-3 border bg-light">
         <table class="table table-bordered table-sm ">
            <thead>
              <tr>
                <th scope="col">Students</th>
                <th scope="col">St_id</th>
                <th scope="col">Fee</th>
                <th scope="col">Paid</th>
                <th scope="col">Dues</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="students-table">
                    {{-- hello  --}}
            </tbody>
          </table>
      </div>
   </div>
 
@endsection