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

///////////////////////////// Start Super Admin /////////////////////////////
//Super Admin Login 
Route::post('/super-admin-login', 'App\Http\Controllers\AccountLoginController@SuperAdminLogin');
//Super Admin Logout 
Route::post('/super-admin-logout', 'App\Http\Controllers\AccountLoginController@SuperAdminLogout');
//Middleware Super Admin
Route::group(['middleware'=>'SuperAdminLogin'],function()
{ 
    // View Route 
    Route::view('admin/dashboard','Super_Admin/admin_template')->name('dashboard');
    // Admin 
    Route::view('admin','Super_Admin/admin_template')->name('admin');
    // Add Teacher 
    Route::view('admin/add-teacher','Super_Admin/layouts/add-teacher')->name('add-teacher');
    // All Teacher 
    Route::view('admin/all-teacher','Super_Admin/layouts/all-teachers')->name('all-teachers');
    // Add Class 
    Route::view('admin/add-classes','Super_Admin/layouts/add-classes')->name('add-classes');
    // Add Subject 
    Route::view('admin/add-subjects','Super_Admin/layouts/add-subjects')->name('add-subjects');
    //Add Students
    Route::view('admin/students-admission','Super_Admin/layouts/add-students')->name('add-students');
    // Set Fee
    Route::view('admin/set-fee','Super_Admin/layouts/set-fees')->name('set-fees');
    // All Student
    Route::view('admin/all-student','Super_Admin/layouts/all-student')->name('all-student');
    // Student Details
    Route::get('admin/student-details/{id}', function($id){
        return view('Super_Admin/layouts/student-details',['id'=>$id]);
    })->name('student-details');
    // fee payment 
    Route::view('admin/fee-payment','Super_Admin/layouts/fee-payment')->name('fee-payment');
    // account dashboard 
    Route::view('admin/account-dashboard','Super_Admin/layouts/account-dashboard')->name('account-dashboard');
    //  check class fee 
    Route::view('admin/check-class-fee','Super_Admin/layouts/check-class-fee')->name('check-class-fee');
    // Teacher Route 
    Route::post('/add-teacher', 'App\Http\Controllers\TeacherController@store');
    // Subject Route 
    Route::post('/add-subject', 'App\Http\Controllers\SubjectController@store');
    // Student Route 
    Route::post('/add-student', 'App\Http\Controllers\StudentController@store');
    Route::get('/get-all-student', 'App\Http\Controllers\StudentController@index');
    Route::get('/get-single-student/{id}', 'App\Http\Controllers\StudentController@show');
    // Class Route 
    Route::post('/add-class', 'App\Http\Controllers\ClassController@store');
    Route::get('/get-all-class', 'App\Http\Controllers\ClassController@index');
    // Roll get 
    Route::get('/roll-generate-admission', 'App\Http\Controllers\StudentController@admission_roll');
    Route::get('/get-class-roll', 'App\Http\Controllers\StudentController@getclassroll');
    // Fee Stracture
    Route::post('/set-fees', 'App\Http\Controllers\FeeStructureController@store');
    Route::get('/retrive-fees-stracture', 'App\Http\Controllers\FeeStructureController@index');
    Route::get('/check-class-fee', 'App\Http\Controllers\CheckClassFeeController@index');
    // FeePayment
    Route::post('/fee-payment', 'App\Http\Controllers\FeePaymentController@store');
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
    Route::get('/get-all-parents', 'App\Http\Controllers\ParentsController@index');
    Route::get('/registration-list', 'App\Http\Controllers\StudentController@registration_list');
    Route::get('/single-student-details', 'App\Http\Controllers\StudentController@GetSingleStudent');
    Route::post('/update-student', 'App\Http\Controllers\StudentController@UpdateStudent');

});
///////////////////////////// Start Student Management /////////////////////////////

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


///////////////////////////// Start Login Page/////////////////////////////
Route::get('account-login', function()
{
    return view('account_login');
})->name('school_login');

///////////////////////////// End Login Page /////////////////////////////