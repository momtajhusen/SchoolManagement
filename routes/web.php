<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'Front_Page/layouts/home');

Route::view('/account-login', 'Admin_Page/account_login')->name('school_login');
Route::view('/user-login', 'Admin_Page/user_login')->name('user_login');


///////////////////////////// START COMMON GET POST ROUTE /////////////////////////////
// if session exists -> account_management || student_management || super_admin || school_management
   Route::group(['middleware' => 'AdminCommonGetPost'], function () {

      Route::get('/get-all-parents', 'App\Http\Controllers\ParentsController@index');
      Route::view('admin/all-student', 'Admin_Page/Super_Admin/layouts/Student_Management/all-student')->name('all-student');

      Route::get('/single-student-details', 'App\Http\Controllers\StudentController@GetSingleStudent');
      Route::post('/update-student', 'App\Http\Controllers\StudentController@UpdateStudent');

      Route::get('/get-exam-term', 'App\Http\Controllers\ExamManageController@index_exam_term');
      Route::get('/process-exam-term', 'App\Http\Controllers\ExamManageController@process_exam_term');


      Route::post('/entry-mark', 'App\Http\Controllers\ExamManageController@entry_mark');
      Route::get('/get-studen-mark-entry', 'App\Http\Controllers\ExamManageController@index_studen_mark_entry');
   });
///////////////////////////// END COMMON GET POST ROUTE /////////////////////////////


///////////////////////////// Start Super Admin /////////////////////////////
   //Super Admin Login 
   Route::post('/super-admin-login', 'App\Http\Controllers\AccountLoginController@SuperAdminLogin');
   //Super Admin Logout 
   Route::post('/super-admin-logout', 'App\Http\Controllers\AccountLoginController@SuperAdminLogout');
   //Middleware Super Admin
   Route::group(['middleware' => 'SuperAdminLogin'], function () {

   // Developer 
      Route::view('admin/developer', 'Admin_Page/Super_Admin/layouts/developer')->name('developer');
      Route::post('/student-fee-set', 'App\Http\Controllers\DeveloperController@StudentFeeSet');

   // Developer 


   Route::view('admin/dashboard', 'Admin_Page/Super_Admin/layouts/SuperAdminDashboard')->name('dashboard');
   Route::view('admin', 'Admin_Page/Super_Admin/layouts/SuperAdminDashboard')->name('admin');
   Route::get('/super-admin-dashboard-data', 'App\Http\Controllers\SuperAdminDashboardController@index');
   Route::get('/month-earning-charts', 'App\Http\Controllers\SuperAdminDashboardController@month_earning_data');

   // Start Super Admin Account management
      Route::view('admin/set-fee', 'Admin_Page/Super_Admin/layouts/Account_management/set-fees')->name('set-fees');
      Route::view('admin/manage-feestracture', 'Admin_Page/Super_Admin/layouts/Account_management/manage-stracture')->name('manage-stracture');
      
      Route::view('admin/fee-payment', 'Admin_Page/Super_Admin/layouts/Account_management/fee-payment')->name('fee-payment');
      Route::view('admin/account-dashboard', 'Admin_Page/Super_Admin/layouts/Account_management/account-dashboard')->name('account-dashboard');
      // Route::view('admin/check-class-fee', 'Super_Admin/layouts/Account_management/check-class-fee')->name('check-class-fee');
      Route::view('admin/add-expenses', 'Admin_Page/Super_Admin/layouts/Account_management/add-expenses')->name('add-expenses');

      Route::view('admin/dues-list', 'Admin_Page/Super_Admin/layouts/Account_management/dues-list')->name('dues-list');
      Route::view('admin/class-finance', 'Admin_Page/Super_Admin/layouts/Reports_Area/class-finance')->name('class-finance');
      Route::view('admin/expense-reports', 'Admin_Page/Super_Admin/layouts/Reports_Area/expense_reports')->name('expense-reports');

      Route::view('admin/salary-report', 'Admin_Page/Super_Admin/layouts/Reports_Area/salary-report')->name('salary-report');
      Route::get('/get-salary-report', 'App\Http\Controllers\ReporstArea@salaryReport');


      Route::get('/retrive-stracture', 'App\Http\Controllers\FeeStructureController@indexManageFee');
      Route::post('/feestracture-update', 'App\Http\Controllers\FeeStructureController@updateFeeStracture');

      Route::get('/joining-set', 'App\Http\Controllers\FeeStructureController@joiningUpdate');

      Route::post('/set-fees', 'App\Http\Controllers\FeeStructureController@store');
      Route::post('/hostel-fees-set', 'App\Http\Controllers\HostelFeeController@update');
      Route::get('/get-hostel-fee', 'App\Http\Controllers\HostelFeeController@index');

      Route::post('/tuition-fees-set', 'App\Http\Controllers\TuitionFeeController@update');
      Route::get('/get-tuition-fee', 'App\Http\Controllers\TuitionFeeController@index');

      Route::get('/retrive-fees-stracture', 'App\Http\Controllers\FeeStructureController@index');
      Route::post('/fee-payment', 'App\Http\Controllers\FeePaymentController@store');
      Route::post('/add-expenses', 'App\Http\Controllers\ExpensesController@store');
      Route::get('/get-all-expenses', 'App\Http\Controllers\ExpensesController@index');
      Route::post('/delete-expenses', 'App\Http\Controllers\ExpensesController@destroy');
      Route::post('/update-expenses', 'App\Http\Controllers\ExpensesController@update');

      Route::get('/fee-payment-monthly', 'App\Http\Controllers\FeePaymenthMondthyController@index');
      Route::get('/invoice-data', 'App\Http\Controllers\FeePaymenthMondthyController@invoiceData');

      Route::post('/monthly-fee-collect', 'App\Http\Controllers\FeePaymentController@MonthlyfeeCollect');
      Route::post('/manual-backyear-fee', 'App\Http\Controllers\FeePaymentController@BackyearManualDues');
      Route::post('/joining-months-save', 'App\Http\Controllers\FeePaymenthMondthyController@joinMonthSave');
      Route::get('/get-joining-months', 'App\Http\Controllers\FeePaymenthMondthyController@GetjoinMonth');

      Route::post('/multy-pay-collect', 'App\Http\Controllers\FeePaymentController@MultiFeeCollect');
      Route::post('/lastyear-fee-collect', 'App\Http\Controllers\FeePaymentController@LastYearFeeCollect');
      Route::get('/dues-list', 'App\Http\Controllers\DuesListController@index');
      Route::post('/dues-message', 'App\Http\Controllers\DuesListController@duesMessage');
      Route::post('/reset-payment', 'App\Http\Controllers\ResetPaymentController@resetPayment');
      Route::post('/reset-all-payment', 'App\Http\Controllers\ResetPaymentController@resetAllPayment');
      Route::get('/back-year-fee', 'App\Http\Controllers\BackYearFeeController@GetBackYearFee');
      Route::get('/bill-data', 'App\Http\Controllers\BackYearFeeController@BillData');
      Route::get('/class-finance', 'App\Http\Controllers\ReporstArea@ClassFinance');
      Route::get('/year-fee-details', 'App\Http\Controllers\BackYearFeeController@YearFeeDetails');

      Route::get('/get-fee-monthly', 'App\Http\Controllers\FeePaymenthMondthyController@getFeeMonth');
      Route::get('/get-multi-monthly-fee', 'App\Http\Controllers\FeePaymenthMondthyController@getMultiMonthFee');

   // End Super Admin Account management

   // Start Super Admin Reports Area
      Route::view('admin/fee-collection-reports', 'Admin_Page/Super_Admin/layouts/Reports_Area/fee-collection-reports')->name('fee-collection-reports');
      Route::view('admin/financial-overview', 'Admin_Page/Super_Admin/layouts/Reports_Area/financialOverview')->name('financial-overview');

      Route::get('/get-collection-history', 'App\Http\Controllers\ReporstArea@CollectionReport');
      Route::get('/get-collection-date-wize', 'App\Http\Controllers\ReporstArea@CollectionDateWize');
      Route::get('/get-collection-student-wize', 'App\Http\Controllers\ReporstArea@CollectionStudentWize');


      Route::get('/get-monthlyfee-generate', 'App\Http\Controllers\ReporstArea@MonthlyFeeGenerate');

      // Route::get('/get-collection-months', 'App\Http\Controllers\ReporstArea@CollectionMonths');

      Route::get('/get-expense-reports', 'App\Http\Controllers\ReporstArea@expenseReports');

      Route::get('/financial-overview', 'App\Http\Controllers\ReporstArea@financialOverview');

   // End Super Admin Reports Area

   // Super Admin School Management
   Route::view('admin/add-classes', 'Admin_Page/Super_Admin/layouts/School_Management/add-classes')->name('add-classes');
   Route::view('admin/add-subjects', 'Admin_Page/Super_Admin/layouts/School_Management/add-subjects')->name('add-subjects');
   Route::view('admin/time-table', 'Admin_Page/Super_Admin/layouts/School_Management/time-table')->name('time-table');

   Route::view('admin/students-admission', 'Admin_Page/Super_Admin/layouts/Student_Management/add-students')->name('add-students');

   Route::view('admin/multiple-students-admission', 'Admin_Page/Super_Admin/layouts/Student_Management/add-multiple-students')->name('add-multiple-students');
   Route::post('/add-multiple-students', 'App\Http\Controllers\StudentController@MultipleStudentStore');


   Route::get('admin/student-details/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/Student_Management/student-details', ['id' => $id]);
   })->name('student-details');

   Route::post('/add-subject', 'App\Http\Controllers\SubjectController@store');
   Route::get('/get-all-subject', 'App\Http\Controllers\SubjectController@index');
   Route::post('/delete-subject', 'App\Http\Controllers\SubjectController@destroy');
   Route::post('/update-subject', 'App\Http\Controllers\SubjectController@update');
   Route::post('/add-class', 'App\Http\Controllers\ClassController@store');
   Route::post('/update-class', 'App\Http\Controllers\ClassController@update');
   Route::post('/delete-class', 'App\Http\Controllers\ClassController@destroy');

   Route::get('/get-all-class', 'App\Http\Controllers\ClassController@index');
   Route::get('/admin/class-section', 'App\Http\Controllers\StudentController@class_section');
   Route::get('/option-all-class', 'App\Http\Controllers\ClassController@option_class');

   // Super Admin Class Time Table
   Route::post('/add-class-period', 'App\Http\Controllers\ClassTimeTableController@addClassPeriod');
   Route::get('/get-class-period', 'App\Http\Controllers\ClassTimeTableController@getClassPeriod');
   Route::post('/delete-period', 'App\Http\Controllers\ClassTimeTableController@deletePeriod');
   Route::post('/delete-subject-period', 'App\Http\Controllers\ClassTimeTableController@deleteSubjectPeriod');

   Route::get('/get-period-subjects', 'App\Http\Controllers\ClassTimeTableController@getPeriodSubjects');
   Route::post('/save-period-subjects', 'App\Http\Controllers\ClassTimeTableController@savePeriodSubjects');
   Route::get('/get-subject-period', 'App\Http\Controllers\ClassTimeTableController@getSubjectPeriod');

   Route::view('admin/class-period', 'Admin_Page/Super_Admin/layouts/ClassTimeTable/class-period')->name('class-period');
   Route::view('admin/class-timetable-subject', 'Admin_Page/Super_Admin/layouts/ClassTimeTable/class-subjects')->name('class-subject');
   Route::view('admin/print-timetable', 'Admin_Page/Super_Admin/layouts/ClassTimeTable/print-time-table')->name('print-timetable');

   // Super Admin Student Management
   Route::view('admin/all-student', 'Admin_Page/Super_Admin/layouts/Student_Management/all-student')->name('all-student');
   Route::view('admin/registration-list', 'Admin_Page/Super_Admin/layouts/Student_Management/registration-list')->name('registration-list');

   Route::post('/add-student', 'App\Http\Controllers\StudentController@store');

   Route::view('admin/student-promotion', 'Admin_Page/Super_Admin/layouts/Student_Management/student-promotion')->name('student-promotion');
   Route::view('admin/passout-student', 'Admin_Page/Super_Admin/layouts/Student_Management/passout-student')->name('passout-student');
   Route::view('admin/student-parents', 'Admin_Page/Super_Admin/layouts/Student_Management/student_parents')->name('admin_student_parents');
   
   Route::view('admin/kick-out', 'Admin_Page/Super_Admin/layouts/Student_Management/kick-out-student')->name('kick_out');


   Route::view('admin/manage-free-student', 'Admin_Page/Super_Admin/layouts/Student_Management/manage_free_student')->name('manage_free_student');
   
   Route::get('admin/manage-free-student/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/Student_Management/manage_free_student', ['id' => $id]);
   });

   Route::get('/parent-child-fee', 'App\Http\Controllers\ManageFreeStudent@index');
   Route::get('/free-fee-stracture', 'App\Http\Controllers\ManageFreeStudent@FreeFeeStracture');
   Route::post('/student-free-fee', 'App\Http\Controllers\ManageFreeStudent@SaveStudentFreeFee');
   Route::get('/get-kick-out', 'App\Http\Controllers\KickOutStudent@GetKickOutStudent');


   Route::get('admin/parent-profile/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/Parents/parent-profile', ['id' => $id]);
   });


   Route::get('/get-parent-profile', 'App\Http\Controllers\ParrentProfile@index');
   Route::get('/admin/student-fee-starcture-retrive', 'App\Http\Controllers\ParrentProfile@StudentsFeeStractures');
   Route::post('/admin/student-fee-starcture-save', 'App\Http\Controllers\ParrentProfile@StudentsFeeStracturesSave');
   Route::post('/admin/delete-month-fee', 'App\Http\Controllers\ParrentProfile@DeleteMonthFee');
   Route::post('/admin/delete-month', 'App\Http\Controllers\ParrentProfile@DeleteMonth');

   // Start New Account payment 
      Route::view('admin/student-fee-payment', 'Admin_Page/Super_Admin/layouts/Account_management/student-fee-payment')->name('student-fee-payment');

      Route::get('/parent-student-retrive', 'App\Http\Controllers\StudentsFeePayment@ParentStudentRetrive');
      Route::get('/student-fee-retrive', 'App\Http\Controllers\StudentsFeePayment@StudentFeePaymentRetrive');
      Route::get('/student-fee-month-particular', 'App\Http\Controllers\StudentsFeePayment@StudentFeeMonthParticular');
      Route::post('/student-fee-paid', 'App\Http\Controllers\StudentsFeePayment@StudentFeePaid');
      Route::get('/student-paid-history', 'App\Http\Controllers\StudentsFeePayment@StudentFeePaidHistory');
      Route::get('/student-invoice-data', 'App\Http\Controllers\StudentsFeePayment@StudentFeeInvoiceData');




   // End New Account payment 

   // Start SelectOption 
      Route::get('/get-all-admit-parents', 'App\Http\Controllers\SelectOption@AllAdmitParents');

      Route::get('/get-all-admit-student', 'App\Http\Controllers\SelectOption@AllAdmitStudents');


   // End SelectOption 

    

   Route::post('/admin/save-deal-fee', 'App\Http\Controllers\ParrentProfile@SaveDealFee');
   Route::post('/admin/add-month', 'App\Http\Controllers\ParrentProfile@AddMonth');


   Route::post('/parent-blance-load', 'App\Http\Controllers\ParrentWallet@loadBlanceSave');
   Route::get('/get-parent-wallet-data', 'App\Http\Controllers\ParrentWallet@walletData');

   Route::get('admin/update-student-details/{id}', function ($id) {
     return view('Admin_Page/Super_Admin/layouts/Student_Management/update_student_details', ['id' => $id]);
   });

   Route::view('admin/student-identification', 'Admin_Page/Super_Admin/layouts/Student_Management/generate_id_card')->name('student-identification');
   Route::get('/get-parent-data', 'App\Http\Controllers\ParentsController@show');
   Route::post('/update-parent-data', 'App\Http\Controllers\ParentsController@update');
   Route::post('/delete-parent', 'App\Http\Controllers\ParentsController@DeleteParent');

   Route::get('/get-all-student', 'App\Http\Controllers\StudentController@index');
   Route::get('/get-registration-list', 'App\Http\Controllers\StudentController@RegistrationList');
   Route::post('/registration-conform', 'App\Http\Controllers\StudentController@RegistrationConform');
   Route::post('/all-registration-conform', 'App\Http\Controllers\StudentController@AllRegistrationConform');
   Route::post('/all-registration-delete', 'App\Http\Controllers\StudentController@AllRegistrationDelete');


   Route::get('/admin/admission-print', 'App\Http\Controllers\StudentController@admission_print');

   Route::get('/get-single-student/{id}', 'App\Http\Controllers\StudentController@show');
   Route::get('/get-class-roll', 'App\Http\Controllers\StudentController@getclassroll');

   Route::get('/roll-generate-admission', 'App\Http\Controllers\StudentController@admission_roll');
   Route::get('/get-student-for-id', 'App\Http\Controllers\StudentController@student_for_card');

   Route::post('/admin/delete-student', 'App\Http\Controllers\StudentController@delete_student');
   Route::post('/check-student-email', 'App\Http\Controllers\EmailCheckController@StudentEmailCheck');
   Route::post('/check-father-email', 'App\Http\Controllers\EmailCheckController@FatherEmailCheck');
   Route::post('/check-student-number', 'App\Http\Controllers\NumberCheckController@StudentNumberCheck');
   Route::post('/check-father-number', 'App\Http\Controllers\NumberCheckController@FatherNumberCheck');
   Route::post('/check-mother-number', 'App\Http\Controllers\NumberCheckController@MotherNumberCheck');
   Route::post('/student-img-crop', 'App\Http\Controllers\ImageCropController@StudentProfileImg');
   Route::post('/father-img-crop', 'App\Http\Controllers\ImageCropController@FatherProfileImg');
   Route::post('/mother-img-crop', 'App\Http\Controllers\ImageCropController@MotherProfileImg');
   Route::post('/document-img-crop', 'App\Http\Controllers\ImageCropController@DocumentImg');
   Route::get('/get-class-student', 'App\Http\Controllers\StudentPromotionController@index');
   Route::post('/passout-class-student', 'App\Http\Controllers\PassOutStudentController@passout');
   Route::post('/student-promote', 'App\Http\Controllers\StudentPromotionController@StudentPromote');

   // Hostel Management
   Route::view('admin/hostel-students', 'Admin_Page/Super_Admin/layouts/Hostel_Management/hostel-students')->name('hostel-students');


   // Super Admin Teacher Management
   Route::view('admin/add-teacher', 'Admin_Page/Super_Admin/layouts/Teachers/add-teacher')->name('add-teacher');
   Route::view('admin/all-teacher', 'Admin_Page/Super_Admin/layouts/Teachers/all-teachers')->name('all-teachers');
   Route::view('admin/teacher-subjects', 'Admin_Page/Super_Admin/layouts/Teachers/teacher-subjects')->name('teacher-subjects');
   Route::view('admin/teacher-timetable', 'Admin_Page/Super_Admin/layouts/Teachers/teacher-timetable')->name('teacher-timetable');


   Route::get('teacher-update/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/update-teacher', ['id' => $id]);
   });

   Route::get('update_employee/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/Employee_Management/update_employee', ['id' => $id]);
   });
   Route::post('/update-employee', 'App\Http\Controllers\EmployeeController@update');
   Route::post('/admin/delete-employee', 'App\Http\Controllers\EmployeeController@deleteEmployee');



   Route::get('admin/teacher-profile/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/Teachers/teacher-profile', ['id' => $id]);
   });
   
   Route::post('/add-teacher', 'App\Http\Controllers\TeacherController@store');
   Route::post('/update-teacher', 'App\Http\Controllers\TeacherController@update');
   Route::get('/get-all-teacher', 'App\Http\Controllers\TeacherController@index');
   Route::get('/get-search-teacher', 'App\Http\Controllers\TeacherController@searchTeacher');

   Route::get('get-single-teacher/{id}', 'App\Http\Controllers\TeacherController@show');
   Route::post('assign-teacher-subject', 'App\Http\Controllers\TeacherController@assignTeacherSubject');
   Route::get('/get-teacher-subject', 'App\Http\Controllers\TeacherController@getTeacherSubject');
   Route::post('/delete-teacher-subject', 'App\Http\Controllers\TeacherController@deleteTeacherSubject');

   Route::get('/get-teacher-timetable', 'App\Http\Controllers\TeacherController@getTeacherTimetable');

   Route::post('/check-teacher-email', 'App\Http\Controllers\EmailCheckController@TeacherEmailCheck');
   Route::post('/check-teacher-number', 'App\Http\Controllers\NumberCheckController@TeacherNumberCheck');
   Route::post('/teacher-img-crop', 'App\Http\Controllers\ImageCropController@TeacherImgCrope');
   Route::post('/employee-img-crop', 'App\Http\Controllers\ImageCropController@EmployeeImgCrope');


   Route::get('/get-passout-year', 'App\Http\Controllers\PassOutStudentController@PassoutYear');
   Route::get('/get-passout-class', 'App\Http\Controllers\PassOutStudentController@GetPassoutClass');

   Route::get('/get-passout-student', 'App\Http\Controllers\PassOutStudentController@GetPassoutStudent');
   Route::get('/get-passout-student-details', 'App\Http\Controllers\PassOutStudentController@GetPassoutStudentDetails');

   Route::post('/admin/kick-out-student', 'App\Http\Controllers\KickOutStudent@KickOutStudent');
   // Route::get('/admin/total-fee-kickout', 'App\Http\Controllers\KickOutStudent@TotalFeeKickOut');
   Route::get('/get-kickout-student-details', 'App\Http\Controllers\KickOutStudent@GetKickOutStudentDetails');
   Route::post('/kickout-student-re-enter', 'App\Http\Controllers\KickOutStudent@ReEnter');

   // Teacher Attendance 
   Route::get('/get-teacher-attendance-period', 'App\Http\Controllers\TeachersAttendanceController@getTeacherAttendancePeriod');
   Route::post('/teachers-attendance', 'App\Http\Controllers\TeachersAttendanceController@SaveTeachersAttendance');

   Route::get('/get-teachers-for-setperiods', 'App\Http\Controllers\TeachersAttendanceController@getTeacherForPeriod');
   Route::post('/teachers-period-for-update', 'App\Http\Controllers\TeachersAttendanceController@updateTeacherPeriod');

   Route::get('/get-teacher-attendance-report', 'App\Http\Controllers\TeachersAttendanceController@getTeacherAttendanceReports');
   Route::get('/get-staff-attendance-report', 'App\Http\Controllers\StaffAttendanceController@getStaffAttendanceReports');


   Route::get('/get-teacher-profile-attendance-report', 'App\Http\Controllers\TeachersAttendanceController@teacherProfileAttendanceReport');
   
   // Staff Attendance
   Route::get('/get-staff-for-attendance', 'App\Http\Controllers\StaffAttendanceController@getStaffForAttendance');
   Route::post('/staff-attendance', 'App\Http\Controllers\StaffAttendanceController@SaveStaffAttendance');

   Route::get('get-single-employee/{id}', 'App\Http\Controllers\EmployeeController@show');



   // Teacher/Staff Salary 
   Route::view('admin/teacher-payment', 'Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/salary-payment')->name('salary-payment');
   Route::view('admin/salary-payment-history', 'Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/salary-payment-history')->name('salary-payment-history');

   Route::view('admin/salary-set', 'Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/salary-set')->name('salary-set');
   Route::view('admin/salary-generate', 'Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/salary-generate')->name('salary-generate');
   Route::view('admin/bonus-ssf-setting', 'Admin_Page/Super_Admin/layouts/TeachersStaff_Salary/bonus-ssf-setting')->name('bonus-ssf-setting');

   Route::post('/admin/save-bonus-ssf-setting', 'App\Http\Controllers\EmployeesSalariesController@SaveBonusSsfSetting');
   Route::get('/admin/get-bonus-ssf-setting', 'App\Http\Controllers\EmployeesSalariesController@GetBonusSsfSetting');
   Route::post('/save-epm-bonus-setting', 'App\Http\Controllers\EmployeesSalariesController@SaveEpmBonusSetting');
   Route::get('/get-all-employee-bonus-setting', 'App\Http\Controllers\EmployeesSalariesController@GetAllEmployeeBonusSetting');


   Route::get('/admin/all-salary-payment-history', 'App\Http\Controllers\EmployeesSalariesController@AllSalaryHistory');

   Route::post('/admin/add-employee-salary', 'App\Http\Controllers\EmployeesSalariesController@AddSalary');
   Route::get('/admin/get-employees-salary', 'App\Http\Controllers\EmployeesSalariesController@GetSalary');
   Route::get('/admin/get-generate-salary', 'App\Http\Controllers\EmployeesSalariesController@GetGenerateSalary');
   Route::post('/admin/teacher-salary-payment', 'App\Http\Controllers\EmployeesSalariesController@TeacherSalaryPayment');

   Route::get('/admin/teacher-salary-paid-history', 'App\Http\Controllers\EmployeesSalariesController@SalaryHistory');
   Route::post('/admin/teacher-salary-history-reset', 'App\Http\Controllers\EmployeesSalariesController@SalaryHistoryReset');



   Route::get('/admin/print-slip-data', 'App\Http\Controllers\EmployeesSalariesController@SalarySlipData');


   Route::view('admin/teachers-periods', 'Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-periods')->name('set-teachers-periods');
   Route::view('admin/teacher-attendance', 'Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-attendance')->name('teachers-attendance');
   Route::view('admin/staff-attendance', 'Admin_Page/Super_Admin/layouts/Teachers_Attendance/staff-attendance')->name('staff-attendance');

   Route::view('admin/teacher-attendance-report', 'Admin_Page/Super_Admin/layouts/Teachers_Attendance/teachers-attendance-report')->name('teachers-attendance-report');

   // Super Admin Message
   Route::view('admin/message', 'Admin_Page/Super_Admin/layouts/Message/message')->name('message');
   Route::post('/sendemail/send', 'App\Http\Controllers\MailController@send');

   // Transport
   Route::view('admin/transport/add-driver', 'Admin_Page/Super_Admin/layouts/Transport/add-driver')->name('add-driver');
   Route::view('admin/transport/vehicle', 'Admin_Page/Super_Admin/layouts/Transport/add-vehicle')->name('add-vehicle');
   Route::view('admin/transport/set-vehicle-root', 'Admin_Page/Super_Admin/layouts/Transport/set-vehicle-root')->name('vehicle-root');
   Route::view('admin/transport/transport-student', 'Admin_Page/Super_Admin/layouts/Transport/transport-student')->name('transport-student');


   Route::post('/driver-img-crop', 'App\Http\Controllers\ImageCropController@DriverImgCrope');
   Route::post('/add-driver', 'App\Http\Controllers\DriverController@store');
   Route::post('/update-driver', 'App\Http\Controllers\DriverController@update');
   Route::get('/retrive-driver', 'App\Http\Controllers\DriverController@index');
   Route::get('/get-all-driver', 'App\Http\Controllers\DriverController@index');
   Route::post('/delete-driver', 'App\Http\Controllers\DriverController@destroy');
   Route::post('/check-drive-number', 'App\Http\Controllers\NumberCheckController@DriverNumberCheck');
   Route::post('/check-driver-email', 'App\Http\Controllers\NumberCheckController@DriverEmailCheck');

   Route::post('/add-vehicle', 'App\Http\Controllers\VehicleController@store');
   Route::post('/update-vehicle', 'App\Http\Controllers\VehicleController@update');
   Route::post('/delete-vehicle', 'App\Http\Controllers\VehicleController@delete_vehicle');
   Route::get('/get-all-vehicle', 'App\Http\Controllers\VehicleController@index');

   Route::post('/add-vehicle-root', 'App\Http\Controllers\VehicleController@AddVehicleRoot');
   Route::post('/update-vehicle-root', 'App\Http\Controllers\VehicleController@UpdateVehicleRoot');
   Route::post('/delete-vehicle-root', 'App\Http\Controllers\VehicleController@DeleteVehicleRoot');

   Route::get('/get-all-vehicle-root', 'App\Http\Controllers\VehicleController@GetVehicleRoot');
   Route::get('/get-transport-student', 'App\Http\Controllers\StudentController@GetTransportStudent');


   // Website Setting 
   Route::view('admin/school-details', 'Admin_Page/Super_Admin/layouts/website-setting')->name('school-details');

   Route::view('admin/active-device-info', 'Admin_Page/Super_Admin/layouts/OnlineActivites/activeDeviceInfo')->name('active-device');

   Route::post('/school-logo-crop', 'App\Http\Controllers\ImageCropController@SchoolLogo');
   Route::post('/school-details', 'App\Http\Controllers\SchoolDetailsController@store');
   Route::get('/school-details', 'App\Http\Controllers\SchoolDetailsController@index');
   Route::post('/date-setting', 'App\Http\Controllers\SchoolDetailsController@dateSettingUpadet');
   Route::get('/date-setting', 'App\Http\Controllers\SchoolDetailsController@dateSettingGet');
   Route::get('/getDeviceInfo', 'App\Http\Controllers\OnlineActivitesController@getDeviceInfo');

   // Exam Management 
   Route::view('admin/exam-term', 'Admin_Page/Super_Admin/layouts/Exam_Management/exam-term')->name('exam-term');
   Route::view('admin/exam-timetable', 'Admin_Page/Super_Admin/layouts/Exam_Management/exam-timetable')->name('exam-timetable');
   Route::view('admin/marks-entry', 'Admin_Page/Super_Admin/layouts/Exam_Management/marks-entry')->name('marks-entry');
   Route::view('admin/exam-grade', 'Admin_Page/Super_Admin/layouts/Exam_Management/exam-grade')->name('exam-grade');
   Route::view('admin/tabulation-sheet', 'Admin_Page/Super_Admin/layouts/Exam_Management/tabulation-sheet')->name('tabulation-sheet');
   Route::view('admin/position-holder', 'Admin_Page/Super_Admin/layouts/Exam_Management/position-holder')->name('position-holder');
   Route::view('admin/print-admit-cards', 'Admin_Page/Super_Admin/layouts/Exam_Management/print-admit-cards')->name('print-admit-cards');
   Route::view('admin/print-marksheets', 'Admin_Page/Super_Admin/layouts/Exam_Management/print-marksheets')->name('print-marksheets');
   Route::view('admin/result-announcement', 'Admin_Page/Super_Admin/layouts/Exam_Management/result-announcement')->name('result-announcement');

   Route::post('/create-exam-term', 'App\Http\Controllers\ExamManageController@create_exam_term');
   Route::post('/delete-exam-term', 'App\Http\Controllers\ExamManageController@delete_exam_term');

   Route::post('/create-exam-timetable', 'App\Http\Controllers\ExamManageController@create_exam_timetable');
   Route::post('/delete-timetable', 'App\Http\Controllers\ExamManageController@delete_timetable');
   Route::get('/get-exam-timetable', 'App\Http\Controllers\ExamManageController@index_exam_timetable');
 
   Route::post('/exam-grade-set', 'App\Http\Controllers\ExamManageController@set_exam_grade');
   Route::post('/delete-exam-grade', 'App\Http\Controllers\ExamManageController@delete_exam_grade');
   Route::get('/get-exam-grade', 'App\Http\Controllers\ExamManageController@index_exam_grade');

   Route::post('/exam-status', 'App\Http\Controllers\ExamManageController@examStatus');

   Route::get('/get-exam-tabulation', 'App\Http\Controllers\ExamManageController@index_exam_tabulation');
   Route::post('/delete-subject-tabulation', 'App\Http\Controllers\ExamManageController@deleteTabulationSubject');
   Route::get('/get-admit-card', 'App\Http\Controllers\ExamManageController@index_admit_card');
   Route::get('/result-annoucement', 'App\Http\Controllers\ExamManageController@ResultAnnoucement');

   // Stock Store
   Route::view('admin/items-category', 'Admin_Page/Super_Admin/layouts/StockStore/AddItemsCategory')->name('items-category');
   Route::view('admin/items-price', 'Admin_Page/Super_Admin/layouts/StockStore/AddItemsPrice')->name('items-price');
   Route::view('admin/add-items-in-stock', 'Admin_Page/Super_Admin/layouts/StockStore/ItemsInStock')->name('items-in-stock');
   Route::view('admin/sell-items', 'Admin_Page/Super_Admin/layouts/StockStore/sellItems')->name('sell-items');

   Route::post('/add-items-category', 'App\Http\Controllers\StockStoreController@AddItemsCategory');
   Route::get('/get-items-all-category', 'App\Http\Controllers\StockStoreController@GetItemsCategory');

   Route::post('/delete-category', 'App\Http\Controllers\StockStoreController@DeleteCategory');

   Route::post('/admin/add-items', 'App\Http\Controllers\StockStoreController@AddItems');
   Route::get('/admin/get-all-items', 'App\Http\Controllers\StockStoreController@GetAllItems');
   Route::get('/get-items-category-change', 'App\Http\Controllers\StockStoreController@GetItemsCategoryChange');
   Route::post('/admin/delete-item', 'App\Http\Controllers\StockStoreController@DeleteItem');

   Route::post('/admin/add-items-in-stock', 'App\Http\Controllers\StockStoreController@AddItemsInStock');
   Route::get('/admin/get-items-in-stock', 'App\Http\Controllers\StockStoreController@GetItemsInStock');

   Route::get('/admin/get-items-add-history', 'App\Http\Controllers\StockStoreController@GetItemsAddStockHistory');

   // Account Setting
   Route::view('admin/account-setting', 'Admin_Page/Super_Admin/layouts/Account_setting/account_setting')->name('account-setting');

   // Visitor  Activity 
   Route::view('admin/visitor-page-activity', 'Admin_Page/Super_Admin/layouts/VisitorActivity/pageActivity')->name('visitor-page-activity');
   Route::view('admin/visitor-button-activity', 'Admin_Page/Super_Admin/layouts/VisitorActivity/pageButtonActivity')->name('visitor-button-activity');

   Route::post('/demo-visitor-data-save', 'App\Http\Controllers\VisitorLogsController@DemoVisitorSave');

   Route::post('/admin/visitor-page-log', 'App\Http\Controllers\VisitorLogsController@VisitorPageLogs');
   Route::get('/get-page-activity', 'App\Http\Controllers\VisitorLogsController@GetPageActivity');

   Route::post('/admin/visitor-button-clicking', 'App\Http\Controllers\VisitorLogsController@VisitorButtonClicking');
   Route::get('/get-button-activity', 'App\Http\Controllers\VisitorLogsController@GetButtonActivity');

});

   // Employee Management
   Route::view('admin/add_new_employee', 'Admin_Page/Super_Admin/layouts/Employee_Management/add_new_employee')->name('add-new-employee');
   Route::view('admin/teacher_staff_details', 'Admin_Page/Super_Admin/layouts/Employee_Management/teacher_staff_details')->name('teacher-staff-details');

   Route::post('admin/add_new_employee', 'App\Http\Controllers\EmployeeController@AddEmployee');
   Route::get('/get-all-employee', 'App\Http\Controllers\EmployeeController@GetAllemployee');


   // Role & Permission
   Route::view('admin/sub_admin_list', 'Admin_Page/Super_Admin/layouts/RoleAndPermission/sub_admin_list')->name('sub_admin_list');
   Route::view('admin/role_permission', 'Admin_Page/Super_Admin/layouts/RoleAndPermission/role_permission')->name('role_permission');

   Route::get('admin/role-permission-update/{id}', function ($id) {
      return view('Admin_Page/Super_Admin/layouts/RoleAndPermission/role_permission', ['id' => $id]);
   });
      
      

   
   Route::post('/admin/user-routes-save', 'App\Http\Controllers\RoleAndPermissionController@SaveRoleAndPermission');
   Route::get('/admin/user-routes-check', 'App\Http\Controllers\RoleAndPermissionController@CheckUserRoutes');
   Route::get('/admin/sub-admin-list', 'App\Http\Controllers\RoleAndPermissionController@SubAdminList');

   Route::get('/admin/get-subadmin-details', 'App\Http\Controllers\RoleAndPermissionController@SubAdminDataForUpdate');


///////////////////////////// End Super Admin /////////////////////////////

///////////////////////////// Start Student Management /////////////////////////////
   //Student Management Login 
   Route::post('/student-management-login', 'App\Http\Controllers\AccountLoginController@studentManagement');
   //Student Management Logout 
   Route::post('/student-management-logout', 'App\Http\Controllers\AccountLoginController@StudentManagementLogout');
   //Middleware Student Management
   Route::group(['middleware' => 'studentManagementLogin'], function () {
      // View Route 
      Route::view('student-management', 'Admin_Page/Student_Management/layouts/dashboard')->name('student_management');
      Route::view('student-management/dashboard', 'Admin_Page/Student_Management/layouts/dashboard')->name('school_management_dashboard');
      Route::view('student-management/student-registration', 'Admin_Page/Student_Management/layouts/student_registration')->name('school_management_student_registration');
      Route::view('student-management/registration-list', 'Admin_Page/Student_Management/layouts/registration_list')->name('school_management_registration_list');
      Route::view('student-management/check-fee-stracture', 'Admin_Page/Student_Management/layouts/check-fee-stracture')->name('school_management_check_fee_stracture');
      Route::view('student-management/student-parents', 'Admin_Page/Student_Management/layouts/student_parents')->name('school_management_student_parents');
      Route::view('student-management/update-student-details', 'Admin_Page/Student_Management/layouts/update_student_details')->name('school_management_update_student_details');
      Route::view('student-management/generate-id-card', 'Admin_Page/Student_Management/layouts/generate_id_card')->name('school_management_generate_id_card');

      // Get & Post route 
      Route::get('/registration-list', 'App\Http\Controllers\StudentController@registration_list');
   });
///////////////////////////// End Student Management /////////////////////////////

///////////////////////////// Start Account Management /////////////////////////////
   //Student Management Login 
   Route::post('/account-management-login', 'App\Http\Controllers\AccountLoginController@AccountManagementLogin');
   //Student Management Logout 
   Route::post('/account-management-logout', 'App\Http\Controllers\AccountLoginController@AccountManagementLogout');
   Route::group(['middleware' => 'AccountManagementLogin'], function () {
      Route::view('account-management', 'Admin_Page/Account_Management/layouts/dashboard')->name('account_management');
   });
///////////////////////////// End Account Management /////////////////////////////

///////////////////////////// Start School Management /////////////////////////////
   //Student Management Login 
   Route::post('/school-management-login', 'App\Http\Controllers\AccountLoginController@SchoolManagementLogin');
   //Student Management Logout 
   Route::post('/school-management-logout', 'App\Http\Controllers\AccountLoginController@SchoolManagementLogout');
   Route::group(['middleware' => 'SchoolManagementLogin'], function () {
      Route::view('school-management', 'Admin_Page/School_Management/layouts/dashboard')->name('school_management');
   });
///////////////////////////// End School Management /////////////////////////////

///////////////////////////// START PARENT ACCOUNT /////////////////////////////
   Route::post('/parent-login', 'App\Http\Controllers\UserLoginController@ParentLogin');
   Route::post('/parent-logout', 'App\Http\Controllers\UserLoginController@ParentLogout');

   Route::group(['middleware' => 'ParentAccountLogin'], function () {
      Route::view('parent/dashboard', 'Admin_Page/Parent_Account/layouts/ParentDashboard')->name('parent-dashboard');
      Route::view('parent/monthly-fee', 'Admin_Page/Parent_Account/layouts/MonthlyFee')->name('monthly-fee');
      Route::view('parent/payment-bill', 'Admin_Page/Parent_Account/layouts/PaymentBill')->name('payment-bill');

      Route::get('/get-student', 'App\Http\Controllers\ParentAccount\StudentController@index');
      Route::get('/parent-payment-monthly', 'App\Http\Controllers\FeePaymenthMondthyController@index');
   });

///////////////////////////// END PARENT ACCOUNT /////////////////////////////

///////////////////////////// START STUDENT ACCOUNT /////////////////////////////
   Route::post('/student-login', 'App\Http\Controllers\UserLoginController@StudentLogin');
   Route::post('/student-logout', 'App\Http\Controllers\UserLoginController@StudentLogout');

   Route::group(['middleware' => 'StudentAccountLogin'], function () {
      Route::view('student/dashboard', 'Admin_Page/Student_Account/layouts/StudentDashboard')->name('student-dashboard');
      Route::get('/get-student-data', 'App\Http\Controllers\StudentAccount\StudentAccountController@index');
   });

///////////////////////////// END STUDENT ACCOUNT /////////////////////////////

///////////////////////////// START TEACHER ACCOUNT /////////////////////////////
   Route::post('/teacher-login', 'App\Http\Controllers\UserLoginController@TeacherLogin');
   Route::post('/teacher-logout', 'App\Http\Controllers\UserLoginController@TeacherLogout');

   Route::group(['middleware' => 'TeacherAccountLogin'], function () {
      Route::view('teacher/dashboard', 'Admin_Page/Teacher_Account/layouts/TeacherDashboard')->name('teacher-dashboard');
      Route::view('teacher/exam-marks-entry', 'Admin_Page/Teacher_Account/layouts/ExamMarksEntry')->name('exam-marks-entry');

      Route::get('/get-teacher-data', 'App\Http\Controllers\TeacherAccount\TeacherAccountController@index');
      Route::get('/teacher/get-teacher-class', 'App\Http\Controllers\TeacherAccount\TeacherAccountController@teacherClass');
      Route::get('/teacher/get-teacher-subject', 'App\Http\Controllers\TeacherAccount\TeacherAccountController@teacherSubject');

      Route::get('/teacher/class-section', 'App\Http\Controllers\StudentController@class_section');

      Route::get('/teacher-account/get-teacher-profile-attendance-report', 'App\Http\Controllers\TeachersAttendanceController@teacherProfileAttendanceReport');
   
   });
///////////////////////////// END STUDENT ACCOUNT /////////////////////////////


// Route::get('/command/seed', function () {
//   Artisan::call('db:seed');
// });

// Route::get('/command/cache', function () {
//   Artisan::call('cache:clear');
// });

// Route::get('/command/storage', function () {
//   Artisan::call('storage:link');
// });

// Route::get('/command/migrate_fresh', function () {
//   Artisan::call('migrate:fresh');
// });

// Route::get('/command/migrate', function () {
//   Artisan::call('migrate');
// });


Route::get('/command/migrate_specific', function () {
   Artisan::call('migrate', [
       '--path' => [
           'database/migrations/2024_03_06_041716_create_students_fee_stractures_table.php',
           'database/migrations/2024_03_10_054154_create_students_fee_months_table.php',
           'database/migrations/2024_03_17_172859_create_students_fee_paids_table.php',
           'database/migrations/2024_03_17_172940_create_students_fee_dues_table.php',
           'database/migrations/2024_03_17_172954_create_students_fee_discs_table.php',
           'database/migrations/2024_03_19_070225_create_students_fee_paid_histories_table.php',
       ]
   ]);
});
 