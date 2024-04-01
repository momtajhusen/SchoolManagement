<?php

namespace App\Http\Controllers\HelperController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeePaid;
use App\Models\StudentsFeeDisc;
use App\Models\StudentsFeeDues;
use App\Models\StudentsFeeStracture;
use App\Models\Student;
use App\Models\SchoolDetails;


class StudentAccountFee extends Controller
{

    public static function StudentsFeeMonthsCalculate()
    {
        $studentsFeeMonths = StudentsFeeMonth::get();

        foreach ($studentsFeeMonths as $studentFeeMonth) 
        {

        $st_id = $studentFeeMonth->st_id;

        // StudentsFeeMonth
            $totalmonthFee = 0;
            for ($i = 0; $i <= 11; $i++) {
                $totalmonthFee += $studentFeeMonth->{"month_$i"};
            }
            
            // StudentsFeePaid
            $studentsFeePaid = StudentsFeePaid::where('st_id', $st_id)->first();
            $totalpaidFee = 0;
            if($studentsFeePaid){
                for ($i = 0; $i <= 11; $i++) {
                    $totalpaidFee += $studentsFeePaid->{"month_$i"};
                    
                }
            }

            // StudentsFeeDisc
            $studentsFeeDisc = StudentsFeeDisc::where('st_id', $st_id)->first();
            $totaldiscFee = 0;
            if($studentsFeeDisc){
                for ($i = 0; $i <= 11; $i++) {
                    $totaldiscFee += $studentsFeeDisc->{"month_$i"};
                }
            }

            // Update total_fee column
            $studentFeeMonth->total_fee = $totalmonthFee;
            $studentFeeMonth->total_paid = $totalpaidFee - $totaldiscFee;
            $studentFeeMonth->total_disc = $totaldiscFee;
            $studentFeeMonth->total_dues = (int) ltrim((string) ($totalpaidFee - $totalmonthFee), '-');
            $studentFeeMonth->save();

        }
    }

    public static function feePaidMonthStatus($year, $student_data)
    {
        // Initialize monthStatus array outside of the if-else block
        $monthStatus = [];

        // Determine payment status for each month
        for ($i = 0; $i < 12; $i++) {
            $month = 'month_' . $i;

            // Initialize total paid and total discount
            $total_fee =  0;
            $total_paid = 0;
            $total_disc = 0;
            $unFeeSet = false;

            // Loop through all students to sum their payments and discounts
            foreach ($student_data as $student) {
                $status_fee = StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                $status_paid = StudentsFeePaid::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                $status_disc = StudentsFeeDisc::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;

                // Accumulate total paid and total discount
                $total_fee += $status_fee;
                $total_paid += $status_paid;
                $total_disc += $status_disc;


                // Check if any student has no fee set for this month
                if ($status_fee == 0) {
                    $unFeeSet = true;
                }
            }

            // Calculate total payments including discounts
            $total_paids = $total_paid + $total_disc;

            // Determine status based on total fee and total payments
            if ($unFeeSet) {
                $status = 'FeeNotSet';
            } else {
                $status = ($total_paids >= $total_fee) ? 'Paid' : (($total_paids > 0) ? 'Dues' : 'Unpaid');
            }

            $monthStatus[$month] = $status;
        }

        return $monthStatus;
    }

    public static function singleStudentMonthStatus($year, $st_id)
    {
        // Initialize monthStatus array
        $monthStatus = [];

        // Determine payment status for each month
        for ($i = 0; $i <= 11; $i++) {
            $month = 'month_' . $i;

            // Fetch the fee status, paid amount, and discount amount for the current month
            $status_fee = StudentsFeeMonth::where('year', $year)->where('st_id', $st_id)->value($month) ?? 0;
            $status_paid = StudentsFeePaid::where('year', $year)->where('st_id', $st_id)->value($month) ?? 0;
            $status_disc = StudentsFeeDisc::where('year', $year)->where('st_id', $st_id)->value($month) ?? 0;

            // Determine the status for the current month
            if ($status_fee == 0) {
                $status = 'FeeNotSet';
            } elseif ($status_paid >= $status_fee) {
                $status = 'Paid';
            } elseif ($status_paid + $status_disc >= $status_fee) {
                $status = 'Dues';
            } else {
                $status = 'Unpaid';
            }

            $monthStatus[$i] = $status;
        }

        return $monthStatus;
    }

    public static function StudentFeeMonthParticular($month_array, $pr_id, $fee_year) 
    {
        try {
            $fee_details = [];
            $common_fee_details = []; 
            $total_common_amount = 0; 
            $students = Student::where('parents_id', $pr_id)->get();
    
            // Iterate over each student
            foreach ($students as $student) {
                // Fetch student details
                $student_id = $student->id;
    
                $student_details = [
                    'id' => $student->id,
                    'student_name' => $student->first_name . ' ' . $student->last_name,
                    'class' => $student->class,
                    'section' => $student->section,
                ];
    
                // Initialize an array to store the total amount and months for each fee type
                $total_fee_details = [];
    
                // Iterate over each month
                foreach ($month_array as $month) {
                    // Query to fetch fee details for the student for the particular month
                    $fee_details_month = StudentsFeeStracture::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->where('month', $month)
                        ->get();
    
                    $dues_column =  $month;
                    $dues_amount_month = StudentsFeeDues::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->value($dues_column) ?? 0;
    
                    if ($dues_amount_month <= 0) {
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
                    } else {
                        // Sum the dues amount for each month in the $month_array
                        $prev_balance_amount = 0;
                        foreach ($month_array as $month) {
                            $dues_column = $month; // Adjusting month to match column index
                            $prev_balance_amount += StudentsFeeDues::where('st_id', $student_id)
                                ->where('year', $fee_year)
                                ->value($dues_column) ?? 0;
                        }
                        $total_fee_details['Previous Balance'] = [
                            'amount' => $prev_balance_amount,
                            'month' => 1, // Initialize month count
                        ];
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
                $total_amount = array_sum(array_column($total_fee_details, 'amount'));
    
                // Include student details along with fee details
                $fee_details[$student_id] = [
                    'student_details' => $student_details,
                    'fee_details' => $total_fee_details,
                    'total_amount' => $total_amount,
                ];
            }
    
            $school_details = SchoolDetails::first();
    
            return response()->json([
                'status' => 'success',
                'data' => $fee_details,
                'common_fee_details' => $common_fee_details,
                'total_common_amount' => $total_common_amount,
                'school_details' => $school_details
            ]);
    
            
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

}

 