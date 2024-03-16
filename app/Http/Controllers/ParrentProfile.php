<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parents;
use App\Models\StudentsFeeStracture;
use App\Models\StudentsFeeMonth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
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
        $annualfee = 0;
        foreach ($feeStructures as $structure) {
            $month = $structure->month;
            $feeType = $structure->fee_type;
            $feeId = $structure->id;
            $amount = $structure->amount;

            $annualfee += $amount;
    
            // Add month if not present
            if (!isset($organizedFeeStructures[$month])) {
                $organizedFeeStructures[$month] = [];
            }
    
            // Add fee type with fee name and amount under respective month
            $organizedFeeStructures[$month][] = [
                'amount' => $amount,
                'fee_name' => $feeType,
                'id' => $feeId,
            ];
        }

        $student = [
            'fee_year'=>$year,
            'st_id'=>$st_id,
            'annualfee'=>$annualfee

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
            $totalfee = 0;
            foreach ($fees as $fee) {
                    // Record doesn't exist, so proceed to save
                    $totalfee += $fee['amount'];
                    $studentFeeStructure = new StudentsFeeStracture();
                    $studentFeeStructure->st_id = $st_id;
                    $studentFeeStructure->month = $month;
                    $studentFeeStructure->year = $year;
                    $studentFeeStructure->fee_type = $fee['fee_name'];
                    $studentFeeStructure->amount = $fee['amount'];
                    $studentFeeStructure->save();
            }
            // end new fee structures
 
            // start StudentsFeeMonth add 
            $all_add = StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->where('month', $month)->sum('amount');
            $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)->where('year', $year)->first();
            if ($StudentsFeeMonthdata) {
                $columnName = 'month_'.$month-1;
                $StudentsFeeMonthdata->$columnName = $all_add;
                $StudentsFeeMonthdata->total_fee = $all_add;
                $StudentsFeeMonthdata->total_dues = $all_add;
                $StudentsFeeMonthdata->save();
            }
            // end StudentsFeeMonth add 
            

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
            $fee_id = $request->fee_id;

            $StudentsFeeStracture = StudentsFeeStracture::where('id', $fee_id)->first();

            // Delete the fee structure entry
            $StudentsFeeStracture->delete();
            
            if ($StudentsFeeStracture) {
                $st_id = $StudentsFeeStracture->st_id;
                $delete_fee_amount = $StudentsFeeStracture->amount;
                $fee_year = $StudentsFeeStracture->year;
                $fee_month = $StudentsFeeStracture->month;
            
                // Sum up all fees for the same student, year, and month
                $all_add = StudentsFeeStracture::where('st_id', $st_id)
                    ->where('year', $fee_year)
                    ->where('month', $fee_month)
                    ->sum('amount');

                
            
                // Find or create a record in StudentsFeeMonth table
                $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)
                    ->where('year', $fee_year)
                    ->first();
            
                if ($StudentsFeeMonthdata) {

                    // Update the month column with the sum of all fees
                    $columnName = 'month_'.($fee_month - 1); // Adjusting month index

                    // echo $columnName;
                    // return false;
                    $StudentsFeeMonthdata->$columnName = $all_add;
                    $StudentsFeeMonthdata->total_fee = $all_add;
                    $StudentsFeeMonthdata->total_dues = $all_add;
                    $StudentsFeeMonthdata->save();
                }
            
  
            
                return response()->json(['status' => 'delete successfully'], 200);
            } else {
                // Handle case where fee structure entry with given ID is not found
            }            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function DeleteMonth(Request $request){
        try {
          // Assuming $fee_year is defined properly before this code snippet

            $st_id = $request->st_id;
            $year = $request->year;
            $month = $request->month;

            // Calculate the sum of the 'amount' column before deleting records
            $deleteAmount = StudentsFeeStracture::where('st_id', $st_id)->where('month', $month)->sum('amount');

            // Delete records from StudentsFeeStracture table
            StudentsFeeStracture::where('st_id', $st_id)->where('month', $month)->delete();

            // Find or create a record in StudentsFeeMonth table
            $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)->where('year', $year)->first();

            if ($StudentsFeeMonthdata) {
                // Update the month column with the sum of all fees
                $columnName = 'month_' . ($month - 1); // Adjusting month index
                $StudentsFeeMonthdata->$columnName = 0;
                $StudentsFeeMonthdata->total_fee -= $deleteAmount;
                $StudentsFeeMonthdata->total_dues -= $deleteAmount; // Assuming $all_add is defined elsewhere in your code
                $StudentsFeeMonthdata->save();
            }

            return response()->json(['status' => 'delete successfully'], 200);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AddMonth(Request $request){
        try {
            $st_id = $request->st_id;
            $year = $request->year;
            $month = $request->month;
            $input_fee_name = $request->input_fee_name;
            $input_fee_amount = $request->input_fee_amount;

            $feeCheck = StudentsFeeStracture::where('st_id', $st_id)
            ->where('year', $year)
            ->where('month', $month)->first();

            if(!$feeCheck){
                $studentFeeStructure = new StudentsFeeStracture();
                $studentFeeStructure->st_id = $st_id;
                $studentFeeStructure->year = $year;
                $studentFeeStructure->month = $month;
                $studentFeeStructure->fee_type = $input_fee_name;
                $studentFeeStructure->amount = $input_fee_amount;
                if($studentFeeStructure->save())
                {

                    // Find or create a record in StudentsFeeMonth table
                    $StudentsFeeMonth = StudentsFeeMonth::updateOrCreate(
                        ['st_id' => $st_id, 'year' => $year],
                        [
                            'month_' . $month-1 => $input_fee_amount,
                            'total_fee' => $input_fee_amount,
                            'total_dues' => $input_fee_amount,
                        ]
                    );

                    return response()->json(['status' => 'add successfully'], 200);
                }
            }else{
                return response()->json(['status' => 'this month already exist'], 200);
            }
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function SaveDealFee(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
            'checkedMonths' => 'required|array',
            'checkedMonths.*' => 'required|integer|min:1|max:12', // Assuming months range from 1 to 12
            'checkedfeeType' => 'required|array',
            'fee_amount' => 'required|numeric|min:0',
            'st_id' => 'required|integer',
            'year' => 'required|integer',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors as a JSON response
            return response()->json(['errors' => $validator->errors()], 422); // 422 is Unprocessable Entity status code
        }

       // Access the sent data
        $checkedMonths = $request->input('checkedMonths');
        $checkedfeeType = $request->input('checkedfeeType');
        $fee_amount = $request->input('fee_amount');
        $st_id =  $request->st_id;
        $year =  $request->year;

        // Delete existing fee structures for the same st_id, year, and month
        StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->whereIn('month', $checkedMonths)->delete();

        // Calculate total number of checked months
        $totalMonths = count($checkedMonths);

        // Calculate amount per month
        $amountPerMonth = floor($fee_amount / $totalMonths);

        // Calculate remaining amount
        $remainingAmount = $fee_amount - ($amountPerMonth * $totalMonths);

        // Process each checked month
        foreach ($checkedMonths as $key => $month) {
            // Add remaining amount to the first month
            $dividedAmount = $amountPerMonth;
            if ($key === 0) {
                $dividedAmount += $remainingAmount;
            }

        // Calculate amount per fee type for this month
        $amountPerFeeType = floor($dividedAmount / count($checkedfeeType));

        // Distribute amount for each fee type
        foreach ($checkedfeeType as $feeType) {
            // Save the data to the database
            StudentsFeeStracture::create([
                'st_id' => $st_id,
                'year' =>  $year, 
                'month' => $month,
                'fee_type' => $feeType,
                'amount' => $amountPerFeeType,
                'fee_structure_type' => 'deal', 
            ]);
        }

        // Find or create a record in StudentsFeeMonth table
        $studentsFeeMonth = StudentsFeeMonth::updateOrCreate(
            ['st_id' => $st_id, 'year' => $year],
            [
                'month_' . ($month - 1) => $dividedAmount,
                'total_fee' =>  $fee_amount,
                'total_dues' =>  $fee_amount,
            ]
        );

}

// Return a success response
return response()->json(['status' => 'Data saved successfully'], 200);
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
