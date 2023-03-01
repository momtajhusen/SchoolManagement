<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        //
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
   
      $subject = new Subject;
      $subject->class  = $request->input("class");
      $subject->subject_name  = $request->input("subject_name");
      $subject->subject_teacher  = $request->input("subject_teacher");
      $subject->subject_code  = $request->input("subject_code");

      if($subject->save())
      {
        echo "Subject Add Sucess";
      }

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
