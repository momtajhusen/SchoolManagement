 
<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Aoboshi+One&display=swap" rel="stylesheet">

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


.menu-card{
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  padding:15px;
  margin-bottom:10px;
  background-color: rgb(255, 255, 255);
  cursor: pointer;
  color: black;
}



    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>

    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>

    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
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


    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12 d-md-none ">
        <div class="menu-card d-flex" style="">
          <div class="w-25 d-flex justify-content-center align-items-center">
            <span class="material-symbols-outlined" style="font-size:40px;">account_circle</span>
          </div>
          <div class="w-75 d-flex align-items-end flex-column">
            <h6 class="m-0" style="font-family: 'Aoboshi One', serif; font-size:20px;">Momtaj Husen</h6>
            <span  style="font-size:20px;">Profile</span>
          </div>
        </div>
     </div>

       <div class="col-xl-3 col-sm-6 col-12">
          <a href="<?php echo e(route('monthly-fee')); ?>" class="menu-card d-flex" style="">
            <div class="w-25 d-flex justify-content-center align-items-center">
              <span class="material-symbols-outlined" style="font-size:40px;">payments</span>
            </div>
            <div class="w-75 d-flex align-items-end flex-column">
              <h6 class="m-0 pr-4" style="font-family: 'Aoboshi One', serif; font-size:20px;">5</h6>
              <span  style="font-size:20px;">Monthly Fee</span>
            </div>
          </a>
       </div>

       <div class="col-xl-3 col-sm-6 col-12">
          <a href="<?php echo e(route('payment-bill')); ?>" class="menu-card d-flex" style="">
            <div class="w-25 d-flex justify-content-center align-items-center">
              <span class="material-symbols-outlined" style="font-size:40px;">receipt_long</span>
            </div>
            <div class="w-75 d-flex align-items-end flex-column">
              <h6 class="m-0 pr-4" style="font-family: 'Aoboshi One', serif; font-size:20px;">5</h6>
              <span  style="font-size:20px;">Payment Bill</span>
            </div>
          </a>
       </div>
    </div>


 


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Parent_Account/parent_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Parent_Account/layouts/ParentDashboard.blade.php ENDPATH**/ ?>