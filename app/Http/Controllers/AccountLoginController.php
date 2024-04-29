<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\AccountLogin;
use App\Models\RoleAndPermissionUsers;
use App\Models\developerLogin;

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
            
            $user = RoleAndPermissionUsers::where('email', $input_username)->first();
            
            if (!$user) {
                $user = DeveloperLogin::where('email', $input_username)->first();
            }
            
            if (!$user) {
                return response()->json(['status' => "User not found"]);
            }
            
            // Assuming passwords are stored in plain text
            if ($input_password === $user->password) 
            {
                $role_type = ($user instanceof RoleAndPermissionUsers) ? $user->role_type : 'super_admin';
            
                $request->session()->put('super_admin', $user->email);
                $request->session()->put('role_type', $role_type);
            
                return response()->json(['status' => "Login success", 'role_type' => $role_type]);
            } else {
                return response()->json(['status' => "Incorrect password"]);
            }
            
        } catch (Exception $e) {
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