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
        <!-- ajax-get-all-employee.js-->
        <script src="{{ asset('../admin_lang/Employee_Management/ajax-get-all-employee.js')}}?v={{ time() }}"></script>

        <!-- ajax-delete-employee.js-->
        <script src="{{ asset('../admin_lang/Employee_Management/ajax-delete-employee.js')}}?v={{ time() }}"></script> 

        <!-- Select 2 Js -->
        <script src="{{ asset('../admin_lang/teacher/ajax-add-teacher.js')}}"></script> 

        <!-- Select 2 Js -->
        <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
        <!-- Date Picker Js -->
        <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    
         <!-- Data Table Js -->
        <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>

@endsection

@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>All Teachers/Staff</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>All Teachers/Staff</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- Teacher Table Area Start Here -->
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="row gutters-8">
                            {{-- <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                <input type="text" placeholder="Search by ID ..." class="form-control">
                            </div> --}}
                            <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                <select class="select2 teacher-search-select" name="teacher_search_by">
                                    <option value="first_name">Teacher First Name ...</option>
                                    <option value="phone">Teacher Mobile .. </option>
                                    <option value="email">Teacher Email ...</option>
                                </select>
                            </div>
                            <div class="col-4-xxxl col-xl-7 col-lg-3 col-12 form-group">
                                <input type="text" maxlength="30" placeholder="Enter Parent Name ..." class="form-control teacher-input-search">
                            </div>

                            <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-teacher">SEARCH</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap table-sm exportTable">
                                <thead>
                                    <tr>
                                        <th> 
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkAll">
                                                <label class="form-check-label">ID</label>
                                            </div>
                                        </th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>joining</th>
                                        <th>address</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>
                                            <div class="d-flex flex-column align-items-center ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 15px; float: left">
                                                <span class="material-symbols-outlined p-1" id="btnCsvExport">file_save</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Teacher Table Area End Here -->
 
 
@endsection
