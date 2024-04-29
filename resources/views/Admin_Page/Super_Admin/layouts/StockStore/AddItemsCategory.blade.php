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
    <!-- ajax ItemsCategory -->
    <script src="{{ asset('../admin_lang/StockStore/ItemsCategory.js')}}?v={{ time() }}"></script> 
 
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
                        <h3>Add Items Category</h3>
                    </div>
                </div>
                <form class="added-item-category-form">
                    <div class="row">
 
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Category Name *</label>
                            <input type="text" required  maxlength="30" name="category_name" id="category" placeholder="Category" class="form-control select2">
                        </div>

                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <br>
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Add</button>
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
                        <h3>All Category</h3>
                    </div>
                </div>
 
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="category-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


@endsection
