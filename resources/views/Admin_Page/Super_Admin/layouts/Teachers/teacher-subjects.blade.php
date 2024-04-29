@extends('Admin_Page/Super_Admin/admin_template')

@section('script')

    <!-- ajax all teacher -->
    <script src="{{ asset('../admin_lang/teacher/ajax-teacher-subject.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all for class-select -->
    <script src="{{ asset('../admin_lang/classes/get-all-class.js')}}?v={{ time() }}"></script> 

    <!-- ajax get all subject  -->
    <script src="{{ asset('../admin_lang/subject/ajax-get-all-subject.js')}}?v={{ time() }}"></script> 

@endsection

@section('contents')

      <!-- All Subjects Area Start Here -->
      <div class="row">
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Assign Subject </h3>
                                    </div>
                                </div>
                                <form class="added-teacher-subject-form">
                                    <div class="row">
                                    <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Select Teacher *</label>
                                                <select name="teacher" required class="select teacher-select" id="teacher-select-add" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                                               </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Select Class</label>
                                            <select name="class" required class="select2 class-select subject-class"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                <option value="">Please Select</option>
                                            </select>
                                        </div>
 
                                        <div class="col-12-xxxl col-lg-3 col-12 form-group">
                                            <label>Select Subject</label>
                                            <select name="subject" required class="select2 select-subject" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
                                                <option value="">Please Select</option>
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
                                        <h3>Teacher Subjects</h3>
                                    </div>
                                </div>
                                <form class="mg-b-20 search-teacher-subject-form"">
                                    <div class="row gutters-8">
                                        <div class="col-lg-10 col-12 form-group">
                                             <label>Select Teacher *</label> 
                                                <select name="class" required class="select2 teacher-select" id="teacher-select-search"  style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">
 
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-12 form-group">
                                            <br>
                                            <button type="submit" class="fw-btn-fill btn-gradient-yellow" id="teacher-select-btn">SEARCH</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap table-sm">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="teacher-subject-table">
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@endsection