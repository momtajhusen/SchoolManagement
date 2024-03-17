<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;
use App\Models\StudentsFeeMonth;



class StudentsFeePayment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function StudentFeePaymentRetrive(Request $request)
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
