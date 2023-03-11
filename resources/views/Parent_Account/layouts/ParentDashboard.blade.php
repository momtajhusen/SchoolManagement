@extends('Parent_Account/parent_template')

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

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 200px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
    </style>
@endsection

@section('script')
    <!-- ajax Get Student -->
    <script src="../admin_lang/Parent_Account/ajax-get-student.js"></script> 

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
        <h3>Parent Dashboard</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Parent Dashboard</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <div class="student-box d-flex">

    </div>
 


@endsection
