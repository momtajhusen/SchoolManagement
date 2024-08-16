<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\AccountLogin;
use App\Models\RoleAndPermissionUsers;
use App\Models\developerLogin;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail; 

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

    
    public function CheckLoginSession(Request $request){
        if ($request->session()->has('super_admin')) {
            echo 'already session login';
        } else {
            // Super admin session does not exist
        }
    }

    public function SuperAdminLogin(Request $request) 
    {
        try {
            $input_username = $request->input("email");
            $input_password = $request->input("password");

     

            $user = RoleAndPermissionUsers::where('email', $input_username)->first();
            Log::info('User found in RoleAndPermissionUsers:', ['user' => $user]);
            
            if (!$user) {
                Log::info('User not found in RoleAndPermissionUsers, checking DeveloperLogin table');
                $user = DeveloperLogin::where('email', $input_username)->first();
    
                if (!$user) {
                    // If user is not found in both tables
                    Log::info('No user found for email:', ['email' => $input_username]);
                    return response()->json(['status' => "invalid Email"]);
                }
            }
            
            Log::info('User found:', ['user' => $user]);


    
            // Assuming passwords are stored in plain text
            if ($input_password === $user->password) 
            {
                $role_type = ($user instanceof RoleAndPermissionUsers) ? $user->role_type : 'super_admin';

                if($user->email_verification == 'on')
                {
                    // Generate a random number between 0 and 999999
                    $randomNumber = mt_rand(0, 999999);
                    // Pad the number with leading zeros to ensure it has 6 digits
                    $sixDigitRandomNumber = str_pad($randomNumber, 6, '0', STR_PAD_LEFT);
        
                    // Update user's record with the generated OTP
                    $user->otp = $sixDigitRandomNumber;
                    $user->save();
        
                    $details = [
                        'title' => 'Login Verification code',
                        'message' => $sixDigitRandomNumber,
                    ];
        
                    // Send OTP to user via email
                    if(Mail::to($user->email)->send(new OTPMail($details))){
                        return response()->json(['status' => "user match", 'email_verification' => 'on', 'role_type' => $role_type]);
                    }
                } else{
                    $request->session()->put('super_admin', $user->email);
                    $request->session()->put('role_type', $role_type);
                    $request->session()->put('user_name', $user->name);
                    
                    return response()->json(['status' => "user match",  'email_verification' => 'off', 'role_type' => $role_type]);
                }   
            } else {
                return response()->json(['status' => "Incorrect password"]);
            }
            
        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    
    public function ReactNativeSuperAdminVerify(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'code' => 'required|string',
        ]);
    
        $email = $validatedData['email'];
        $code = $validatedData['code'];
    
        // Try to find the user in RoleAndPermissionUsers
        $user = RoleAndPermissionUsers::where('email', $email)
            ->where('otp', $code)
            ->first();
    
        // If not found, try to find the user in DeveloperLogin
        if (!$user) {
            $user = DeveloperLogin::where('email', $email)
                ->where('otp', $code)
                ->first();
        }
    
        // Check if the user exists
        if ($user) {
            // Determine the role type
            $role_type = ($user instanceof RoleAndPermissionUsers) ? $user->role_type : 'super_admin';
    
            // Return success response
            return response()->json([
                'status' => 'Verify Success',
                'role_type' => $role_type
            ]);
        }
    
        // Return failure response if user is not found
        return response()->json(['status' => 'Not Verified']);
    }

    public function ReactNativeSuperAdminLogin(Request $request) 
    {
        try {
            $input_username = $request->input("email");
            $input_password = $request->input("password");

     

            $user = RoleAndPermissionUsers::where('email', $input_username)->first();
            Log::info('User found in RoleAndPermissionUsers:', ['user' => $user]);
            
            if (!$user) {
                Log::info('User not found in RoleAndPermissionUsers, checking DeveloperLogin table');
                $user = DeveloperLogin::where('email', $input_username)->first();
    
                if (!$user) {
                    // If user is not found in both tables
                    Log::info('No user found for email:', ['email' => $input_username]);
                    return response()->json(['status' => "invalid Email"]);
                }
            }
            
            Log::info('User found:', ['user' => $user]);


    
            // Assuming passwords are stored in plain text
            if ($input_password === $user->password) 
            {
                $role_type = ($user instanceof RoleAndPermissionUsers) ? $user->role_type : 'super_admin';

                if($user->email_verification == 'on')
                {
                    // Generate a random number between 0 and 999999
                    $randomNumber = mt_rand(0, 999999);
                    // Pad the number with leading zeros to ensure it has 6 digits
                    $sixDigitRandomNumber = str_pad($randomNumber, 6, '0', STR_PAD_LEFT);
        
                    // Update user's record with the generated OTP
                    $user->otp = $sixDigitRandomNumber;
                    $user->save();
        
                    $details = [
                        'title' => 'Login Verification code',
                        'message' => $sixDigitRandomNumber,
                    ];
        
                    // Send OTP to user via email
                    if(Mail::to($user->email)->send(new OTPMail($details))){
                        return response()->json(['status' => "user match", 'email_verification' => 'on', 'role_type' => $role_type]);
                    }
                } else{
                    return response()->json(['status' => "user match",  'email_verification' => 'off', 'role_type' => $role_type]);
                }   
            } else {
                return response()->json(['status' => "Incorrect password"]);
            }
            
        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    public function Manuallogin(Request $request){

        $request->session()->put('super_admin',  'manual_login@gmail.com');
        $request->session()->put('role_type',  'super_admin');
        $request->session()->put('user_name',  'ScriptQube');

        return redirect()->route('school_login');

    }

   public function SuperAdminVerify(Request $request)
{
    // Validate input data
    $validatedData = $request->validate([
        'email' => 'required|email',
        'psd' => 'required|string',  // Add this if you need to use the password later
        'code' => 'required|string',
    ]);

    $email = $validatedData['email'];
    $code = $validatedData['code'];

    // Try to find the user in RoleAndPermissionUsers
    $user = RoleAndPermissionUsers::where('email', $email)
        ->where('otp', $code)
        ->first();

    // If not found, try to find the user in DeveloperLogin
    if (!$user) {
        $user = DeveloperLogin::where('email', $email)
            ->where('otp', $code)
            ->first();
    }

    // Check if the user exists
    if ($user) {
        // Determine the role type
        $role_type = ($user instanceof RoleAndPermissionUsers) ? $user->role_type : 'super_admin';

        // Store user data in session
        $request->session()->put('super_admin', $user->email);
        $request->session()->put('role_type', $role_type);
        $request->session()->put('user_name', $user->name);

        // Return success response
        return response()->json([
            'status' => 'Verify Success',
            'role_type' => $role_type
        ]);
    }

    // Return failure response if user is not found
    return response()->json(['status' => 'Not Verified']);
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