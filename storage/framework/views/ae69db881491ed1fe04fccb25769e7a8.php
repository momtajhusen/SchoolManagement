

<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.js"></script>

    <style>
        .no-spinners::-webkit-outer-spin-button,
        .no-spinners::-webkit-inner-spin-button 
        {
          -webkit-appearance: none;
          margin: 0;
        }

 
      /* .fee-stracture-body {
        width: 210mm;
        height: 297mm;
        border:2px solid red;
      } */

      @media print {
      table {
    transform: rotate(90deg);
  }
}

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/student_management/check-fee-stracture.js')); ?>"></script>
 
    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>


    <script>
 function printDiv() 
 {
    var divContents = document.querySelector('.fee-stracture-body').innerHTML;
    var printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<html><head><title>A4 size div page</title></head><body>');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  }
    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Check Class Fees Stracture</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Fees Stracture</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

                    <!-- All Subjects Area Start Here -->
                    <div class="row">
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Class Fees Stracture</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                          
                                    <div class="row gutters-8">
                                        <div class="col-10 form-group">
                                            <select name="class p-4" class="select-class" style="height:50px;width:100%; padding:10px;">
                                                <option value="">Search By Class</option>
                                                <option value="NURSERY">NURSERY</option>
                                                <option value="LKG">LKG</option>
                                                <option value="UKG">UKG</option>
                                                <option value="1ST">1ST</option>
                                                <option value="2ND">2ND</option>
                                                <option value="3RD">3RD</option>
                                                <option value="4TH">4TH</option>
                                                <option value="5TH">5TH</option>
                                                <option value="6TH">6TH</option>
                                                <option value="7TH">7TH</option>
                                                <option value="8TH">8TH</option>
                                                <option value="9TH">9TH</option>
                                                <option value="10TH">10TH</option>
                                                <option value="11TH">11TH</option>
                                                <option value="12TH">12TH</option>
                                            </select>
                                        </div>
 
                                    </div>
 
                                <form class="fee-structure-form" >
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
 
                                        <tbody class="fee-stracture-body">
                                            <tr>
                                                <th>S No</th><th>Fee Type</th><th>₹ Baishakh </th><th>₹ Jestha</th><th>₹ Ashadh</th><th>₹ Shrawan</th>
                                                <th>₹ Bhadau</th><th>₹ Asoj</th><th>₹ Kartik</th><th>₹ Mangsir</th><th>₹ Poush</th><th>₹ Magh</th><th>₹ Falgun</th><th>₹ Chaitra</th>
                                            </tr>    
                                        </tbody> 

                                    </table>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Student_Management/student_management_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Momtaj Husen\Desktop\School Accounting\resources\views/Student_Management/layouts/check-fee-stracture.blade.php ENDPATH**/ ?>