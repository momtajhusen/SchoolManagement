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

       {{-- ago time calculate  --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

      <!-- ajax visitorActivityData -->
      <script src="{{ asset('../admin_lang/visitorActivityData/ajax-page-activity.js')}}?v={{ time() }}"></script>
      
@endsection

@section('contents')

<div class="row">
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <h4>Visitor Page Activity</h4>

               <div class="row gutters-8">
                <div class="col-lg-5 col-12 form-group">
                    <label>Select from date*</label>
                    <input type="text" required maxlength="10" name="activity_start_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker activity_start_date">
                    <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>

                <div class="col-lg-5 col-12 form-group">
                  <label>Select to date*</label>
                  <input type="text" required maxlength="10" name="activity_end_date" placeholder="yyyy-mm-dd" value="" class="form-control nepali-datepicker activity_end_date">
                  <i class="far fa-calendar-alt" style="position:absolute;top:45px;right:30px;"></i>
                </div>

                <div class="col-lg-2 col-12 form-group">
                    <br>
                    <button class="fw-btn-fill btn-gradient-yellow" id="search-btn">SEARCH</button>
                </div>
            </div>

            <div class="w-100" style="overflow:auto;">
               <table class="table table-sm" style="width:1300px;">
                <div class="d-flex justify-content-between">
                  <div class="d-flex"><b>Total Page Activity: </b><b class="total-expense">0</b></div>

                  <div class="d-flex">
                    <select class="form-control" id="visitor-name">
                      <option value="A-Z">A-Z</option>
                    </select>
                    <select class="form-control" id="select-spend">
                      <option value="wating_second">Spend</option>
                      <option value="load_count">Load</option>
                      <option value="last_time">Last</option>
                    </select>
                  </div>
                </div>

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Page</th>
                    <th scope="col">Load</th>
                    <th scope="col">Spend</th>
                    <th scope="col">Date</th>
                    <th scope="col">Device</th>
                    <th scope="col">Browser</th>
                    <th scope="col">Last Time</th>
                    <th scope="col">Time Ago</th>
                    <th scope="col">Address</th>
                  </tr>
                </thead>
                <tbody class="activity-report-table">
                   
                </tbody>
               </table>
            </div>

           
            </div>
        </div>
    </div>
</div>


@endsection
