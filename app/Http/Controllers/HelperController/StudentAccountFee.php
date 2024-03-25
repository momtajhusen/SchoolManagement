<?php

namespace App\Http\Controllers\HelperController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeePaid;
use App\Models\StudentsFeeDisc;
use App\Models\StudentsFeeDues;

class StudentAccountFee extends Controller
{
    public static function StudentsFeeMonthsCalculate(){
        $studentsFeeMonths = StudentsFeeMonth::get();

        foreach ($studentsFeeMonths as $studentFeeMonth) {

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
            $studentFeeMonth->total_paid = $totalpaidFee;
            $studentFeeMonth->total_disc = $totaldiscFee;
            $studentFeeMonth->total_dues = $totalpaidFee + $totaldiscFee - $totalmonthFee;
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
}

 