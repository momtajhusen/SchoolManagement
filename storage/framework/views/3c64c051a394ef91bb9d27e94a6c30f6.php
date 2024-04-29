<?php $__env->startSection('style'); ?>
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/select2.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/style.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/datepicker.min.css')); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('../admin_template_assets/css/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- ajax  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-get-all-student.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax Kick Out -->
    <script src="<?php echo e(asset('../admin_lang/kick-out/ajax-kick-out.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax print admission  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-print-admission.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax delete-student admission  -->
    <script src="<?php echo e(asset('../admin_lang/student/ajax-delete-student.js')); ?>?v=<?php echo e(time()); ?>"></script>

    <!-- ajax get all for class-select -->
    <script src="<?php echo e(asset('../admin_lang/classes/get-all-class.js')); ?>?v=<?php echo e(time()); ?>"></script> 

    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/select2.min.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/datepicker.min.js')); ?>"></script>

        <!-- Data Table Js -->
    <script src="<?php echo e(asset('../admin_template_assets/js/jquery.dataTables.min.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
 
                    <!-- Teacher Table Area Start Here -->
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Student</h3>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kick Out Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" id="st_id-input">
                                    <div class="col-12 form-group">
                                        <label>Kick Out Month</label>
                                        <select class="select2" required name="month" id="month">
                                            <option value="">Please Select Month *</option>
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
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary p-2 px-3" data-dismiss="modal">Cancle</button>
                                <button type="button" class="btn btn-primary p-2 px-3" id="model-save-btn">Kick Out</button>
                            </div>
                            </div>
                        </div>
                        </div>
 
                   
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row gutters-8">
                                    
                                    <div class="col-lg-5 col-12 form-group">
                                        <select class="select2 student-search-select" name="student_blood_group">
                                            <option value="">Select for search</option>
                                            <option value="class">Class Name</option>
                                            <option value="first_name">St First Name</option>
                                            <option value="village">Village Name</option>
                                            <option value="phone">Student Mobile</option>
                                            <option value="email">Student Email</option>
                                            <option value="id">st_id</option>
                                            <option value="parents_id">pr_Id</option>
                                            <option value="hostel_outi">hostel_outi</option>
                                            <option value="admission_date">Admission Date</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 col-12 form-group d-none" id="input-class-col">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Student First Name ..." class="form-control student-input-search" id="student-input" style="height:100%;background:#f0f1f3;">
                                    </div>
        
                                    <div class="col-lg-5 col-12 form-group" id="select-class-col">
                                        <select name="class" required class="select2 class-select  student-input-search" id="class-select" style="height:50px;width:100%; padding:10px;">
            
                                        </select>
                                    </div>
        
                                    <div class="col-lg-5 col-12 form-group d-none" id="select-hostel-col">
                                        <select name="hostel" required class="select2 student-input-search" id="hostel-select" style="height:50px;width:100%; padding:10px;">
                                           <option value="full-hostel">full-hostel</option>
                                            <option value="half-hostel">half-hostel</option>
                                            <option value="outi">outi</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-12 form-group admission-class-col d-none">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Admission From Date" class="form-control currentSatrtDate" id="from-admission-date" style="background:#f0f1f3;">
                                    </div>
                                    <div class="col-lg-3 col-12 form-group admission-class-col d-none">
                                        <input type="text" value="" maxlength="30" placeholder="Enter Admission To Date" class="form-control currentDate" id="to-admission-date" style="background:#f0f1f3;">
                                    </div>
                                    
        
                                    <div class="col-lg-2 col-12 form-group">
                                        <div class="fw-btn-fill btn-gradient-yellow text-center w-100 search-student d-flex justify-content-center align-items-center search-btn" style="height:100%;">SEARCH</div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="pl-1">
                                        <span>Total Result :</span>
                                        <span class="result_no"></span>
        
                                    </div>
                                    
                                </div>
                            </div>
 
                 


                        <div class="table-responsive" style="position:relative;">
                            <table class="table display data-table text-nowrap table-sm exportTable">
                                <thead>
                                    <tr>
                                        <th>st_id.</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Roll</th>
                                        <th>Section</th>
                                        <th>Admission Date</th>
                                        <th>pr_id.</th>
                                        <th>Father Name</th>
                                        <th>Address</th>
                                        <th>Student Phone</th>
                                        <th>
                                            <div class="d-flex flex-column align-items-center ml-1 export-excell-btn" btntable="month-wize" style="cursor:pointer;font-size: 15px; float: left">
                                                <span class="material-symbols-outlined p-1" id="btnCsvExport">file_save</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-body" style="height:150px;">
           
                                </tbody>
                            </table>
                        </div>

                        <nav class="mt-3" aria-label="Page navigation example">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">Previous</span>
                                </a>
                              </li>
                              <div class="d-flex pagnation-box">
            
                              </div>
                              <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </li>
                            </ul>
                          </nav>

                    </div>
                </div>
                <!-- Teacher Table Area End Here -->


                




<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_Page/Super_Admin/admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u569470620/domains/scriptqube.com/public_html/Schools_Projects/Gurukul_School/resources/views/Admin_Page/Super_Admin/layouts/Student_Management/all-student.blade.php ENDPATH**/ ?>