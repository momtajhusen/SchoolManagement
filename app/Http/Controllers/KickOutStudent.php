<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Carbon\Carbon;
use App\Models\Parents;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\FeeDiscount;

use App\Models\ManageFreeStudents;
use App\Models\JoinleaveDates;

use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;

use App\Models\VehicleRoot;

use App\Models\DiscountExceptions;

class KickOutStudent extends Controller
{

    public function TotalFeeKickOut(Request $request)
    {
      echo "Controller TotalFeeKickOut";
    }
 
    public function KickOutStudent(Request $request)
    {
        try {
            $st_id = $request->st_id;
            $current_year = $request->current_year;
            $kickout_month = $request->kickout_month;



            $admission_status = Student::where("id", $st_id)->first();
          

            if($admission_status)
            {

                $student = Student::where("id", $st_id)->first();

                $admission_status->admission_status = "kick-out";
                $admission_status->status_date = $current_year."-".$kickout_month;

                
                $TotalFee = 0;
                $TotalPayment = 0;
                $TotalDiscount = 0;
                ///////////////////// Start Total Feee Retrive ///////////////////////////
                    $FeestractureMonthly = FeestractureMonthly::where('class', $student->class)->first();
                    $FeestractureOnetime = FeestractureOnetime::where('class', $student->class)->first();
                    $FeestractureQuarterly = FeestractureQuarterly::where('class', $student->class)->first();

                    $joining_months = JoinleaveDates::where('st_id', $st_id)->first();
                    $StudentsFreeFee = ManageFreeStudents::where('st_id', $st_id)->first();

                    $student = Student::where('id', $st_id)->first();
                    $admission_date = Carbon::parse($student->admission_date);
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month;

                    if($current_year != $admission_year)
                    {
                        $start_month = 0;
                    }
                    else{
                    $start_month = $admission_month-1;
                    }  

                    for ($i = $start_month; $i <= $kickout_month-1; $i++) {
                            
                        ////////// Start Check Tuition Fee /////////
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
                            }
                        /////////// End Check Tuition Fee /////////

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
                            }
                        /////////// End Check Exam Fee  ///////////
                        
                    }
                ///////////////////// End Total Feee Retrive ///////////////////////////

                
                
                for ($i = 0; $i <= 11; $i++) {
                    $totalPaymentSum = FeePayment::where('class_year', $current_year)->where('st_id', $st_id)->value("month_$i");
                    $totalDiscountSum = FeeDiscount::where('class_year', $current_year)->where('st_id', $st_id)->value("month_$i");
                    $TotalPayment += $totalPaymentSum;
                    $TotalDiscount += $totalDiscountSum;
                }
                
                $FeePayment = FeePayment::where("class_year", $current_year)->where("st_id", $st_id)->first();
                
                $FeePayment->total_fee = $TotalFee;
                $FeePayment->total_payment = $TotalPayment;
                $FeePayment->total_discount = $TotalDiscount;
                $FeePayment->save();

                $Parents = Parents::where("id", $student->parents_id)->first();
                $Parents->admission_status = "kick-out";
                $Parents->save();

                if($admission_status->save())
                {
                 return response()->json(['message' =>  "save sucess"], 200);   
                }
            }
            else{
                return response()->json(['message' =>  "student not found"], 500);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred at line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['ErrorMessage' => $message], 500);
        }
    }

    public function GetKickOutStudent(Request $request)
    {
        $select_year = $request->select_year;
        $select_class = $request->select_class;

        $student =  Student::where("admission_status", "kick-out")->get();

        $StudentData = [];
        if (count($student) != "0") {
            foreach ($student as $data) {
                array_push($StudentData, $data);
            }

            return response(array("StudentData" => $StudentData), 200);
        }
    }

    public function GetKickOutStudentDetails(Request $request)
    {
 
        $student_id = $request->student_id;

        $StudentDetails =  Student::where("admission_status", "kick-out")->where("id", $student_id)->first();

        /////////// Start Back Year Fee ///////////
        $YearFee = [];
        $YearFeeResponse = FeePayment::where('st_id', $student_id)->orderBy('class_year', 'desc')->get();
        if (count($YearFeeResponse) != "0") {

            foreach ($YearFeeResponse as $data) {
                array_push($YearFee, $data);
            }
        }
        /////////// End Back Year Fee ///////////

        return response(array("StudentDetails" => $StudentDetails, "YearFee" => $YearFee), 200);
    }

    public function ReEnter(Request $request)
    {
        try {
            $st_id = $request->st_id;

            $student = Student::where("id", $st_id)->first();

            if ($student) {
                $student->admission_status =  "admit";

                $Parents = Parents::where("id", $student->parents_id)->first();
                $Parents->admission_status =  null;
                $Parents->save();
            
                if ($student->save()) {
                    return response()->json(['message' =>  "save success"], 200);
                }
            }
            else{
                return response()->json(['message' =>  "student not found"], 500);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred at line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['ErrorMessage' => $message], 500);
        }
    }


 
}
