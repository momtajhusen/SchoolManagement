@extends('Super_Admin/admin_template')

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
    <!-- ajax add subject -->
    <script src="{{ asset('../admin_lang/subject/ajax-add-subject.js')}}"></script> 
    <!-- ajax get all subject  -->
    <script src="{{ asset('../admin_lang/subject/ajax-get-all-subject.js')}}"></script> 
    <!-- ajax delete subject  -->
    <script src="{{ asset('../admin_lang/subject/ajax-delete-subject.js')}}"></script> 
    <!-- ajax Edit subject  -->
    <script src="{{ asset('../admin_lang/subject/ajax-update-subject.js')}}"></script> 
    <!-- script update subject  -->
    <script src="{{ asset('../admin_lang/subject/script-edit-subject.js')}}"></script> 
    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.dataTables.min.js')}}"></script>
@endsection


@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>All Subjects</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Subjects</li>
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
                                        <h3>Add New Subject</h3>
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
                                <form class="added-subject-form">
                                    <div class="row">
                                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Select Class *</label>
                                            {{-- <select name="class" required class="select class-select"> --}}
                                                <select name="class" required class="selec2 class-select" style="height:45px;width:100%; padding:10px;">
 
                                            </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Subject Name *</label>
                                            <input type="text" required  maxlength="30" name="subject_name" placeholder="" class="form-contro subject_name" style="height:45px;width:100%; padding:10px;">
                                        </div>
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Subject Teacher *</label>
                                            <select name="subject_teacher" id="subject_teacher" class="selec2" style="height:45px;width:100%; padding:10px;">

                                                <option value="">Please Select</option>
                                                <option value="Momtaj">Momtaj</option>
                                                <option value="Sadam">Sadam</option>
                                                <option value="Bijay">Bijay</option>
                                                <option value="Momtaj">Momtaj</option>
                                                <option value="Sadam">Sadam</option>
                                            </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Select Code</label>
                                            <select name="subject_code" id="subject_code" class="selec2" style="height:45px;width:100%; padding:10px;">

                                                <option value="">Please Select</option>
                                                <option value="00524">00524</option>
                                                <option value="00525">00525</option>
                                                <option value="00526">00526</option>
                                                <option value="00527">00527</option>
                                                <option value="00528">00528</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark upload-btn">Save</button>
                                            <div class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark update-btn d-none">Update</div>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
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
                                        <h3>All Subjects</h3>
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
                                <form class="mg-b-20">
                                    <div class="row gutters-8">
                                        <div class="col-lg-4 col-12 form-group">
                                            <input type="text" placeholder="Search by Exam ..." class="form-control">
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <input type="text" placeholder="Search by Subject ..." class="form-control">
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <input type="text" placeholder="dd/mm/yyyy" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <button type="submit"
                                                class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkAll">
                                                        <label class="form-check-label">ID</label>
                                                    </div>
                                                </th>
                                                <th>Subject Name</th>
                                                <th>Class</th>
                                                <th>Subject Teacher</th>
                                                <th>Subject Code</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->


@endsection
