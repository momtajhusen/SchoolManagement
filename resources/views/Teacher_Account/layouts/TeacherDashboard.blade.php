@extends('Teacher_Account/teacher_template')

@section('style')
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

 
@endsection

@section('script')
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
        <h3>Teacher Dashboard</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Teacher Dashboard</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
 


@endsection
