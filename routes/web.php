<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/','welcome')->name('home');

Route::view('/account-login','account_login')->name('school_login');
Route::view('/user-login','user_login')->name('user_login');


///////////////////////////// START COMMON GET POST ROUTE /////////////////////////////
// if session exists -> account_management || student_management || super_admin || school_management 
Route::group(['middleware'=>'AdminCommonGetPost'],function()
{
   Route::get('/get-all-parents', 'App\Http\Controllers\ParentsController@index');
    
});

///////////////////////////// END COMMON GET POST ROUTE /////////////////////////////


///////////////////////////// Start Super Admin /////////////////////////////
//Super Admin Login 
Route::post('/super-admin-login', 'App\Http\Controllers\AccountLoginController@SuperAdminLogin');
//Super Admin Logout 
Route::post('/super-admin-logout', 'App\Http\Controllers\AccountLoginController@SuperAdminLogout');
//Middleware Super Admin
Route::group(['middleware'=>'SuperAdminLogin'],function()
{ 
   
    Route::view('admin/dashboard','Super_Admin/layouts/SuperAdminDashboard')->name('dashboard');
    Route::view('admin','Super_Admin/layouts/SuperAdminDashboard')->name('admin');
    Route::get('/super-admin-dashboard-data', 'App\Http\Controllers\SuperAdminDashboardController@index');

    // Super Admin Account management
       Route::view('admin/set-fee','Super_Admin/layouts/Account_management/set-fees')->name('set-fees');
       Route::view('admin/fee-payment','Super_Admin/layouts/Account_management/fee-payment')->name('fee-payment');
       Route::view('admin/account-dashboard','Super_Admin/layouts/Account_management/account-dashboard')->name('account-dashboard');
       Route::view('admin/check-class-fee','Super_Admin/layouts/Account_management/check-class-fee')->name('check-class-fee');

       Route::post('/set-fees', 'App\Http\Controllers\FeeStructureController@store');
       Route::get('/retrive-fees-stracture', 'App\Http\Controllers\FeeStructureController@index');
       Route::get('/check-class-fee', 'App\Http\Controllers\CheckClassFeeController@index');
       Route::post('/fee-payment', 'App\Http\Controllers\FeePaymentController@store');

    // Super Admin School Management
       Route::view('admin/add-classes','Super_Admin/layouts/School_Management/add-classes')->name('add-classes');
       Route::view('admin/add-subjects','Super_Admin/layouts/School_Management/add-subjects')->name('add-subjects');
       Route::view('admin/students-admission','Super_Admin/layouts/Student_Management/add-students')->name('add-students');
       Route::get('admin/student-details/{id}', function($id){
        return view('Super_Admin/layouts/Student_Management/student-details',['id'=>$id]);
       })->name('student-details');

       Route::post('/add-subject', 'App\Http\Controllers\SubjectController@store');
       Route::get('/get-all-subject', 'App\Http\Controllers\SubjectController@index');
       Route::post('/delete-subject', 'App\Http\Controllers\SubjectController@destroy');
       Route::post('/update-subject', 'App\Http\Controllers\SubjectController@update');
       Route::post('/add-class', 'App\Http\Controllers\ClassController@store');
       Route::get('/get-all-class', 'App\Http\Controllers\ClassController@index');


    // Super Admin Student Management
       Route::view('admin/all-student','Super_Admin/layouts/Student_Management/all-student')->name('all-student');
       Route::post('/add-student', 'App\Http\Controllers\StudentController@store');

       Route::get('/get-all-student', 'App\Http\Controllers\StudentController@index');
       Route::get('/get-single-student/{id}', 'App\Http\Controllers\StudentController@show');
       Route::get('/get-class-roll', 'App\Http\Controllers\StudentController@getclassroll');
       Route::get('/roll-generate-admission', 'App\Http\Controllers\StudentController@admission_roll');
       Route::post('/check-student-email', 'App\Http\Controllers\EmailCheckController@StudentEmailCheck');
       Route::post('/check-father-email', 'App\Http\Controllers\EmailCheckController@FatherEmailCheck');
       Route::post('/check-student-number', 'App\Http\Controllers\NumberCheckController@StudentNumberCheck');



       
    // Super Admin Teacher Management
       Route::view('admin/add-teacher','Super_Admin/layouts/add-teacher')->name('add-teacher');
       Route::view('admin/all-teacher','Super_Admin/layouts/all-teachers')->name('all-teachers');

       Route::post('/add-teacher', 'App\Http\Controllers\TeacherController@store');
       Route::get('/get-all-teacher', 'App\Http\Controllers\TeacherController@index');
       Route::post('/check-teacher-email', 'App\Http\Controllers\EmailCheckController@TeacherEmailCheck');

 
 
});
///////////////////////////// End Super Admin /////////////////////////////


///////////////////////////// Start Student Management /////////////////////////////
//Student Management Login 
Route::post('/student-management-login', 'App\Http\Controllers\AccountLoginController@studentManagement');
//Student Management Logout 
Route::post('/student-management-logout', 'App\Http\Controllers\AccountLoginController@StudentManagementLogout');
//Middleware Student Management
Route::group(['middleware'=>'studentManagementLogin'],function()
{
    // View Route 
    Route::view('student-management', 'Student_Management/layouts/dashboard')->name('student_management');
    Route::view('student-management/dashboard', 'Student_Management/layouts/dashboard')->name('school_management_dashboard');
    Route::view('student-management/student-registration', 'Student_Management/layouts/student_registration')->name('school_management_student_registration');
    Route::view('student-management/registration-list', 'Student_Management/layouts/registration_list')->name('school_management_registration_list');
    Route::view('student-management/check-fee-stracture', 'Student_Management/layouts/check-fee-stracture')->name('school_management_check_fee_stracture');
    Route::view('student-management/student-parents', 'Student_Management/layouts/student_parents')->name('school_management_student_parents');
    Route::view('student-management/update-student-details', 'Student_Management/layouts/update_student_details')->name('school_management_update_student_details');
    Route::view('student-management/generate-id-card', 'Student_Management/layouts/generate_id_card')->name('school_management_generate_id_card');

    // Get & Post route 
    Route::get('/registration-list', 'App\Http\Controllers\StudentController@registration_list');
    Route::get('/single-student-details', 'App\Http\Controllers\StudentController@GetSingleStudent');
    Route::post('/update-student', 'App\Http\Controllers\StudentController@UpdateStudent');

});
///////////////////////////// End Student Management /////////////////////////////

///////////////////////////// Start Account Management /////////////////////////////
//Student Management Login 
Route::post('/account-management-login', 'App\Http\Controllers\AccountLoginController@AccountManagementLogin');
//Student Management Logout 
Route::post('/account-management-logout', 'App\Http\Controllers\AccountLoginController@AccountManagementLogout');
Route::group(['middleware'=>'AccountManagementLogin'],function()
{
  Route::view('account-management', 'Account_Management/layouts/dashboard')->name('account_management');
    
});

///////////////////////////// End Account Management /////////////////////////////

///////////////////////////// Start School Management /////////////////////////////
//Student Management Login 
Route::post('/school-management-login', 'App\Http\Controllers\AccountLoginController@SchoolManagementLogin');
//Student Management Logout 
Route::post('/school-management-logout', 'App\Http\Controllers\AccountLoginController@SchoolManagementLogout');
Route::group(['middleware'=>'SchoolManagementLogin'],function()
{
     Route::view('school-management', 'School_Management/layouts/dashboard')->name('school_management');
    
});
///////////////////////////// End School Management /////////////////////////////

///////////////////////////// START PARENT ACCOUNT /////////////////////////////
   Route::post('/parent-login', 'App\Http\Controllers\UserLoginController@ParentLogin');
   Route::post('/parent-logout', 'App\Http\Controllers\UserLoginController@ParentLogout');

   Route::group(['middleware'=>'ParentAccountLogin'],function()
{
   Route::view('parent/dashboard','Parent_Account/layouts/ParentDashboard')->name('parent-dashboard');
   Route::get('/get-student', 'App\Http\Controllers\ParentAccount\StudentController@index');

});

///////////////////////////// END PARENT ACCOUNT /////////////////////////////

///////////////////////////// START STUDENT ACCOUNT /////////////////////////////
Route::post('/student-login', 'App\Http\Controllers\UserLoginController@StudentLogin');
Route::post('/student-logout', 'App\Http\Controllers\UserLoginController@StudentLogout');

Route::group(['middleware'=>'StudentAccountLogin'],function()
{
  Route::view('student/dashboard','Student_Account/layouts/StudentDashboard')->name('student-dashboard');

});

///////////////////////////// END STUDENT ACCOUNT /////////////////////////////


 