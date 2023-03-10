<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Teacher;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        echo "index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        echo "create";
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
           $teacher = new Teacher;
 

        $teacher->first_name  = $request->input("first_name");
        $teacher->last_name  = $request->input("last_name");
        $teacher->gender  = $request->input("gender");
        $teacher->dob  = $request->input("dob");
        $teacher->religion  = $request->input("religion");
        $teacher->blood_group  = $request->input("blood_group");
        $teacher->address  = $request->input("address");
        $teacher->phone  = $request->input("phone");
        $teacher->email  = $request->input("email");
        $teacher->qualification  = $request->input("qualification");
        $teacher->joining_date  = $request->input("joining_date");
        $teacher->salary  = $request->input("salary");
        $teacher->class_teacher  = $request->input("class_teacher");
        $teacher->section  = $request->input("section");

        // Teacher Image Store
        $image_id = time();
        $teacher->image =   "upload_assets/teachers/teacher_image_". $image_id.".jpg";
        $teacher_image = $request->file("image");
        $teacher_image->storeAs('public/upload_assets/teachers',  "teacher_image_".$image_id.".jpg");

        if($teacher->save())
        {
            echo "Add Successfully";
        }
        else{
           echo "Failed Something Error";
        } 



        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        echo "show";
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) 
    {
        echo "edit";
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) 
    {
        echo "update";
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        echo "destroy";

    }
}
