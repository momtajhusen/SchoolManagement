<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:31:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PARENT</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('../admin_template_assets/img/favicon.png')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/fonts/flaticon.css')}}">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/fullcalendar.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/css/animate.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('../admin_template_assets/style.css')}}">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css" />
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>


    <!-- Google fa fa icon  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- <link rel="stylesheet" href="css/select2.min.css"> -->

    <!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Ajax CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

<!-- Modernize js -->
<script src="{{ asset('../admin_template_assets/js/modernizr-3.6.0.min.js')}}"></script>


<!-- Logout ajax -->
<script src="{{ asset('../admin_lang/UserLogin/ajax-logout.js')}}?v={{ time() }}"></script>

<!-- Nepali Clander css -->
<link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>

    <!-- ajax Get Student -->
    <script src="{{ asset('../admin_lang/Parent_Account/ajax-get-student.js')}}?v={{ time() }}"></script> 

    <!-- Script Student -->
    <script src="{{ asset('../admin_lang/Parent_Account/script-student.js')}}?v={{ time() }}"></script> 


    @yield('style')

    <style>

        .active-select-menu
        {
            background: #051f3e;
            color:white;
        }

    </style>

</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="{{ asset('../admin_template_assets/img/logo.png')}}" alt="logo">
                    </a>
                </div>
                 <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title parent_name">****</h5>
                                <span>Parent</span>
                            </div>
                            <div class="admin-img">
                                <img id="parent_img" src="{{ asset('../admin_template_assets/img/figure/admin.jpg')}}" style="width:40px;" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title parent_name"><b>****</b></h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li class="parents-logout-btn"><a href="#"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ asset('../admin_template_assets/img/logo1.png')}}" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content" style="height:100vh;">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        
                        <li class="nav-item">
                            <a href="{{route('parent-dashboard')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;color:#ff9d37">dashboard</span>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:25px;color:#ff9d37">person</span>
                                <span>Student</span>
                            </a>
                            <ul class="nav sub-group-menu p-2">
                                <div class="student-box w-100" style="z-index:1;">

                                </div>
                            </ul>
                        </li>



 

                         
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
  

               @yield('contents')

            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="{{ asset('../admin_template_assets/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('../admin_template_assets/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{ asset('../admin_template_assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('../admin_template_assets/js/bootstrap.min.js')}}"></script>
    <!-- Counterup Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.counterup.min.js')}}"></script>
    <!-- Moment Js -->
    <script src="{{ asset('../admin_template_assets/js/moment.min.js')}}"></script>
    <!-- Waypoints Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.waypoints.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{ asset('../admin_template_assets/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Full Calender Js -->
    <script src="{{ asset('../admin_template_assets/js/fullcalendar.min.js')}}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('../admin_template_assets/js/Chart.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('../admin_template_assets/js/main.js')}}"></script>

    
    @yield('script')


 
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
window.onload = function() {
/* Select your element */
var elm = document.querySelectorAll(".nepali-datepicker");

var year = NepaliFunctions.GetCurrentBsDate().year;
var momth = NepaliFunctions.GetCurrentBsDate().month;
var day = NepaliFunctions.GetCurrentBsDate().day;
 
for (var i = 0; i < elm.length; i++) {
  // Set the value of the current input element
  var dayString = day.toString().padStart(2, '0');

  elm[i].value = dayString+"/"+momth+"/"+year;
}

elm.nepaliDatePicker({
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 10,
    language: "english",
    dateFormat: "DD/MM/YYYY",

}); 

};
</script>


</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:33:03 GMT -->
</html>