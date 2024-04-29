<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Employee;



use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
    
    //////////////////////// Login Function //////////////////////////////////
    public function ParentLogin(Request $request) 
    {
        try{
            $email = $request->input("email");
            $password = $request->input("password");

            $user = Parents::where('login_email', $email)->first();

            $name = Parents::where('login_email', $email)->value('father_name');
        
       
           if ($user && $password === $user->login_password) {
       
               $request->session()->put('parent_account', $email);
               $request->session()->put('parent_name', $name);
       
               return response()->json(['status' => "Login success"]);
           }
       
           else{
               return response()->json(['status' => "Email or password is incorrect"]);
           }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function StudentLogin(Request $request) 
    {
        try{
            $email = $request->input("email");
            $password = $request->input("password");

            $user = Student::where('login_email', $email)->first();
 
       
           if ($user && $password === $user->login_password) {
       
               $request->session()->put('student_account', $email);
   
               return response()->json(['status' => "Login success"]);
           }
       
           else{
               return response()->json(['status' => "Email or password is incorrect"]);
           }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function TeacherLogin(Request $request) 
    {
        try{
            $email = $request->input("email");
            $password = $request->input("password");

            $user = Employee::where('email', $email)->first();
 
       
           if ($user && $password === $user->password)
           {
       
               $request->session()->put('teacher_account', $email);
   
               return response()->json(['status' => "Login success"]);
           }
       
           else{
               return response()->json(['status' => "Email or password is incorrect"]);
           }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

     //////////////////////// Logout Function //////////////////////////////////
     public function ParentLogout(Request $request)
     {
      try{
         if(session()->forget('parent_account'))
         {
             return response()->json(['status' => "logout success"]);
         }
         else{
             return response()->json(['status' => "something error"]);
         }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
     }

     public function StudentLogout(Request $request)
     {
       try{
         if(session()->forget('student_account'))
         {
             return response()->json(['status' => "logout success"]);
         }
         else{
             return response()->json(['status' => "something error"]);
         }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
     }

     public function TeacherLogout(Request $request)
     {
       try{
         if(session()->forget('teacher_account'))
         {
             return response()->json(['status' => "logout success"]);
         }
         else{
             return response()->json(['status' => "something error"]);
         }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
     }
}