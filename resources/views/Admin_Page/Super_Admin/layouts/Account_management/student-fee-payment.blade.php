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
      <div class="col-12 col-md-8 py-3 border bg-light">
         <table class="table table-bordered table-sm table-hover">
            <thead>
              <tr class='text-center'>
                <th scope="col">Students <span class="total-children"></span></th>
                <th scope="col">St_id</th>
                <th scope="col">Amount</th>
                <th scope="col">Paid</th>
                <th scope="col">Dues</th>
                {{-- <th scope="col">Action</th> --}}
              </tr>
            </thead>
            <tbody class="students-table">
                    {{-- hello  --}}
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