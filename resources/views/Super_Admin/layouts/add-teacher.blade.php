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
    <script src="{{ asset('../admin_lang/teacher/ajax-add-teacher.js')}}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}"></script> 

    <!-- script input file image set preview img  -->
    <script src="{{ asset('../admin_lang/common/image-select.js')}}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
@endsection


@section('contents')
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
        <h3>Teacher</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Add New Teacher</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                   <!-- Add New Teacher Area Start Here -->
                   <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Teacher</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <form class="teacher-added-form" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-xl-3 col-lg-6 col-12 form-group d-flex flex-column align-items-center justify-content-center" style="height:110px;">
                                    <label>Teacher Photo *</label>
                                    <div class="position-relative" style="height:80%; width:100px;">
                                       <img src="#" class="h-100 w-100 imagepreview" style="position:absolute;">
                                       <input type="file" name="image" class="form-control-file imageinput" style="height:100px; width:100px;opacity: 0;">
                                    </div>
                                 </div>

                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name"  placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Gender </label>
                                    <select name="gender" class="select2">
                                        <option value="">Please Select Gender *</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Of Birth *</label>
                                    <input type="text" name="dob" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
                                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Religion</label>
                                    <select class="select2" name="religion">
                                        <option value="">Please Select Religion *</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Buddish">Buddish</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Blood Group</label>
                                    <select class="select2" name="blood_group">
                                        <option value="">Please Select Group *</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Qualification</label>
                                    <input type="text" name="qualification"   class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Joining Date *</label>
                                    <input type="text" name="joining_date" placeholder="dd/mm/yyyy" class="form-control nepali-datepicker">
                                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Salary</label>
                                    <input type="number" name="salary" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Teacher</label>
                                    <select class="select2 class-select" name="class_teacher">
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Section</label>
                                    <select class="select2" name="section">
                                        <option value="">Please Select Section *</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                    </select>
                                </div>

 
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Teacher Area End Here -->
@endsection