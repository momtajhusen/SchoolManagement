<?php

namespace App\Http\Controllers\TeacherAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Teacher;
use App\Models\TeacherSubject;


class TeacherAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
    try {

         $teacher_email = session('teacher_account');

        if (Teacher::where('email', $teacher_email)->exists()) 
        {
           $teacher = Teacher::where("email", $teacher_email)->first();         
           return response()->json(array("TecherData"=>$teacher));
        } 
        else 
        {
           return response()->json(['TecherData' => 'teacher not available']); 
        }
    }
    catch (Exception $e) 
    {
              // Code to handle the exception
              $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
              return response()->json(['status' => $message], 500);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function teacherClass() 
    {
        try {

            $teacher_email = session('teacher_account');
   
           if (Teacher::where('email', $teacher_email)->exists()) 
           {
              $teacher = Teacher::where("email", $teacher_email)->first(); 
              $teacher_id = $teacher->id;

              $TeacherClass = TeacherSubject::where("tr_id", $teacher_id)->select('class')->distinct()->get();
              
              return response()->json(array("TeacherClass"=>$TeacherClass));
           } 
           else 
           {
              return response()->json(['TecherData' => 'teacher not available']); 
           }
       }
       catch (Exception $e) 
       {
                 // Code to handle the exception
                 $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
                 return response()->json(['status' => $message], 500);
       }
    }

    public function teacherSubject() 
    {
        try {

            $teacher_email = session('teacher_account');
   
           if (Teacher::where('email', $teacher_email)->exists()) 
           {
              $teacher = Teacher::where("email", $teacher_email)->first(); 
              $teacher_id = $teacher->id;

              $TeacherSubject = TeacherSubject::where("tr_id", $teacher_id)->select('subject')->distinct()->get();
              
              return response()->json(array("TeacherSubject"=>$TeacherSubject));
           } 
           else 
           {
              return response()->json(['TecherData' => 'teacher not available']); 
           }
       }
       catch (Exception $e) 
       {
                 // Code to handle the exception
                 $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
                 return response()->json(['status' => $message], 500);
       }
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