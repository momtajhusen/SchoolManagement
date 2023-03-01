<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Classes;


class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index()
    {
        $this->response = Classes::get();
        if(count($this->response) != "0")
        {
            foreach($this->response as $this->data)
            {
                array_push($this->allData,$this->data);
            }   
            
            return response(array("data"=>$this->allData),200);
        }
        else{
            return response()->json(['message' => 'data not found']); 
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
        $class = new Classes;
        $class->class  = $request->input("class");
        $class->section  = $request->input("section");
        $class->class_teacher  = $request->input("class_teacher");
        $class->capacity  = $request->input("capacity");
        $class->start_date  = $request->input("start_date");
        $class->end_date  = $request->input("end_date");
        $class->year  = $request->year;
        $class->location  = $request->input("location");


        if($class->save())
        {
            echo "Add sucess";
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
