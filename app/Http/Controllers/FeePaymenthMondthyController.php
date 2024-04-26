<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\DateSetting;
use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\Parents;

use App\Models\FeeGenerated;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;
use App\Models\AdmissionFee;
use App\Models\AdmissionPay;
use App\Models\ManageFreeStudents;
use App\Models\DiscountExceptions;
use App\Models\SchoolDetails;


use App\Models\VehicleRoot;
use App\Models\PaymentHistory;
use App\Models\JoinleaveDates;

use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;

use App\Models\ItemsSellHistories;

use Carbon\Carbon;


class FeePaymenthMondthyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];

    public $history_response;
    public $Datahistory;
    public $historyData = [];

    public $year_response;
    public $YearfeeData = [];
    public function index(Request $request)
    {

        try {
            // $class = $request->class;
            $student_id = $request->student_id;
            $st_id = $request->student_id;



            if(Student::where('id', $student_id)->where("admission_status", "admit")->first())
            {
                // date year 
                $dateSetting = DateSetting::first();
                $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

                $class = Student::where('id', $student_id)->where('class_year', $year)->first()->class;

                $this->response = Student::where("class", $class)->where("id",  $student_id)->where('class_year', $year)->get();


                if (count($this->response) != "0") {

                    /////////// Start This Class All Student Details Data ///////////
                        foreach ($this->response as $this->data) {
                            array_push($this->allData, $this->data);
                        }
                    ///////////End  This Class All Student Data ///////////

                    $TotalFee = 0;


                ///////////////////// Start Total Feee Retrive ///////////////////////////
                    $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
                    $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
                    $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();

                    $student = Student::where('class', $class)->where('id', $student_id)->where('class_year', $year)->first();
                    $StudentsFreeFee = ManageFreeStudents::where('st_id', $student_id)->first();
    

                    $joining_months = JoinleaveDates::where('st_id', $student_id)->first();

                    $admission_date = Carbon::parse($student->admission_date);
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month;

                    $feeMonthly = [
                        'month_0' => 0,
                        'month_1' => 0,
                        'month_2' => 0,
                        'month_3' => 0,
                        'month_4' => 0,
                        'month_5' => 0,
                        'month_6' => 0,
                        'month_7' => 0,
                        'month_8' => 0,
                        'month_9' => 0,
                        'month_10' => 0,
                        'month_11' => 0,
                    ]; 

                    if($year != $admission_year)
                    {
                        $start_month = 0;
                    }
                    else{
                      $start_month = $admission_month-1;
                    }  
                    
                    ///////////////////// Start Inventory Check ///////////////////////////

                        // $ItemsAmount = ItemsSellHistories::where('st_id', $st_id)->where('status', 'Dues')->sum('dues');
                        // if($ItemsAmount){

                        //     $ItemsSellHistories = ItemsSellHistories::where('st_id', $st_id)->where('status', 'Dues')->first();
                        //     if($ItemsSellHistories){
                        //         $SellMonth =  $ItemsSellHistories->month;
    
                        //         $feeMonthly['month_'.$SellMonth] += $ItemsAmount;
                        //     }

                        // }

                        $ItemsSellHistories = ItemsSellHistories::where('st_id', $student_id)->where('status', 'Dues')->get();

                        foreach ($ItemsSellHistories as $Histories) {
                            $SellMonth = $Histories->month;
                            $SellDues = $Histories->dues;
                            $SellYear = $Histories->fee_year;
                        
                            $month = 'month_'.$SellMonth;
                        
                            $duesAmount = DuesAmount::where("st_id", $student_id)->where("class_year", $SellYear)->first();
                        
                            if ($duesAmount) {
                                if ($duesAmount->$month === null) { // Checking if the property exists and then its value
                                    $feeMonthly[$month] += $SellDues;
                                }
                            } 
                        }
                    ///////////////////// End Inventory Check ///////////////////////////

                    for ($i = $start_month; $i <= 11; $i++) {
                        $MonthFeeGenerate = 0;

                        ////////// Start Check Tuition Fee /////////
                          //Start tuition joining month check than add amount
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Tuition Fee")->first();
                                    if($DiscountExceptions){
                                        $tuitionDisc = $DiscountExceptions->dis; 
                                        $tutionDiscAmount = ($tuition_fee * $tuitionDisc) / 100;
                                        $tuition_fee = $tuition_fee - $tutionDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($tuition_fee != 0) {
                                $feeMonthly['month_'.$i] += $tuition_fee;
                                $TotalFee += $tuition_fee;
                                $MonthFeeGenerate += $tuition_fee;
                            }
                        ////////// End Check Tuition Fee /////////

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
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Transport Fee")->first();
                                        if($DiscountExceptions){
                                            $transportDisc = $DiscountExceptions->dis; 
                                            $transportDiscAmount = ($transport_amount * $transportDisc) / 100;
                                            $transport_amount = $transport_amount - $transportDiscAmount;
                                        }
                                    // End Check Discount Exception

                            if ($transport_amount != 0) {
                                $feeMonthly['month_'.$i] += $transport_amount;
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
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "F Hostel Fee")->first();
                                        if($DiscountExceptions){
                                            $fhostelDisc = $DiscountExceptions->dis; 
                                            $fhostelDiscAmount = ($full_hostel_fee * $fhostelDisc) / 100;
                                            $full_hostel_fee = $full_hostel_fee - $fhostelDiscAmount;
                                        }
                                    // End Check Discount Exception 

                                if ($full_hostel_fee != 0) {
                                    $feeMonthly['month_'.$i] += $full_hostel_fee;
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
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "H Hostel Fee")->first();
                                        if($DiscountExceptions){
                                            $hhostelDisc = $DiscountExceptions->dis; 
                                            $hhostelDiscAmount = ($half_hostel_fee * $hhostelDisc) / 100;
                                            $half_hostel_fee = $half_hostel_fee - $hhostelDiscAmount;
                                        }
                                    // End Check Discount Exception 

                                if ($half_hostel_fee != 0) {
                                    $feeMonthly['month_'.$i] += $half_hostel_fee;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Coaching Fee")->first();
                                    if($DiscountExceptions){
                                        $coachingDisc = $DiscountExceptions->dis; 
                                        $transportDiscAmount = ($coaching_fee * $coachingDisc) / 100;
                                        $coaching_fee = $coaching_fee - $transportDiscAmount;
                                    }
                                // End Check Discount Exception

                            if ($coaching_fee != 0) {
                                $feeMonthly['month_'.$i] += $coaching_fee;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Computer Fee")->first();
                                    if($DiscountExceptions){
                                        $computergDisc = $DiscountExceptions->dis; 
                                        $computerDiscAmount = ($computer_fee * $computergDisc) / 100;
                                        $computer_fee = $computer_fee - $computerDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($computer_fee != 0) {
                                $feeMonthly['month_'.$i] += $computer_fee;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Admission Fee")->first();
                                    if($DiscountExceptions){
                                        $admissionDisc = $DiscountExceptions->dis; 
                                        $admissionDiscAmount = ($admission_fee * $admissionDisc) / 100;
                                        $admission_fee = $admission_fee - $admissionDiscAmount;
                                    }
                                // End Check Discount Exception 
                    
                            if ($admission_fee != 0) {
                                $feeMonthly['month_'.$i] += $admission_fee;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Annual Charge")->first();
                                    if($DiscountExceptions){
                                        $annualDisc = $DiscountExceptions->dis; 
                                        $annualDiscAmount = ($annual_charge * $annualDisc) / 100;
                                        $annual_charge = $annual_charge - $annualDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($annual_charge != 0) {
                                $feeMonthly['month_'.$i] += $annual_charge;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Saraswati Puja")->first();
                                    if($DiscountExceptions){
                                        $saraswatiDisc = $DiscountExceptions->dis; 
                                        $examDiscAmount = ($saraswati_puja * $saraswatiDisc) / 100;
                                        $saraswati_puja = $saraswati_puja - $examDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($saraswati_puja != 0) {
                                $feeMonthly['month_'.$i] += $saraswati_puja;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Exam Fee")->first();
                                    if($DiscountExceptions){
                                        $examDisc = $DiscountExceptions->dis; 
                                        $examDiscAmount = ($exam_fee * $examDisc) / 100;
                                        $exam_fee = $exam_fee - $examDiscAmount;
                                    }
                                // End Check Discount Exception

                            if ($exam_fee != 0) {
                                $feeMonthly['month_'.$i] += $exam_fee;
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
                    
                    /////////// Start Payment Fee 12 Month  ///////////
                        $PaymentFee = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->get();
                        if (count($PaymentFee) == "0") {
                            $PaymentFee = "data not found";
                        }
                    /////////// End Payment Fee 12 Month ///////////

                    /////////// Start Discount Fee 12 Month  ///////////
                        $FeeDiscount = FeeDiscount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->get();
                        if (count($FeeDiscount) == "0") {
                            $FeeDiscount = "data not found";
                        }
                    /////////// End Discount Fee 12 Month ///////////

                    /////////// Start FeeFree 12 Month  ///////////
                        $FeeFree = FeeFree::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->get();
                        if (count($FeeFree) == "0") {
                            $FeeFree = "data not found";
                        }
                    /////////// End Discount Fee 12 Month ///////////

                    ////////// Start DuesAmount Fee 12 Month  ///////////
                        $DuesAmount = DuesAmount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->get();
                        if (count($DuesAmount) == "0") {
                            $DuesAmount = "data not found";
                        }
                    /////////// End DuesAmount Fee 12 Month ///////////

                    /////////// Start Retrive PaymentHistory Data ///////////
                        $resetStatus = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                        $paymentresetStatus = $resetStatus->reset_status;

                        $this->response = PaymentHistory::where("student_id", $student_id)
                        ->whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$year])
                        ->orderBy('id', 'desc')
                        ->get();
                        if (count($this->response) != "0") {
                            foreach ($this->response as $this->Datahistory) {
                                array_push($this->historyData, $this->Datahistory);
                            }
                        }
                        
                    /////////// End Retrive PaymentHistory Data ///////////

                    /////////// Start Back Year Fee ///////////
                        $ResponseYearFee = FeePayment::where('st_id', $student_id)->whereNot('class_year', $year)->get();

                        if (count($ResponseYearFee) != 0) {
                            foreach ($ResponseYearFee as $fee) {

                                $topalpayment = (int)$fee->total_payment + (int)$fee->total_discount + (int)$fee->free_fee;
                                if ($fee->total_fee != $topalpayment) {
                                    $YearFee[] = $fee;
                                }
                            }
                            if (empty($YearFee)) {
                                $YearFee = [];
                            }
                        } else {
                            $YearFee = [];
                        }
                    /////////// End Back Year Fee ///////////

                    $parent_data = Parents::where("id",  $student->parents_id)->first();

                    // Start Fee Fee & Discount Exception
                        // Free Fee Exception
                        $ExceptionFreeFee = "";
                        if ($StudentsFreeFee) {
                            $feeArray = json_decode($StudentsFreeFee->free_fee, true); // Assuming $StudentsFreeFee is an object
                            if (!empty($feeArray)) {
                                foreach ($feeArray as $fee) {
                                    $ExceptionFreeFee .= "• ".$fee ." Free". "<br>"; // Use concatenation (.=) to append to the string
                                }
                            }
                        } else {
                            $ExceptionFreeFee = "No free fee exception";
                        }

                        // Discount Exception
                        $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)
                            ->where('dis', '!=', 0)
                            ->get();

                        $ExceptionDiscountFee = "";

                        if ($DiscountExceptions->count() != 0) {
                            foreach ($DiscountExceptions as $exception) {
                                $ExceptionDiscountFee .=  "• ".$exception->fee_type . " : " . $exception->dis."% Free" . "<br>";
                            }
                        } else {
                            $ExceptionDiscountFee = "No discount exception";
                        }
                    // End Fee And Discount Exception


                    return response(array("data" => $this->allData, "ExceptionFreeFee"=>$ExceptionFreeFee, "ExceptionDiscountFee"=>$ExceptionDiscountFee, "parent_data"=> $parent_data, 'BackYear' => $YearFee,  'feeMonthly' => $feeMonthly, 'PaymentFee' => $PaymentFee, 'FeeDiscount' => $FeeDiscount, 'FeeFree' => $FeeFree, 'DuesAmount' => $DuesAmount, "PaymentHistory" => $this->historyData, "paymentresetStatus" => $paymentresetStatus), 200);
                } else {
                    return response()->json(['message' => 'Student not found']);
                }
            }

            else {
                $Student = Student::where('id', $student_id)->first();
                if($Student){
                   $admission_status = $Student->admission_status;
                   return response()->json(['message' => 'This is '.$admission_status.' student']);
                }
                else{
                    return response()->json(['message' => 'Student not found']);
                }
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
            
        }
    }

    public function invoiceData(Request $request){
        try {


          $st_id = $request->student_id;
 

          $months = json_decode($request->input('selectmonth'));
          $length = count($months);



            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

            if(Student::where('id', $st_id)->first())
            {
                $class = Student::where('id', $st_id)->where("class_year", $current_year)->first()->class;

            
                $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
                $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
                $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();
    
                $data = Student::where("class", $class)->where('id', $st_id)->where("class_year", $current_year)->first();
    
    
                $totalFeesForStudent = 0;
                $PreviusBlance = 0;
                $joining_months = JoinleaveDates::where('st_id', $data->id)->first();
                $StudentsFreeFee = ManageFreeStudents::where('st_id', $data->id)->first();
    
                $duesAmount = DuesAmount::where("st_id", $data->id)->where("class_year", $current_year)->first();
    
                $admission_date = Carbon::parse($data->admission_date);
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month;
    
                if($current_year != $admission_year)
                {
                    $start_month = 0;
                }
                else{
                   $start_month = $admission_month-1;
                }   
    
    
                //////////// Start Prev Year Dues  /////////// 
                    $YearFeeResponse = FeePayment::where('class_year', '<>', $current_year)->where('st_id', $data->id)->get();
                    $TotalFee = 0;
                    $TotalPayment = 0;
                    $TotalDis= 0;
                    $TotalFree= 0;
                
                    foreach ($YearFeeResponse as $feeRecord) {
    
                        $TotalFee += $feeRecord->total_fee;
                        $TotalPayment += (int)$feeRecord->total_payment;
                        $TotalDis += (int)$feeRecord->total_discount;
                        $TotalFree += $feeRecord->free_fee;
                    }
    
                    $pay_amount = $TotalPayment + $TotalDis + $TotalFree;
                    
                    $data->BackYearFee = $TotalFee - $pay_amount;
            
                //////////// End Prev Year Dues  ///////////
                
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
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $admission_months_array = json_decode($joining_months->admission_fee, true);
                                    if ($admission_months_array[$numerMonth] == 1) {
    
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
                                    if ($annual_months_array[$numerMonth] == 1) {
                                        
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
                                if ($tuition_months_array[$numerMonth] == 1) {
    
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
                                if ($fullhostel_months_array[$numerMonth] == 1) {
    
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
                                    if ($halfhostel_months_array[$numerMonth] == 1) {
                                        
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
                                if ($transport_months_array[$numerMonth] == 1) {
    
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
                                    if ($coaching_months_array[$numerMonth] == 1) {
    
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
                                    if ($halfhostel_months_array[$numerMonth] == 1) {
                                        
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
                                    if ($exam_months_array[$numerMonth] == 1) {
    
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
    
                /////////// Start Check Saraswati Puja Fee ///////////
    
                        $saraswatiAmount = $FeestractureOnetime->saraswati_puja ?? 0;
    
                        // Start puja fee month check than add month
                            $saraswati_join_month = 0;
                            for ($i = $start_month; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                                    if ($saraswati_months_array[$numerMonth] == 1) {
    
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
    
                // Add $totalFeesForStudent to the $data array
                $data->totalFeesForStudent = $totalFeesForStudent;
                $data->PreviusBlance = $PreviusBlance;
    
                // School Data 
                $SchoolDetails = SchoolDetails::first();
                $data->SchoolDetails =  $SchoolDetails;
    
                // Add $data to $this->allData
                array_push($this->allData, $data);
    
                return response(array("invoice" => $this->allData), 200);
            }
            else{
                return response()->json(['message' => 'Student not found']);   
            }

          
        


        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
            
        }
    } 

    public function getFeeMonth(Request $request)
    {

        $month = $request->select_month;
        $student_id = $request->student_id;

        // date year 
        $dateSetting = DateSetting::first();
        $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

        if(Student::where('id', $student_id)->first()){

            $student = Student::where('id', $student_id)->where('class_year', $year)->first();
            $class = $student->class;

            $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
            $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
            $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();

            $numerMonth = (int)str_replace("month_", "", $month);
            $joining_months = JoinleaveDates::where('st_id', $student_id)->first();

            $StudentsFreeFee = ManageFreeStudents::where('st_id', $student_id)->first();
    
            $admission_date = Carbon::parse($student->admission_date);
            $admission_year = $admission_date->year;
            $admission_month = $admission_date->month;

            $FeeTypeWithAmount = [];
 
 
            $DuesAmountData = DuesAmount::where('st_id', $student_id)->where('class_year', $year)->first();
            if ($DuesAmountData) 
            {


                // Check if the month property is not null or 0
                if (!is_null($DuesAmountData->$month) || $DuesAmountData->$month != 0) {
                    // If it's not null or 0, assign it to $DuesAmount
                    $DuesAmount = $DuesAmountData->$month;
                    $FeeTypeWithAmount["Previus Blance"] = $DuesAmount;
                } else {

                    ///////////////////// Start Inventory Particular ///////////////////////////
                            $ItemsSellHistories = ItemsSellHistories::where('st_id', $student_id)->where('month', $numerMonth)->where('status', 'Dues')->get();

                            if(!$ItemsSellHistories->isEmpty()) {

                                foreach($ItemsSellHistories as $ItemsHistory) {
                                    $PurchaseArray = json_decode($ItemsHistory->particulars_data);

                                    if ($ItemsHistory->paid == 0) {
                                        foreach ($PurchaseArray as $Purchase) {
                                            $itemName = $Purchase->itemName;
                                            $amount = $Purchase->amount;
                                    
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
                                    }
                                    
                                
          
                                }
                            }
                    ///////////////////// End Inventory Particular ///////////////////////////

                    /////////// Start Check Admission Fee ///////////
                        // Start admission joining month check than add amount
                        if ($joining_months) {
                            $admission_months_array = json_decode($joining_months->admission_fee, true);
                            if($admission_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Admission Fee")->first();
                                if($DiscountExceptions){
                                    $admissionDisc = $DiscountExceptions->dis; 
                                    $admissionDiscAmount = ($admission_fee * $admissionDisc) / 100;
                                    $admission_fee = $admission_fee - $admissionDiscAmount;
                                }
                            // End Check Discount Exception 
                
                        if ($admission_fee != 0) {
                            $FeeTypeWithAmount["Admission Fee"] = $admission_fee;
                        }
                    /////////// End Check Admission Fee ///////////

                    /////////// Start Check Annual Charge ///////////
                        // Start annual joining month check than add amount
                        if ($joining_months) {
                            $annual_months_array = json_decode($joining_months->annual_charge, true);
                            if($annual_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Annual Charge")->first();
                                if($DiscountExceptions){
                                    $annualDisc = $DiscountExceptions->dis; 
                                    $annualDiscAmount = ($annual_charge * $annualDisc) / 100;
                                    $annual_charge = $annual_charge - $annualDiscAmount;
                                }
                            // End Check Discount Exception 
                
                        if ($annual_charge != 0) {
                            $FeeTypeWithAmount["Annual Charge"] = $annual_charge;
                        }
                    /////////// End Check Annual Charge ///////////

                    ////////// Start Check Tuition Fee /////////
            
                        // Start tuition joining month check than add amount
                        if ($joining_months) {
                            $tuition_months_array = json_decode($joining_months->tuition_fee, true);
                            if($tuition_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Tuition Fee")->first();
                                if($DiscountExceptions){
                                    $tuitionDisc = $DiscountExceptions->dis; 
                                    $tutionDiscAmount = ($tuition_fee * $tuitionDisc) / 100;
                                    $tuition_fee = $tuition_fee - $tutionDiscAmount;
                                }
                            // End Check Discount Exception 

                        if ($tuition_fee != 0) {
                            $FeeTypeWithAmount["Tuition Fee"] = $tuition_fee;
                        }
                    ////////// End Check Tuition Fee /////////

                    /////////// Start Check Full Hostel Fee ///////////
                        // Start coaching joining month check than add amount
                        if ($joining_months) {
                            $fullhostel_months_array = json_decode($joining_months->full_hostel_fee, true);
                            if($fullhostel_months_array[$numerMonth] == 1)
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "F Hostel Fee")->first();
                                    if($DiscountExceptions){
                                        $fhostelDisc = $DiscountExceptions->dis; 
                                        $fhostelDiscAmount = ($full_hostel_fee * $fhostelDisc) / 100;
                                        $full_hostel_fee = $full_hostel_fee - $fhostelDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($full_hostel_fee != 0) {
                                $FeeTypeWithAmount["F Hostel Fee"] = $full_hostel_fee;
                            }
                    /////////// End Check Full Hostel Fee ///////////

                    /////////// Start Check Half Hostel Fee ///////////
                        // Start coaching joining month check than add amount
                        if ($joining_months) {
                            $halfhostel_months_array = json_decode($joining_months->half_hostel_fee, true);
                            if($halfhostel_months_array[$numerMonth] == 1)
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "H Hostel Fee")->first();
                                    if($DiscountExceptions){
                                        $hhostelDisc = $DiscountExceptions->dis; 
                                        $hhostelDiscAmount = ($half_hostel_fee * $hhostelDisc) / 100;
                                        $half_hostel_fee = $half_hostel_fee - $hhostelDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($half_hostel_fee != 0) {
                                $FeeTypeWithAmount["H Hostel Fee"] = $half_hostel_fee;
                            }
                    /////////// End Check Half Hostel Fee ///////////

                    /////////// Start Check Transport Fee ///////////
                            if ($student->vehicle_root != "No") {
                                // Outi Use Transport
                                $VehicleRoot = VehicleRoot::where('id', $student->vehicle_root)->first();
                                if ($joining_months) {
                                    $transport_months_array = json_decode($joining_months->transport_fee, true);
                                    if($transport_months_array[$numerMonth] == 1)
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Transport Fee")->first();
                                    if($DiscountExceptions){
                                        $transportDisc = $DiscountExceptions->dis; 
                                        $transportDiscAmount = ($transport_amount * $transportDisc) / 100;
                                        $transport_amount = $transport_amount - $transportDiscAmount;
                                    }
                                // End Check Discount Exception

                        if ($transport_amount != 0) {
                            $FeeTypeWithAmount["Transport Fee"] = $transport_amount;
                        }
            
                    /////////// End Check Transport Fee ///////////

                    /////////// Start Check Coaching Fee ///////////
                    if ($student->coaching == "Yes") {
                            // Start coaching joining month check than add amount
                            if ($joining_months) {
                            $coaching_months_array = json_decode($joining_months->coaching_fee, true);
                            if($coaching_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Coaching Fee")->first();
                                if($DiscountExceptions){
                                    $coachingDisc = $DiscountExceptions->dis; 
                                    $transportDiscAmount = ($coaching_fee * $coachingDisc) / 100;
                                    $coaching_fee = $coaching_fee - $transportDiscAmount;
                                }
                            // End Check Discount Exception

                        if ($coaching_fee != 0) {
                            $FeeTypeWithAmount["Coaching Fee"] = $coaching_fee;
                        }
                    /////////// End Check CoachingFee Fee ///////////

                    /////////// Start Check Computer Fee ///////////
                        // Start computer joining month check than add amount
                        if ($joining_months) {
                            $computer_months_array = json_decode($joining_months->computer_fee, true);
                            if($computer_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Computer Fee")->first();
                                if($DiscountExceptions){
                                    $computergDisc = $DiscountExceptions->dis; 
                                    $computerDiscAmount = ($computer_fee * $computergDisc) / 100;
                                    $computer_fee = $computer_fee - $computerDiscAmount;
                                }
                            // End Check Discount Exception
                
                        if ($computer_fee != 0) {
                            $FeeTypeWithAmount["Computer Fee"] = $computer_fee;
                        }
                    /////////// End Check CoachingFee Fee ///////////

                    /////////// Start Check Exam Fee ///////////
                        // Start exam joining month check than add amount
                        if ($joining_months) {
                            $exam_months_array = json_decode($joining_months->exam_fee, true);
                            if($exam_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Exam Fee")->first();
                                if($DiscountExceptions){
                                    $examDisc = $DiscountExceptions->dis; 
                                    $examDiscAmount = ($exam_fee * $examDisc) / 100;
                                    $exam_fee = $exam_fee - $examDiscAmount;
                                }
                            // End Check Discount Exception

                        if ($exam_fee != 0) {
                            $FeeTypeWithAmount["Exam Fee"] = $exam_fee;
                        }
                    /////////// End Check Exam Fee  ///////////

                    /////////// Start Check Saraswati Puja Charge ///////////
                        // Start Saraswati joining month check than add amount
                        if ($joining_months) {
                            $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                            if($saraswati_months_array[$numerMonth] == 1)
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Saraswati Puja")->first();
                                if($DiscountExceptions){
                                    $saraswatiDisc = $DiscountExceptions->dis; 
                                    $examDiscAmount = ($saraswati_puja * $saraswatiDisc) / 100;
                                    $saraswati_puja = $saraswati_puja - $examDiscAmount;
                                }
                            // End Check Discount Exception
                
                        if ($saraswati_puja != 0) {
                            $FeeTypeWithAmount["Saraswati Puja"] = $saraswati_puja;
                        }
                    /////////// End Check Saraswati Puja Charge ///////////

                }
            }

            return response(array('FeeTypeWithAmount' => $FeeTypeWithAmount ), 200);
        }
        else {
            return response()->json(['message' => 'Student not found']);
        }

    }

    public function getMultiMonthFee(Request $request)
    {
        try {
            $student_id = $request->student_id;
            $months = json_decode($request->query('months'));
            $length = count($months);

            if(Student::where('id', $student_id)->first())
            {   
                // date year 
                $dateSetting = DateSetting::first();
                $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

                $student = Student::where('id', $student_id)->where('class_year', $year)->first();
                $class = $student->class;

                $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
                $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
                $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();
        
                $joining_months = JoinleaveDates::where('st_id', $student_id)->first();
                $StudentsFreeFee = ManageFreeStudents::where('st_id', $student_id)->first();

                $admission_date = Carbon::parse($student->admission_date);
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month;

                $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();

                $FeeTypeWithAmount = [];
 
                $DuesAmountData = DuesAmount::where('st_id', $student_id)
                    ->where('class_year', $year)
                    ->first();
                
                if ($DuesAmountData) {
                    $Previus_Blance = 0;
                    foreach ($months as $month) {
                        // Check if the value for the current month is null or zero
                        if (!is_null($DuesAmountData->$month) || $DuesAmountData->$month != 0) {
                            $length--;
                            $Previus_Blance += $DuesAmountData->$month;
                        }
                    }
                    if($Previus_Blance != 0){
                        $FeeTypeWithAmount["Previus Blance"] = $Previus_Blance;
                    }
                }

                       ///////////////////// Start Inventory Particular ///////////////////////////
                        for ($i = 0; $i < $length; $i++) 
                        {

                               $numerMonth = (int) str_replace("month_", "", $months[$i]);

                               $ItemsSellHistories = ItemsSellHistories::where('st_id', $student_id)->where('month', $numerMonth)->where('status', 'Dues')->get();

                               if(!$ItemsSellHistories->isEmpty()) {
   
                                   foreach($ItemsSellHistories as $ItemsHistory) {
                                       $PurchaseArray = json_decode($ItemsHistory->particulars_data);
   
                                       if ($ItemsHistory->paid == 0) {
                                           foreach ($PurchaseArray as $Purchase) {
                                               $itemName = $Purchase->itemName;
                                               $amount = $Purchase->amount;
                                       
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
                                       }
                                       
                                   
             
                                   }
                               }
                            }
                      ///////////////////// End Inventory Particular ///////////////////////////
 
                /////////// Start Check Admission Fee ///////////

                        $admissionAmount = $FeestractureOnetime->admission_fee ?? 0;

                        // Start admission joining month check than add month
                            $admission_join_month = 0;
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $admission_months_array = json_decode($joining_months->admission_fee, true);
                                    if ($admission_months_array[$numerMonth] == 1) {
                                        $admission_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Admission Fee")->first();
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

                                $FeeTypeWithAmount["Admission Fee"] = $admissionFinalAmount;
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
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $annual_months_array = json_decode($joining_months->annual_charge, true);
                                    if ($annual_months_array[$numerMonth] == 1) {
                                        $annual_join_month += 1;
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
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Annual Charge")->first();
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

                                $FeeTypeWithAmount["Annual Charge"] = $annualFinalAmount;
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
                        for ($i = 0; $i < $length; $i++) {
                            $numerMonth = (int) str_replace("month_", "", $months[$i]);
                            if ($joining_months) {
                                $tuition_months_array = json_decode($joining_months->tuition_fee, true);
                                if ($tuition_months_array[$numerMonth] == 1) {
                                    $tuition_join_month += 1;
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Tuition Fee")->first();
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

                            $FeeTypeWithAmount["Tuition Fee"] = $tutionFinalAmount;
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
                        for ($i = 0; $i < $length; $i++) {
                            $numerMonth = (int) str_replace("month_", "", $months[$i]);
                            if ($joining_months) {
                                $fullhostel_months_array = json_decode($joining_months->full_hostel_fee, true);
                                if ($fullhostel_months_array[$numerMonth] == 1) {
                                    $fullhostel_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "F Hostel Fee")->first();
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

                            $FeeTypeWithAmount["F Hostel Fee"] = $fullhostelFinalAmount;
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
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $halfhostel_months_array = json_decode($joining_months->half_hostel_fee, true);
                                    if ($halfhostel_months_array[$numerMonth] == 1) {
                                        $halfhostel_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "H Hostel Fee")->first();
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

                                $FeeTypeWithAmount["H Hostel Fee"] = $halfhostelFinalAmount;
                            }
                            else{
                                unset($FeeTypeWithAmount["H Hostel Fee"]); 
                            }
                        //// Now Half_Hostel Total calculation with Joining month ////

                /////////// Start Check Half_Hostel Fee ///////////

                /////////// Start Check Transport Fee than Add  ///////////
                    if ($student->vehicle_root != "No") {
                        $root_id = $student->vehicle_root;
                        $Transport = VehicleRoot::where('id', $root_id)->first();
                        $transportAmount = $Transport->amount ?? 0;

                    // Start transport joining month check than add month
                        $transport_join_month = 0;
                        for ($i = 0; $i < $length; $i++) {
                            $numerMonth = (int) str_replace("month_", "", $months[$i]);
                            if ($joining_months) {
                                $transport_months_array = json_decode($joining_months->transport_fee, true);
                                if ($transport_months_array[$numerMonth] == 1) {
                                    $transport_join_month += 1;
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Transport Fee")->first();
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

                            $FeeTypeWithAmount["Transport Fee"] = $transportFinalAmount;
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
                        for ($i = 0; $i < $length; $i++) {
                            $numerMonth = (int) str_replace("month_", "", $months[$i]);
                            if ($joining_months) {
                                $coaching_months_array = json_decode($joining_months->coaching_fee, true);
                                if ($coaching_months_array[$numerMonth] == 1) {
                                    $coaching_join_month += 1;
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
                                $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Coaching Fee")->first();
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

                            $FeeTypeWithAmount["Coaching Fee"] = $coachingFinalAmount;
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
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $halfhostel_months_array = json_decode($joining_months->computer_fee, true);
                                    if ($halfhostel_months_array[$numerMonth] == 1) {
                                        $computer_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Computer Fee")->first();
                                    if($DiscountExceptions){
                                        $computerDisc = $DiscountExceptions->dis;
                                        $computerTotalAmount = $computerAmount * $computer_join_month;
                                        $computerDiscAmount = ($computerTotalAmount * $computerDisc) / 100;
                                        $computerFinalAmount = $computerTotalAmount - $computerDiscAmount;
                                    }
                                    else{
                                        $computerFinalAmount = $computerAmount * $computer_join_month; 
                                    }
                                // End Check Discount Exception

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
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $exam_months_array = json_decode($joining_months->exam_fee, true);
                                    if ($exam_months_array[$numerMonth] == 1) {
                                        $exam_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Exam Fee")->first();
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

                                $FeeTypeWithAmount["Exam Fee"] = $examFinalAmount;
                            }
                            else{
                                unset($FeeTypeWithAmount["Exam Fee"]); 
                            }
                        //// Now Exam Fee Total calculation with Joining month ////

                /////////// Start Check Exam Fee ///////////

                /////////// Start Check Saraswati Puja Fee ///////////

                        $saraswatiAmount = $FeestractureOnetime->saraswati_puja ?? 0;

                        // Start puja fee month check than add month
                            $saraswati_join_month = 0;
                            for ($i = 0; $i < $length; $i++) {
                                $numerMonth = (int) str_replace("month_", "", $months[$i]);
                                if ($joining_months) {
                                    $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                                    if ($saraswati_months_array[$numerMonth] == 1) {
                                        $saraswati_join_month += 1;
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
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $student_id)->where("fee_type", "Saraswati Puja")->first();
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

                                $FeeTypeWithAmount["Saraswati Puja"] = $saraswatiFinalAmount;
                            }
                            else{
                                unset($FeeTypeWithAmount["Saraswati Puja"]); 
                            }
                        //// Now Puja Fee Total calculation with Joining month ////

                /////////// Start Check Saraswati Puja Fee ///////////

                return response(array('FeeTypeWithAmount' => $FeeTypeWithAmount), 200);
            }
            else {
                return response()->json(['message' => 'Student not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function joinMonthSave(Request $request)
    {

          // Define validation rules
          $rules = [
            'student_id' => 'required|integer',
            'tuitionArray' => 'array',
            'transportArray' => 'array',
            'fullhostelArray' => 'array',
            'halfhostelArray' => 'array',
            'computerArray' => 'array',
            'coachingArray' => 'array',
            'admissionArray' => 'array',
            'annualArray' => 'array',
            'saraswatiArray' => 'array',
            'examArray' => 'array',
            'year' => 'integer', 
          ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['ErrorMessage' => $validator->errors()], 400); 
        }

        try {
           $Student = Student::where('id', $request->input('student_id'))->first();
            if($Student)
            { 
                $class = $Student->class;
                $st_id = $request->input('student_id');
                $tuitionArray = $request->input('tuitionArray', []);
                $transportArray = $request->input('transportArray', []);
                $fullhostelArray = $request->input('fullhostelArray', []);
                $halfhostelArray = $request->input('halfhostelArray', []);
                $computerArray = $request->input('computerArray', []);
                $coachingArray = $request->input('coachingArray', []);

                $admissionArray = $request->input('admissionArray', []);
                $annualArray = $request->input('annualArray', []);
                $saraswatiArray = $request->input('saraswatiArray', []);

                $examArray = $request->input('examArray', []);

                // date year 
                $dateSetting = DateSetting::first();
                $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->input('year') ?? null);

                // Convert arrays to JSON strings
                $serializedTuitionArray = json_encode($tuitionArray);
                $serializedTransportArray = json_encode($transportArray);
                $serializedFullHostelArray = json_encode($fullhostelArray);
                $serializedHalfHostelArray = json_encode($halfhostelArray);
                $serializedComputerArray = json_encode($computerArray);
                $serializedCoachingArray = json_encode($coachingArray);

                $serializedAdmitArray = json_encode($admissionArray);
                $serializedAnnualArray = json_encode($annualArray);
                $serializedSaraswatiArray = json_encode($saraswatiArray);

                $serializedExamArray = json_encode($examArray);



                $student = Student::where('class', $class)->where('id', $st_id)->where('class_year', $year)->first();

                // Admission date
                $admission_date = Carbon::parse($student->admission_date); 
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month - 1;


                if($year == $admission_year){

                // Define an array with 12 elements initialized to "0"
                $admissionStartMonthsArray = array_fill(0, 12, "0");

                // Set the admission month and subsequent months to "1"
                for ($i = $admission_month; $i < 12; $i++) {
                    $admissionStartMonthsArray[$i] = "1";
                }

                $admissionMonthsArray = array_fill(0, 12, "0");
                $admissionMonthsArray[$admission_month] = "1";
                $serializedAdmissionArray = json_encode($admissionMonthsArray);
                
                $serializedStartAdmissionArray = json_encode($admissionStartMonthsArray);

                    $joinLeaveEntry = JoinleaveDates::where('st_id', $st_id)->first();
                    if ($joinLeaveEntry) {
                            $joinLeaveEntry->admission_months = $serializedAdmissionArray;
                            $joinLeaveEntry->admission_start = $serializedStartAdmissionArray;
                            $joinLeaveEntry->save();
                    } else {
                        JoinleaveDates::create([
                            'st_id' =>  $st_id,
                            'class_year' => $year,
                            'admission_months' => $serializedAdmissionArray,
                            'admission_start' => $serializedStartAdmissionArray,
                            'tuition_fee' => $serializedTuitionArray,
                            'transport_fee' => $serializedTransportArray,
                            'full_hostel_fee' => $serializedFullHostelArray,
                            'half_hostel_fee' => $serializedHalfHostelArray,
                            'computer_fee' => $serializedComputerArray,
                            'coaching_fee' => $serializedCoachingArray,
                            'admission_fee' => $serializedAdmitArray,
                            'annual_charge' => $serializedAnnualArray,
                            'saraswati_puja' => $serializedSaraswatiArray,
                            'exam_fee' => $serializedExamArray,
                        ]);
                    }

                }
    
                // Admission date
                $admission_date = Carbon::parse($student->admission_date); 
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month - 1;

                $admissionStartMonthsArray = array_fill(0, 12, "0");

                // Define an array with 12 elements initialized to "0"
                $admissionStartMonthsArray = array_fill(0, 12, "0");

                // Set the admission month and subsequent months to "1"
                for ($i = $admission_month; $i < 12; $i++) {
                    $admissionStartMonthsArray[$i] = "1";
                }

                $admissionMonthsArray = array_fill(0, 12, "0");
                $admissionMonthsArray[$admission_month] = "1";
                $serializedAdmissionArray = json_encode($admissionMonthsArray);
                

                $serializedStartAdmissionArray = json_encode($admissionStartMonthsArray);


                // Find or create the record based on student_id
                JoinleaveDates::updateOrCreate(
                    ['st_id' => $st_id],
                    [
                        'st_id' =>  $st_id,
                        'class_year' => $year,
                        'admission_months' => $serializedAdmissionArray,
                        'admission_start' => $serializedStartAdmissionArray,
                        'tuition_fee' => $serializedTuitionArray,
                        'transport_fee' => $serializedTransportArray,
                        'full_hostel_fee' => $serializedFullHostelArray,
                        'half_hostel_fee' => $serializedHalfHostelArray,
                        'computer_fee' => $serializedComputerArray,
                        'coaching_fee' => $serializedCoachingArray,
                        'admission_fee' => $serializedAdmitArray,
                        'annual_charge' => $serializedAnnualArray,
                        'saraswati_puja' => $serializedSaraswatiArray,
                        'exam_fee' => $serializedExamArray,
                    ]
                );

                $TotalFee = 0;
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

                        $feeGenerated = FeeGenerated::where("class_year", $request->year)->where('st_id', $st_id)->first();
                        if ($feeGenerated) {
                            $feeGenerated->{'month_'.$i} = $MonthFeeGenerate;
                            $feeGenerated->save();
                        } else {
                            $newRecord = new FeeGenerated();
                            $newRecord->st_id = $st_id;
                            $newRecord->class = $student->class;
                            $newRecord->class_year = $request->year; 
                            $newRecord->{'month_'.$i} = $MonthFeeGenerate; 
                            $newRecord->save();
                        }    
                    }
                ///////////////////// End Total Feee Retrive ///////////////////////////

                $FeePayment = FeePayment::where("class_year", $year)->where("st_id", $st_id)->first();
                $FeePayment->total_fee = $TotalFee;
                $FeePayment->save();

                return "updated successfully.";
        }
        else {
            return response()->json(['message' => 'Student not found']);
        }
        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
   
    }

    public function GetjoinMonth(Request $request)
    {
        // date year 
        $dateSetting = DateSetting::first();
        $select_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->select_year ?? null);
    
        $student_id = $request->input('student_id');


        // student admission montah and year 
        $student_response = Student::where("id", $student_id)->first();
        $admission_date = Carbon::parse($student_response->admission_date);
        $admission_year = $admission_date->year;
        $admission_month = $admission_date->month;

        $payment_month = FeePayment::where("st_id", $student_id)->where('class_year', $select_year)->first();

        $nullColumns = [];
        // Iterate through month columns
        for ($i = 0; $i <= 11; $i++) {
            $columnName = "month_" . $i;
            
            // Check if the column value is null
            if ($payment_month->{$columnName} !== null) {
                $nullColumns[] = $columnName;
            }
        }
    

        // Retrieve Join Months data based on student_id
        $data = JoinLeaveDates::where('st_id', $student_id)->first();
    
        if ($data) {
            $tuitionArray = json_decode($data->tuition_fee);
            $transportArray = json_decode($data->transport_fee);
            $fullhostelArray = json_decode($data->full_hostel_fee);
            $halfhostelArray = json_decode($data->half_hostel_fee);
            $computerArray = json_decode($data->computer_fee);
            $coachingArray = json_decode($data->coaching_fee);
            $admissionArray = json_decode($data->admission_fee);
            $annualArray = json_decode($data->annual_charge);
            $saraswatiArray = json_decode($data->saraswati_puja);
            $examArray = json_decode($data->exam_fee);
            $coachingArray = json_decode($data->coaching_fee);
    
            // Prepare the response data
            $responseData = [
                'tuitionArray' => $tuitionArray,
                'transportArray' => $transportArray,
                'fullhostelArray' => $fullhostelArray,
                'halfhostelArray' => $halfhostelArray,
                'computerArray' => $computerArray,
                'admissionArray' => $admissionArray,
                'annualArray' => $annualArray,
                'saraswatiArray' => $saraswatiArray,
                'examArray' => $examArray,
                'coachingArray' => $coachingArray,
            ];

            $StudentData = Student::where('id', $student_id)->first();

            return response(array('StudentData'=>$StudentData, 'join_months' => $responseData, 'admision_year' => $admission_year, 'admission_month' => $admission_month, 'pay_months' =>$nullColumns), 200);
        } else {
            // Handle the case where no data is found
            // return "No data found";
            return response(array('join_months' =>  "No data found", 'admision_year' => $admission_year, 'admission_month' => $admission_month, 'pay_months' =>$nullColumns), 200);

        }

      
    }
 
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
