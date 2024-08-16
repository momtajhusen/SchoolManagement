<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleAndPermissionUsers;
use App\Models\developerLogin;
use Illuminate\Support\Facades\Log;


class AdminAccountSetting extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function EmailVerificationEnable(Request $request)
    {
        $input_username = session('super_admin');
    
        $user = RoleAndPermissionUsers::where('email', $input_username)->first();
        Log::info('User found in RoleAndPermissionUsers:', ['user' => $user]);
        
        if (!$user) {
            Log::info('User not found in RoleAndPermissionUsers, checking DeveloperLogin table');
            $user = DeveloperLogin::where('email', $input_username)->first();
    
            if (!$user) {
                // If user is not found in both tables
                Log::info('No user found for email:', ['email' => $input_username]);
                return response()->json(['status' => 'invalid Email']);
            }
        }
    
        // Toggle email_verification status
        if ($user->email_verification == 'off') {
            $user->email_verification = 'on';
        } else {
            $user->email_verification = 'off';
        }
    
        $user->save();
    
        return response()->json([
            'status' => 'success',
            'verification' => $user->email_verification,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function EmailVerificationCheck()
    {
        $input_username = session('super_admin');
    
        $user = RoleAndPermissionUsers::where('email', $input_username)->first();
        Log::info('User found in RoleAndPermissionUsers:', ['user' => $user]);
        
        if (!$user) {
            Log::info('User not found in RoleAndPermissionUsers, checking DeveloperLogin table');
            $user = DeveloperLogin::where('email', $input_username)->first();
    
            if (!$user) {
                // If user is not found in both tables
                Log::info('No user found for email:', ['email' => $input_username]);
                return response()->json(['status' => 'invalid Email']);
            }
        }
    
        return response()->json([
            'status' => 'success',
            'verification' => $user->email_verification,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
