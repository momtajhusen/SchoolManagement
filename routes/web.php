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

Route::get('/', function () 
{
    return view('welcome');
});

// Dashboard 
Route::get('admin/dashboard', function(){
    return view('Admin/admin_template');
})->name('dashboard');

// Admin 
Route::get('admin', function(){
    return view('Admin/admin_template');
})->name('admin');

// Add Teacher 
Route::get('admin/add-teacher', function(){
    return view('Admin/layouts/add-teacher');
})->name('add-teacher');

// All Teacher 
Route::get('admin/all-teacher', function(){
    return view('Admin/layouts/all-teachers');
})->name('all-teachers');

// Add Class 
Route::get('admin/add-classes', function(){
    return view('Admin/layouts/add-classes');
})->name('add-classes');

// Add Subject 
Route::get('admin/add-subjects', function(){
    return view('Admin/layouts/add-subjects');
})->name('add-subjects');

//Add Students
Route::get('admin/students-admission', function(){
    return view('Admin/layouts/add-students');
})->name('add-students');

// Set Fee
Route::get('admin/set-fee', function(){
    return view('Admin/layouts/set-fees');
})->name('set-fees');

// All Student
Route::get('admin/all-student', function(){
    return view('Admin/layouts/all-student');
})->name('all-student');

Route::get('admin/student-details/{id}', function($id){
    return view('Admin/layouts/student-details',['id'=>$id]);
})->name('student-details');

Route::get('admin/fee-payment', function(){
    return view('Admin/layouts/fee-payment');
})->name('fee-payment');

Route::get('admin/account-dashboard', function(){
    return view('Admin/layouts/account-dashboard');
})->name('account-dashboard');

Route::get('admin/check-class-fee', function(){
    return view('Admin/layouts/check-class-fee');
})->name('check-class-fee');

 
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

 


///////////////////////////// Start Student Management /////////////////////////////
//Student Management Login 
Route::post('/student-management-login', 'App\Http\Controllers\AccountLoginController@studentManagement');
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
    Route::get('/student-update', 'App\Http\Controllers\StudentController@update');

    //Student Management Logout 
    Route::post('/student-management-logout', 'App\Http\Controllers\AccountLoginController@StudentManagementLogout');
});
///////////////////////////// Start Student Management /////////////////////////////

///////////////////////////// Start Account Management /////////////////////////////
Route::get('account-management', function(){
    return view('Account_Management/layouts/dashboard');
})->name('account_management');

///////////////////////////// End Account Management /////////////////////////////



///////////////////////////// Start Login /////////////////////////////
Route::get('account-login', function()
{
    return view('account_login');
})->name('school_login');



///////////////////////////// End  Login /////////////////////////////















