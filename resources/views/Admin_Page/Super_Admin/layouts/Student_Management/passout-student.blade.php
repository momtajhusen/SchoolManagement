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
 
    <!-- ajax get all class -->
    <script src="{{ asset('../admin_lang/student/ajax-passout-student.js')}}?v={{ time() }}"></script> 
 
        <!-- ajax ajax-re-enter-->
        <script src="{{ asset('../admin_lang/kick-out/ajax-re-enter.js')}}?v={{ time() }}"></script> 


    <!-- Select 2 Js -->
    <script src="{{ asset('../admin_template_assets/js/select2.min.js')}}"></script>

    <!-- Date Picker Js -->
    <script src="{{ asset('../admin_template_assets/js/datepicker.min.js')}}"></script>

 
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
@endsection


@section('contents')

    <!-- All Payment Table -->
    <div class="row">
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Select Passout Student</h3>
                        </div>
                    </div>
    
                        <div class="row">
                            <div class=" col-lg-3 col-12 form-group">
                                <label>Passout Year *</label>
                                <select name="class" class="select2 select-year" id="select-year">
    
                                </select>
                            </div>
                        <div class=" col-lg-3 col-12 form-group">
                                <label>Class *</label>
                                <select name="class" class="select2 class-select" id="class-select" style="height:50px;width:100%; padding:10px;background:#f0f1f3;border:0px;">
                                    <option value="">Passout Class :</option>
                                </select>
                            </div>
    
                            <div class="roll-box col-lg-3 col-12 form-group animate__animated">
                                <label>Select Student *</label>
                                <select name="period" class="select2 student-select">
                                    <option value="">Passout Student :</option>
                                </select>
                            </div>
                            <input type="hidden" id="student_id" value="0">
                            <div class="col-lg-3 col-12 form-group" >
                                <br>
                                <button class="fw-btn-fill btn-gradient-yellow btn search-btn form-group animate__animated" style="height:50px">SEARCH</button>
                            </div>
                        </div>
                </div>
        </div>
    </div>

        {{-- History and Back YearDues  --}}
        <div class="card ui-tab-card w-100 py-0 my-0 " id="payment-history">
            <div class="card-body shadow-none w-100 py-4 px-4">
                <div class="border-nav-tab">
                    <ul class="nav nav-tabs border-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link shadow-none border active d-flex" id="history-btn" data-toggle="tab" href="#tab9" role="tab" aria-selected="false">
                                Student Details
                                <span class="material-symbols-outlined mt-1 mx-2">person</span>
                            </a>
                        </li>
                        <li class="nav-item" id="back-year-btn" st_id="#">
                            <a class="nav-link shadow-none border d-flex" data-toggle="tab" href="#tab8" role="tab" aria-selected="false">
                                Check Fee
                                <span class="material-symbols-outlined  mx-2">payments</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab8" role="tabpanel">
                            <table class="table table-dark table-hover table-sm">
                                <thead>
                                    <tr style="background-color: #000">
                                        <th scope="col">SN:</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Total Fee</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Dues</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="back-year-fee-table">
        
                                </tbody>
                            </table>
        
                        </div>
                        
                        <div class="tab-pane fade show active " id="tab9" role="tabpanel">
                             <div class="row">
                               <div class="p-2 border col-3 col-md-2"> 
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                    <img class="p-1 student_img" src="http://bit.ly/3IUenmf" style="height:80px;border:3px solid #000;" alt="">
                                </div>
                             </div>
                             <div class="border col-9 col-md-3 "> 
                                <div class="p-2">
                                    <div>
                                        <b>Name :</b>
                                        <span class="student-name"></span>
                                    </div>
                                    <div>
                                        <b>Passout Class :</b>
                                        <span class="passout-class"></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <b>St Id :</b>
                                            <span class="st_id"></span>
                                        </div>
                                        <button type="button" id="re-enter-btn" st_id="#" class="btn btn-secondary">Re Enter</button>
    
                                    </div>

                                </div>
                            </div>
 
                        </div>
        
                    </div>
                </div>
            </div>
            </div>
            {{-- History and Back YearDues  --}}

@endsection