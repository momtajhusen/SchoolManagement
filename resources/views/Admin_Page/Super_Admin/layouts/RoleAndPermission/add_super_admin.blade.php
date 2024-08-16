@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">

     <style>
        .routes-box-body{
            box-shadow:none !important;
            border:1px solid #ddd;
            padding: 10px !important;
        }
     </style>

@endsection

@section('script')
    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- ajax-add-super_admin  -->
    <script src="{{ asset('../admin_lang/RoleAndPermission/ajax_add_super_admin.js')}}?v={{ time() }}"></script>


@endsection

@section('contents')

    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Add New Super Admin</h3>
            </div>
        </div>
        <form class="add-super-admin-form">
            <div class="row">

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Name *</label>
                    <input type="text" required name="name" placeholder="name" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Number *</label>
                    <input type="number" required name="number" placeholder="number" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Email *</label>
                    <input type="email" required name="email" placeholder="email" class="form-control">
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Password *</label>
                    <input type="text" required name="password" placeholder="password" class="form-control">
                </div>
            </div>
            <button type="submit" class="my-2 btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
        </form>

    </div>
    </div>
    <!-- Add New Teacher Area End Here -->
    
 
@endsection
