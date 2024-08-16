@extends('Admin_Page/Student_Management/student_management_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

    <style>
      .card-body{
        background: rgb(26,17,78);
        background: linear-gradient(90deg, rgba(26,17,78,1) 10%, rgba(4,41,84,1) 47%, rgba(26,17,78,1) 90%);
        cursor:pointer;
        color:white;
      }
    </style>
@endsection

@section('script')
    <!-- ajax  -->
    <script src="{{ asset('../admin_lang/parents/ajax-all-parent.js')}}?v={{ time() }}"></script> 

    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>

    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>
@endsection


@section('contents')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Student Management Dashboard</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Student Management Dashboard</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

<div class="row">
    
      <div class="col-12 col-md-6 col-xl-3 col-3-xxxl mb-2">
        <div class="card h-100 p-0" >
        <a href="{{route('school_management_student_registration')}}" class="card-body d-flex p-5">
             <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                <span class="material-symbols-outlined pr-3" style="font-size:30px;">person_add</span>
            </div>
            <div class="w-50 h-100 d-flex justify-content-center align-items-center">
               <h5 class="pt-4 text-light">Student Registration</h5>
            </div>
         </a>
        </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3 col-3-xxxl mb-2">
        <div class="card h-100 p-0" >
           <a href="{{route('school_management_registration_list')}}" class="card-body d-flex p-5">
                <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                    <span class="material-symbols-outlined pr-3" style="font-size:30px;">view_list</span>
                </div>
                <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                <h5 class="pt-4 text-light text-center">Registration List</h5>
                </div>
            </a>
        </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3 col-3-xxxl mb-2">
        <div class="card h-100 p-0" >
        <a href="{{route('school_management_check_fee_stracture')}}" class="card-body d-flex p-5">
             <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                <span class="material-symbols-outlined pr-3" style="font-size:30px;">format_list_bulleted</span>
            </div>
            <div class="w-50 h-100 d-flex justify-content-center align-items-center">
               <h5 class="pt-4 text-light">Check Fee Stracture</h5>
            </div>
         </a>
        </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3 col-3-xxxl mb-2">
        <div class="card h-100 p-0" >
            <a href="{{route('school_management_student_parents')}}" class="card-body d-flex p-5">
                <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                    <span class="material-symbols-outlined pr-3" style="font-size:30px;">group</span>
                </div>
                <div class="w-50 h-100 d-flex justify-content-center align-items-center">
                <h5 class="pt-4 text-light">Student Parent</h5>
                </div>
            </a>
        </div>
        </div>

        
        

    
</div>





@endsection
