<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\HostelFee;
use App\Models\TuitionFee;
use App\Models\AdmissionFee;
use App\Models\ManageFreeStudents;
use App\Models\DiscountExceptions;

use App\Models\JoinleaveDates;
use Carbon\Carbon;
use App\Models\DateSetting;

use App\Models\FeeGenerated;
use App\Models\VehicleRoot;


use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;



class ManageFreeStudent extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $parent_id = $request->parent_id;

    

            $parent_response = Parents::where("id", $parent_id)->first();

            $student_response = Student::where("parents_id", $parent_id)->get();

            foreach ($student_response as $student) {
                $FreeStudentFee = ManageFreeStudents::where('st_id', $student->id)->first();
                $DiscountExc = DiscountExceptions::where('st_id', $student->id)->first();

            
                if ($FreeStudentFee) {
                    $student->FreeStudents = "Yes";
                } else {
                    $student->FreeStudents = "No";
                }

                if($DiscountExc){
                    $student->DiscountExc = "Yes";
                }
                else{
                    $student->DiscountExc = "No";
                }
            }
 

            if($parent_response){
                if($student_response){
                    return response(array("parent_data" => $parent_response, "student" => $student_response), 200);
                }
                else{
                    echo "student not found";   
                }
            }
            else{
                echo "parent not found";
            }



        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    public function FreeFeeStracture(Request $request)
    {
        try {

           $st_id = $request->st_id;

           $student_response = Student::where("id", $st_id)->first();
           $class = $student_response->class;

           $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
           $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
           $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();


           $feeTypes = []; 

            if($FeestractureOnetime->admission_fee != "0"){
                array_push($feeTypes, 'Admission Fee');
            }

            if($FeestractureOnetime->annual_charge != "0"){
                array_push($feeTypes, 'Annual Charge');
             }

           if($FeestractureMonthly->tuition_fee != "0"){
              array_push($feeTypes, 'Tuition Fee');
           }

            if($student_response->vehicle_root != "No"){
              array_push($feeTypes, 'Transport Fee');
            }

           if($FeestractureMonthly->full_hostel_fee != "0"){
             if($student_response->hostel_outi == "full-hostel"){
                array_push($feeTypes, 'F Hostel Fee');

              }
            }

            if($FeestractureMonthly->half_hostel_fee != "0"){
                if($student_response->hostel_outi == "half-hostel"){
                   array_push($feeTypes, 'H Hostel Fee');
                }
            }

            if($FeestractureMonthly->computer_fee != "0"){
               array_push($feeTypes, 'Computer Fee');
            }

            if($FeestractureMonthly->coaching_fee != "0"){
               array_push($feeTypes, 'Coaching Fee');
            }

            if($FeestractureOnetime->saraswati_puja != "0"){
               array_push($feeTypes, 'Saraswati Puja');
            }

            if($FeestractureOnetime->hostel_deposit != "0"){
                array_push($feeTypes, 'Hostel Deposit');
             }

            if($FeestractureQuarterly->exam_fee != "0")
            {
               array_push($feeTypes, 'Exam Fee');
            }

            $FreeStudentFee = ManageFreeStudents::where('st_id', $st_id)->first();
            $DiscountExc = DiscountExceptions::where("st_id", $st_id)->get();

            if(!$DiscountExc){
                $DiscountExc = "not discount";
            }
 
           if ($FreeStudentFee) {
               $freeFeeArray = json_decode($FreeStudentFee->free_fee, true); // Convert to an associative array
           }
           
           else{
            $freeFeeArray = "not free";
           }

 
             return response(array("SchoolFeeStructure" => $feeTypes, "FreeStudentFee"=>$freeFeeArray, "DiscountExceptions"=>$DiscountExc), 200);
 
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    

    public function SaveStudentFreeFee(Request $request)
    {
        try {
             $st_id = $request->st_id;
             $pr_id = $request->pr_id;
             $FreeFee = $request->FreeFee;
             $DisExcFeeType = $request->DisExcFeeType;
             $DisExcPerce = $request->DisExcPerce;

             $decodedDisExcFeeType  = json_decode($DisExcFeeType);
             $decodedDisExcPerce  = json_decode($DisExcPerce);

            // date year 
            $dateSetting = DateSetting::first();
            $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

             if ($decodedDisExcFeeType != null) {
                DiscountExceptions::where("st_id", $st_id)->delete();
                foreach ($decodedDisExcFeeType as $index => $DisFeeType) {
                        $DiscountExceptions = new DiscountExceptions();
                        $DiscountExceptions->st_id = $st_id;
                        $DiscountExceptions->class_year = $year;
                        $DiscountExceptions->pr_id = $pr_id;
                        $DiscountExceptions->fee_type = $DisFeeType;
                        $DiscountExceptions->dis = $decodedDisExcPerce[$index];
                        $DiscountExceptions->save();
                    }
             } 
             else{
                DiscountExceptions::where("st_id", $st_id)->delete();
             } 

             // Find and delete the existing row if it exists
                $existingManageFreeStudent = ManageFreeStudents::where("pr_id", $pr_id)->first();

                if ($existingManageFreeStudent) {
                    $existingManageFreeStudent->delete();
                }

                if($FreeFee == "[]"){
                    if ($existingManageFreeStudent) {
                        $existingManageFreeStudent->delete();
                        echo "update sucess";
                    }
                }
                else{
                    // Create a new row
                    $newManageFreeStudent = new ManageFreeStudents();
                    $newManageFreeStudent->st_id = $st_id;
                    $newManageFreeStudent->class_year = $year;
                    $newManageFreeStudent->pr_id = $pr_id;
                    $newManageFreeStudent->free_fee = $FreeFee;
                    if($newManageFreeStudent->save())
                    {
                        echo "update sucess";
                    }
                }

                $TotalFee = 0;
                ///////////////////// Start Total Feee Retrive ///////////////////////////
                    $student = Student::where('id', $st_id)->first();
                    $FeestractureMonthly = FeestractureMonthly::where('class', $student->class)->first();
                    $FeestractureOnetime = FeestractureOnetime::where('class', $student->class)->first();
                    $FeestractureQuarterly = FeestractureQuarterly::where('class', $student->class)->first();

                    $joining_months = JoinleaveDates::where('st_id', $st_id)->first();
                    $StudentsFreeFee = ManageFreeStudents::where('st_id', $st_id)->first();

                    $student = Student::where('id', $st_id)->first();
                    $admission_date = Carbon::parse($student->admission_date);
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month;

                    if($year != $admission_year)
                    {
                        $start_month = 0;
                    }
                    else{
                    $start_month = $admission_month-1;
                    }  

                    for ($i = $start_month; $i <= 11; $i++) {
                        $MonthFeeGenerate = 0;  
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
                                $MonthFeeGenerate += $tuition_fee;
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

                        $feeGenerated = FeeGenerated::where("class_year", $year)->where('st_id', $st_id)->first();
                        if ($feeGenerated) {
                            $feeGenerated->{'month_'.$i} = $MonthFeeGenerate;
                            $feeGenerated->save();
                        } else {
                            $newRecord = new FeeGenerated();
                            $newRecord->st_id = $st_id;
                            $newRecord->class = $student->class;
                            $newRecord->class_year = $year; 
                            $newRecord->{'month_'.$i} = $MonthFeeGenerate; 
                            $newRecord->save();
                        }                        
                    }
                ///////////////////// End Total Feee Retrive ///////////////////////////

 


 
        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    } 
 
    
}
