<?php

namespace App\Http\Controllers\StudentAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Student;

class StudentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
        $student_email = session('student_account');

        if (Student::where('email', $student_email)->exists()) 
        {
           $student = Student::where("email", $student_email)->first();         
           return response()->json(array("StudentData"=>$student));
        } 
        else 
        {
           return response()->json(['StudentData' => 'student not available']); 
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
    public function create()
    {
        //
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