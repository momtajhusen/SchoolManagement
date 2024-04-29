@extends('Admin_Page/Super_Admin/admin_template')

@section('script')
    <!-- ajax update -->
    <script src="{{ asset('../admin_lang/developer/ajax-student-fee-set.js')}}?v={{ time() }}"></script> 
@endsection


@section('contents')


  <button class="set-student-fee">Set Student Fee</button>


  <button class="set-new-account-student-fee">Set New Account Student Fee</button>



@endsection