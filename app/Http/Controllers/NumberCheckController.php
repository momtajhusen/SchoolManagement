<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;

class NumberCheckController extends Controller
{
    public function StudentNumberCheck(Request $request) 
    {
        $user_number= $request->number;
        $users = Student::where('phone', $user_number)->first();
        if ($users)
        {
            return response()->json(['status' => "number exists"]);
        }
        else{
            return response()->json(['status' => "number not exists"]);
        }

    }

    public function FatherNumberCheck(Request $request) 
    {
        $user_number= $request->number;
        $users = Parents::where('father_mobile', $user_number)->first();
        if ($users)
        {
            return response()->json(['status' => "number exists"]);
        }
        else{
            return response()->json(['status' => "number not exists"]);
        }

    }

    public function MotherNumberCheck(Request $request) 
    {
        $user_number= $request->number;
        $users = Parents::where('mother_mobile', $user_number)->first();
        if ($users)
        {
            return response()->json(['status' => "number exists"]);
        }
        else{
            return response()->json(['status' => "number not exists"]);
        }

    }

    public function TeacherNumberCheck(Request $request) 
    {
        $user_number= $request->number;
        $users = Teacher::where('phone', $user_number)->first();
        if ($users)
        {
            return response()->json(['status' => "number exists"]);
        }
        else{
            return response()->json(['status' => "number not exists"]);
        }

    }
    
    
}