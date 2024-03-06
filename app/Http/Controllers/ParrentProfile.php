<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parents;
use App\Models\StudentsFeeStracture;
use App\Models\Student;
use Exception;


class ParrentProfile extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            $parent_id = $request->pr_id;
            $parent_data = Parents::where("id", $parent_id)->first();
            if(!$parent_data){
                return response()->json(['message' =>  "parents not found"], 500);
            }

            $student_data = Student::where("parents_id", $parent_id)->get();

            return response()->json(['parent_data' => $parent_data, 'student_data' => $student_data], 200);

        } 
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    
    public function StudentsFeeStractures(Request $request)
    {
        $st_id = $request->st_id;
        $year = 2080; // Assuming you want data for the year 2080
    
        // Fetch fee structures for the given year and student
        $feeStructures = StudentsFeeStracture::where('year', $year)
                            ->where('st_id', $st_id)
                            ->get();
    
        // Organize fee structures by month and fee type
        $organizedFeeStructures = [];
        foreach ($feeStructures as $structure) {
            $month = $structure->month;
            $feeType = $structure->fee_type;
            $amount = $structure->amount;
    
            // Add month if not present
            if (!isset($organizedFeeStructures[$month])) {
                $organizedFeeStructures[$month] = [];
            }
    
            // Add fee type with fee name and amount under respective month
            $organizedFeeStructures[$month][] = [
                'fee_name' => $feeType,
                'amount' => $amount
            ];
        }

        $student = [
            'fee_year'=>$year,
            'st_id'=>$st_id
        ];
    
        return response(array("StudentFeeStracture" => $organizedFeeStructures, 'student'=>$student), 200);
    }

    public function StudentsFeeStracturesSave(Request $request){
        try {
            $st_id = $request->st_id;
            $month = $request->month;
            $year = $request->year;
            $fees = $request->fees; // Assuming 'fees' is an array containing fee data
            
            // Delete existing fee structures for the same st_id, year, and month
            StudentsFeeStracture::where('st_id', $st_id)
                ->where('year', $year)
                ->where('month', $month)
                ->delete();
            
            // Save new fee structures
            foreach ($fees as $fee) {
                $studentFeeStructure = new StudentsFeeStracture();
                $studentFeeStructure->st_id = $st_id;
                $studentFeeStructure->month = $month;
                $studentFeeStructure->year = $year;
                $studentFeeStructure->fee_type = $fee['fee_name'];
                $studentFeeStructure->amount = $fee['amount'];
                $studentFeeStructure->save();
            }           
            // Return success response
            return response()->json(['status' => 'Fee structures saved successfully'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function DeleteMonthFee(Request $request){
        try {
            $st_id = $request->st_id;
            $month = $request->month;
            $year = $request->year;
            $fees = $request->fees; 
            return response()->json(['status' => 'Fee structures saved successfully'], 200);
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
