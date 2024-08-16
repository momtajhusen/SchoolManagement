@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
@endsection

@section('script')
    <!-- script-treeview-menu -->
    <script src="{{ asset('../admin_lang/RoleAndPermission/ajax-sub_admin_list.js')}}?v={{ time() }}"></script>

    <script src="{{ asset('../admin_lang/RoleAndPermission/ajax-super_admin_list.js')}}?v={{ time() }}"></script>

 
    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
@endsection


@section('contents')

<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1 pt-3">
            <div class="item-title">
                <h4>Super Admin List</h4>
            </div>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Number</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody  class="super-admin-table">
            {{-- Retrive Data  --}}
        </tbody>
        </table>
    </div>
</div>

    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1 pt-3">
                <div class="item-title">
                    <h4>Sub Admin List</h4>
                </div>
            </div>

            <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody  class="sub-admin-table">
                {{-- Retrive Data  --}}
            </tbody>
            </table>
        </div>
    </div>
    
@endsection
