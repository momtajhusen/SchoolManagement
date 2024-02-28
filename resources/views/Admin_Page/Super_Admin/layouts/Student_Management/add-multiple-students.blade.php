@extends('Admin_Page/Super_Admin/admin_template')


@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/datepicker.min.css')}}">

    <style>
        .table-box{
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            overflow:auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        input {
            width: auto; /* Allow input to take the width of its content */
            box-sizing: border-box; /* Include padding and border in the width calculation */
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

        <input type="file" id="fileInput" accept=".csv" />

        <div class="w-100 table-box">
            <table class="table-sm">


            </table>
        </div>

 
    </div>
</div>
 
@endsection


