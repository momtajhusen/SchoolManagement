<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/select2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../admin_template_assets/style.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/datepicker.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="../admin_template_assets/css/jquery.dataTables.min.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    

        <!-- ajax profile data -->
        <script src="<?php echo e(asset('../admin_lang/teacher/ajax-teacher-profile.js')); ?>?v=<?php echo e(time()); ?>"></script> 
 

    <!-- Select 2 Js -->
    <script src="../admin_template_assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="../admin_template_assets/js/datepicker.min.js"></script>
    <!-- Data Table Js -->
    <script src="../admin_template_assets/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

   <input value="<?php echo e($id); ?>" type="hidden" id="teacher-id">
 
   <div style="width: 100%; height:130px;position:relative;z-index:0;background: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
           <h3 class="text-light p-3">Profile</h3>
           <h4 class="text-light p-3 teacher_name" style="position:absolute;top:90px;left:115px;">Momtaj Husen</h4>
          <img src="https://i.pinimg.com/564x/9d/0a/21/9d0a21b58f487baf651dd9fb6fd4fed1.jpg" alt="" class="bg-info" style="border: 3px solid white;width:100px; height:100px; border-radius:100%; position:absolute;top:80px;left:20px;z-index:1;">
   </div>
 

   <div class="row" style="margin-top: 55px;">
      <div class="col-12 col-md-4 mb-3">
        <div class="px-4 pt-2" style="height:300px;width:100%; border-radius:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                <h4>Details</h4>
                 <div>
                    <span>Name :</span>
                    <span class="teacher_name"></span>
                 </div>
                 <div>
                    <span>Dob :</span>
                    <span class="teacher_dob"></span>
                 </div>
                 <div>
                    <span>salary :</span>
                    <span class="teacher_salary"></span>
                 </div>
                 <div>
                    <span>phone :</span>
                    <span class="teacher_phone"></span>
                 </div>
                 <div>
                    <span>email :</span>
                    <span class="teacher_email"></span>
                 </div>
                 <div>
                    <span>address :</span>
                    <span class="teacher_address"></span>
                 </div>
                 <div>
                    <span>qualification :</span>
                    <span class="teacher_qualification"></span>
                 </div>
        </div>
      </div>
      <div class="col-12 col-md-4 mb-3">
         <div class="px-4 pt-2" style="height:300px;width:100%;border-radius:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            <div class="d-flex flex-column">
               <h4 class="mb-0">Attendance</h4>
               <div class="d-flex">
                  <select class="p-2 bg-light" id="attendance-year" style="width:25%;outline:none;border-radius:none;border:none;">
                    <option value="2079">2079</option>
                    <option value="2080">2080</option>
                    <option value="2081">2081</option>
                    <option value="2082">2082</option>
                    <option value="2083">2083</option>
                    <option value="2084">2084</option>
                    <option value="2085">2085</option>
                  </select>
                  <select class="p-2 bg-light" id="attendance-month" style="width:50%;outline:none;border-radius:none;border:none;">
                    <option value="1">Baishakh</option>
                    <option value="2">Jestha</option>
                    <option value="3">Ashadh</option>
                    <option value="4">Shrawan</option>
                    <option value="5">Bhadau</option>
                    <option value="6">Asoj</option>
                    <option value="7">Kartik</option>
                    <option value="8">Mangsir</option>
                    <option value="9">Poush</option>
                    <option value="10">Magh</option>
                    <option value="11">Falgun</option>
                    <option value="12">Chaitra</option>
                  </select>
                  <input class="search-btn text-light" type="submit" value="Search" style="width:25%;background:#ff9d37; border:none; cursor: pointer;">
               </div>
            </div>
            
            <div class="border" style="height:200px; overflow-y:auto;">
               <table class="table table-dark table-hover" >
                  <thead>
                      <tr style="background-color: #000">
                          <th scope="col" class="p-1 py-2">
                             <div class="d-flex flex-column">
                               <b>Date</b>
                               <div class="d-flex pl-1">
                                 <span class="text-center th-year" style="font-size:12px;">2080-</span>
                                 <span class="text-center th-month" style="font-size:12px;">10-</span>
                               </div>
                             </div>
                          </th>
                          <th scope="col" class="p-1 py-2">
                           <div class="d-flex flex-column">
                              <div class="d-flex justify-content-between">
                                 <b>Attendance</b>
                                 <span style="font-size:15px;">Periods: <b class="totalMonthPeriod">120/34</b></span>
                              </div>

                              <div class="d-flex align-items-center">
                                 <div class="progress" style="width:77%;height: 20px;border:1px solid #e9ecef;font-size:11px;">
                                    <div class="progress-bar bg-dark percentageProgress" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <div class="pl-2 percentageText" style="width:23%; font-size:13px;">0%</div>
                              </div>

                           </div>
                          </th>
                      </tr>
                  </thead>
                  <tbody class="attendance-table">
                    
                  </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="col-12 col-md-4 mb-3">
        <div  class="px-4 pt-2" style="height:300px;width:100%;border-radius:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
          <h4>Salary Recive</h4>
            <div class="list-group" style="height:230px;overflow: scroll;">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <small class="text-muted">And some muted small print.</small>
                </a>
            </div>
        </div>
      </div>
   </div>

   <div class="row">
      <div class="col-12 col-md-4 mb-3">
        <div  class="px-4 pt-2" style="height:300px;width:100%;border-radius:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
           <h4>Class Subject</h4>
            <ul class="list-group teacher-subject-list" style="height:230px;overflow: auto;">

            </ul>
        </div>
      </div>

      <div class="col-12 col-md-4 mb-3">
        <div  class="px-4 pt-2" style="height:300px;width:100%;border-radius:10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
           <h4>Login Authentication</h4>
           <span>Username</span>
           <li class="list-group-item d-flex justify-content-between login-email" style="width:auto;">
             mumtaz666raza@gmail.com
           </li>
           <span>Password</span>
           <li class="list-group-item d-flex justify-content-between login-psaaword" style="width:auto;">
             mumtaz666raza@gmail.com
           </li>
        </div>
      </div>
   </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Teacher_Account/teacher_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Teacher_Account/layouts/TeacherDashboard.blade.php ENDPATH**/ ?>