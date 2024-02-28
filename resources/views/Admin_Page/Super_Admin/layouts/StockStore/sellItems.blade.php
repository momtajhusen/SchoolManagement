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
    <!-- ajax ItemsInStock & Price -->
    <script src="{{ asset('../admin_lang/StockStore/ItemsInStock.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>
@endsection


@section('contents')
    <div class="row">
        <div class="col-12 col-md-9">
             <div class="p-2 border d-flex justify-content-center">

                <div>
                    <div class="col-12 form-group">
                        <label>Parent Name *</label>
                        <input type="text" maxlength="20" required name="student_first_name" placeholder="First Name" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label>Student Name *</label>
                        <input type="text" maxlength="20" required name="student_first_name" placeholder="First Name" class="form-control">
                    </div>
                </div>

             </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="p-2 border">
                 <div class="font-weight-bold text-center">Items In Stock</div>
                 <div class="itemsstock">
 
                 </div>
            </div>
        </div>
    </div>
@endsection
