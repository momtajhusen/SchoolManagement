<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parents;
use App\Models\Student;

use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
    
    //////////////////////// Login Function //////////////////////////////////
    public function ParentLogin(Request $request) 
    {
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

    public function StudentLogin(Request $request) 
    {
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

     //////////////////////// Logout Function //////////////////////////////////
     public function ParentLogout(Request $request)
     {
  
         if(session()->forget('parent_account'))
         {
             return response()->json(['status' => "logout success"]);
         }
         else{
             return response()->json(['status' => "something error"]);
         }
     }

     public function StudentLogout(Request $request)
     {
  
         if(session()->forget('student_account'))
         {
             return response()->json(['status' => "logout success"]);
         }
         else{
             return response()->json(['status' => "something error"]);
         }
     }
}