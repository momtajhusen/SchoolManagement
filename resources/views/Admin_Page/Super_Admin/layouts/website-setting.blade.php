@extends('Admin_Page/Super_Admin/admin_template')
 

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

@endsection

@section('script')

    <!-- ajax school Details  -->
    <script src="{{ asset('../admin_lang/school_details/ajax_school_details.js')}}?v={{ time() }}"></script> 

    <!-- ajax date setting  -->
    <script src="{{ asset('../admin_lang/school_details/ajax_date_setting.js')}}?v={{ time() }}"></script> 
 
    <!-- script image Crope preview img  -->
    <script src="{{ asset('../admin_lang/common/ImageCrope/School-Details-Crop.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <style>
    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid white;
    }
    </style>
  
@endsection


@section('contents')

    {{-- School Logo Crope Model  --}}
    <div class="modal fade" id="schoolo-logo-modal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color:#042954;z-index:1000;">
                <div class="modal-header">
                    <h5 class="modal-title text-light" id="cropModalLabel">Crop Image</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="schoolo-logo-sample-img" src="" alt="Crop Image">
                        </div>
                        <div class="col-md-4">
                            <div id="logo_preview" class="preview"></div>
                        </div>
            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark p-4 px-5" id="student-model-cancle" data-dismiss="modal" style="font-size: 20px;">Cancel</button>
                    <button type="button" class="btn btn-success p-4 px-5 text-lg d-flex" id="logo-crop" style="z-index:100">
                        <span style="font-size: 20px;" class="crop-text">CROP</span> 
                        <span class="material-symbols-outlined mt-2 mx-2 crop-icon">crop_free</span>
                        <i class="fa fa-spinner fa-spin mt-2 mx-2 d-none crop-loading" style="font-size:20px;color:rgb(255, 255, 255)"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- School Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1 pt-3">
                <div class="item-title">
                    <h4>School Details</h4>
                </div>
            </div>
            <form class="school-details-form" enctype="multipart/form-data">
                <div class="row">


                    <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center">
                        <label>School Logo *</label>
                        <div class="h-100 position-relative" style="height:60px; width:100px;border:5px ridge black; box-shadow: -8px 7px 7px -3px rgba(0,0,0,0.43);">
                            <img src="https://as2.ftcdn.net/v2/jpg/02/70/97/55/1000_F_270975504_Vh1pbNgw99cMA0NxtQLKB2hL6bllDTeZ.jpg" id="schoolo_logo_preview" class="h-100 w-100" style="position:absolute;">
                            <input type="file" id="logo_img_input" name="logo_img" class="form-control-file" style="height:100px; width:100px;opacity: 0;">
                            <label class="p-0 m-0 w-100 text-center bg-dark text-light" for="logo_img_input" style="position:absolute;bottom:0px;width:100px;z-index:1;opacity: 0.5;">UPLOAD</label>
                        </div>
                    </div>

            
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>School Name *</label>
                        <input type="text" maxlength="50" required name="school_name" placeholder="First Name" class="form-control">
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input type="number"  name="phone" id="student_number" placeholder="Phone" class="form-control mobile-number">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail *</label>
                        <input type="email" maxlength="40" id="student-email" required name="email" placeholder="Email" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address *</label>
                        <input type="text" maxlength="40" id="student-email" required name="address" placeholder="Address" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Website *</label>
                        <input type="text" maxlength="40" id="student-email" required name="website" placeholder="wwww.school.com" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Pan No</label>
                        <input type="number"  name="pan_no" id="pan_no" placeholder="Pan no" class="form-control pan-no">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Estd Year</label>
                        <input type="number"  name="estd_year" id="estd_year" placeholder="Estd Year" class="form-control estd-year">
                    </div>


                    <div class="col-12 form-group mg-t-8 d-flex justify-content-end">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                    </div>
        </div>
    </form>
    </div>

        <!-- School date setting Area Start Here -->
        <div class="card height-auto mt-5 deve-use">
            <div class="card-body">
                <div class="heading-layout1 pt-3">
                    <div class="item-title">
                        <h4>Date Setting</h4>
                    </div>
                </div>
                <form class="date-setting-form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Set Date Use *</label>
                            <select name="use_date" required class="select use_date p-2" style="height:45px; width:200px;background:#f0f1f3;">
                                <option value="internet-date">Internet Date</option>
                                <option value="my-date">My Date</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Years *</label>
                            <select name="year" required class="select year p-2" style="height:45px; width:200px;background:#f0f1f3;">
                                <option value="2078">2078</option>
                                <option value="2079">2079</option>
                                <option value="2080">2080</option>
                                <option value="2081">2081</option>
                                <option value="2082">2082</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Months *</label>
                            <select name="months" required class="select months p-2" style="height:45px; width:200px;background:#f0f1f3;">
                                <option value="1">Baishakh</option>
                                <option value="2">Jestha</option>
                                <option value="3">Ashadh</option>
                                <option value="4">Shrawan</option>
                                <option value="5">Bhadau</option>
                                <option value="6">Asoj</option>
                                <option value="7">Kartik</option>
                                <option value="8">Mangsir</option>
                                <option value="9">Poush</option>
                                <option value="10">Magh</option>
                                <option value="11">Falgun</option>
                                <option value="12">Chaitra</option>
                            </select>
                        </div>

                        

    
                        <div class="col-12 form-group mg-t-8 d-flex justify-content-end">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                        </div>
            </div>
        </form>

        </div>
        
       
    {{-- progress bar with alert --}}
    <div class="progress w-100 d-none" style="height:30px;">
    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>
    
    <div class="alert alert-success  align-items-center alert-info d-none" role="alert">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi mr-3 bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="success:">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
        <b>Upload Success</b>
        </div>
    </div>

          
                    </div>
                </form>
            </div>
        </div>
@endsection