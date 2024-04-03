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
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;
use App\Models\VehicleRoot;

 
 
use App\Models\JoinleaveDates;
use App\Models\ManageFreeStudents;
use App\Models\DiscountExceptions;
use App\Models\FeeGenerated;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;
use App\Models\LastPaymentForReset;
use App\Models\LastDuesForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastFreeFeeForReset;
use Carbon\Carbon;




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
            $studentFeeMonth->total_paid = $totalpaidFee;
            $studentFeeMonth->total_disc = $totaldiscFee;
            $studentFeeMonth->total_dues = (int) ltrim((string) ($totalpaidFee + $totaldiscFee - $totalmonthFee), '-');
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

    // Set Student Fee When Student Register New Account
    public static function setStudentFees($class, $start_month, $class_year, $admission_year, $request,  $st_id)
    {
        $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
        $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
        $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();
        $VehicleRoot = VehicleRoot::where('id', $request->vehicle_root)->first();

 
    
        // Initialize fees array
        $fees = [
            'tuition_fee' => $FeestractureMonthly->tuition_fee ?? 0,
            'exam_fee' => 0,
            'saraswati_puja' => 0,
            'admission_fee' => 0,
            'annual_charge' => 0,
            'transport_fee' => 0,
        ];
    
        // Include computer_fee if its value is greater than 0
        if ($FeestractureMonthly->computer_fee > 0) {
            $fees['computer_fee'] = $FeestractureMonthly->computer_fee;
        }
    
        // Include coaching_fee if its value is greater than 0
        if ($FeestractureMonthly->coaching_fee > 0) {
            $fees['coaching_fee'] = $FeestractureMonthly->coaching_fee;
        }

        if ($VehicleRoot) {
            $fees['transport_fee'] = $VehicleRoot->amount;  
        }
          

    
        // Variable to track if it's the first iteration
        $firstloop = true;
    
        $start_month = $start_month+1;
        // Loop through months
        for ($i = $start_month; $i < 12; $i++) {
            $fees['exam_fee'] = 0;
            $fees['saraswati_puja'] = 0;


            // Set exam_fee only in months 3, 6, 9, and 12
            if (in_array($i + 1, [3, 6, 9, 12]) && ($FeestractureQuarterly->exam_fee ?? 0) > 0) {
                $fees['exam_fee'] = $FeestractureQuarterly->exam_fee;
            }
    
            // Set saraswati_puja_fee only in month 10
            if (in_array($i + 1, [10]) && ($FeestractureOnetime->saraswati_puja ?? 0) > 0) {
                $fees['saraswati_puja'] = $FeestractureOnetime->saraswati_puja;

            }
    
            // Set admission_fee or annual_charge based on class year and admission year only in the first iteration
            if ($firstloop) {
                if ((int)$class_year === (int)$admission_year) {
                    $fees['admission_fee'] = $FeestractureOnetime->admission_fee;
                } else {
                    $fees['annual_charge'] = $FeestractureOnetime->annual_charge;
                }
                $firstloop = false; // Set to false after the first iteration
            } else {
                // Reset admission_fee and annual_charge to 0 in subsequent iterations
                $fees['admission_fee'] = 0;
                $fees['annual_charge'] = 0;
            }
    
            // Filter out fees with amounts less than or equal to 0
            $feesToSave = array_filter($fees, function($amount) {
                return $amount > 0;
            });
    
            // Save fees to StudentsFeeStracture
            foreach ($feesToSave as $fee_type => $amount) {
                $studentFeeStructure = new StudentsFeeStracture();
                $studentFeeStructure->st_id = $st_id;
                $studentFeeStructure->year = $class_year;
                $studentFeeStructure->month = $i + 1;
                $studentFeeStructure->fee_type = $fee_type;
                $studentFeeStructure->amount = $amount;
                $studentFeeStructure->save();
            }
    
            // Update the sum of fees for the current month in StudentsFeeMonth table
            $monthColumn = 'month_' . $i;
            $all_add = StudentsFeeStracture::where('st_id', $st_id)
                ->where('year', $class_year)
                ->where('month', $i + 1)
                ->sum('amount');
    
            $StudentsFeeMonthdata = StudentsFeeMonth::firstOrNew(['st_id' => $st_id, 'year' => $class_year]);
            $StudentsFeeMonthdata->$monthColumn = $all_add;
            $StudentsFeeMonthdata->save();
        }
    }


    /////////////////////////////// Start Old Account Fee Set /////////////////////////
        public static function setStudentFeesOldAccount($class, $class_year, $st_id, $request)
        {
            $TotalFee = 0;
            ///////////////////// Start Total Feee Retrive ///////////////////////////
                $student = Student::where('class', $request->input("class"))->where('id', $st_id)->where('class_year', $class_year)->first();
                $FeestractureMonthly = FeestractureMonthly::where('class', $student->class)->first();
                $FeestractureOnetime = FeestractureOnetime::where('class', $student->class)->first();
                $FeestractureQuarterly = FeestractureQuarterly::where('class', $student->class)->first();

                $joining_months = JoinleaveDates::where('st_id', $st_id)->first();
                $StudentsFreeFee = ManageFreeStudents::where('st_id', $st_id)->first();

                $student = Student::where('id', $st_id)->first();
                $admission_date = Carbon::parse($student->admission_date);
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month;

                if($class_year != $admission_year)
                {
                    $start_month = 0;
                }
                else{
                $start_month = $admission_month-1;
                }  

                for ($i = $start_month; $i <= 11; $i++) {
                    $MonthFeeGenerate = 0;  
                    /////////// Start Check Tuition Fee /////////

                    // Start tuition joining month check than add amount
                        if ($joining_months) {
                            $tuition_months_array = json_decode($joining_months->tuition_fee, true);
                            if($tuition_months_array[$i] == 1)
                            {
                                $tuition_fee =  $FeestractureMonthly->tuition_fee;
                            }
                            else{
                                $tuition_fee = 0; 
                            }
                        }
                        else{
                            $tuition_fee = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Tuition Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $tuition_fee = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Tuition Fee")->first();
                                if($DiscountExceptions){
                                    $tuitionDisc = $DiscountExceptions->dis; 
                                    $tutionDiscAmount = ($tuition_fee * $tuitionDisc) / 100;
                                    $tuition_fee = $tuition_fee - $tutionDiscAmount;
                                }
                            // End Check Discount Exception 

                        if ($tuition_fee != 0) {
                            $TotalFee += $tuition_fee;
                            $MonthFeeGenerate += $tuition_fee;
                        }
                    //////////// End Check Tuition Fee /////////

                    /////////// Start Check Transport Fee ///////////
                            if ($student->vehicle_root != "No") {
                                // Outi Use Transport
                                $VehicleRoot = VehicleRoot::where('id', $student->vehicle_root)->first();
                                if ($joining_months) {
                                    $transport_months_array = json_decode($joining_months->transport_fee, true);
                                    if($transport_months_array[$i] == 1)
                                    {
                                        $transport_amount =  $VehicleRoot->amount ?? 0;
                                    }
                                    else{
                                        $transport_amount = 0; 
                                    }
                                }
                                else{
                                    $transport_amount = 0;
                                }
                            } else {
                                // Outi Not use Transport
                                $transport_amount = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Transport Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $transport_amount = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Transport Fee")->first();
                                    if($DiscountExceptions){
                                        $transportDisc = $DiscountExceptions->dis; 
                                        $transportDiscAmount = ($transport_amount * $transportDisc) / 100;
                                        $transport_amount = $transport_amount - $transportDiscAmount;
                                    }
                                // End Check Discount Exception

                        if ($transport_amount != 0) {
                            $TotalFee += $transport_amount;
                            $MonthFeeGenerate += $transport_amount;
                        }
            
                    /////////// End Check Transport Fee /////////// 
                    
                    /////////// Start Check Full Hostel Fee ///////////
                        // Start coaching joining month check than add amount
                        if ($joining_months) {
                            $fullhostel_months_array = json_decode($joining_months->full_hostel_fee, true);
                            if($fullhostel_months_array[$i] == 1)
                            {
                                $full_hostel_fee =  $FeestractureMonthly->full_hostel_fee;
                            }
                            else{
                                $full_hostel_fee = 0; 
                            }
                            }
                            else{
                                $full_hostel_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("F Hostel Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $full_hostel_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "F Hostel Fee")->first();
                                    if($DiscountExceptions){
                                        $fhostelDisc = $DiscountExceptions->dis; 
                                        $fhostelDiscAmount = ($full_hostel_fee * $fhostelDisc) / 100;
                                        $full_hostel_fee = $full_hostel_fee - $fhostelDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($full_hostel_fee != 0) {
                                $TotalFee += $full_hostel_fee;
                                $MonthFeeGenerate += $full_hostel_fee;
                            }
                    /////////// End Check Full Hostel Fee ///////////

                    /////////// Start Check Half Hostel Fee ///////////
                        // Start coaching joining month check than add amount
                        if ($joining_months) {
                            $halfhostel_months_array = json_decode($joining_months->half_hostel_fee, true);
                            if($halfhostel_months_array[$i] == 1)
                            {
                                $half_hostel_fee =  $FeestractureMonthly->half_hostel_fee;
                            }
                            else{
                                $half_hostel_fee = 0; 
                            }
                            }
                            else{
                                $half_hostel_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("H Hostel Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $half_hostel_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "H Hostel Fee")->first();
                                    if($DiscountExceptions){
                                        $hhostelDisc = $DiscountExceptions->dis; 
                                        $hhostelDiscAmount = ($half_hostel_fee * $hhostelDisc) / 100;
                                        $half_hostel_fee = $half_hostel_fee - $hhostelDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($half_hostel_fee != 0) {
                                $TotalFee += $half_hostel_fee;
                                $MonthFeeGenerate += $half_hostel_fee;
                            }
                    /////////// End Check Half Hostel Fee ///////////

                    /////////// Start Check Coaching Fee ///////////
                        if ($student->coaching == "Yes") {
                            // Start coaching joining month check than add amount
                            if ($joining_months) {
                            $coaching_months_array = json_decode($joining_months->coaching_fee, true);
                            if($coaching_months_array[$i] == 1)
                            {
                                $coaching_fee =  $FeestractureMonthly->coaching_fee;
                            }
                            else{
                                $coaching_fee = 0; 
                            }
                        }
                        else{
                            $coaching_fee = 0;
                        }

                        } else {
                            $coaching_fee = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Coaching Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $coaching_fee = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Coaching Fee")->first();
                                if($DiscountExceptions){
                                    $coachingDisc = $DiscountExceptions->dis; 
                                    $transportDiscAmount = ($coaching_fee * $coachingDisc) / 100;
                                    $coaching_fee = $coaching_fee - $transportDiscAmount;
                                }
                            // End Check Discount Exception

                        if ($coaching_fee != 0) {
                            $TotalFee += $coaching_fee;
                            $MonthFeeGenerate += $coaching_fee;
                        }
                    /////////// End Check CoachingFee Fee ///////////

                    /////////// Start Check Computer Fee ///////////
                        // Start computer joining month check than add amount
                        if ($joining_months) {
                            $computer_months_array = json_decode($joining_months->computer_fee, true);
                            if($computer_months_array[$i] == 1)
                            {
                                $computer_fee =  $FeestractureMonthly->computer_fee;
                            }
                            else{
                                $computer_fee = 0; 
                            }
                        }
                        else{
                            $computer_fee = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Computer Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $computer_fee = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Computer Fee")->first();
                                if($DiscountExceptions){
                                    $computergDisc = $DiscountExceptions->dis; 
                                    $computerDiscAmount = ($computer_fee * $computergDisc) / 100;
                                    $computer_fee = $computer_fee - $computerDiscAmount;
                                }
                            // End Check Discount Exception
                
                        if ($computer_fee != 0) {
                            $TotalFee += $computer_fee;
                            $MonthFeeGenerate += $computer_fee;
                        }
                    /////////// End Check CoachingFee Fee ///////////

                    /////////// Start Check Admission Fee ///////////
                        // Start admission joining month check than add amount
                        if ($joining_months) {
                            $admission_months_array = json_decode($joining_months->admission_fee, true);
                            if($admission_months_array[$i] == 1)
                            {
                                $admission_fee =  $FeestractureOnetime->admission_fee;
                            }
                            else{
                                $admission_fee = 0; 
                            }
                        }
                        else{
                            $admission_fee = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Admission Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $admission_fee = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Admission Fee")->first();
                                if($DiscountExceptions){
                                    $admissionDisc = $DiscountExceptions->dis; 
                                    $admissionDiscAmount = ($admission_fee * $admissionDisc) / 100;
                                    $admission_fee = $admission_fee - $admissionDiscAmount;
                                }
                            // End Check Discount Exception 
                
                        if ($admission_fee != 0) {
                            $TotalFee += $admission_fee;
                            $MonthFeeGenerate += $admission_fee;
                        }
                    /////////// End Check Admission Fee ///////////

                    /////////// Start Check Annual Charge ///////////
                        // Start annual joining month check than add amount
                        if ($joining_months) {
                            $annual_months_array = json_decode($joining_months->annual_charge, true);
                            if($annual_months_array[$i] == 1)
                            {
                                $annual_charge =  $FeestractureOnetime->annual_charge;
                            }
                            else{
                                $annual_charge = 0; 
                            }
                        }
                        else{
                            $annual_charge = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Annual Charge", $freeFeeArray);
                                    if ($index !== false) {
                                        $annual_charge = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Annual Charge")->first();
                                if($DiscountExceptions){
                                    $annualDisc = $DiscountExceptions->dis; 
                                    $annualDiscAmount = ($annual_charge * $annualDisc) / 100;
                                    $annual_charge = $annual_charge - $annualDiscAmount;
                                }
                            // End Check Discount Exception
                
                        if ($annual_charge != 0) {
                            $TotalFee += $annual_charge;
                            $MonthFeeGenerate += $annual_charge;
                        }
                    /////////// End Check Annual Charge ///////////

                    /////////// Start Check Saraswati Puja Charge ///////////
                        // Start Saraswati joining month check than add amount
                        if ($joining_months) {
                            $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                            if($saraswati_months_array[$i] == 1)
                            {
                                $saraswati_puja =  $FeestractureOnetime->saraswati_puja;
                            }
                            else{
                                $saraswati_puja = 0; 
                            }
                        }
                        else{
                            $saraswati_puja = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Saraswati Puja", $freeFeeArray);
                                    if ($index !== false) {
                                        $saraswati_puja = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Saraswati Puja")->first();
                                if($DiscountExceptions){
                                    $saraswatiDisc = $DiscountExceptions->dis; 
                                    $examDiscAmount = ($saraswati_puja * $saraswatiDisc) / 100;
                                    $saraswati_puja = $saraswati_puja - $examDiscAmount;
                                }
                            // End Check Discount Exception
                
                        if ($saraswati_puja != 0) {
                            $TotalFee += $saraswati_puja;
                            $MonthFeeGenerate += $saraswati_puja;
                        }
                    /////////// End Check Saraswati Puja Charge ///////////

                    /////////// Start Check Exam Fee ///////////
                        // Start exam joining month check than add amount
                        if ($joining_months) {
                            $exam_months_array = json_decode($joining_months->exam_fee, true);
                            if($exam_months_array[$i] == 1)
                            {
                                $exam_fee =  $FeestractureQuarterly->exam_fee;
                            }
                            else{
                                $exam_fee = 0; 
                            }
                        }
                        else{
                            $exam_fee = 0;
                        }

                            ///// Start Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Exam Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $exam_fee = 0;
                                    }
                                } 
                            ///// End Fee Exceptionss

                            // Start Check Discount Exception 
                                $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Exam Fee")->first();
                                if($DiscountExceptions){
                                    $examDisc = $DiscountExceptions->dis; 
                                    $examDiscAmount = ($exam_fee * $examDisc) / 100;
                                    $exam_fee = $exam_fee - $examDiscAmount;
                                }
                            // End Check Discount Exception

                            if ($exam_fee != 0) {
                                $TotalFee += $exam_fee;
                                $MonthFeeGenerate += $exam_fee;
                            }
                    /////////// End Check Exam Fee  ///////////

                    $feeGenerated = FeeGenerated::where("class_year", $class_year)->where('st_id', $st_id)->first();
                    if ($feeGenerated) {
                        $feeGenerated->{'month_'.$i} = $MonthFeeGenerate;
                        $feeGenerated->save();
                    } else {
                        $newRecord = new FeeGenerated();
                        $newRecord->st_id = $st_id;
                        $newRecord->class = $student->class;
                        $newRecord->class_year = $class_year; 
                        $newRecord->{'month_'.$i} = $MonthFeeGenerate; 
                        $newRecord->save();
                    }                        
                }
            ///////////////////// End Total Feee Retrive ///////////////////////////

            // Start Create Table Row For This Student 
                $payment = [
                    'st_id' => $student->id,
                    'class' => $request->input('class'),
                    'class_year' => $class_year,
                    'total_fee' => $TotalFee,
                    'total_dues' => $TotalFee,
                    'total_payment' => 0,
                    'free_fee' => 0,
                    'total_discount' => 0,
                ];
                $attributes = [
                    'st_id' => $student->id,
                    'class' => $request->input('class'),
                    'class_year' => $class_year,
                ];

                FeePayment::create($payment);
                DuesAmount::create($attributes);
                FeeDiscount::create($attributes);
                FeeFree::create($attributes);
                
                LastPaymentForReset::create($payment);
                LastDuesForReset::create($attributes);
                LastDiscountsForReset::create($attributes);
                LastFreeFeeForReset::create($attributes);
            // End Create Table Row For This Student 
        }

        public static function setJoiningData($student, $class_year, $admission_month, $request)
        {
            $admissionStartMonthsArray = array_fill(0, 12, "0");

            for ($i = $admission_month; $i < 12; $i++) {
                $admissionStartMonthsArray[$i] = "1";
            }

            $admissionMonthsArray = array_fill(0, 12, "0");
            $admissionMonthsArray[$admission_month] = "1";
            $serializedAdmissionArray = json_encode($admissionMonthsArray);
            
            $serializedStartAdmissionArray = json_encode($admissionStartMonthsArray);

            $FullHostel_Join = $request->input("hostel_outi") === "full-hostel" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $HalfHostel_Join = $request->input("hostel_outi") === "half-hostel" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';

            $Transport_Join = $request->input("transport_use") === "Yes" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $Coaching_join = $request->input("coaching_use") === "Yes" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            
            $JoinleaveDates = JoinleaveDates::where('st_id', $student->id)->first();
            if ($JoinleaveDates) {
                $JoinleaveDates->delete();
            }

            $exam_json = '["0","0","1","0","0","1","0","0","1","0","0","1"]';
            if($admission_month >= 2){
                $exam_json = '["0","0","1","0","0","1","0","0","1","0","0","1"]';
            }
            if($admission_month >= 3){
                $exam_json = '["0","0","0","0","0","1","0","0","1","0","0","1"]';
            }
            if($admission_month >= 6){
                $exam_json = '["0","0","0","0","0","0","0","0","1","0","0","1"]';
            }
            if($admission_month >= 9){
                $exam_json = '["0","0","0","0","0","0","0","0","0","0","0","1"]';
            }

            $joinLeaveEntry = new JoinleaveDates;
            $joinLeaveEntry->st_id  = $student->id;
            $joinLeaveEntry->class_year  = $class_year;
            $joinLeaveEntry->admission_months = $serializedAdmissionArray;
            $joinLeaveEntry->admission_start = $serializedStartAdmissionArray;
            $joinLeaveEntry->tuition_fee = $serializedStartAdmissionArray;
            $joinLeaveEntry->transport_fee = $Transport_Join;
            $joinLeaveEntry->full_hostel_fee = $FullHostel_Join;
            $joinLeaveEntry->half_hostel_fee = $HalfHostel_Join;     
            $joinLeaveEntry->coaching_fee  =  $Coaching_join;
            $joinLeaveEntry->computer_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $joinLeaveEntry->admission_fee  =  $serializedAdmissionArray;
            $joinLeaveEntry->annual_charge  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $joinLeaveEntry->saraswati_puja  =  '["0","0","0","0","0","0","0","0","0","1","0","0"]';
            $joinLeaveEntry->exam_fee  =  $exam_json;
            $joinLeaveEntry->save();
        }
    /////////////////////////////// End Old Account Fee Set /////////////////////////
 

}

 