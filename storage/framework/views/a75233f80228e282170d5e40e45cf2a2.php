<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

 
    <title><?php echo $__env->yieldContent('title'); ?></title>
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

     <?php echo $__env->yieldContent('ajax'); ?>
  
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('front_template_assets/assets/css/fontawesome.css')); ?>">
    <link rel="stylesheet" href="front_template_assets/assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="<?php echo e(asset('front_template_assets/assets/css/owl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('front_template_assets/assets/css/lightbox.css')); ?>">


     <?php echo $__env->yieldContent('style'); ?>
  </head>

<body>
     
  <!--Header Menu-->
  <div style="height:80px;background-color: rgba(22,34,57,0.95);"></div>
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <img src="<?php echo e(asset('front_template_assets/assets/images/school-image/logo.png')); ?>" width="50px" alt="logo">
 
    </div>
    <a href="/" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li class="<?php echo $__env->yieldContent('active'); ?>"><a href="/">Home</a></li>
        <li class="<?php echo $__env->yieldContent('active'); ?>"><a href="/classes">Classes</a></li>
        <li class="<?php echo $__env->yieldContent('active'); ?>"><a href="/teachers">Teachers</a></li>
        <li class="has-submenu"><a href="about">About Us</a>
          <ul class="sub-menu">
            <li><a href="#section2">Who we are?</a></li>
            <li><a href="#section3">What we do?</a></li>
            <li><a href="#section3">How it works?</a></li>
            <li><a href="https://templatemo.com/about" rel="sponsored" class="external">External URL</a></li>
          </ul>
        </li>
        <li><a href="#section4">Contact</a></li>
        <li class="has-submenu"><a href="about">Login</a>
          <ul class="sub-menu">
            <li><a href="#section2">Who we are?</a></li>
            <li><a href="#section3">What we do?</a></li>
            <li><a href="#section3">How it works?</a></li>
            <li><a href="https://templatemo.com/about" rel="sponsored" class="external">External URL</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
 


  <?php echo $__env->yieldContent('contents'); ?>

 
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2023 by Shubhatara School  
          
           | Developed By: <a href="https://templatemo.com" rel="sponsored" target="_parent">Digital Graphic Solution</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="front_template_assets/vendor/jquery/jquery.min.js"></script>
    <script src="front_template_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="front_template_assets/assets/js/isotope.min.js"></script>
    <script src="front_template_assets/assets/js/owl-carousel.js"></script>
    <script src="front_template_assets/assets/js/lightbox.js"></script>
    <script src="front_template_assets/assets/js/tabs.js"></script>
    <script src="front_template_assets/assets/js/video.js"></script>
    <script src="front_template_assets/assets/js/slick-slider.js"></script>
    <script src="front_template_assets/assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }
        };

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Bina Computer\Desktop\School_Project\resources\views/Front_Page/welcome.blade.php ENDPATH**/ ?>