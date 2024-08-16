<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\Student;
use App\Models\HostelFee;
use App\Models\TuitionFee;
use App\Models\FeeStructure;
use App\Models\VehicleRoot;
use App\Models\FeePayment;
use App\Models\FeeDiscount;
use App\Models\FeeFree;
use App\Models\JoinleaveDates;
use App\Models\AdmissionFee;
use App\Models\AdmissionPay;
use App\Models\ManageFreeStudents;
use App\Models\DiscountExceptions;
use Carbon\Carbon;
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;
use App\Models\SchoolDetails;
use App\Models\Parents;
use App\Models\Classes;
use App\Models\ClassTotalFeePayment;
use App\Models\ClassTotalFeeDiscount;
use App\Models\DuesAmount;
use App\Models\ItemsSellHistories;



class DuesListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $allData = [];
    public $FeeParticular = [];
    public function index(Request $request)
    {

        try {
            $class = $request->select_class;
            $section = $request->select_section;
            $select_student = $request->select_student;

            $months = json_decode($request->input('selectmonth'));
            $lastIndex = count($months);
            $length = count($months);

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);
 

            if ($class == 'all_class' && $section == 'all_section') {
                if($select_student == 'current_student'){
                    $response = Student::where("class_year", $current_year)->where("admission_status", "admit")->get();
                }else if($select_student == 'kick_out_student'){
                    $response = Student::where("admission_status", "kick-out")->get();
                    
                }else if($select_student == 'pass_out_student'){
                    $response = Student::where("admission_status", "pass-out")->get();
                    
                }
            } elseif ($class != 'all_class' && $section == 'all_section') {
                if($select_student == 'current_student'){
                    $response = Student::where("class", $class)->where("class_year", $current_year)->where("admission_status", "admit")->get();
                }else if($select_student == 'kick_out_student'){
                    $response = Student::where("class", $class)->where("admission_status", "kick-out")->get();

                }else if($select_student == 'pass_out_student'){
                    $response = Student::where("class", $class)->where("admission_status", "pass-out")->get();
                    
                }
            } else {
                if($select_student == 'current_student'){
                  $response = Student::where("class", $class)->where('section', $section)->where("class_year", $current_year)->where("admission_status", "admit")->get();   
                }
                if($select_student == 'kick_out_student'){
                  $response = Student::where("class", $class)->where('section', $section)->where("admission_status", "kick-out")->get();   
                    
                }
                if($select_student == 'pass_out_student'){
                    $response = Student::where("class", $class)->where('section', $section)->where("admission_status", "pass-out")->get();     
                }
            }
            

            if (count($response) != "0") {
                foreach ($response as $data) 
                {

                $FeestractureMonthly = FeestractureMonthly::where('class', $data->class)->first();
                $FeestractureOnetime = FeestractureOnetime::where('class', $data->class)->first();
                $FeestractureQuarterly = FeestractureQuarterly::where('class', $data->class)->first();
                
                // Admission date
                $admission_date = Carbon::parse($data->admission_date); 
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month;

                if ($current_year != $admission_year) {
                    $start_month = 0;
                } else {
                    $start_month = $admission_month - 1;
                }   

                    // Payment Fee 
                        $Paymentfee = FeePayment::where('class', $data->class)->where('st_id', $data->id)->where('class_year', $current_year)->first();
                        $TotalPaymentFee = 0;
                        if ($Paymentfee) {
                            for ($i = 0; $i < $length; $i++) {
                                $TotalPaymentFee += $Paymentfee->{$months[$i]};
                            }
                        } else {
                            $TotalPaymentFee = 0;
                        }
                    // Payment Fee

                    // FeeDiscount Fee 
                        $FeeDiscountfee = FeeDiscount::where('class', $data->class)->where('st_id', $data->id)->where('class_year', $current_year)->first();
                        $FeeDiscountFee = 0;
                        if ($FeeDiscountfee) {
                            for ($i = 0; $i < $length; $i++) {
                                $FeeDiscountFee += $FeeDiscountfee->{$months[$i]};
                            }
                        } else {
                            $FeeDiscountFee = 0;
                        }
                    // FeeDiscount Fee 
                    
                    // Fetch FeeFree 
                        $feeFreeObj = FeeFree::where('class', $data->class)->where('st_id', $data->id)->where('class_year', $current_year)->first();
                        $FeeFree = 0;
                        if ($feeFreeObj) {
                            for ($i = 0; $i < $length; $i++) {
                                $FeeFree += $feeFreeObj->{$months[$i]};
                            }
                        } else {
                            $FeeFree = 0;
                        }
                    // Fetch FeeFree

                    //////////// Start Prev Year Dues  /////////// 

                    if ($data->admission_status == 'admit') {
                        // For currently admitted students, fetch fee payment records from previous years
                        $YearFeeResponse = FeePayment::where('class_year', '<>', $current_year)->where('st_id', $data->id)->get();
                    } else {
                        // For kick-out or pass-out students, fetch fee payment records for the current year
                        $YearFeeResponse = FeePayment::where('st_id', $data->id)->get();
                    }

                        $TotalFee = 0;
                        $TotalPayment = 0;
                        $TotalDis= 0;
                        $TotalFree= 0;
                    
                        foreach ($YearFeeResponse as $feeRecord) {

                            $TotalFee += (int)$feeRecord->total_fee;
                            $TotalPayment += (int)$feeRecord->total_payment;
                            $TotalDis += (int)$feeRecord->total_discount;
                            $TotalFree += (int)$feeRecord->free_fee;
                        }

                        $pay_amount = $TotalPayment + $TotalDis + $TotalFree;
                        
                        $BackYearFee = $TotalFee - $pay_amount;
                        $data->BackYearFee = $TotalFee - $pay_amount;
                
                    //////////// End Prev Year Dues  ///////////

                    $totalFeesForStudent = 0;
                    $PreviusBlance = 0;
                    $joining_months = JoinleaveDates::where('st_id', $data->id)->first();
                    $StudentsFreeFee = ManageFreeStudents::where('st_id', $data->id)->first();

                    $duesAmount = DuesAmount::where("st_id", $data->id)->where("class_year", $current_year)->first();
                    $FeeTypeWithAmount = [];


            ///////////////////// Start Inventory Particular ///////////////////////////
                for ($i = 0; $i < $length; $i++) 
                {

                    $numerMonth = (int) str_replace("month_", "", $months[$i]);

                    $ItemsSellHistories = ItemsSellHistories::where('st_id', $data->id)->where('month', $numerMonth)->where('status', 'Dues')->get();

                    if(!$ItemsSellHistories->isEmpty()) {

                        $total_inventry_amount = 0;
                        foreach($ItemsSellHistories as $ItemsHistory) {

                            $HistoryMonth = $ItemsHistory->month;
                            $HistoryFeeYear = $ItemsHistory->fee_year;

                            $PurchaseArray = json_decode($ItemsHistory->particulars_data);


                            $column = 'month_'.$HistoryMonth; 
                           $DuesAmount = DuesAmount::where("st_id",$data->id)->where("class_year", $HistoryFeeYear)->first();
                           if($DuesAmount){
                            if($duesAmount->$column == null){
                                if ($ItemsHistory->paid == 0) {
                                    foreach ($PurchaseArray as $Purchase) {
                                        $itemName = $Purchase->itemName;
                                        $amount = $Purchase->amount;
                                        $quantity = $Purchase->quantity;

                                        $total_inventry_amount += $amount;
                                
                                        // Check if the item already exists in the array, if yes, add the amount
                                        if (isset($FeeTypeWithAmount[$itemName])) {
                                            $FeeTypeWithAmount[$itemName] += $amount;
                                        } else {
                                            $FeeTypeWithAmount[$itemName] = $amount;
                                        }
                                    }
                                } else {
                                    // Use a separate variable to accumulate item names
                                    $itemNames = '';
                                    foreach ($PurchaseArray as $Purchase) {
                                        $itemNames .= $Purchase->itemName.', '; // Concatenate item names
                                    }
                                
                                    // Assign concatenated item names as key and dues as value in FeeTypeWithAmount array
                                    $FeeTypeWithAmount[$itemNames] = $ItemsHistory->dues;

                                    $total_inventry_amount += $ItemsHistory->dues;

                                }
                             } 
                           }
                       
                        }

                        $totalFeesForStudent += $total_inventry_amount;
                    }
                }
            ///////////////////// End Inventory Particular ///////////////////////////

 
                    /////////// Start Check Admission Fee ///////////
                            $admissionAmount = $FeestractureOnetime->admission_fee ?? 0;

                            // Start admission joining month check than add month
                                $admission_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth =  str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $admission_months_array = json_decode($joining_months->admission_fee, true);
                                        if (($admission_months_array[$numerMonth] ?? null) == 1) {

                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $admission_join_month += 1;
                                            } 
                                        }
                                    }
                                }
                            // End admission joining month check than add amount

                                    //// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Admission Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $admission_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 


                            //// Now Admission Total calculation with Joining month  ////
                                if($admissionAmount * $admission_join_month != 0){

                                        // Start Check Discount Exception 
                                            $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Admission Fee")->first();
                                            if($DiscountExceptions){
                                                $admissionDisc = $DiscountExceptions->dis; 
                                                $admissionTotalAmount = $admissionAmount * $admission_join_month;
                                                $admissionDiscAmount = ($admissionTotalAmount * $admissionDisc) / 100;
                                                $admissionFinalAmount = $admissionTotalAmount - $admissionDiscAmount;
                                            }
                                            else{
                                                $admissionFinalAmount = $admissionAmount * $admission_join_month; 
                                            }
                                        // End Check Discount Exception 

                                    $totalFeesForStudent += $admissionFinalAmount;
                                    $FeeTypeWithAmount["Admission Fee"] = $admissionFinalAmount.",".$admission_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Admission Fee"]); 
                                }
                            //// Now Admission Total calculation with Joining month ////

                    /////////// Start Check Admission Fee ///////////

                    /////////// Start Check Annual Charge ///////////

                            $annualAmount = $FeestractureOnetime->annual_charge ?? 0;

                            // Start annual joining month check than add month
                                $annual_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $annual_months_array = json_decode($joining_months->annual_charge, true);
                                        if (($annual_months_array[$numerMonth] ?? null) == 1) {
                                            
                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $annual_join_month += 1;
                                            }
                                            
                                        }
                                    }
                                }
                            // End annual joining month check than add amount

                                    //// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Annual Charge", $freeFeeArray);
                                            if ($index !== false) {
                                                $annual_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 


                            //// Now Annual Total calculation with Joining month  ////
                                if($annualAmount * $annual_join_month != 0){

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Annual Charge")->first();
                                        if($DiscountExceptions){
                                            $annualDisc = $DiscountExceptions->dis;
                                            $annualTotalAmount = $annualAmount * $annual_join_month;
                                            $annualDiscAmount = ($annualTotalAmount * $annualDisc) / 100;
                                            $annualFinalAmount = $annualTotalAmount - $annualDiscAmount;
                                        }
                                        else{
                                            $annualFinalAmount = $annualAmount * $annual_join_month; 
                                        }
                                    // End Check Discount Exception 
                                    $totalFeesForStudent += $annualFinalAmount;
                                    $FeeTypeWithAmount["Annual Charge"] = $annualFinalAmount.",".$annual_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Annual Charge"]); 
                                }
                            //// Now Annual Total calculation with Joining month ////

                    /////////// Start Check Annual Charge ///////////

                    ////////// Start Check Tuition Fee /////////
 
                        $tuitionAmount = $FeestractureMonthly->tuition_fee ?? 0;

                        // Start tuition joining month check than add month
                            $tuition_join_month = 0;
                            for ($i = $start_month; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $tuition_months_array = json_decode($joining_months->tuition_fee, true);
                                    if (($tuition_months_array[$numerMonth] ?? null) == 1) {

                                        // check this month already pay or not if not pay than add join_month 
                                        if ($duesAmount && $duesAmount->{$months[$i]} === null) {
                                            $tuition_join_month += 1;

                                        }
                                    }

                                    // PreviusBlance than add 
                                    if ($duesAmount && $duesAmount->{$months[$i]} !== null) {
                                        $PreviusBlance += (int)$duesAmount->{$months[$i]};
                                    }
                                }
                            }
                        // End tuition joining month check than add amount

                            ///// Start Check Fee Exceptionss 
                                if ($StudentsFreeFee) {
                                    $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                    $index = array_search("Tuition Fee", $freeFeeArray);
                                    if ($index !== false) {
                                        $tuition_join_month = 0;
                                    }
                                } 
                            ///// End Check Fee Exceptionss 
    

                        //// Now Tuition Total calculation with Joining month  ////
                            if($tuitionAmount * $tuition_join_month != 0){

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Tuition Fee")->first();
                                    if($DiscountExceptions){

                                       $tuitionDisc = $DiscountExceptions->dis; 
                                       $tuitionTotalAmount = $tuitionAmount * $tuition_join_month;
                                       $tutionDiscAmount = ($tuitionTotalAmount * $tuitionDisc) / 100;
                                       $tutionFinalAmount = $tuitionTotalAmount - $tutionDiscAmount;

                                    }
                                    else{
                                        $tutionFinalAmount = $tuitionAmount * $tuition_join_month; 
                                    }
                                // End Check Discount Exception 

                                $totalFeesForStudent += $tutionFinalAmount;
                                $FeeTypeWithAmount["Tuition Fee"] = $tutionFinalAmount.",".$tuition_join_month;
                            }
                            else{
                                unset($FeeTypeWithAmount["Tuition Fee"]); 
                            }
                        //// Now Tuition Total calculation with Joining month ////
 
                    // //////// End Check Tuition Fee /////////

                    /////////// Start Check Full_Hostel Fee ///////////

                        $fullhostelAmount = $FeestractureMonthly->full_hostel_fee ?? 0;

                        // Start fullhostel joining month check than add month
                            $fullhostel_join_month = 0;
                            for ($i = $start_month; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $fullhostel_months_array = json_decode($joining_months->full_hostel_fee, true);
                                    if (($fullhostel_months_array[$numerMonth] ?? null) == 1) {

                                        // check this month already pay or not if not pay than add join_month 
                                        if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                            $fullhostel_join_month += 1;
                                        }

                                    }
                                }
                            }
                        // End fullhostel joining month check than add amount

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("F Hostel Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $fullhostel_join_month = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss 
    

                        //// Now Full_Hostel Total calculation with Joining month  ////
                            if($fullhostelAmount * $fullhostel_join_month != 0){

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "F Hostel Fee")->first();
                                    if($DiscountExceptions){
                                        $fullhostelDisc = $DiscountExceptions->dis;
                                        $fullhostelTotalAmount = $fullhostelAmount * $fullhostel_join_month;
                                        $fullhostelDiscAmount = ($fullhostelTotalAmount * $fullhostelDisc) / 100;
                                        $fullhostelFinalAmount = $fullhostelTotalAmount - $fullhostelDiscAmount;
                                    }
                                    else{
                                        $fullhostelFinalAmount = $fullhostelAmount * $fullhostel_join_month; 
                                    }
                                // End Check Discount Exception 

                                $totalFeesForStudent += $fullhostelFinalAmount;
                                $FeeTypeWithAmount["F Hostel Fee"] = $fullhostelFinalAmount.",".$fullhostel_join_month;
                            }
                            else{
                                unset($FeeTypeWithAmount["F Hostel Fee"]); 
                            }
                        //// Now Full_Hostel Total calculation with Joining month ////
    
                    /////////// Start Check Full_Hostel Fee ///////////

                    /////////// Start Check Half_Hostel Fee ///////////

                            $halfhostelAmount = $FeestractureMonthly->half_hostel_fee ?? 0;

                            // Start halfhostel joining month check than add month
                                $halfhostel_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $halfhostel_months_array = json_decode($joining_months->half_hostel_fee, true);
                                        if (($halfhostel_months_array[$numerMonth] ?? null) == 1) {
                                            
                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $halfhostel_join_month += 1;
                                            }
                                        }
                                    }
                                }
                            // End halfhostel joining month check than add amount

                                        ///// Start Fee Exceptionss 
                                            if ($StudentsFreeFee) {
                                                $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                                $index = array_search("H Hostel Fee", $freeFeeArray);
                                                if ($index !== false) {
                                                    $halfhostel_join_month = 0;
                                                }
                                            } 
                                        ///// End Fee Exceptionss 
        
    
                            //// Now Half_Hostel Total calculation with Joining month  ////
                                if($halfhostelAmount * $halfhostel_join_month != 0){

                                        // Start Check Discount Exception 
                                            $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "H Hostel Fee")->first();
                                            if($DiscountExceptions){
                                                $halfhostelDisc = $DiscountExceptions->dis;
                                                $halfhostelTotalAmount = $halfhostelAmount * $halfhostel_join_month;
                                                $halfhostelDiscAmount = ($halfhostelTotalAmount * $halfhostelDisc) / 100;
                                                $halfhostelFinalAmount = $halfhostelTotalAmount - $halfhostelDiscAmount;
                                            }
                                            else{
                                                $halfhostelFinalAmount = $halfhostelAmount * $halfhostel_join_month; 
                                            }
                                        // End Check Discount Exception 

                                    $totalFeesForStudent += $halfhostelFinalAmount;
                                    $FeeTypeWithAmount["H Hostel Fee"] = $halfhostelFinalAmount.",".$halfhostel_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["H Hostel Fee"]); 
                                }
                            //// Now Half_Hostel Total calculation with Joining month ////
        
                    /////////// Start Check Half_Hostel Fee ///////////

                    /////////// Start Check Transport Fee than Add  ///////////
                        if ($data->vehicle_root != "No") {
                            $root_id = $data->vehicle_root;
                            $Transport = VehicleRoot::where('id', $root_id)->first();
                            $transportAmount = $Transport->amount ?? 0;

                        // Start transport joining month check than add month
                            $transport_join_month = 0;
                            for ($i = $start_month; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $transport_months_array = json_decode($joining_months->transport_fee, true);
                                    if (($transport_months_array[$numerMonth] ?? null) == 1) {

                                        // check this month already pay or not if not pay than add join_month 
                                        if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                            $transport_join_month += 1;
                                        }
                                    }
                                }
                            }
                        // End transport joining month check than add amount

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Transport Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $transport_join_month = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss 
    

                        //// Now Transport Total calculation with Joining month  ////
                            if($transportAmount * $transport_join_month != 0){

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Transport Fee")->first();
                                    if($DiscountExceptions){
                                        $transportDisc = $DiscountExceptions->dis;
                                        $transportTotalAmount = $transportAmount * $transport_join_month;
                                        $transportDiscAmount = ($transportTotalAmount * $transportDisc) / 100;
                                        $transportFinalAmount = $transportTotalAmount - $transportDiscAmount;
                                    }
                                    else{
                                        $transportFinalAmount = $transportAmount * $transport_join_month; 
                                    }
                                // End Check Discount Exception 

                                $totalFeesForStudent += $transportFinalAmount;
                                $FeeTypeWithAmount["Transport Fee"] = $transportFinalAmount.",".$transport_join_month;
                            }
                            else{
                                unset($FeeTypeWithAmount["Transport Fee"]); 
                            }
                        //// Now Transport Total calculation with Joining month ////

                        } else {
                            unset($FeeTypeWithAmount["Transport Fee"]); 
                        }
                    /////////// End Check Transport Fee than Add  ///////////

                    /////////// Start Check Coaching Fee ///////////

                            $coachingAmount = $FeestractureMonthly->coaching_fee ?? 0;

                            // Start coaching joining month check than add month
                                $coaching_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $coaching_months_array = json_decode($joining_months->coaching_fee, true);
                                        if (($coaching_months_array[$numerMonth] ?? null) == 1) {

                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $coaching_join_month += 1;
                                            }
                                        }
                                    }
                                }
                            // End coaching joining month check than add amount

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Coaching Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $coaching_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 


                            //// Now Coaching Total calculation with Joining month  ////
                                if($coachingAmount * $coaching_join_month != 0){

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Coaching Fee")->first();
                                        if($DiscountExceptions){
                                            $coachingDisc = $DiscountExceptions->dis;
                                            $coachingTotalAmount = $coachingAmount * $coaching_join_month;
                                            $coachingDiscAmount = ($coachingTotalAmount * $coachingDisc) / 100;
                                            $coachingFinalAmount = $coachingTotalAmount - $coachingDiscAmount;
                                        }
                                        else{
                                            $coachingFinalAmount = $coachingAmount * $coaching_join_month; 
                                        }
                                    // End Check Discount Exception

                                    $totalFeesForStudent += $coachingFinalAmount ;
                                    $FeeTypeWithAmount["Coaching Fee"] = $coachingFinalAmount.",".$coaching_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Coaching Fee"]); 
                                }
                            //// Now Coaching Total calculation with Joining month ////

                    /////////// Start Check Coaching Fee ///////////
                
                    /////////// Start Check Computer Fee ///////////

                            $computerAmount = $FeestractureMonthly->computer_fee ?? 0;

                            // Start computer joining month check than add month
                                $computer_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $halfhostel_months_array = json_decode($joining_months->computer_fee, true);
                                        if (($halfhostel_months_array[$numerMonth] ?? null) == 1) {
                                           
                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $computer_join_month += 1;
                                            }
                                        }
                                    }
                                }
                            // End computer joining month check than add amount

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Computer Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $computer_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 
        
    
                            //// Now Computer Total calculation with Joining month  ////
                                if($computerAmount * $computer_join_month != 0){

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Computer Fee")->first();
                                        if($DiscountExceptions){
                                            $computerDisc = $DiscountExceptions->dis;
                                            $computerTotalAmount = $computerAmount * $computer_join_month;
                                            $computerDiscAmount = ($computerTotalAmount * $computerDisc) / 100;
                                            $computerFinalAmount = $computerTotalAmount - $computerDiscAmount;
                                        }
                                        else{
                                            $computerFinalAmount = $computerAmount * $computer_join_month.",".$computer_join_month; 
                                        }
                                    // End Check Discount Exception

                                    $totalFeesForStudent += $computerFinalAmount;
                                    $FeeTypeWithAmount["Computer Fee"] = $computerFinalAmount;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Computer Fee"]); 
                                }
                            //// Now Computer Total calculation with Joining month ////
        
                    /////////// Start Check Computer Fee ///////////

                    /////////// Start Check Exam Fee ///////////

                            $examAmount = $FeestractureQuarterly->exam_fee ?? 0;

                            // Start exam fee month check than add month
                                $exam_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $exam_months_array = json_decode($joining_months->exam_fee, true);
                                        if (($exam_months_array[$numerMonth] ?? null) == 1) {

                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $exam_join_month += 1;
                                            }
                                        }
                                    }
                                }
                            // End exam fee joining month check than add amount

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Exam Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $exam_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 


                            //// Now Exam Fee calculation with Joining month  ////
                                if($examAmount * $exam_join_month != 0){

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Exam Fee")->first();
                                        if($DiscountExceptions){
                                            $examDisc = $DiscountExceptions->dis;
                                            $examTotalAmount = $examAmount * $exam_join_month;
                                            $examDiscAmount = ($examTotalAmount * $examDisc) / 100;
                                            $examFinalAmount = $examTotalAmount - $examDiscAmount;
                                        }
                                        else{
                                            $examFinalAmount = $examAmount * $exam_join_month; 
                                        }
                                    // End Check Discount Exception

                                    $totalFeesForStudent += $examFinalAmount;
                                    $FeeTypeWithAmount["Exam Fee"] = $examFinalAmount.",".$exam_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Exam Fee"]); 
                                }
                            //// Now Exam Fee Total calculation with Joining month ////

                    /////////// Start Check Exam Fee ///////////

                    /////////// Start Check Hostel Deposit Fee ///////////

                        $hosteldepositAmount = $FeestractureOnetime->hostel_deposit ?? 0;

                        // Start exam fee month check than add month
                            $hosteldeposit_join_month = 0;
                            for ($i = $start_month; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $hosteldeposit_months_array = json_decode($joining_months->hostel_deposit, true);
                                    if (($hosteldeposit_months_array[$numerMonth] ?? null) == 1) {

                                        // check this month already pay or not if not pay than add join_month 
                                        if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                            $hosteldeposit_join_month += 1;
                                        }
                                    }
                                }
                            }
                        // End exam fee joining month check than add amount

                            ///// Start Fee Exceptionss 
                                // if ($StudentsFreeFee) {
                                //     $freeFeeArray = json_decode($StudentsFreeFee->hostel_deposit, true);
                                //     $index = array_search("Hostel Deposit", $freeFeeArray);
                                //     if ($index !== false) {
                                //         $hosteldeposit_join_month = 0;
                                //     }
                                // } 
                            ///// End Fee Exceptionss 


                        //// Now Exam Fee calculation with Joining month  ////
                            if($hosteldepositAmount * $hosteldeposit_join_month != 0){

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Hostel Deposit")->first();
                                    if($DiscountExceptions){
                                        $hosteldepositDisc = $DiscountExceptions->dis;
                                        $hosteldepositTotalAmount = $hosteldepositAmount * $hosteldeposit_join_month;
                                        $hosteldepositDiscAmount = ($hosteldepositTotalAmount * $hosteldepositDisc) / 100;
                                        $hosteldepositFinalAmount = $hosteldepositTotalAmount - $hosteldepositDiscAmount;
                                    }
                                    else{
                                        $hosteldepositFinalAmount = $hosteldepositAmount * $hosteldeposit_join_month; 
                                    }
                                // End Check Discount Exception

                                $totalFeesForStudent += $hosteldepositFinalAmount;
                                $FeeTypeWithAmount["Hostel Deposit"] = $hosteldepositFinalAmount.",".$hosteldeposit_join_month;
                            }
                            else{
                                unset($FeeTypeWithAmount["Hostel Deposit"]);
                            }
                        //// Now Exam Fee Total calculation with Joining month ////

                    /////////// Start Check Hostel Deposit Fee ///////////

                    /////////// Start Check Saraswati Puja Fee ///////////

                            $saraswatiAmount = $FeestractureOnetime->saraswati_puja ?? 0;

                            // Start puja fee month check than add month
                                $saraswati_join_month = 0;
                                for ($i = $start_month; $i < $length; $i++) {
                                    $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                    if ($joining_months) {
                                        $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                                        if (($saraswati_months_array[$numerMonth] ?? null) == 1) {

                                            // check this month already pay or not if not pay than add join_month 
                                            if (!$duesAmount || $duesAmount->{$months[$i]} === null) {
                                                $saraswati_join_month += 1;
                                            }

                                        }
                                    }
                                }
                            // End puja fee joining month check than add amount

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Saraswati Puja", $freeFeeArray);
                                            if ($index !== false) {
                                                $saraswati_join_month = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss 


                            //// Now Puja Fee calculation with Joining month  ////
                                if($saraswatiAmount * $saraswati_join_month != 0){

                                        // Start Check Discount Exception 
                                            $DiscountExceptions = DiscountExceptions::where('st_id', $data->id)->where("fee_type", "Saraswati Puja")->first();
                                            if($DiscountExceptions){
                                                $saraswatiDisc = $DiscountExceptions->dis;
                                                $saraswatiTotalAmount = $saraswatiAmount * $saraswati_join_month;
                                                $saraswatiDiscAmount = ($saraswatiTotalAmount * $saraswatiDisc) / 100;
                                                $saraswatiFinalAmount = $saraswatiTotalAmount - $saraswatiDiscAmount;
                                            }
                                            else{
                                                $saraswatiFinalAmount = $saraswatiAmount * $saraswati_join_month; 
                                            }
                                        // End Check Discount Exception

                                    $totalFeesForStudent += $saraswatiFinalAmount;
                                    $FeeTypeWithAmount["Saraswati Puja"] = $saraswatiFinalAmount.",".$saraswati_join_month;
                                }
                                else{
                                    unset($FeeTypeWithAmount["Saraswati Puja"]); 
                                }
                            //// Now Puja Fee Total calculation with Joining month ////

                    /////////// Start Check Saraswati Puja Fee ///////////
 
                    // All FeeTypeWithAmount append data array
                    $data->FeeTypeWithAmount = $FeeTypeWithAmount;

                    // Parents Data 
                    $Parents = Parents::where('id', $data->parents_id)->first();
                    $data->ParentsData =  $Parents;

                    // School Data 
                    $SchoolDetails = SchoolDetails::first();
                    $data->SchoolDetails =  $SchoolDetails;

                    // TotalPaymentFee
                    $data->totalPaymentFee = $TotalPaymentFee;

                    // TotalFeeDiscountee
                    $data->totalDiscountfee = $FeeDiscountFee;

                    // TotalFreeFee
                    $data->totalFeeFree = $FeeFree;

                    // Add $totalFeesForStudent to the $data array
                    $data->totalFeesForStudent = $totalFeesForStudent;
                    $data->PreviusBlance = $PreviusBlance;

                    $data->NetPay = $totalFeesForStudent + $PreviusBlance + $BackYearFee;


                    // Add $data to $this->allData
                    array_push($this->allData, $data);
 
                  
                }
                return response(array("data" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function duesMessage(Request $request)
    {
        $studentData = $request->input('StudentData');
        $studentDataArray = json_decode($studentData, true);

        foreach ($studentDataArray as $data) {
            $fatherMobile = $data[0];
            $Student = $data[1];
            $TotalFee = $data[2];
            $payment = $data[3];
            $duesAmount = $data[4];

            echo "Polar Star School " . "Name : " . $Student . " total Payed " . $payment . " " . "Dues Amount" . $duesAmount . " Next Message ";
        }
    }
 
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
