@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">


    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
 
 
@endsection   

@section('script')
 

    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 
 
    <!-- ajax get class all student -->
    <script src="{{ asset('../admin_lang/classes/get-class-student.js')}}?v={{ time() }}"></script> 

    <!-- ajax discount manage js-->
    <script src="{{ asset('../admin_lang/fees/discount-manage.js')}}?v={{ time() }}"></script> 


    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>


@endsection

@section('contents')

 

    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Select Student</h3>
                    </div>
                </div>

                    <div class="row">
                    <div class="col-12-xxxl col-lg-5 col-12 form-group">
                            <label>Class *</label>
                            <select name="class" class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">

                            </select>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-12 form-group">
                                <label>Section *</label>
                                <select class="select2 section-select" required name="section">
                                    <option value="">Please Select Section *</option>
                                </select>
                            </div>
 
                        <input type="hidden" id="student_id" value="0">
                        <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                            <br>
                            <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group animate__animated" style="height:50px">SEARCH</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-8-xxxl col-12">
    <div class="card height-auto">
    <div class="card-body">
            <div class="item-title">
                <h3>Student Discount Manage</h3>

                <div class="w-1-00 student-box">
                     
                </div>



 
        </div>
    </div>
    <!-- End All Month Payment Table -->
 
@endsection
