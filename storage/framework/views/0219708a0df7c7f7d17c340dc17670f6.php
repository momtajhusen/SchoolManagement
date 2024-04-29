<?php $__env->startSection('style'); ?>
 
    <style>

         .edit-btn{
            background-color: rgb(238, 237, 237);
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            cursor: pointer;
         }
         .content-box{
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;

         }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Super Admin Account Setting</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Account Setting</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
 
    
    <div class="modal fade" id="ChangeEmail" tabindex="-1" aria-labelledby="ChangeEmailLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ChangeEmailLabel">Change Email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3">
            <span>If you want to Change email. Enter Password or Email Verification code we are send on this email.</span>
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Current Password:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Verification Code :</label>
                <input class="form-control" id="message-text"></input>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 15px">Cancle</button>
            <button type="button" class="btn btn-primary" style="font-size: 15px">Save</button>
          </div>
        </div>
      </div>
    </div>


    <div class="row p-0">
        <div class="col-12 col-md-6 mb-3">
            <div class="w-100 border border-2 p-3 d-flex flex-column content-box">
               <div class="w-100 d-flex justify-content-between">
                   <h5 class="p-0 pt-2 m-0">Change Email</h4>
                    <button class="px-5 p-2 edit-btn" style="outline: none; border: none; cursor:pointer;" data-toggle="modal" data-target="#ChangeEmail" data-whatever="@mdo">Edit</button>
               </div>
               <span>superadmin@gmail.com</span>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="w-100 border border-2 p-3 d-flex flex-column content-box">
                <div class="w-100 d-flex justify-content-between">
                    <h5 class="p-0 pt-2 m-0">Password:</h4>
                     <button class="px-5 p-2 edit-btn" style="outline: none; border: none; cursor:pointer;" >Edit</button>
                </div>
                <span>**********</span>
             </div>
        </div>
    </div>

    <div class="row p-0">
        <div class="col-12 col-md-6 mb-3">
            <div class="w-100 border border-2 p-3 d-flex flex-column content-box">
               <div class="w-100 d-flex justify-content-between">
                   <h5 class="p-0 pt-2 m-0">2-step verification:</h4>
                    <button class="px-5 p-2 edit-btn" style="outline: none; border: none; cursor:pointer;" >Turn on</button>
               </div>
               <span style="width:65%;">Add a layer of security. Required a verification code in addition to password.</span>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            
        </div>
    </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/mustlearn.in/public_html/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Account_setting/account_setting.blade.php ENDPATH**/ ?>