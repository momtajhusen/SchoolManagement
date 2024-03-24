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
            $studentFeeMonth->total_dues = $totalmonthFee - $totalpaidFee + $totaldiscFee;
            $studentFeeMonth->save();

        }
    }
}

 