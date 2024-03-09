<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\StudentsFeeStracture;

 


class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function StudentFeeSet(Request $request)
    {
        try {

            $studentsdata = Student::get();

            foreach ($studentsdata as $student) 
            {
                $st_id = $student->id;
                $FeePayments = FeePayment::where('st_id', $st_id)->get();

                foreach ($FeePayments as $FeePayment) 
                {
                   $class_year = $FeePayment->class_year;
                   $StudentsFeeStracture  = StudentsFeeStracture::where('st_id', $st_id)->where('year', $class_year)->first();
                   if(!$StudentsFeeStracture){
                       echo 'hello';
                   }
                }
            }


        } catch (Exception $e) {
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
    public function store(Request $request): RedirectResponse
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
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
