<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Driver;

class NumberCheckController extends Controller
{
    public function StudentNumberCheck(Request $request) 
    {
        try{
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
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function FatherNumberCheck(Request $request) 
    {
        try{
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
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function MotherNumberCheck(Request $request) 
    {
        try{
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
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function TeacherNumberCheck(Request $request) 
    {
        try{
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
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function DriverNumberCheck(Request $request) 
    {
        try{
        $user_number= $request->number;
        $users = Driver::where('phone', $user_number)->first();
        if ($users)
        {
            return response()->json(['status' => "number exists"]);
        }
        else{
            return response()->json(['status' => "number not exists"]);
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