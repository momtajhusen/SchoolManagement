@extends('Admin_Page/Super_Admin/admin_template')

@section('script')
    <!-- ajax set class subject -->
    <script src="{{ asset('../admin_lang/TeachersAttendance/ajax-teachers-periods.js')}}?v={{ time() }}"></script> 
 
@endsection

@section('style')
  <style>
    .input-group-text{
        width: 31px;
        height: 31px;

    }
    input[type="checkbox"]{
        cursor:pointer;
    }
  </style>
@endsection


@section('contents')
 
<table class="table table-striped table-dark table-sm" id="time-table-view">
    <thead class="period_hearder">
        <!-- ... (unchanged) ... -->
    </thead>
    <tbody class="teachers-periods-table">
        <!-- daynamic period  -->
    </tbody>
</table>

@endsection
