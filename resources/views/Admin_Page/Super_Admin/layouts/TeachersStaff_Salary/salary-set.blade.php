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
    <!-- ajax-get-all-employee -->
    <script src="{{ asset('../admin_lang/Employee_Management/ajax-get-all-employee.js')}}?v={{ time() }}"></script> 

    <!-- ajax teacher/staff salary -->
    <script src="{{ asset('../admin_lang/TeachersStaffSalary/ajax-teachersStaffSalary.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>
@endsection


@section('contents')
 
    <!-- All Subjects Area Start Here -->
    <div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add Teachers/Staff Salary</h3>
                    </div>
                </div>
                <form class="salary-add-form">
                    <div class="row">
                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Teachers/Staff *</label>
                            <select name="all-employee" required class="select all-employee" id="all-employee-select-add" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Salary Amount *</label>
                            <input type="number" required  min="500" name="salary_amount" placeholder="Amount" class="form-control select2" style="height:50px;width:100%; padding:10px;background:#f8f8f8;">
                        </div>

                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Salary Join Date *</label>
                            <input type="text" required maxlength="10" name="salary_join_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker salary_join_date">
                            <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                        </div>

                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Check Teacher/Staff Salary</h3>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-10 col-12 form-group">
                            <select name="all-employee" required class="select all-employee" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                            </select>
                        </div>

                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit"
                                class="fw-btn-fill btn-gradient-yellow search-class-subject">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Salary Date</th>
                                <th>Salary Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="salary-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


@endsection
