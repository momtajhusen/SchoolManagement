@extends('Admin_Page/Super_Admin/admin_template')


@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

    <style>
   .reg_no,
   .blood_group,
    .roll_no,
   .hostel_outi,
    .vehicle_root,
    .coaching{
      width: 40px;
    }

    .first_name,
    .middle_name,
    .last_name,
    .district {
        width: 130px;
    }

    .gender,
    .religion {
        width: 70px;
    }

    .admission_date,
    .dob,
    .class {
        width: 90px;
    }
    .section {
        width: 30px;
    }

    .submit-btn{
        border: 1px solid black;
        width: 80px;
        font-size: 15px;
        outline: none;
    }

      .student-data{
        width: 100%;
        overflow-x: scroll;
      }
    </style>


@endsection

@section('script')
    <!-- ajax add-multiple-students  -->
    <script src="{{ asset('../admin_lang/student/add-multiple-students.js')}}?v={{ time() }}"></script>
@endsection

@section('contents')







<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1 pt-3">
            <div class="item-title">
                <h4>Student Details</h4>
            </div>
        </div>

        <div class="border d-flex justify-content-between">
            <div>
                <input type="file" id="fileInput" accept=".csv" />
                <div class="load" style="display: none;">Loading...</div>
            </div>
            <div class="d-flex">
                 <div class="d-flex flex-column text-center m-2">
                      <b>Total</b>
                      <span class="total-upload-students">0</span>
                 </div>
                 <div class="d-flex flex-column text-center m-2">
                    <b>Sucess</b>
                    <span class="total-sucess-students">0</span>
                </div>
                <div class="d-flex flex-column text-center m-2">
                    <b>Failed</b>
                    <span class="total-failed-students">0</span>
                </div>
            </div>
            <button class="save-all-student">Upload All</button>
        </div>



        <div class="student-data p-2"></div>
 
    </div>
</div>
 
@endsection


