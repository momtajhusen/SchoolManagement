<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Driver;




class EmailCheckController extends Controller
{
    public function TeacherEmailCheck(Request $request) 
    {
        try{
        $user_email = $request->email;
        $users = Teacher::where('email', $user_email)->first();
        if ($users)
        {
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
        }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function StudentEmailCheck(Request $request)
    {
        try{
        $user_email = $request->email;
        $users = Student::where('login_email', $user_email)->first();
        if ($users){
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
        }

        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function FatherEmailCheck(Request $request)
    {
       try{
        $user_email = $request->email;
        $users = Parents::where('login_email', $user_email)->first();
        if ($users){
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
        }
        }
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function DriverEmailCheck(Request $request)
    {
       try{
        $user_email = $request->email;
        $users = Driver::where('email', $user_email)->first();
        if ($users){
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
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