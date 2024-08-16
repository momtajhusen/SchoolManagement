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
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/student_management/ajax-registration-list.js')}}?v={{ time() }}"></script>

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
        <h3>Registration List</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Registration List</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- Teacher Table Area Start Here -->
                    <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>All Student Data</h3>
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
                    
                                <div class="row gutters-8">
                                    <div class="col-xl-5 col-lg-6 col-12 form-group">
                                        <label>Year </label>
                                        <select name="student_gender" required class="select2 gender-select select-year" style="height:50px;width:100%; padding:10px;">
                                
                                        </select>
                                    </div>
                                    <div class="col-xl-5 col-lg-6 col-12 form-group">
                                        <label>Month </label>
                                        <select name="student_gender" required class="select2 select-month" style="height:50px;width:100%; padding:10px;">
                                            <option value="0" class="bg-dark text-light p-4">Baishakh</option>
                                            <option value="1" class="bg-dark text-light">Jestha</option>
                                            <option value="2" class="bg-dark text-light">Ashadh</option>
                                            <option value="3" class="bg-dark text-light">Shrawan</option>
                                            <option value="4" class="bg-dark text-light">Bhadau</option>
                                            <option value="5" class="bg-dark text-light">Asoj</option>
                                            <option value="6" class="bg-dark text-light">Kartik</option>
                                            <option value="7" class="bg-dark text-light">Mangsir</option>
                                            <option value="8" class="bg-dark text-light">Poush</option>
                                            <option value="9" class="bg-dark text-light">Magh</option>
                                            <option value="10" class="bg-dark text-light">Falgun</option>
                                            <option value="11" class="bg-dark text-light">Chaitra</option>
                              
                                        </select>
                                    </div>
                                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                        <br>
                                        <button class="fw-btn-fill btn-gradient-yellow my-3 search-btn">SEARCH</button>
                                    </div>
                                </div>
 
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
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Father</th>
                                            <th>Address</th>
                                            <th>Date Of Birth</th>
                                            <th>Student Phone</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- Teacher Table Area End Here -->

@endsection
