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
      width: 60px;
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
    .save-all-student{
        height: 40px;
        padding: 10px;
        cursor: pointer;
        background-color: #042954;
        color: white;
    }

      .student-data{
        width: 100%;
        overflow-x: scroll;
      }
      .header-column{
        background-color: #042954;
        color: #dddddd;
        outline: none;
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
            <div class="item-title d-flex justify-content-between w-100">
                    <h4>Student Details</h4>
                    <span class="upload-event">stop</span>
            </div>
        </div>

        <div class="border d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <input type="file" id="fileInput" accept=".csv" />
            </div>
            <div class="d-flex align-items-center">
                 <div class="d-flex flex-column text-center m-2">
                      <b>Total</b>
                      <b class="total-upload-students">0</b>
                 </div>
                 <div class="d-flex flex-column text-center m-2">
                    <b>Success</b>
                    <b class="total-sucess-students">0</b>
                </div>
                <div class="d-flex flex-column text-center m-2">
                    <b>Failed</b>
                    <b class="total-failed-students">0</b>
                </div>
            </div>
             <div class="d-flex align-items-center">
                <button class="save-all-student align-items-center d-none">Upload All <span class="material-symbols-outlined">
                    upload
                    </span></button>
             </div>
        </div>



        <div class="student-data p-2"></div>
 
    </div>
</div>
 
@endsection


