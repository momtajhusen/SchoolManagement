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

    <!-- ajax ajax-student-fee-payment,js  -->
    <script src="{{ asset('../admin_lang/fees/ajax-student-fee-payment.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    
@endsection


@section('contents')
   <div><h5>Student Fee Payment</h5></div>

   <div class="row border">
      <div class="col-12 col-md-6 border bg-light">
         <div class="row" id="class_student_row">
            <div class="col-lg-5 col-12 form-group">
                <label>Class *</label>
                <select name="class" class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">

                </select>
            </div>

            <div class="col-lg-5 col-12 form-group animate__animated">
                <label>Select Student *</label>
                <select name="period" class="select2 student-select">
                    <option value="">Please Select Student :</option>
                </select>
            </div>

            <input type="hidden" id="student_id" value="0">
            <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                <br>
                <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group animate__animated" style="height:50px">SEARCH</button>
            </div>
        </div>
      </div>
      <div class="col-12 col-md-3 border">
         sdsdsd
      </div>
      <div class="col-12 col-md-3 border">
         sdsdsd
      </div>
   </div>
    
 

@endsection