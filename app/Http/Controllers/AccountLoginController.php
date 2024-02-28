<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\AccountLogin;
use App\Models\RoleAndPermissionUsers;

class AccountLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //////////////////////// Login Function //////////////////////////////////
    public function studentManagement(Request $request) 
    {
        try {
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
        catch (Exception $e) 
        {
                // Code to handle the exception
                $message = "An exception occurred: " . $e->getMessage();
                return response()->json(['ErrorMessage' => $message], 500);
        }

    }

    public function SuperAdminLogin(Request $request) 
    {
        try {
        $input_username = $request->input("email");
        $input_password = $request->input("password");

        //////////////////////////
        $User = RoleAndPermissionUsers::where('email',  $input_username)->first();
        // echo  $User;
        // return false;
        if($User){
            if($input_username ==  $User->email)
            {
        
                if($input_password == $User->password)
                {
                    $request->session()->put('super_admin', $User->email);
                    $request->session()->put('role_type', $User->role_type);
                    return response()->json(['status' => "Login success", 'role_type'=>$User->role_type]);
                }
                else{
                    return response()->json(['status' => "Incorrect password"]);
                }
            }
            else{
               return response()->json(['status' => "Incorrect username"]);
            }
        }
        else{
            return response()->json(['status' => "Username not found"]);
        }








        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AccountManagementLogin(Request $request) 
    {
     try {
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
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function SchoolManagementLogin(Request $request) 
    {
                try {
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
            catch (Exception $e) 
            {
                // Code to handle the exception
                $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
                return response()->json(['status' => $message], 500);
            }

    }

    //////////////////////// Logout Function //////////////////////////////////
    public function StudentManagementLogout(Request $request)
    {
        try {

    
            if(session()->forget('student_management'))
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

    public function SuperAdminLogout(Request $request)
    {
      try{
        if(session()->forget('super_admin'))
        {
            return response()->json(['status' => "logout success"]);
        }
        else{
            return response()->json(['status' => "something error"]);
        }        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AccountManagementLogout(Request $request)
    {
      try{ 
            if(session()->forget('account_management'))
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

    public function SchoolManagementLogout(Request $request)
    {
      try{
        if(session()->forget('school_management'))
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