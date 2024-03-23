<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Http\Controllers\HelperController\StudentAccountFee;
use App\Models\Parents;
use App\Models\Student;
use App\Models\SchoolDetails;
use App\Models\StudentsFeeStracture;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeePaid;
use App\Models\StudentsFeeDisc;
use App\Models\StudentsFeeDues;

class StudentsFeePayment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ParentStudentRetrive(Request $request)
    {
        try {
            $pr_id = $request->pr_id;

            $selectedMonth = $request->selectedMonth;
            $monthLength = count($selectedMonth);
            $year = 2080;


            
            $parent_data = Parents::where("id", $pr_id)->first();
            if ($parent_data && $monthLength > 0) {
                $student_data = Student::select('id', 'first_name', 'last_name', 'student_image', 'village')->where("parents_id", $pr_id)->get();
            
                // Loop through each student to get their total_fee
                foreach ($student_data as $student) {
                    $total_fee = 0;
                    $total_paid = 0;
                    $total_dues = 0;
                    $total_disc = 0;

                    foreach ($selectedMonth as $month) {
                        // Sum the fees for the selected months
                        $total_fee += StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->value($month);
                        $total_paid += StudentsFeePaid::where('year', $year)->where('st_id', $student->id)->value($month);
                        $total_dues += StudentsFeeDues::where('year', $year)->where('st_id', $student->id)->value($month);
                        $total_disc += StudentsFeeDisc::where('year', $year)->where('st_id', $student->id)->value($month);
                    }
                    $student->total_fee = $total_fee;
                    $student->total_paid = $total_paid;
                    $student->total_dues = $total_dues;
                    $student->total_disc = $total_disc;
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
            $year = 2080;
        
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

    public function StudentFeeMonthParticular(Request $request) {
        try {
            $month_array = $request->month_array;
            $st_id_array = $request->st_id_array;
            $fee_year = $request->fee_year;
    
            $fee_details = [];
            $common_fee_details = []; // Initialize array for common fee details
            $total_common_amount = 0; // Initialize total sum of common fee amounts
    
            // Iterate over each student
            foreach ($st_id_array as $student_id) {
                // Fetch student details
                $student_details = Student::where('id', $student_id)->first();
    
                $student_fee_details = [];
    
                // Initialize an array to store the total amount and months for each fee type
                $total_fee_details = [];
    
                // Iterate over each month
                foreach ($month_array as $month) {
                    // Query to fetch fee details for the student for the particular month
                    $fee_details_month = StudentsFeeStracture::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->where('month', $month)
                        ->get();
    
                    // Accumulate amounts and track months for each fee type
                    foreach ($fee_details_month as $fee_detail) {
                        $fee_type = $fee_detail->fee_type;
                        $amount = $fee_detail->amount;
    
                        // Sum the amount if the fee type already exists
                        if (isset($total_fee_details[$fee_type])) {
                            $total_fee_details[$fee_type]['amount'] += $amount;
                            $total_fee_details[$fee_type]['month']++; // Increment month count
                        } else {
                            $total_fee_details[$fee_type] = [
                                'amount' => $amount,
                                'month' => 1, // Initialize month count
                            ];
                        }
                    }
                }
    
                // Include common fee types in the common_fee_details array and calculate total common amount
                foreach ($total_fee_details as $fee_type => $details) {
                    // Add amount to total_common_amount
                    $total_common_amount += $details['amount'];
    
                    // Check if this fee type exists in common fee details, if yes, add the amount and month count
                    if (isset($common_fee_details[$fee_type])) {
                        $common_fee_details[$fee_type]['amount'] += $details['amount'];
                        $common_fee_details[$fee_type]['month'] += $details['month'];
                    } else {
                        $common_fee_details[$fee_type] = [
                            'amount' => $details['amount'],
                            'month' => $details['month'],
                        ];
                    }
                }
    
                // Sum up the total amount for this student
                $total_amount = 0;
                foreach ($total_fee_details as $details) {
                    $total_amount += $details['amount'];
                }
    
                // Include student details along with fee details
                $fee_details[$student_id] = [
                    'student_details' => $student_details,
                    'fee_details' => $total_fee_details,
                    'total_amount' => $total_amount,
                ];
            }

            $school_details = SchoolDetails::first();
    
            return response()->json(['status' => 'success', 'data' => $fee_details, 'common_fee_details' => $common_fee_details, 'total_common_amount' => $total_common_amount, 'school_details'=> $school_details]);
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    public function StudentFeePaid(Request $request)
    {
        try {
            $pay_month_array = $request->pay_month_array;
            $st_id_array = $request->st_id_array;
            $fee_year = $request->fee_year;
            $fee_amount = $request->fee_amount;
            $paid_amount = $request->paid_amount;
            $disc_amount = $request->disc_amount;
            $dues_amount = $request->dues_amount;
            $comment_disc = $request->comment_disc;
            $pay_date = $request->pay_date;
            $data_fee_particular = $request->data_fee_particular;
            $pr_id = $request->pr_id;


            ////////////////////// Start StudentsFeePaid //////////////////////
            // Loop through each student ID
            foreach ($st_id_array as $st_id) {
                // Fetch fee details for the current student from StudentsFeeMonth table
                $fee_details = StudentsFeeMonth::where('st_id', $st_id)->where('year', $fee_year)->first();

                $student_discount = $disc_amount / count($st_id_array);
            
                if ($fee_details) {
                    // Check if there is a record in StudentsFeePaid for this student
                    $student_paid_record = StudentsFeePaid::where('st_id', $st_id)->first();
                    $student_disc_record = StudentsFeeDisc::where('st_id', $st_id)->first();
                    $student_dues_record = StudentsFeeDues::where('st_id', $st_id)->first();

                    // If StudentsFeePaid no record exists, create one
                    if (!$student_paid_record) 
                    {
                        $student_paid_record = new StudentsFeePaid();
                        $student_paid_record->st_id = $st_id;
                        // Set all month columns to 0 as initial values
                        foreach ($pay_month_array as $pay_month) {
                            $student_paid_record->$pay_month = 0;
                            $student_paid_record->year = $fee_year;
                        }
                        $student_paid_record->save();

                    }
                    // If StudentsFeeDisc no record exists, create one
                    if (!$student_disc_record) 
                    {
                        $student_disc_record = new StudentsFeeDisc();
                        $student_disc_record->st_id = $st_id;
                        // Set all month columns to 0 as initial values
                        foreach ($pay_month_array as $pay_month) {
                            $student_disc_record->$pay_month = 0;
                            $student_disc_record->year = $fee_year;
                        }
                        $student_disc_record->save();
                    }
                    // If StudentsFeeDues no record exists, create one
                    if (!$student_dues_record) 
                    {
                        $student_dues_record = new StudentsFeeDues();
                        $student_dues_record->st_id = $st_id;
                        // Set all month columns to 0 as initial values
                        foreach ($pay_month_array as $pay_month) {
                            $student_dues_record->$pay_month = 0;
                            $student_dues_record->year = $fee_year;
                        }
                        $student_dues_record->save();
                    }
            
                    // Loop through each month in pay_month_array
                    foreach ($pay_month_array as $pay_month) {
                        // Check if the amount in StudentsFeePaid is less than StudentsFeeMonth for this month
                        if ($student_paid_record->$pay_month < $fee_details->$pay_month) {
                            // Calculate the remaining amount to be paid for this month
                            $remaining_amount = $fee_details->$pay_month - $student_paid_record->$pay_month;
            
                            // Distribute the minimum of remaining amount and paid amount for this month
                            $amount_to_pay = min($remaining_amount, $paid_amount);
            
                            // Set the amount in StudentsFeePaid
                            $student_paid_record->$pay_month += $amount_to_pay;
            
                            // Deduct the paid amount
                            $paid_amount -= $amount_to_pay;


            
                            // If all amount has been distributed, exit the loop
                            if ($paid_amount <= 0) {
                                break;
                            }
                        }
                    }
            
                    $student_paid_record->save();

                    // For the last iteration, save the discount amount in StudentsFeeDisc for each month
                    if (isset($student_disc_record)) {
                        foreach ($pay_month_array as $pay_month) {
                            $student_disc_record->$pay_month = $disc_amount;
                        }
                        $student_disc_record->save();
                    }
                }
            }
            ////////////////////// End StudentsFeePaid //////////////////////

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate();

            return response()->json(['status' =>  'success'], 200);

        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
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
