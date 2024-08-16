@extends('Admin_Page/Super_Admin/admin_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        input[type=number] {
        -moz-appearance: textfield; /* Firefox */
        }
    </style>
@endsection



@section('script')

    <!-- ajax Marks Entry -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_new_marks_entry.js')}}?v={{ time() }}"></script> 

    <!-- ajax Get All Exam Term -->
    <script src="{{ asset('../admin_lang/Exam_Management/ajax_get_exam_term.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all subject  -->
    <script src="{{ asset('../admin_lang/subject/ajax-get-all-subject.js')}}?v={{ time() }}"></script> 

       {{-- Sorting Script  --}}
   <script src="{{ asset('../admin_lang/common/sorting-script.js')}}?v={{ time() }}"></script>
 

@endsection




 
@section('contents')

                <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Manage Exam Marks</h3>
                                    </div>
                                </div>

                                <form class="mg-b-20 search-student">
                                    <div class="row gutters-8">
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Exam *</label>
                                            <select name="exam" required class="select2 select-process-term" id="select_exam" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
<<<<<<< HEAD

    
=======
                                                
>>>>>>> 0981ca2f451b75d53f172842175003e92a932ce3
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <label>Class *</label>
                                            <select name="class" required class="select2 class-select search-class-subject" id="class-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
    
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <label>Section *</label>
                                            <select name="class" required class="select2 section-select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                <option value="">Select Section *</option>
    
                                        </select>
                                        </div>
                                        <div class="col-lg-3 col-12 form-group">
                                            <label>Subject *</label>
                                            <select name="class" required class="select2 select-subject" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
    
                                        </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group d-flex align-items-end">
                                            <button type="submit" id="search-btn" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="SEARCH">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                        
                                <form class="table-responsive entry-mark-form d-none">
                                    <table class="table data-table text-nowrap table-sm sortable-table">
                                        <thead>
                                            <tr>
                                                <th data-column="0">SN.</th>
                                                <th data-column="1">st_id.</th>
                                                <th data-column="2">Name</th>
                                                {{-- <th>Parent</th> --}}
                                                <th data-column="3">Marks Obtained</th>
                                                <th data-column="4">Total Marks</th>
                                                <th data-column="5">Minimum Marks</th>
                                                <th data-column="6">Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center border" colspan="3">
                                                    <input type="text" id="searchInput" class="form-control" placeholder="Student Search..." style="border-radius: 0%; box-shadow:none;">
                                                </td>
                                                <td class="text-center border" colspan="4">Subject: <span id="enter-subject"></span></td>
                                            </tr>
                                        </tbody>
                                        <tbody class=" sortable-bordy">
                        
                                        </tbody>
                                    </table>
                                    <div class="col-lg-2 col-12 form-group d-flex align-items-end">
                                        <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2" visitorbtn="btn" btnName="Save Result">Save Result</button>
                                    </div>
                                </form>

                                <form class="table-responsive entry-mark-form">
                                <div class="container">
                                    <div class="row">
                                      <div class="col">
                                        <table class="table table-bordered text-center text-nowrap table-responsive-md sortable-table">
                                          <thead>
                                            <tr>
                                              <th rowspan="2">S.N</th>
                                              <th rowspan="2">
                                                <span>Students</span>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Student Search..." style="border-radius: 0%; box-shadow:none;height:30px;font-size:14px;">
                                              </th>
                                              <th colspan="2" class="text-center">Total Marks</th>
                                              <th colspan="2" class="text-center">Pass Marks</th>
                                              <th colspan="2" class="text-center">Obtained Marks</th>
                                            </tr>
                                            <tr>
                                              <th class="text-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <span style="font-size: 12px;">TH</span>
                                                    <input class="text-center p-1" required min="1" step="0.01" id="total_th" type="number" style="width:40px;height:25px;font-size:12px;outline:none;">
                                                </div>
                                              </th>
                                              <th class="text-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <span style="font-size: 12px;">PR</span>
                                                    <input class="text-center p-1" min='0' step="0.01" id="total_pr" type="number" style="width:40px;height:25px;font-size:12px;outline:none;">
                                                </div>
                                              </th>
                                              <th class="text-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <span style="font-size: 12px;">TH</span>
                                                    <input class="text-center p-1" required min='1' id="pass_th" type="number" style="width:40px;height:25px;font-size:12px;outline:none;">
                                                </div>
                                              </th>
                                              <th class="text-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center">
                                                    <span style="font-size: 12px;">PR</span>
                                                    <input class="text-center p-1"  min='0' id="pass_pr" type="number" style="width:40px;height:25px;font-size:12px;outline:none;">
                                                </div>
                                              </th>
                                              <th class="text-center">Th</th>
                                              <th class="text-center">Pr</th>
                                            </tr>
                                          </thead>
                                          <tbody class="marks-entry sortable-bordy">
 
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-2 col-12 form-group d-flex align-items-end">
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow py-2 save-btn d-none" visitorbtn="btn" btnName="Save Result">Save Result</button>
                                  </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
@endsection
