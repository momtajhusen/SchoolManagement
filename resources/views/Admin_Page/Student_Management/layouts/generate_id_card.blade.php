@extends('Admin_Page/Student_Management/student_management_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

 
@endsection

@section('script')
    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- ajax get class roll -->
    <script src="{{ asset('../admin_lang/classes/get-class-roll.js')}}?v={{ time() }}"></script> 
 
    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>

    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>
@endsection


@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Generate Id Card</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Generate Id Card</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
                        <!-- All Subjects Area Start Here -->
                        <div class="row">
                            <div class="col-4-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title d-flex justify-content-between w-100">
                                                <h3>Select Class</h3>  
                                            </div>
                                        </div>
                                       
                                            <div class="row">
        
                                                <div class="col-10-xxxl col-lg-5 col-12 form-group">
                                                    <label>Select Class *</label>
                                                    <select name="period" class="class-select select2"  style="height:50px;width:100%; padding:10px;">
                                                    </select>
                                                </div>
                                                <div class="col-5-xxxl col-lg-5 col-12 form-group">
                                                    <label>Roll No *</label>
                                                    <select name="period" class="roll-select select2"  style="height:50px;width:100%; padding:10px;">
                                                    </select>
                                                </div>
                                                <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group" >
                                                       <br>
                                                      <button class="fw-btn-fill btn-gradient-yellow btn search-btn" style="height:50px">GENERATE ID</button>
                                                 </div>
                                            </div>
                                                <!-- <div class="col-12 form-group mg-t-8">
                                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                                </div> -->
                                            </div>
                                      
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                        <!-- All Subjects Area End Here -->
 





@endsection
