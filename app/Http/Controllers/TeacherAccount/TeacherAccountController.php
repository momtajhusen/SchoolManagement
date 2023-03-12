<?php

namespace App\Http\Controllers\TeacherAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Teacher;

class TeacherAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
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