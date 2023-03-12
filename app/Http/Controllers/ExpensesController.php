<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Expenses;
use Exception;

class ExpensesController extends Controller
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
 
        try {
           $expenses = new Expenses;
           $expenses->expenses_name  = $request->input("expenses_name");
           $expenses->amount  = $request->input("amount");
           $expenses->expenses_date  = $request->input("expenses_date");
     
           if($expenses->save())
           {
             return response()->json(['status' => "Expenses Add Sucess"]);
           } 
           else{
            return response()->json(['status' => "Somethings Error"]);
           }
        } 
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred: " . $e->getMessage();
            return response()->json(['ststus' => $message], 500);
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