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
 
  </style>
@endsection

@section('script')

    <!-- ajax ajax-student-fee-payment,js  -->
    <script src="{{ asset('../admin_lang/fees/ajax-student-fee-payment.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    
@endsection


@section('contents')
   <div><h5>Student Fee Payment</h5></div>

   <div class="row border py-3">
      <div class="col-12 col-md-6 border position-relative">
         <span>Search For Payment</span>
         <div class="d-flex justify-content-start mb-3">
            <sapn class="search-select px-3 py-1">Parent Name</sapn>
            <span  class="search-select ml-2 px-3 py-1">Student Name</span>
            <sapn class="search-select ml-2 px-3 py-1">Parent ID</sapn>
            <span class="search-select ml-2 px-3 py-1">Student ID</span>
            <span class="search-select ml-2 px-3 py-1">Parent Number</span>
         </div>
         <div class="d-flex">
            <input type="text" class="w-75 p-2 search_input" required name="search_input" placeholder="Search">
            <button type="submit" class="border submit-btn px-3 w-25">Search</button>
        </div>
        
  
      </div>
      <div class="col-12 col-md-3 border">
         sdsdsd
      </div>
      <div class="col-12 col-md-3 border">
         sdsdsd
      </div>
   </div>
    
   {{-- Start Search List  --}}
   <div class="bg-danger row">
      <div class="col-12 col-md-6">
         <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
         </div>
      </div>
      <div class="col-12 col-md-6"></div>
   </div>
   {{-- End Search List  --}}
   <div>
      sdsd
   </div>


@endsection