@extends('Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
@endsection

@section('script')
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/fees/ajax-fee-payment.js')}}"></script>
    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}"></script> 

    <!-- ajax get class all roll for roll-select-->
    <script src="{{ asset('../admin_lang/classes/get-class-roll.js')}}"></script> 


    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
@endsection


@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Fees Student</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Fees Payment</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- All Subjects Area Start Here -->
                    <div class="row">
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Select Student</h3>
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
                                <form class="set-fe-form">
                                    <div class="row">

 
                                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Class *</label>
                                            <select name="class" class="selec2 class-select" style="height:50px;width:100%; padding:10px;">
 
                                            </select>
                                        </div>
 
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Roll *</label>
                                            <select name="period" class="select2 roll-select">
                                                <option value="">Please Select Roll No:</option>
                                            </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Period *</label>
                                            <select name="period" class="select2">
                                                <option value="">Please Select</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly (3 Months)">Quarterly (3 Months)</option>
                                                <option value="Half Yearly (6 Months)">Half Yearly (6 Months)</option>
                                                <option value="Annually (12 Months)">Annually (12 Months)</option>
                                            </select>
                                        </div>
              
                                        <!-- <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                   <div class="item-title">
                                        <h3>Bill Student</h3>
                                    </div>
                                    <div>
                                        <div class="row">
                                           <div class="col-12-xxxl col-lg-3 col-12 form-group">1</div>
                                           <div class="col-12-xxxl col-lg-3 col-12 form-group">1</div>
                                           <div class="col-12-xxxl col-lg-3 col-12 form-group">1</div>
                                           <div class="col-12-xxxl col-lg-3 col-12 form-group">1</div>
                                        </div>
                                    </div>
            
   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->


@endsection
