

<?php $__env->startSection('style'); ?>
    <!-- Nepali Clander css -->
    <link href="../admin_lang/common/nepali_date/nepali.datepicker.css" rel="stylesheet" type="text/css"/>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
 

    <!-- ajax profile data -->
    <script src="<?php echo e(asset('../admin_lang/parents/ajax-parents-profile.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- ajax parent wallet -->
    <script src="<?php echo e(asset('../admin_lang/parents/ajax-parent-wallet.js')); ?>?v=<?php echo e(time()); ?>"></script> 

        <!-- Date Picker Js -->
        <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<input type="hidden" id="parent-id" value="<?php echo e($id); ?>">


<!-- Load Blance Modal -->
<div class="modal fade" id="LoadBlance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex" id="exampleModalLabel">
            <span class="material-symbols-outlined mr-2">add_card</span> 
            Load Blance
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form class="blance-load-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Load Amount</label>
                    <input type="number" required name="amount" class="form-control" id="inputEmail4" placeholder="amount">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Load By</label>
                    <input type="text" required name="load_by" class="form-control" id="inputPassword4" placeholder="your name">
                    </div>
                </div>
      </div>
        <div class="modal-footer">
            <button type="button" id="close-load-model" class="btn btn-secondary px-3 p-2" data-dismiss="modal">Cancle</button>
            <button type="submit" id="load-save" class="btn btn-primary px-3 p-2">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="row">

 

     <div class="p-3 col-12 col-md-4 ">
         <div class="w-100" style="background-color: #ddd;">
            <div class="p-2 py-3 d-flex justify-content-around ">
                <img class="mr-1" src="#" alt="" style="height:100px; width:100px;">
                <img src="#" alt="" style="height:100px; width:100px;">
            </div>


         </div>

         <div class="w-100 mt-3 p-3" style="background-color: #ddd;">
           <h4 class="mb-1">Parent Details</h4>

           <div>
               <div>
                    <span>Father :</span>
                    <span>Jakir Husen</span>
               </div>
               <div>
                    <span>Mother :</span>
                    <span>Jakir Husen</span>
               </div>
               <div>
                    <span>Father Contact :</span>
                    <span>Jakir Husen</span>
               </div>
               <div>
                    <span>Father :</span>
                    <span>Jakir Husen</span>
               </div>
           </div>
 
         </div>
     </div>

     <div class="p-3 col-12 col-md-8">

         <div class="row">
              <div class="col-12 col-md-7 mb-3">
                <div class="w-100" style="border:1px solid #ccc;">
                    <div class="p-2 d-flex justify-content-between" style="border:1px solid #ddd;">
                      <div class="d-flex">
                         <span class="material-symbols-outlined">person</span> Students
                      </div>
                      <div>
                         <span class="st_no">2</span>
                      </div>
                      
                    </div>
                    <div class="p-2" id="student_box" style="border:1px solid #ddd;">

                   </div>
                </div>
              </div>

              <div class="col-12 col-md-5 mb-4">
                <div style="border:1px solid #ccc;">
                    <div class="p-2 d-flex justify-content-between align-items-center " style="border:1px solid #ddd; height:35px; ">
                      <div class="d-flex">
                         <span class="material-symbols-outlined mr-2">account_balance_wallet</span> Wallet
                      </div>
                      <div class="d-flex flex-column justify-content-end align-content-end" style="font-size: 10px;">
                         <span>Blance</span>
                         <b id="current_blance">000</b>
                      </div>
                    </div>
                    <div class="p-2 d-flex align-items-start " style="border:1px solid #ddd; height:100px; "> 
                        <div class="d-flex flex-column justify-content-center align-items-center" data-toggle="modal" data-target="#LoadBlance" style="cursor:pointer;">
                            <span class="material-symbols-outlined mr-2">add_card</span>
                            <span style="font-size:8px;">Load Blance</span>
                        </div>

                        <div class="ml-3 d-flex flex-column justify-content-center align-items-center" style="cursor:pointer;">
                            <span class="material-symbols-outlined mr-2">history</span>
                            <span style="font-size:8px;">History</span>
                        </div>
                   </div>
                </div>
              </div>

         </div>
     </div>


  </div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Developer/resources/views/Admin_Page/Super_Admin/layouts/Parents/parent-profile.blade.php ENDPATH**/ ?>