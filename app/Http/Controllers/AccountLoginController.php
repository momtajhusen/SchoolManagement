<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AccountLogin;

class AccountLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //////////////////////// Login Function //////////////////////////////////
    public function studentManagement(Request $request) 
    {
       $input_username = $request->input("email");
       $input_password = $request->input("password");

       $username = AccountLogin::first()->student_management_username;
       $password = AccountLogin::first()->student_management_password;
     
       if($input_username == $username)
       {
 
         if($input_password == $password)
         {
  
             $request->session()->put('student_management', $username);
             return response()->json(['status' => "Login success"]);

         }
 
         else{
            return response()->json(['status' => "Incorrect Password"]);
         }
 
       }
 
       else{
         return response()->json(['status' => "Incorrect Username"]);
       }

    }

    public function SuperAdminLogin(Request $request) 
    {
       $input_username = $request->input("email");
       $input_password = $request->input("password");

       $username = AccountLogin::first()->super_admin_username;
       $password = AccountLogin::first()->super_admin_password;
     
       if($input_username == $username)
       {
 
         if($input_password == $password)
         {
  
             $request->session()->put('super_admin', $username);
             return response()->json(['status' => "Login success"]);

         }
 
         else{
            return response()->json(['status' => "Incorrect Password"]);
         }
 
       }
 
       else{
         return response()->json(['status' => "Incorrect Username"]);
       }

    }

    public function AccountManagementLogin(Request $request) 
    {
       $input_username = $request->input("email");
       $input_password = $request->input("password");

       $username = AccountLogin::first()->account_management_username;
       $password = AccountLogin::first()->account_management_password;
     
       if($input_username == $username)
       {
 
         if($input_password == $password)
         {
  
             $request->session()->put('account_management', $username);
             return response()->json(['status' => "Login success"]);

         }
 
         else{
            return response()->json(['status' => "Incorrect Password"]);
         }
 
       }
 
       else{
         return response()->json(['status' => "Incorrect Username"]);
       }

    }

    public function SchoolManagementLogin(Request $request) 
    {
       $input_username = $request->input("email");
       $input_password = $request->input("password");

       $username = AccountLogin::first()->school_management_username;
       $password = AccountLogin::first()->school_management_password;
     
       if($input_username == $username)
       {
 
         if($input_password == $password)
         {
  
             $request->session()->put('school_management', $username);
             return response()->json(['status' => "Login success"]);

         }
 
         else{
            return response()->json(['status' => "Incorrect Password"]);
         }
         
       }
 
       else{
         return response()->json(['status' => "Incorrect Username"]);
       }

    }


    //////////////////////// Logout Function //////////////////////////////////
    public function StudentManagementLogout(Request $request)
    {
 
        if(session()->forget('student_management'))
        {
            return response()->json(['status' => "logout success"]);
        }
        else{
            return response()->json(['status' => "something error"]);
        }
    }

    public function SuperAdminLogout(Request $request)
    {
 
        if(session()->forget('super_admin'))
        {
            return response()->json(['status' => "logout success"]);
        }
        else{
            return response()->json(['status' => "something error"]);
        }
    }

    public function AccountManagementLogout(Request $request)
    {
 
        if(session()->forget('account_management'))
        {
            return response()->json(['status' => "logout success"]);
        }
        else{
            return response()->json(['status' => "something error"]);
        }
    }

    public function SchoolManagementLogout(Request $request)
    {
 
        if(session()->forget('school_management'))
        {
            return response()->json(['status' => "logout success"]);
        }
        else{
            return response()->json(['status' => "something error"]);
        }
    }



 
}