<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;



class EmailCheckController extends Controller
{
    public function TeacherEmailCheck(Request $request) 
    {
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

    public function StudentEmailCheck(Request $request)
    {
        $user_email = $request->email;
        $users = Student::where('login_email', $user_email)->first();
        if ($users){
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
        }

    }

    public function FatherEmailCheck(Request $request)
    {
        $user_email = $request->email;
        $users = Parents::where('login_email', $user_email)->first();
        if ($users){
            return response()->json(['status' => "email exists"]);
        }
        else{
            return response()->json(['status' => "email not exists"]);
        }

    }
}