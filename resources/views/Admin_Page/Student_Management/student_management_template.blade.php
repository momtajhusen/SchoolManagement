<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:31:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>STUDENT MANAGEMENT</title>
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
<script src="{{ asset('../admin_lang/accountLogin/ajax-logout.js')}}?v={{ time() }}"></script>

<!-- Nepali Clander css -->
<link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>

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
                                <h5 class="item-title">Stevne Zone</h5>
                                <span>Admin</span>
                            </div>
                            <div class="admin-img">
                                <img src="{{ asset('../admin_template_assets/img/figure/admin.jpg')}}" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">Steven Zone</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li class="student-management-logout-btn"><a href="#"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                            <span>5</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">05 Message</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-img bg-skyblue author-online">
                                        <img src="{{ asset('../admin_template_assets/img/figure/student11.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Maria Zaman</span> 
                                                <span class="item-time">18:30</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-yellow author-online">
                                        <img src="{{ asset('../admin_template_assets/img/figure/student12.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Benny Roy</span> 
                                                <span class="item-time">10:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-pink">
                                        <img src="{{ asset('../admin_template_assets/img/figure/student13.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Steven</span> 
                                                <span class="item-time">02:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-violet-blue">
                                        <img src="{{ asset('../admin_template_assets/img/figure/student11.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Joshep Joe</span> 
                                                <span class="item-time">12:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li class="navbar-item dropdown header-notification">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                            <span>8</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">03 Notifiacations</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-icon bg-skyblue">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Complete Today Task</div>
                                        <span>1 Mins ago</span>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-icon bg-orange">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Director Metting</div>
                                        <span>20 Mins ago</span>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-icon bg-violet-blue">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Update Password</div>
                                        <span>45 Mins ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                     {{-- <li class="navbar-item dropdown header-language">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" 
                        data-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe-americas"></i>EN</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">Spanish</a>
                            <a class="dropdown-item" href="#">Franchis</a>
                            <a class="dropdown-item" href="#">Chiness</a>
                        </div>
                    </li> --}}
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
                 

                        <li class="nav-item {{ request()->routeIs(['school_management_dashboard', 'student_management']) ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_dashboard')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">dashboard</span>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('school_management_student_registration') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_student_registration')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">person_add</span>
                                <span>Student Registration</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('school_management_registration_list') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_registration_list')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">view_list</span>
                                <span>Registration List</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('school_management_check_fee_stracture') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_check_fee_stracture')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">format_list_bulleted</span>
                                <span>Check Fee Stracture</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('school_management_student_parents') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_student_parents')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">group</span>
                                <span>Student Parent</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">height</span>
                                <span>Promotion / Demotion</span>
                            </a>
                        </li>

                        <li class="nav-item  {{ request()->routeIs('school_management_update_student_details') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_update_student_details')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">info</span>
                                <span>Update Student Details</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item  {{ request()->routeIs('school_management_generate_id_card') ? 'active-select-menu' : ''}}">
                            <a href="{{route('school_management_generate_id_card')}}" class="nav-link d-flex align-items-center">
                                <span class="material-symbols-outlined pr-3" style="font-size:25px;">badge</span>
                                <span>ID Card Generate</span>
                            </a>
                        </li> --}}


                         
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