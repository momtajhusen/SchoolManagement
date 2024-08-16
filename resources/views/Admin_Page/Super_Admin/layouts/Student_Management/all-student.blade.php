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
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/student/ajax-get-all-student.js')}}?v={{ time() }}"></script>

    <!-- ajax Kick Out -->
    <script src="{{ asset('../admin_lang/kick-out/ajax-kick-out.js')}}?v={{ time() }}"></script>

    <!-- ajax print admission  -->
    <script src="{{ asset('../admin_lang/student/ajax-print-admission.js')}}?v={{ time() }}"></script>

    <!-- ajax delete-student admission  -->
    <script src="{{ asset('../admin_lang/student/ajax-delete-student.js')}}?v={{ time() }}"></script>

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}?v={{ time() }}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

    {{-- Sorting Script  --}}
    <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>

@endsection

@section('contents')
 
                    <!-- Teacher Table Area Start Here -->
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Student</h3>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kick Out Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" id="st_id-input">
                                    <div class="col-12 form-group">
                                        <label>Kick Out Month</label>
                                        <select class="select2" required name="month" id="month">
                                            <option value="">Please Select Month *</option>
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
                                    {{-- <div class="col-6 form-group">
                                        <label>Total Fee</label>
                                        <input type="text" required name="roll_no" placeholder="total fee" class="form-control student_roll">
                                    </div>

                                    <div class="col-6 form-group">
                                        <label>Payment</label>
                                        <input type="text" required name="roll_no" placeholder="total fee" class="form-control student_roll">
                                    </div>

                                    <div class="col-6 form-group">
                                        <label>Discount</label>
                                        <input type="text" required name="roll_no" placeholder="total fee" class="form-control student_roll">
                                    </div>

                                    <div class="col-6 form-group">
                                        <label>Dues</label>
                                        <input type="text" required name="roll_no" placeholder="total fee" class="form-control student_roll">
                                    </div> --}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary p-2 px-3" data-dismiss="modal">Cancle</button>
                                <button type="button" class="btn btn-primary p-2 px-3" id="model-save-btn">Kick Out</button>
                            </div>
                            </div>
                        </div>
                        </div>
 
                   
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row gutters-8">
                                    {{-- <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                        <input type="text" placeholder="Search by ID ..." class="form-control">
                                    </div> --}}
                                    <div class="col-lg-5 col-12 form-group">
                                        <select class="select2 student-search-select" name="student_blood_group">
                                            <option value="">Select for search</option>
                                            <option value="class">Class Name</option>
                                            <option value="first_name">St First Name</option>
                                            <option value="village">Village Name</option>
                                            <option value="phone">Student Mobile</option>
                                            <option value="email">Student Email</option>
                                            <option value="id">st_id</option>
                                            <option value="parents_id">pr_Id</option>
                                            <option value="hostel_outi">hostel_outi</option>
                                            <option value="admission_date">Admission Date</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 col-12 form-group d-none" id="input-class-col">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Student First Name ..." class="form-control student-input-search" id="student-input" style="height:100%;background:#f0f1f3;">
                                    </div>
        
                                    <div class="col-lg-5 col-12 form-group" id="select-class-col">
                                        <select name="class" required class="select2 class-select  student-input-search" id="class-select" style="height:50px;width:100%; padding:10px;">
            
                                        </select>
                                    </div>
        
                                    <div class="col-lg-5 col-12 form-group d-none" id="select-hostel-col">
                                        <select name="hostel" required class="select2 student-input-search" id="hostel-select" style="height:50px;width:100%; padding:10px;">
                                           <option value="full-hostel">full-hostel</option>
                                            <option value="half-hostel">half-hostel</option>
                                            <option value="outi">outi</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-12 form-group admission-class-col d-none">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Admission From Date" class="form-control currentSatrtDate" id="from-admission-date" style="background:#f0f1f3;">
                                    </div>
                                    <div class="col-lg-3 col-12 form-group admission-class-col d-none">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Admission To Date" class="form-control currentDate" id="to-admission-date" style="background:#f0f1f3;">
                                    </div>
                                    
        
                                    <div class="col-lg-2 col-12 form-group">
                                        <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-student d-flex justify-content-center align-items-center search-btn" style="height:100%;">SEARCH</div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="pl-1">
                                        <span>Total Result :</span>
                                        <span class="result_no"></span>
        
                                    </div>
                                    
                                </div>
                            </div>
 
                 


                        <div class="table-responsive" style="position:relative;">
                        <div class="d-flex">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="border-radius: 0%; box-shadow:none;">
                        </div>
                            <table class="table display data-table text-nowrap table-sm exportTable sortable-table" id="myTable">
                                <thead>
                                    <tr class='text-center'> 
                                        <th data-column="0">st_id.</th>
                                        <th data-column="1">Photo</th>
                                        <th data-column="2">Name</th>
                                        <th data-column="3">Gender</th>
                                        <th data-column="4">DOB</th>
                                        <th data-column="5">Class</th>
                                        <th data-column="6">Roll</th>
                                        <th data-column="7">Section</th>
                                        <th data-column="8">Admission Date</th>
                                        <th data-column="9">pr_id.</th>
                                        <th data-column="10">Father Name</th>
                                        <th data-column="11">Address</th>
                                        <th data-column="11">Student Phone</th>
                                        <th>
                                            <div class="d-flex flex-column align-items-center ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 15px; float: left">
                                                <span class="material-symbols-outlined p-1" id="btnCsvExport">file_save</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body sortable-bordy" style="height:150px;">
           
                                </tbody>
                            </table>
                        </div>

                        <nav class="mt-3" aria-label="Page navigation example">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">Previous</span>
                                </a>
                              </li>
                              <div class="d-flex pagnation-box">
            
                              </div>
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </li>
                            </ul>
                          </nav>

                    </div>
                </div>
                <!-- Teacher Table Area End Here -->


                




@endsection
