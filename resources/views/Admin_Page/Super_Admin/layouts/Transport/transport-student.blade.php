@extends('Admin_Page/Super_Admin/admin_template')

@section('script')

    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/Transport/ajax-get-transport-student.js')}}?v={{ time() }}"></script> 

 

@endsection



@section('contents')

    <!-- Transport Student -->
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Transport Students</h3>
                        </div>
                    </div>
                    <form class="mg-b-20 search-transport">
                        <div class="row gutters-8">
                            <div class="col-lg-10 col-12 form-group">
                                {{-- <label>Select Root *</label> --}}
                                    <select name="vehicle_root" required class="select2" id="root_select" style="height:50px;width:100%; padding:10px;background:#f8f8f8; outline: none; border:none;">

                                    </select>
                            <div><span class="root-name"></span> Result : </span><span class="count-student"></span></div>


                                <!-- <select name="vehicle_root" class="select2" id="root_select"> -->
                            </select>
                            </div>

                            <div class="col-lg-2 col-12 form-group">
                                <button type="submit" id="search-btn" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                    <table class="table display data-table text-nowrap table-sm exportTable">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>st_id</th>
                                <th>student name</th>
                                <th>class</th>
                                <th>village</th>
                                <th>
                                    <div class="d-flex flex-column align-items-center ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 15px; float: left">
                                        <span class="material-symbols-outlined p-1" id="btnCsvExport">file_save</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="transport-student-table expense-total-report">

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- All Subjects Area End Here -->
 

@endsection
