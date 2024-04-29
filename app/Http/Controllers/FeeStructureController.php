<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DateSetting;
use Exception;
use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\Classes;
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;
use Carbon\Carbon;
use App\Models\JoinleaveDates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index(Request $request)
    {
        try {
            $class = $request->class;

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

            $total_payment = 0;
            foreach (Student::all() as $student) {
                $PaymentStudent = FeePayment::where('class', $class)->where('class_year', $current_year)->where('st_id', $student->id)->first();
                if ($PaymentStudent) {
                    $total_payment += $PaymentStudent->total_payment;
                }
            }



            $this->response = FeeStructure::where('class', $class)->get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                /////////// Start 12 Month fee Check and Add ///////////
                $MonthTotalFee = array();
                for ($i = 0; $i <= 11; $i++) {
                    $month = 'month_' . $i;
                    $MonthTotalFee[$month] = FeeStructure::where('class', $class)->sum($month);
                }
                /////////// End 12 Month fee Check and Add ///////////


                /////////// Start Selected Total Month Amount and add ///////////
                $totalFees = 0;
                foreach ($MonthTotalFee as $month => $fee) {
                    $totalFees += intval($fee);
                }
                /////////// End Selected Total Month Amount and add ///////////

                return response(array("data" => $this->allData, 'MonthTotalFee' => $MonthTotalFee, 'total_payment' => $total_payment), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $class = $request->class;
            $same_fee_class = $request->same_fee_class;
            $feeTypes = $request->input('fee-type');
            $months = $request->only([
                'month_0', 'month_1', 'month_2', 'month_3', 'month_4',
                'month_5', 'month_6', 'month_7', 'month_8', 'month_9',
                'month_10', 'month_11'
            ]);

            if ($same_fee_class != "") {
                // Update Class Fee After Delete
                $class_data = FeeStructure::where('class', $same_fee_class);
                if ($class_data->exists()) {
                    $class_data->delete();
                }

                foreach ($feeTypes as $key => $feeType) {
                    $feePayment = new FeeStructure();
                    $feePayment->class = $same_fee_class;
                    $feePayment->fee_type = $feeType;
                    foreach ($months as $month => $values) {
                        $feePayment->{$month} = $values[$key];
                    }
                    $feePayment->save();
                }

                return response()->json(['message' => 'Update Success']);
            } else {
                // New Class Fee Add 
                if (FeeStructure::where('class', $class)->exists()) {
                    $class_data = FeeStructure::where('class', $class);
                    $class_data->delete();
                }

                foreach ($feeTypes as $key => $feeType) {
                    $feePayment = new FeeStructure();
                    $feePayment->class = $class;
                    $feePayment->fee_type = $feeType;
                    foreach ($months as $month => $values) {
                        $feePayment->{$month} = $values[$key];
                    }
                    $feePayment->save();
                }

                return response()->json(['message' => 'Create Success']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

   public function indexManageFee(Request $request)
{
    try {
        $current_year = $request->current_year;

        $FeestractureMonthly = FeestractureMonthly::get();
        $FeestractureOnetime = FeestractureOnetime::get();
        $FeestractureQuarterly = FeestractureQuarterly::get();

        $feePayments = FeePayment::where('class_year', $current_year)->get();
        $TotalsClassPayment = [];

        // Initialize total amounts for all classes to 0
        $classes = Classes::pluck('class')->map(function ($className) {
            return trim($className);
        })->toArray(); // Get all class names and trim whitespace
        
        // Initialize total amounts for all classes to 0
        foreach ($classes as $class) {
            $TotalsClassPayment[$class] = 0;
        }

        // Calculate total amounts for classes with corresponding rows in FeePayment table
        foreach ($feePayments as $payment) {
            $class = $payment->class;
            if (!array_key_exists($class, $TotalsClassPayment)) {
                Log::warning("Class $class found in feePayments but not in classes.");
                continue;
            }
            $totalAmount = 0;

            for ($i = 0; $i <= 11; $i++) {
                $totalAmount += $payment->{"month_$i"};
            }

            $TotalsClassPayment[$class] += $totalAmount;
        }

        // end TotalsClassPayment

        return response()->json([
            "TotalsClassPayment" => $TotalsClassPayment,
            "FeestractureMonthly" => $FeestractureMonthly,
            "FeestractureOnetime" => $FeestractureOnetime,
            "FeestractureQuarterly" => $FeestractureQuarterly
        ], 200);

    } catch (Exception $e) {
        // Code to handle the exception
        $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
        return response()->json(['status' => $message], 500);
    }
}


    public function updateFeeStracture(Request $request)
    {
        try {

 
            if($request->formtype == "monthly-feestracture"){
                $classArray = $request->input('class');
                $tuitionFeeArray = $request->input('tuition_fee');
                $fullhostelFeeArray = $request->input('full_hostel_fee');
                $halfhostelFeeArray = $request->input('half_hostel_fee');
                $computerFeeArray = $request->input('computer_fee');
                $coachingFeeArray = $request->input('coaching_fee');
    
                if(FeestractureMonthly::get()){
                    FeestractureMonthly::truncate();
                }
    
                foreach ($classArray as $key => $data) {
                    $FeestractureMonthly = new FeestractureMonthly();
                    $FeestractureMonthly->class = $classArray[$key];
                    $FeestractureMonthly->tuition_fee = $tuitionFeeArray[$key];
                    $FeestractureMonthly->full_hostel_fee = $fullhostelFeeArray[$key];
                    $FeestractureMonthly->half_hostel_fee = $halfhostelFeeArray[$key];
                    $FeestractureMonthly->computer_fee = $computerFeeArray[$key];
                    $FeestractureMonthly->coaching_fee = $coachingFeeArray[$key];
                    $FeestractureMonthly->save();
                }

                return response()->json(['status' => "monthly feestracture update success"], 200);
            }

            if($request->formtype == "onetime-feestracture"){
                $classArray = $request->input('class');
                $admissionArray = $request->input('admission_fee');
                $annualArray = $request->input('annual_charge');
                $saraswatiArray = $request->input('saraswati_puja');

                if(FeestractureOnetime::get()){
                    FeestractureOnetime::truncate();
                }

                foreach ($classArray as $key => $data) {
                    $FeestractureOnetime = new FeestractureOnetime();
                    $FeestractureOnetime->class = $classArray[$key];
                    $FeestractureOnetime->admission_fee = $admissionArray[$key];
                    $FeestractureOnetime->annual_charge = $annualArray[$key];
                    $FeestractureOnetime->saraswati_puja = $saraswatiArray[$key];
                    $FeestractureOnetime->save();
                }

                return response()->json(['status' => "onetime feestracture update success"], 200);

            }

            if($request->formtype == "quarterly-feestracture"){
                $classArray = $request->input('class');
                $examArray = $request->input('exam_fee');


                if(FeestractureQuarterly::get()){
                    FeestractureQuarterly::truncate();
                }

                foreach ($classArray as $key => $data) {
                    $FeestractureQuarterly = new FeestractureQuarterly();
                    $FeestractureQuarterly->class = $classArray[$key];
                    $FeestractureQuarterly->exam_fee = $examArray[$key];
                    $FeestractureQuarterly->save();
                }

                return response()->json(['status' => "Quarterly feestracture update success"], 200);

            }

        }  
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function joiningUpdate(Request $request){

        $students = Student::get();

        foreach ($students as $student) {

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

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

            $FullHostel_Join = $student->hostel_outi === "full-hostel" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';
 
            $Transport_Join = $student->transport_use === "Yes" ? $serializedStartAdmissionArray : '["0","0","0","0","0","0","0","0","0","0","0","0"]';
 
 
            $joinLeaveEntry = JoinleaveDates::where("st_id", $student->id)->first();

            // Exam Joining
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

            if($student->hostel_outi == 'hostel'){
                $student->hostel_outi = 'full-hostel';
                $student->save();  
            }

            if($joinLeaveEntry){

                if($joinLeaveEntry->tuition_fee == ""){
                    $joinLeaveEntry->tuition_fee = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
                    $joinLeaveEntry->save();  
               }

               if($joinLeaveEntry->half_hostel_fee == ""){
                    $joinLeaveEntry->half_hostel_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->save();  
               }
               
               if($joinLeaveEntry->computer_fee == ""){
                    $joinLeaveEntry->computer_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->save();  
                }

                if($joinLeaveEntry->coaching_fee == ""){
                    $joinLeaveEntry->coaching_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->save();  
                }

                if($joinLeaveEntry->saraswati_puja == ""){
                    $joinLeaveEntry->saraswati_puja = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->save();  
                }

                if($joinLeaveEntry->exam_fee == ""){
                    $joinLeaveEntry->exam_fee = $exam_json;
                    $joinLeaveEntry->save();  
                }

                if($joinLeaveEntry->admission_fee != ""){
                    if($admission_year == $current_year){
                        $joinLeaveEntry->admission_fee = '["1","0","0","0","0","0","0","0","0","0","0","0"]';
                        $joinLeaveEntry->save();  
                    }
                    else{
                        $joinLeaveEntry->admission_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                        $joinLeaveEntry->save(); 
                    }
                }

                if($joinLeaveEntry->annual_charge != ""){
                    if($admission_year == $current_year){
                        $joinLeaveEntry->annual_charge = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                        $joinLeaveEntry->save();  
                    }
                    else{
                        $joinLeaveEntry->annual_charge = '["1","0","0","0","0","0","0","0","0","0","0","0"]';
                        $joinLeaveEntry->save(); 
                    }
                }

                // if($admission_year == $current_year){
                //      echo $student->id.' 2080 ,';

                // }
                // else{
                //     echo $student->id.' 2079 ,'; 
                // }
            }
            else{
                if($admission_year == $current_year){

                    $joinLeaveEntry = new JoinleaveDates;
                    $joinLeaveEntry->st_id  = $student->id;
                    $joinLeaveEntry->admission_months = $serializedAdmissionArray;
                    $joinLeaveEntry->admission_start = $serializedStartAdmissionArray;
                    $joinLeaveEntry->tuition_fee = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
                    $joinLeaveEntry->transport_fee = $Transport_Join;
                    $joinLeaveEntry->full_hostel_fee = $FullHostel_Join;
                    $joinLeaveEntry->half_hostel_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';     
                    $joinLeaveEntry->coaching_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->computer_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->admission_fee  =  $serializedAdmissionArray;
                    $joinLeaveEntry->annual_charge  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->saraswati_puja  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->exam_fee  =  $exam_json;
                    $joinLeaveEntry->save(); // Save the $joinLeaveEntry object

                }
                else{
                    $joinLeaveEntry = new JoinleaveDates;
                    $joinLeaveEntry->st_id  = $student->id;
                    $joinLeaveEntry->admission_months = $serializedAdmissionArray;
                    $joinLeaveEntry->admission_start = $serializedStartAdmissionArray;
                    $joinLeaveEntry->tuition_fee = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
                    $joinLeaveEntry->transport_fee = $Transport_Join;
                    $joinLeaveEntry->full_hostel_fee = $FullHostel_Join;
                    $joinLeaveEntry->half_hostel_fee = '["0","0","0","0","0","0","0","0","0","0","0","0"]';     
                    $joinLeaveEntry->coaching_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->computer_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->admission_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->annual_charge  =  '["1","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->saraswati_puja  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->exam_fee  =  '["0","0","1","0","0","1","0","0","1","0","0","1"]';
                    $joinLeaveEntry->save();
                }
            }
 
        }

        echo "Update Sucess";
        

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
