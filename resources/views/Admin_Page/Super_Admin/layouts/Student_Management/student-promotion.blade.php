@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/jquery.dataTables.min.css')}}">
@endsection

@section('script')
 
    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- ajax get class student for promotion-->
    <script src="{{ asset('../admin_lang/promotion_student/ajax-get-student.js')}}?v={{ time() }}"></script> 

    <!-- ajax student passout-->
    <script src="{{ asset('../admin_lang/promotion_student/ajax-pass_out_student.js')}}?v={{ time() }}"></script> 

    <!-- ajax student Promotion-->
    <script src="{{ asset('../admin_lang/promotion_student/ajax-promote.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
 
    <!-- Data Table Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>

    {{-- Sorting Script  --}}
    <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>

@endsection

@section('contents')
 
        <!-- Teacher Table Area Start Here -->
        <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Promotion Class Student</h3>
                </div>

            </div>
            <div class="row gutters-8">
                <div class="col-3-xxxl col-xl-5 col-lg-5 col-12 form-group">
                    <span>From</span>
                    <select name="class" required class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;">

                    </select>
                </div>
                <div class="col-3-xxxl col-xl-5 col-lg-5 col-12 form-group">
                    <span>Promote Class</span>
                    <select name="class" required class="select2 class-select" id="promote-class" style="height:50px;width:100%; padding:10px;">

                    </select>
                </div>
                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                    <br>
                    <div class="fw-btn-fill btn-gradient-yellow text-center w-100" id="class-student">SEARCH</div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="d-flex">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 0%; box-shadow:none;">
                </div>
                <table class="table display data-table text-nowrap table-sm sortable-table" id="myTable">
                    <thead>
                        <tr>
                            <th data-column="0"> 
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                    <label class="form-check-label">ID</label>
                                </div>
                            </th>
                            <th data-column="1">Photo</th>
                            <th data-column="2">Name</th>
                            <th data-column="3">Class</th>
                            <th data-column="4">Section</th>
                            <th data-column="5">Roll No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="promotion-table sortable-bordy">

                    </tbody>
                </table>
            </div>

            <div class="w-100 d-flex justify-content-between ">
                <button class="fw-btn-fill btn btn-gradient-yellow text-center mt-3" id="promotion-btn" style="width:200px;">Promotion</button>
                <button class="fw-btn-fill btn btn-gradient-yellow text-center mt-3" id="passout-btn" style="width:200px;">Pass Out</button>
            </div>

        </div>
    </div>
    <!-- Teacher Table Area End Here -->



@endsection
