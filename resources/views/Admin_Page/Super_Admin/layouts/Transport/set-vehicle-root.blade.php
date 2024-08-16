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
    <!-- ajax Vehicle Root  -->
    <script src="{{ asset('../admin_lang/Transport/ajax-vehicle-root.js')}}"></script> 

    <!-- ajax get all Vehicle  -->
    <script src="{{ asset('../admin_lang/Transport/ajax-vehicle.js')}}"></script>

    <!-- ajax get all Driver  -->
    <script src="{{ asset('../admin_lang/Transport/get-all-driver.js')}}"></script>

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
 
@endsection


@section('contents')
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
        <h3>Transport</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Set Vehicle Root</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Set Vehicle Root</h3>
            </div>
        </div>
        <form class="set-vechicle-form">
            <div class="row">

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Root Name *</label>
                    <input type="text" required name="root_name" placeholder="Root Name" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Select Vehicle *</label>
                     <select id="select-vehicle" required name="vehicle"  class="select border-0 p-2 w-100" style="height:45px;background:#f8f8f8;color:#a3a2a2;border-radius:5px;">
                    </select>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Timing *</label>
                    <input type="time" required name="timing" placeholder="Timing" class="form-control">
                </div>


                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Amount *</label>
                    <input type="number" required name="amount" placeholder="Amount" class="form-control">
                </div>

                <input type="hidden" id="check_action"  value="add" class="form-control">
                <input type="hidden" name="root_id"  value="" class="form-control">


                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                </div>
            </div>
        </form>
        
    </div>
    </div>

    <!-- Add New Teacher Area End Here -->
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Vehicle Root</h3>
                    </div>
                </div>
        
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>Root Name</th>
                                <th>Vehicle</th>
                                <th>Timing</th>
                                <th>Amount</th>
                                <th>Student</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="vehicle-root-table">
 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection