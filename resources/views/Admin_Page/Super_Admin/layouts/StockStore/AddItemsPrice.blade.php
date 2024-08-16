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

    <!-- ajax AddItems & Price -->
    <script src="{{ asset('../admin_lang/StockStore/AddItemsPrice.js')}}?v={{ time() }}"></script> 


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
                        <h3>Add New Items</h3>
                    </div>
                </div>
                <form class="added-items-form">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Select Items Category *</label>
                            <select name="categories" required class="select2 select-category"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                            </select>
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Item Name *</label>
                            <input type="text" required  maxlength="30" name="items" placeholder="Item Name" class="form-control select2">
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <label>Item Price *</label>
                            <input type="number" required  min="1" name="price" placeholder="Price" class="form-control select2">
                        </div>
                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                            <br>
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
                        <h3>All Items</h3>
                    </div>
                </div>
 
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Items Name</th>
                                <th>Items Price</th>
                                <th>Items Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="items-table">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
    <!-- All Subjects Area End Here -->


@endsection
