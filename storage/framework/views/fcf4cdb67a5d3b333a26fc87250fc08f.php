<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:31:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SUPER ADMIN</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="<?php echo e(asset('../admin_lang/common/nepali_date/nepali.datepicker.js')); ?>" defer></script>
    <script src="<?php echo e(asset('admin_lang/HelperScript/date.js')); ?>?v=<?php echo e(time()); ?>" defer></script>
    <script src="<?php echo e(asset('admin_lang/HelperScript/KeyEvent.js')); ?>?v=<?php echo e(time()); ?>" defer></script>
    <script src="<?php echo e(asset('admin_lang/HelperScript/ReuseScript.js')); ?>?v=<?php echo e(time()); ?>" defer></script>



    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('../admin_template_assets/img/favicon.png')); ?>">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/normalize.css')); ?>">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/main.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/bootstrap.min.css')); ?>">
 
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/all.min.css')); ?>">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/fonts/flaticon.css')); ?>">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/fullcalendar.min.css')); ?>">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/animate.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">

    

    <!-- Google fa fa icon  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="css/select2.min.css"> -->

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css')); ?>" />
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" type="text/javascript"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Ajax CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    

    <!-- Modernize js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/modernizr-3.6.0.min.js')); ?>"></script>

    <!-- Nepali Clander css -->
        <link href="<?php echo e(asset('../admin_lang/common/nepali_date/nepali.datepicker.css')); ?>" rel="stylesheet" type="text/css"/>

    <!-- Developer Script -->
    <script src="<?php echo e(asset('../admin_lang/common/developer-mode.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- Logout ajax -->
    <script src="<?php echo e(asset('../admin_lang/accountLogin/ajax-logout.js')); ?>?v=<?php echo e(time()); ?>"></script>

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>


    <!-- Start Date Piceker Clander   -->
    <link rel="stylesheet"  href="<?php echo e(asset('../admin_lang/common/AdvanceNepaliDate/nepali-date-picker.min.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/themes/prism.min.css" rel="stylesheet" />
    <!-- End Date Piceker Clander   -->

    <!-- Visitor Details -->
    <script src="<?php echo e(asset('../admin_lang/visitorLogs/ajax-visitorDetails.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- Visitor PageLog -->
    <script src="<?php echo e(asset('../admin_lang/visitorLogs/ajax-visitorPageLog.js')); ?>?v=<?php echo e(time()); ?>"></script> 
    <!-- Visitor ButtonClick -->
    <script src="<?php echo e(asset('../admin_lang/visitorLogs/ajax-buttonClick.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <script src="<?php echo e(asset('admin_lang/SuperAdminTemplate/school-details.js')); ?>?v=<?php echo e(time()); ?>"></script>


    


    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Calculator css -->
    <link rel="stylesheet"  href="<?php echo e(asset('../admin_template_assets/calculator/style.css')); ?>">

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>




    <?php echo $__env->yieldContent('style'); ?>

    <style>
        .dashboard-content-one 
        {
            height: fit-content;
            
        }

        .header-menu-one{
            background: rgb(4,41,80);
            background: linear-gradient(90deg, rgba(4,41,80,1) 50%, rgba(255,174,0,1) 100%);
        }

        .material-symbols-outlined {
        font-variation-settings:
        'FILL' 1,
        'wght' 400,
        'GRAD' 0,
        'opsz' 48
        }

        .active-select-menu
        {
            background-color: #042954 !important;
            color:white;
        }

        /* Start Scroll Designe  */
            /* For vertical scrollbar */
            ::-webkit-scrollbar-thumb:vertical {
                      background-color: #b2bff8d3;
                      box-shadow: inset 0 0 10px rgba(63, 63, 63, 0.5);
            }

            /* For horizontal scrollbar */
            ::-webkit-scrollbar-thumb:horizontal {
                background-color: #b2bff8d3;
                box-shadow: inset 0 0 10px rgba(63, 63, 63, 0.5);
            }

            /* Set the width, height, and background color for both scrollbars */
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
                background-color: #F5F5F5;
                box-shadow: inset 0 0 10px rgba(63, 63, 63, 0.5);
                border-radius: 20px;
            }
        /* Start Scroll Designe  */
 

    .nav-links {
        background-color: transparent !important; 
    }

    .nav-links.active { 
        background-color: rgb(0, 0, 0) !important; 
        color: rgb(255, 255, 255) !important; 
    }

    .header-logo b{
        font-family: "Black Ops One", system-ui;
        font-weight: 400;
        font-style: normal;
        font-size: 20px;
        opacity:0.6;
    }

    .demo-visitor-box{
        width: 100vw;
        height: 100vh;
        backdrop-filter: blur(4px);
        position: fixed;
        top: 0px;
        left: 0%;
        z-index: 200;
    }
    .demo-visitor-form-box{
        width: 350px;
        height: 490px;
        backdrop-filter: blur(5px);
        margin-top: 80px;
        border-radius: 10px;
        background: rgb(0,0,0);
        background: linear-gradient(90deg, rgba(0,0,0,0.44) 0%, rgba(4,41,84,0.4430147058823529) 100%);
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    .demo-visitor-form-box input{
        cursor: pointer;
    }
 
    .sortable-table thead th{
        cursor: pointer;
    }
    .sortable-table thead th{
        padding: 10px;
        user-select: none;
    }
 
    </style>

</head>

<body class="position-relative" style="height:100vh;overflow: hidden;">
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one w-100" style="position: fixed; z-index:100;">
            <div class="nav-bar-header-one p-0">
                <div class="header-logo w-100 d-flex align-items-center justify-content-center" style="height: 65px; background-color: #ffa801; background-image: url('https://i.gifer.com/KLMu.gif'); background-size: cover; background-repeat: no-repeat;">
                   <div class="d-flex flex-column" style="line-height: 18px">
                        <b class="text-light">SCRIPTQUBE</b>
                        <span style="font-size: 10px;color: #bdbdbd">Software</span>
                   </div>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse pl-2" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar d-flex">
                        <img class="border p-1 mr-2 schoolo_logo_preview" src="#"  style="width:50px;">
                        <div class="d-flex align-items-start flex-column ">
                            <b class="school_name"  style="color: #bdbdbd"></b>
                            <div style="color: #bdbdbd; font-size:15px;"><b><span class="currentDate"></span><span class="currentTime ml-3"></span></span></b> <b id="current_date_header"></b> </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title" style="color: #e0dede">Super Admin</h5>
                                <span style="color: #e0dede">Admin</span>
                            </div>
                            <div class="admin-img">
                                <img src="<?php echo e(asset('../admin_template_assets/img/figure/admin.jpg')); ?>" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">Super Admin</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="<?php echo e(route('account-setting')); ?>"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li class="super-admin-logout-btn"><a href="#"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->


        <!-- Page Area Start Here -->
        <div style="height:65px;">ds</div>
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
               <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="index.html"><img src="<?php echo e(asset('../admin_template_assets/img/logo1.png')); ?>" alt="logo"></a>
                    </div>
               </div>
                <div class="sidebar-menu-content" style="height: 100vh; overflow-y: scroll;padding-bottom:100px;">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item sidebar-nav-item">
                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">dashboard</span>
                                <span class="menu-name">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">pie_chart</span>
                                <span class="menu-name">Finance Analysis</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('financial-overview')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Financial Overview</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('fee-collection-reports')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Fee Collections</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('salary-report')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                    <span class="menu-name">Salary</span>
                                   </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('class-finance')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                    <span class="menu-name">Financial Class</span>
                                   </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('expense-reports')); ?>"  class="nav-link"><i class="fas fa-angle-right"></i>
                                    <span class="menu-name">Expenses</span>
                                   </a>
                                </li>  
                            </ul>
                        </li>

                        

                        <li class="nav-item sidebar-nav-item" id="old-account-menu">
                            <a href="#" class="nav-link d-flex" id="account-btn">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">account_balance</span>
                                <span class="menu-name">Acconunt Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                            
                                <li class="nav-item d-none">
                                    <a href="<?php echo e(route('fee-payment')); ?>" class="nav-link">
                                       <i class="fas fa-angle-right"></i>
                                       <span class="menu-name">Fee Payment</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('dues-list')); ?>" class="nav-link">
                                       <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Dues Fee</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-expenses')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add Expenses</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('manage-stracture')); ?>" class="nav-link">
                                      <i class="fas fa-angle-right"></i>
                                      <span class="menu-name">Fee Structure</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('manage_free_student')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Fee & Disc Exceptions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item sidebar-nav-item d-none" id="new-account-menu">
                            <a href="#" class="nav-link d-flex" id="new-account-btn">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">account_balance</span>
                                <span class="menu-name">Acconunt Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-fee-payment')); ?>" class="nav-link">
                                       <i class="fas fa-angle-right"></i>
                                       <span class="menu-name">Student Fee Payment</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-deus-fee-list')); ?>" class="nav-link">
                                       <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Dues Fee List</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('manage-stracture')); ?>" class="nav-link">
                                      <i class="fas fa-angle-right"></i>
                                      <span class="menu-name">Student Fee Structure</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-expenses')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add New Expenses</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">receipt_long</span>
                                <span class="menu-name">Teacher/Staff Salary</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('salary-payment')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Salary Payment</span>
                                    </a>
                                </li>
                                <li class="nav-item deve-use">
                                    <a href="<?php echo e(route('salary-payment-history')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Salary Payment History</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('salary-generate')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Check Salary Generate</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('salary-set')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Set Salary</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('bonus-ssf-setting')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Bonus & SSF Setting</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">demography</span>
                                <span class="menu-name">Attendan Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('teachers-attendance')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Teachers Attendance</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('staff-attendance')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Staff Attendance</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('teachers-attendance-report')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Attendance Reports</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('set-teachers-periods')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Set Teachers Periods</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">group</span>
                                <span class="menu-name">Students Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                               <li class="nav-item">
                                    <a href="<?php echo e(route('add-students')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Student Registration</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('registration-list')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Registration List</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('all-student')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">All Students</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin_student_parents')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">All Parents</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-promotion')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span>Student Promotion</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('passout-student')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Passout Student</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('kick_out')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Kick Out Students</span>
                                    </a>
                                </li>
                             
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-identification')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Generate Id Card</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                        <li class="nav-item sidebar-nav-item deve-use">
                            <a href="#" class="nav-link d-flex">  
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">night_shelter</span>
                                <span class="menu-name">Hostel Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                               <li class="nav-item d-none">
                                    <a href="<?php echo e(route('hostel-students')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>
                                            <span class="menu-name">Hostel Students</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">person_apron</span>
                                <span class="menu-name">Employee Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('teacher-staff-details')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Teacher/Staff Details</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-new-employee')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add New Employee</span>
                                    </a>
                                </li>              
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">edit_square</span>
                                <span class="menu-name">Exam Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
           
                                
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-marks-entry')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Marks Entry</span>
                                    </a>
                                </li>
  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('tabulation-sheet')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Tabulation Sheet</span>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="<?php echo e(route('print-marksheets')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Print Marksheets</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('print-admit-cards')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Print Admit Cards</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-timetable')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Exam Timetable</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-term')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Exam Term</span>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-grade')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Exam Grade</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">store</span>
                                <span class="menu-name">Inventory Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('sell-items')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Sell Items</span>
                                    </a>
                                </li>  
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('items-in-stock')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add Items In Stock</span>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="<?php echo e(route('items-price')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add Items & Price</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('items-category')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add Items Category</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>

                        
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">manage_accounts</span>
                                <span class="menu-name">Role & Permission</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('sub_admin_list')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">SubAdmin List</span>
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a href="<?php echo e(route('role_permission')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add New SubAdmin</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>


                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">school</span>
                                <span class="menu-name">Academy</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-classes')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Class</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-subjects')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Subject</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('teacher-subjects')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                      <span class="menu-name">Teacher Subjects</span>
                                    </a>
                                </li>            
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">schedule</span>
                                <span class="menu-name">Time Table</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('class-period')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Class Period</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('class-subject')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Set Class Subject</span>
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('print-timetable')); ?>"  class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                          <span class="menu-name">Class Time Table</span>
                                        </a>
                                </li>    
                                <li class="nav-item">
                                    <a href="<?php echo e(route('teacher-timetable')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                      <span class="menu-name">Teacher TimeTable</span>
                                    </a>
                                </li>               
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex" id="transport-btn">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">airport_shuttle</span>
                                <span class="menu-name">Transport</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-vehicle')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Add Vehicle</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('vehicle-root')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Set Vehicle Root</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('transport-student')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">Transport Student</span>
                                    </a>
                                </li>
                 
                            </ul>
                        </li>

                        

                        <li class="nav-item sidebar-nav-item">
                            <a href="<?php echo e(route('message')); ?>" class="nav-link d-flex">
                                 <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">mail</span>
                                 <span class="menu-name">Message</span>
                            </a>
                        </li>
                        
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">settings</span>
                                <span class="menu-name">School Setting</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('school-details')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="menu-name">School Details</span>
                                    </a>
                                </li> 
                            </ul>
                        </li>
   
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one border">

                <div class="demo-visitor-main d-none">
                    <div class="demo-visitor-box d-flex justify-content-center">
                        <form class="demo-visitor-form p-5 demo-visitor-form-box animate__animated animate__slideInDown animate__slower 3s">
                            <div class="form-group">
                                <label class="text-light">Your Name *</label>
                                <input type="text" maxlength="20" required name="visitor_name" placeholder="your name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-light">School Name *</label>
                                <input type="text" maxlength="20" required name="school_name" placeholder="school name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-light">Address *</label>
                                <input type="text" maxlength="20" required name="address" placeholder="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-light">Contact Number *</label>
                                <input type="number" maxlength="20" required name="contact_number" placeholder="contact number" class="form-control">
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="content-box" style="height:80vh;overflow: auto;">
 
                   <?php echo $__env->yieldContent('contents'); ?>

                </div>
                

               

            </div>
        </div>
        <!-- Page Area End Here -->

        
          <div class="tool-box d-none">
               <b class="px-1 text-center tool-text" style="font-size:13px;">Tools</b>
               <div class="d-flex justify-content-center">
                  <span class="material-symbols-outlined" id='calculator-icon' style="font-size:35px;cursor:pointer;"> calculate</span>
               </div>
          </div>
        

        
            <div class="bg-danger draggable d-none calculator-box" style="position:fixed; top:50%; left:50%; z-index:100">
                <div class="calculator">
                    <div class="px-3 p-1 header d-flex justify-content-between" style="z-index:200">
                      <span>Calculator</span>
                      <span class="cal-close border px-3">X</span>
                    </div>

                    <div class="display">
                    <input type="text" placeholder="0" id="input" disabled />
                    </div>
                    <div class="cal-buttons pb-3">
                    <!-- Full Erase -->
                    <button value="AC" id="clear" class="operation-button" >AC</button>
                    <!-- Erase Single Value -->
                    <button value="DEL" id="erase" class="operation-button" >DEL</button>
                    <button value="/" class="operation-button cal-button">/</button>
                    <button value="*" class="operation-button cal-button" >*</button>
            
                    <button value="7" class="digit-button cal-button cal-btn" />7</button>
                    <button value="8" class="digit-button cal-button cal-btn" />8</button>
                    <button value="9" class="digit-button cal-button cal-btn" />9</button>
                    <button value="-" class="operation-button cal-button" />-</button>
            
                    <button value="6" class="digit-button cal-button cal-btn" />6</button>
                    <button value="5" class="digit-button cal-button cal-btn" />5</button>
                    <button value="4" class="digit-button cal-button cal-btn" />4</button>
                    <button value="+" class="operation-button cal-button" />+</button>
            
                    <button value="1" class="digit-button cal-button cal-btn" />1</button>
                    <button value="2" class="digit-button cal-button cal-btn" />2</button>
                    <button value="3" class="digit-button cal-button cal-btn" />3</button>
            
                    <button value="=" id="equal" class="operation-button" />=</button>
                    <button value="0" class="digit-button cal-button cal-btn" id="zero" />0</button>
                    <button value="." class="digit-button cal-button cal-btn" />.</button>
                    </div>
                </div>
            </div>
        

        
    </div>
    <!-- jquery-->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery-3.3.1.min.js')); ?>"></script>
    <!-- Plugins js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/plugins.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/bootstrap.min.js')); ?>"></script>
    <!-- Counterup Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.counterup.min.js')); ?>"></script>
    <!-- Moment Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/moment.min.js')); ?>"></script>
    <!-- Waypoints Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.waypoints.min.js')); ?>"></script>
    <!-- Scroll Up Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.scrollUp.min.js')); ?>"></script>
    <!-- Full Calender Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/fullcalendar.min.js')); ?>"></script>
    <!-- Chart Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/Chart.min.js')); ?>"></script>
    <!-- Custom Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/main.js')); ?>"></script>

    <!--flaticon -->
    <?php echo $__env->yieldContent('script'); ?>



    <!-- Start Date Piceker Clander -->
        <script src="<?php echo e(asset('../admin_lang/common/AdvanceNepaliDate/nepali-date-picker.min.js')); ?>"></script>
        <script src="<?php echo e(asset('https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/components/prism-core.min.js')); ?>"></script>
        <script src="<?php echo e(asset('https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0/plugins/autoloader/prism-autoloader.min.js')); ?>"></script>
    <!-- End Date Piceker Clander -->

    
    <script src="<?php echo e(asset('../admin_lang/common/tableExport/export.js')); ?>?v=<?php echo e(time()); ?>"></script>


     
    <script src="<?php echo e(asset('../admin_lang/RoleAndPermission/ajax-check-menu-sub-menu.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- new-account-skip-school  -->
    <script src="<?php echo e(asset('../admin_lang/developer/new-account-skip-school.js')); ?>?v=<?php echo e(time()); ?>"></script>


    <!-- Calculator js -->
    <script src="<?php echo e(asset('../admin_template_assets/calculator/script.js')); ?>?v=<?php echo e(time()); ?>"></script>

<script type="text/javascript">
 

    jQuery(document).ready(function () {
        $('.date-picker').nepaliDatePicker();
    })

    window.onload = function() {
    /* Select your element */
    var elm = document.querySelectorAll(".nepali-datepicker");
        elm.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 220,
            language: "english",
            dateFormat: "YYYY-MM-DD",
        }); 
    };

 

    $(document).ready(function(){
        $(".today-btn").click(function(){
        
                var today =   $(this).parent().parent().find(".today-date");
                
                for (var i = 0; i < today.length; i++) {
                // Set the value of the current input element
                var dayString = current_day.toString().padStart(2, '0');

                var today =  today[i].value = current_year+"-"+current_month+"-"+dayString;

                // $(this).parent().parent().find("input").val(today[i].value = dayString+"/"+momth+"/"+year);

                }
        });
    });

// Get the button element
var fullscreenButton = $("#fullscreen-button");

// Add a click event listener to the button
fullscreenButton.click(function() {
  // Check if the browser supports fullscreen mode
  if (document.fullscreenEnabled) {
    // Toggle fullscreen mode
    if (document.fullscreenElement) {
      $("#screen-text").html("Fullscreen");
      document.exitFullscreen();
    } else {
      $("#screen-text").html("Exit Fullscreen");
      document.documentElement.requestFullscreen();
    }
  }
});

$(document).ready(function() {
    // Color and click last btn Click Menu 
    $(".menu-name").each(function() {
        var content = $(this).html();
        

        if (content == localStorage.getItem("current_menu")) {
            $(this).parent().css("background-color", "#042954");
            $(this).parent().parent().parent().parent().find('.nav-link').click();
        }
    });

    // last click btn store localStorage for page loade click 
    $(".nav-link").click(function() {
        var content = $(this).find('.menu-name').html();
        localStorage.setItem("current_menu", content);
    });
    
});

$(document).ready(function() {
    // Check if there's a stored scroll position in localStorage
    var SidebarstoredScrollPosition = localStorage.getItem("sidebar_scroll_position");
 
    // If there's a stored scroll position, restore it
    if (SidebarstoredScrollPosition) {
        $(".sidebar-menu-content").scrollTop(SidebarstoredScrollPosition);
    }

    // Listen for scroll events on the .sidebar-main element
    $(".sidebar-menu-content").scroll(function() {
        // Store the current scroll position in localStorage
        localStorage.setItem("sidebar_scroll_position", $(this).scrollTop());
    });
 
});






// Current Nepal Date
$(document).ready(function(){

    var current_date = current_year + "-" + current_month + "-" + current_day;
    var current_satrt = current_year + "-" + current_month + "-1";

    $(".currentDate").val(current_date);
    $(".currentSatrtDate").val(current_satrt);
    $(".currentDate").html(current_date);
});

// Current Nepal Time 
function updateNepalTime() {
    // Get the current UTC time
    var currentTimeUTC = new Date();

    // Nepal is 5 hours and 45 minutes ahead of UTC
    var nepalTimeOffset = 5 * 60 + 45;
    var nepalTime = new Date(currentTimeUTC.getTime() + nepalTimeOffset * 60000);

    // Format the time in hours, minutes, and seconds
    var hours = nepalTime.getUTCHours();
    var minutes = nepalTime.getUTCMinutes();
    var seconds = nepalTime.getUTCSeconds();

    // Determine AM/PM
    var ampm = hours >= 12 ? 'PM' : 'AM';

    // Convert hours to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // The hour '0' should be '12' in AM/PM

    // Display the Nepal time
    var formattedTime = hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds + " " + ampm;
    $(".currentTime").text(formattedTime);

    // Update the time every second
    setTimeout(updateNepalTime, 1000);
}

// Initial call to set up the clock
updateNepalTime();

</script>


</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:33:03 GMT -->
</html><?php /**PATH C:\Users\Bina Computer\Desktop\editorconfig\resources\views/Admin_Page/Super_Admin/admin_template.blade.php ENDPATH**/ ?>