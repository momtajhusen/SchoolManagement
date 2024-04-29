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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css" />
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Ajax CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

    <!-- Modernize js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/modernizr-3.6.0.min.js')); ?>"></script>

    <!-- Nepali Clander css -->
        <link href="../admin_lang/common/nepali_date/nepali.datepicker.css" rel="stylesheet" type="text/css"/>

    <!-- Logout ajax -->
    <script src="<?php echo e(asset('../admin_lang/accountLogin/ajax-logout.js')); ?>?v=<?php echo e(time()); ?>"></script>

    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <?php echo $__env->yieldContent('style'); ?>

    <style>
        /* .dashboard-content-one 
        {
            width: 100%;
            transform: scale(0.8);
            transform-origin: top;
            background-color: antiquewhite;
        } */

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

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
	        background-color: #F5F5F5;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background-color: #030303;
            background-image: -webkit-linear-gradient(0deg,
            rgba(255, 255, 255, 0.5) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.5) 50%,
            rgba(255, 255, 255, 0.5) 75%,
            transparent 75%,
            transparent)
          }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background-color: #0e1f50;
            background-image: -webkit-linear-gradient(0deg,
            rgba(255, 255, 255, 0.5) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.5) 50%,
            rgba(255, 255, 255, 0.5) 75%,
            transparent 75%,
            transparent)
        }
    </style>

</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light w-100" style="position: fixed; z-index:100;">
            <div class="nav-bar-header-one p-0">
                <div class="header-logo w-100 d-flex align-items-center justify-content-center" style="height: 65px; background-color: #ffa801; background-image: url('https://img.freepik.com/free-vector/abstract-realistic-technology-particle-background_23-2148431736.jpg?w=740&t=st=1686002536~exp=1686003136~hmac=ed23dd5ae09208a3c3234811c398a30d058a8b772c1405b283148262edbd429e'); background-size: cover; background-repeat: no-repeat;">
                   <b class="text-light" style="font-size: 25px;">DIGITAL</b>
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
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="d-flex align-items-center">
                            <b style="color: #bdbdbd">SUPER ADMIN</b>
                            
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">Super Admin</h5>
                                <span>Admin</span>
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
                <div class="sidebar-menu-content" style="height: 100vh;">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                        <li class="nav-item">
                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">dashboard</span>
                               <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">group</span>
                                <span>Students Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item active-select-menu">
                                    <a href="<?php echo e(route('all-student')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        All Students
                                    </a>
                                </li>
 
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-students')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Student Registration</a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin_update_student_details')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Update Student Details</a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('admin_student_parents')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Student Parents</a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-promotion')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Student Promotion</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('passout-student')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Passout Student</a>
                                </li>
                             
                                <li class="nav-item">
                                    <a href="<?php echo e(route('student-identification')); ?>" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Generate Id Card</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex" id="account-btn">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">account_balance</span>
                                <span>Acconunt Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                            
                                <li class="nav-item">
                                    <a href="<?php echo e(route('fee-payment')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                       Fee Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('set-fees')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>Set Fee Structure</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('dues-list')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Dues List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('all-class-fee')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                       Check Class Fee</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-expenses')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Expenses</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">apartment</span>
                                <span>School Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-subjects')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        Subject</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-classes')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>
                                        Class</a>
                                </li>  
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        Class Routing</a>
                                </li>                   
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item" >
                            <a href="#" class="nav-link d-flex" id="transport-btn">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">airport_shuttle</span>
                                <span>Transport</span>
                            </a>
                            <ul class="nav sub-group-menu" >
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-driver')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        Add Driver
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-vehicle')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        Add Vehicle</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('vehicle-root')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        Set Vehicle Root</a>
                                </li>
                 
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Teachers</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('all-teachers')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>All
                                        Teachers</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('add-teacher')); ?>" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                        Teacher</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('message')); ?>" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">mail</span>
                               <span>Message</span>
                            </a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">language</span>
                                <span>Website Setting</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('school-details')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>
                                        School Details</a>
                                </li>                  
                            </ul>
                        </li>
                        


                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" style="font-size:20px;color:#ff9d37">edit_square</span>
                                <span>Exam Management</span>
                            </a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-term')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Exam Term
                                    </a>
                                </li>   
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-grade')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Exam Grade
                                    </a>
                                </li>   
                                <li class="nav-item">
                                    <a href="<?php echo e(route('exam-timetable')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Exam Timetable
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('marks-entry')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Marks Entry
                                    </a>
                                </li>  
                                <li class="nav-item">
                                    <a href="<?php echo e(route('tabulation-sheet')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Tabulation Sheet
                                    </a>
                                </li> 
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route('print-admit-cards')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Print Admit Cards
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('print-marksheets')); ?>" class="nav-link">
                                        <i class="fas fa-angle-right"></i>Print Marksheets
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" id="fullscreen-button">
                            <a href="#" class="nav-link d-flex">
                                <span class="material-symbols-outlined mr-3" id="screen-icon" style="font-size:20px;color:#ff9d37">fullscreen</span>
                               <span id="screen-text">Fullscreen</span>
                            </a>
                        </li
                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one py-4" style="height: fit-content;">
  

               <?php echo $__env->yieldContent('contents'); ?>

               

            </div>
        </div>
        <!-- Page Area End Here -->
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

    <?php echo $__env->yieldContent('script'); ?>

<script src="../admin_lang/common/nepali_date/nepali.datepicker.js" type="text/javascript"></script>
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
 
//Color and click last btn Click Menu 
$(".nav-link").each(function() {
  var content = $(this).html();
  var modifiedContent = $("<div>").append(content).find("i").remove().end().html();
if (modifiedContent.trim() == localStorage.getItem("current_menu")) {
  $(this).css("background-color", "#042954");
  $(this).closest(".sidebar-nav-item").find("a").click();
 
}
});

// last click btn store localStorage for page loade click 
$(".nav-link").each(function() {
  $(this).click(function() {
    var content = $(this).html();
    var modifiedContent = $("<div>").append(content).find("i").remove().end().html();
    localStorage.setItem("current_menu", modifiedContent.trim());
  });
});

});



</script>


</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:33:03 GMT -->
</html><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Demo_School/resources/views/Admin_Page/Super_Admin/admin_template.blade.php ENDPATH**/ ?>