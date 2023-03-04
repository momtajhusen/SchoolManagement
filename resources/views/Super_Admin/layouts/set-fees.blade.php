@extends('Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <style>
        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button 
        {
          -webkit-appearance: none;
          margin: 0;
        }
    </style>
@endsection

@section('script')
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/fees/ajax-fee-structure.js')}}"></script>
    <!-- script  -->
    <script src="{{ asset('../admin_lang/fees/script-add-fee.js')}}"></script>

    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

    <script>
       const dragArea = document.querySelector(".fee-stracture-body");
       new Sortable(dragArea, {
          animation: 350 
       });
    </script>
@endsection


@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Set Fees Stracture</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Set Fees Stracture</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- All Subjects Area Start Here -->
                    <div class="row">
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Class Fees Stracture</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                          
                                    <div class="row gutters-8">
                                        <div class="col-10 form-group">
                                            <select name="class p-4" class="select-class class-select" style="height:50px;width:100%; padding:10px;">
                                                <option value="">Search By Class</option>
                                            </select>
                                        </div>
                                        <div class="col-2 form-group">
                                           <button class="btn h-100 w-100 add-fee-btn">ADD FEE</button>
                                        </div>
                                    </div>
 
                                <form class="fee-structure-form" >
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
 
                                        <tbody class="fee-stracture-body">
                                            <tr>
                                                <th>S No</th><th>Trash</th><th>Fee Type</th><th>₹ Baishakh </th><th>₹ Jestha</th><th>₹ Ashadh</th><th>₹ Shrawan</th>
                                                <th>₹ Bhadau</th><th>₹ Asoj</th><th>₹ Kartik</th><th>₹ Mangsir</th><th>₹ Poush</th><th>₹ Magh</th><th>₹ Falgun</th><th>₹ Chaitra</th>
                                            </tr>    
                                        </tbody> 

                                    </table>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->


@endsection
