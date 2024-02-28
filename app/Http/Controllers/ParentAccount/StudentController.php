<?php

namespace App\Http\Controllers\ParentAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $student_response;
    public $data;
    public $StudentData = [];
    public function index()
    {
    try {
       $parent_email = session('parent_account');

       $Parents_id = Parents::where('login_email', $parent_email)->pluck('id');

       $ParentData = Parents::where("login_email", $parent_email)->first();         

       $this->student_response = Student::where("parents_id", $Parents_id)->get();

       if(count($this->student_response) != "0")
       {
           foreach($this->student_response as $this->data)
           {
               array_push($this->StudentData,$this->data);
           }              
           return response(array("data"=>$this->StudentData,"ParentData"=>$ParentData),200);
       }
       else{
           return response()->json(['message' => 'data not found']); 
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