<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', 'App\Http\Controllers\UserController@register');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/get-all-student', 'App\Http\Controllers\StudentController@index');
    
});

    Route::get('/get-button-activity', 'App\Http\Controllers\VisitorLogsController@GetButtonActivity');
    Route::get('/get-page-activity', 'App\Http\Controllers\VisitorLogsController@GetPageActivity');
    

   //Super Admin Login 
   Route::post('/super-admin-login', 'App\Http\Controllers\AccountLoginController@SuperAdminLogin');
   Route::post('/super-admin-code-verify', 'App\Http\Controllers\AccountLoginController@SuperAdminVerifyCode');
   Route::post('/check-login-session', 'App\Http\Controllers\AccountLoginController@CheckLoginSession');
   
   
  Route::get('/get-all-parents', 'App\Http\Controllers\ParentsController@index');
  
//   Dashboard 
  Route::get('/super-admin-dashboard-data', 'App\Http\Controllers\SuperAdminDashboardController@index');
  
//   Students 
  Route::get('/get-all-admit-student', 'App\Http\Controllers\SelectOption@AllAdmitStudents');
  Route::get('/get-all-student', 'App\Http\Controllers\StudentController@index');


// AddEmployee
 Route::post('admin/add_new_employee', 'App\Http\Controllers\EmployeeController@store');
 
//  Transport 
    Route::get('/get-all-vehicle', 'App\Http\Controllers\VehicleController@index');
    
//  Class 
   Route::get('/get-all-class', 'App\Http\Controllers\ClassController@index');
   Route::get('/admin/class-section', 'App\Http\Controllers\StudentController@class_section');
  Route::get('/option-all-class', 'App\Http\Controllers\ClassController@option_class');
   
 // Subjects 
    Route::get('/get-all-subject', 'App\Http\Controllers\SubjectController@index');
    
//   Exam 
      Route::get('/process-exam-term', 'App\Http\Controllers\ExamManageController@process_exam_term');
      Route::get('/get-studen-mark-entry', 'App\Http\Controllers\ExamManageController@index_studen_mark_entry');
      Route::post('/entry-mark', 'App\Http\Controllers\ExamManageController@entry_mark');
      Route::get('/get-exam-tabulation', 'App\Http\Controllers\ExamManageController@index_exam_tabulation');
      Route::post('/delete-subject-tabulation', 'App\Http\Controllers\ExamManageController@deleteTabulationSubject');

// Email Verification 
  Route::post('/email-verification-enable', 'App\Http\Controllers\AdminAccountSetting@EmailVerificationEnable');
  Route::post('/email-verification-check', 'App\Http\Controllers\AdminAccountSetting@EmailVerificationCheck');

   