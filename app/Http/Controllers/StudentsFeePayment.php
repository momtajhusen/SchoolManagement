<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeeStracture;



class StudentsFeePayment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ParentStudentRetrive(Request $request)
    {
        try {
            $pr_id = $request->pr_id;
        
            $parent_data = Parents::where("id", $pr_id)->first();
            if ($parent_data) {
                $student_data = Student::select('id', 'first_name', 'last_name', 'student_image', 'village')->where("parents_id", $pr_id)->get();
        
                // Loop through each student to get their total_fee
                foreach ($student_data as $student) {
                    $student->total_fee = StudentsFeeMonth::where('st_id', $student->id)->sum('total_fee');
                    $student->total_paid = StudentsFeeMonth::where('st_id', $student->id)->sum('total_paid');
                    $student->total_dues = StudentsFeeMonth::where('st_id', $student->id)->sum('total_dues');
                }
        
                return response()->json(['status' => 'success', 'parent_details' => $parent_data, 'student_details' => $student_data], 200);
            }
        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
        
    }

    public function StudentFeePaymentRetrive(Request $request)
    {
        try {
            $st_id = $request->st_id;
            $year = 2080; // Assuming you want data for the year 2080
        
            // Fetch the fee structures for the specified student ID and year
            $feeStructures = StudentsFeeMonth::where('year', $year)->where('st_id', $st_id)->first();

            $Student = Student::where('id', $st_id)->first();
        
            if ($feeStructures) {
                // Extract fee data from month_0 to month_12
                $feeArray = [];
                for ($i = 0; $i <= 11; $i++) {
                    $column = 'month_' . $i;
                    $feeArray[$i] = $feeStructures->$column;
                }

                $student = [
                    'fee_year'=>$year,
                    'st_id'=>$st_id,
                    'pr_id'=>$Student->id,
                ];
        
                // Return the fee array as JSON response
                return response()->json(['status' => 'success', 'fee_month' => $feeArray, 'student' => $student]);
            } else {
                // No fee structures found for the specified criteria
                return response()->json(['status' => 'No fee structures found for the specified criteria'], 404);
            }
        } catch (Exception $e) {
            // Handle exceptions
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
