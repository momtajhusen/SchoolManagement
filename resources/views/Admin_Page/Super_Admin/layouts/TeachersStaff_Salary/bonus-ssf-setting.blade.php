@extends('Admin_Page/Super_Admin/admin_template')

@section('script')
    <!-- ajax-bonus-epf-setting-->
    <script src="{{ asset('../admin_lang/TeachersStaffSalary/ajax-bonus-epf-setting.js')}}?v={{ time() }}"></script> 
 
@endsection


@section('contents')
<div class="card height-auto">
    <div class="card-body">
         <div class="row">

            <div class="col-12 col-md-5">
                <h4 class="mb-1">Bonus & SST Setting</h4>
               <div class="border p-2 mb-5">
                <form class="bonus-attendance-form">

                    <div class="bg-secondary text-light col-12 form-group border p-2">
                        {{-- <div class="border-bottom p-2">Social Service Tax (SST)</div> --}}
                        <div class="border p-2">
                            <label>Social Service Tax (SST)  %</label>
                            <input type="number" min="1" max="99" required maxlength="20" name="ssf_per" placeholder="percent" class="form-control">
                        </div>
                    </div>

                    <div class="bg-secondary text-light col-12 form-group border p-2">
                        <div class="border-bottom p-2">Bonus Attendance (BA)</div>
                        <div class="d-flex border p-2">
                            <div class="w-50">
                                <label>Attendance %</label>
                                <input type="number" min="1" max="100"  required maxlength="20" name="bouns_attend" placeholder="percent" class="form-control">
                            </div>
                            <div class="w-50 ml-1">
                                <label>% for Bonus salary</label>
                                <input type="text" min="1" max="99" required maxlength="20" name="bouns_per" placeholder="percent" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary text-light col-12 form-group border p-2">
                        <div class="border-bottom p-2">Leave and Salary (LS)</div>
                        <div class="d-flex border p-2">
                            <div class="w-50">
                                <label>Leave %</label>
                                <input type="text" min="1" max="100"  required maxlength="20" name="leave_per" placeholder="percent" class="form-control">
                            </div>
                            <div class="w-50 ml-1">
                                <label>Salary %</label>
                                <input type="number" min="1" max="100"  required maxlength="20" name="leave_salary" placeholder="percent" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="w-100 btn-fill-lg btn-gradient-yellow btn-hover-bluedark submit-btn">Save</button>
                    </div>

                </form>
               </div>
            </div>

            <div class="col-12 col-md-7">
                <h4 class="mb-1">SSF, Bonus, Leave apply for Employee</h4>
                  <div class="border p-2 mb-5">
                    <table class="table table-bordered table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Teachers/Staff</th>
                            <th scope="col">Role</th>
                            <th scope="col">SST</th>
                            <th scope="col">BA</th>
                            <th scope="col">LS</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-body">
                           
                        </tbody>
                      </table>
                      <div class="col-12 form-group mg-t-8">
                        <button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" id='save-all-emp'>Save All</button>
                    </div>
                  </div>
            </div>


            </div>
         </div>
    </div>
</div>

@endsection
