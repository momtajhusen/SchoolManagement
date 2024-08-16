<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelperController\StudentAccountFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parents;
use App\Models\StudentsFeeStracture;
use App\Models\StudentsFeeMonth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;

use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;

use App\Models\VehicleRoot;



class ParrentProfile extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            $parent_id = $request->pr_id;
            $parent_data = Parents::where("id", $parent_id)->first();
            if(!$parent_data){
                return response()->json(['message' =>  "parent not found"], 200);
            }

            $student_data = Student::where("parents_id", $parent_id)->get();
            
            return response()->json(['parent_data' => $parent_data, 'student_data' => $student_data], 200);
        } 
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function StudentsFeeStractures(Request $request)
    {
        $st_id = $request->st_id;
        $year =  $request->select_fee_year; // Assuming you want data for the year 2080
    
        // Fetch fee structures for the given year and student
        $feeStructures = StudentsFeeStracture::where('year', $year)
                            ->where('st_id', $st_id)
                            ->get();

        // Organize fee structures by month and fee type
        $organizedFeeStructures = [];
        $annualfee = 0;
        foreach ($feeStructures as $structure) {
            $month = $structure->month;
            $feeType = $structure->fee_type;
            $feeId = $structure->id;
            $amount = $structure->amount;

            $annualfee += $amount;
    
            // Add month if not present
            if (!isset($organizedFeeStructures[$month])) {
                $organizedFeeStructures[$month] = [];
            }
    
            // Add fee type with fee name and amount under respective month
            $organizedFeeStructures[$month][] = [
                'amount' => $amount,
                'fee_name' => $feeType,
                'id' => $feeId,
            ];
        }

        $student = [
            'fee_year'=>$year,
            'st_id'=>$st_id,
            'annualfee'=>$annualfee

        ];
        
        $monthStatus = StudentAccountFee::singleStudentMonthStatus($year, $st_id);
    
        $responseData = array(
            "StudentFeeStructure" => $organizedFeeStructures,
            'student' => $student,
            'month_status' => $monthStatus
        );
    
        // Return the response with HTTP status 200
        return response($responseData, 200);
    }

    public function StudentsFeeStracturesSave(Request $request){
        try {
            $st_id = $request->st_id;
            $month = $request->month;
            $year = $request->year;
            $fees = $request->fees; // Assuming 'fees' is an array containing fee data
            
            // Delete existing fee structures for the same st_id, year, and month
            StudentsFeeStracture::where('st_id', $st_id)
                ->where('year', $year)
                ->where('month', $month)
                ->delete();
            
            // Save new fee structures
            $totalfee = 0;
            foreach ($fees as $fee) {
                    // Record doesn't exist, so proceed to save
                    $totalfee += $fee['amount'];
                    $studentFeeStructure = new StudentsFeeStracture();
                    $studentFeeStructure->st_id = $st_id;
                    $studentFeeStructure->month = $month;
                    $studentFeeStructure->year = $year;
                    $studentFeeStructure->fee_type = $fee['fee_name'];
                    $studentFeeStructure->amount = $fee['amount'];
                    $studentFeeStructure->fee_stracture_type =  'deal';
                    $studentFeeStructure->save();
            }
            // end new fee structures
 
            // start StudentsFeeMonth add 
            $all_add = StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->where('month', $month)->sum('amount');
            $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)->where('year', $year)->first();
            if ($StudentsFeeMonthdata) {
                $columnName = 'month_'.$month-1;
                $StudentsFeeMonthdata->$columnName = $all_add;
                $StudentsFeeMonthdata->save();
            }
            // end StudentsFeeMonth add 

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate($st_id);
        
            // Return success response
            return response()->json(['status' => 'Fee structures saved successfully'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function DeleteMonthFee(Request $request){
        try {
            $fee_id = $request->fee_id;

            $StudentsFeeStracture = StudentsFeeStracture::where('id', $fee_id)->first();

            // Delete the fee structure entry
            $StudentsFeeStracture->delete();
            
            if ($StudentsFeeStracture) {
                $st_id = $StudentsFeeStracture->st_id;
                $delete_fee_amount = $StudentsFeeStracture->amount;
                $fee_year = $StudentsFeeStracture->year;
                $fee_month = $StudentsFeeStracture->month;
            
                // Sum up all fees for the same student, year, and month
                $all_add = StudentsFeeStracture::where('st_id', $st_id)
                    ->where('year', $fee_year)
                    ->where('month', $fee_month)
                    ->sum('amount');

                
            
                // Find or create a record in StudentsFeeMonth table
                $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)
                    ->where('year', $fee_year)
                    ->first();
            
                if ($StudentsFeeMonthdata) {

                    // Update the month column with the sum of all fees
                    $columnName = 'month_'.($fee_month - 1);

                    $StudentsFeeMonthdata->$columnName = $all_add;
                    $StudentsFeeMonthdata->save();

                    //Sum total_fee, total_paid, total_disc, total_dues
                    StudentAccountFee::StudentsFeeMonthsCalculate($st_id);
                }
            
                return response()->json(['status' => 'delete successfully'], 200);
            } else {
                // Handle case where fee structure entry with given ID is not found
            }            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function DeleteMonth(Request $request){
        try {
          // Assuming $fee_year is defined properly before this code snippet

            $st_id = $request->st_id;
            $year = $request->year;
            $month = $request->month;

            // Delete records from StudentsFeeStracture table
            StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->where('month', $month)->delete();

            // Find or create a record in StudentsFeeMonth table
            $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)->where('year', $year)->first();

            // Find or create a record in StudentsFeeMonth table
            $StudentsFeeMonthdata = StudentsFeeMonth::where('st_id', $st_id)->where('year', $year)->first();

            if ($StudentsFeeMonthdata) {
                $columnName = 'month_' . ($month - 1); 
                $StudentsFeeMonthdata->$columnName = 0;
                $StudentsFeeMonthdata->save();
            }

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate($st_id);

            return response()->json(['status' => 'delete successfully'], 200);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AddMonth(Request $request){
        try {
            $st_id = $request->st_id;
            $year = $request->year;
            $month = $request->month;
            $input_fee_name = $request->input_fee_name;
            $input_fee_amount = $request->input_fee_amount;

            $feeCheck = StudentsFeeStracture::where('st_id', $st_id)
            ->where('year', $year)
            ->where('month', $month)->first();

            if(!$feeCheck){
                $studentFeeStructure = new StudentsFeeStracture();
                $studentFeeStructure->st_id = $st_id;
                $studentFeeStructure->year = $year;
                $studentFeeStructure->month = $month;
                $studentFeeStructure->fee_type = $input_fee_name;
                $studentFeeStructure->amount = $input_fee_amount;
                $studentFeeStructure->fee_stracture_type =  'deal';
                if($studentFeeStructure->save())
                {

                    // Find or create a record in StudentsFeeMonth table
                    $StudentsFeeMonth = StudentsFeeMonth::updateOrCreate(
                        ['st_id' => $st_id, 'year' => $year],
                        [
                            'month_' . $month-1 => $input_fee_amount,
                        ]
                    );

                    //Sum total_fee, total_paid, total_disc, total_dues
                    StudentAccountFee::StudentsFeeMonthsCalculate($st_id);

                    return response()->json(['status' => 'add successfully'], 200);
                }
            }else{
                return response()->json(['status' => 'this month already exist in '.$year], 200);
            }
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function SaveDealFee(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
            'checkedMonths' => 'required|array',
            'checkedMonths.*' => 'required|integer|min:1|max:12', // Assuming months range from 1 to 12
            'checkedfeeType' => 'required|array',
            'fee_amount' => 'required|numeric|min:0',
            'st_id' => 'required|integer',
            'year' => 'required|integer',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors as a JSON response
            return response()->json(['errors' => $validator->errors()], 422); // 422 is Unprocessable Entity status code
        }

          // Access the sent data
            $checkedMonths = $request->input('checkedMonths');
            $checkedfeeType = $request->input('checkedfeeType');
            $fee_amount = $request->input('fee_amount');
            $st_id =  $request->st_id;
            $year =  $request->year;

            $start_month =  $checkedMonths[0];



            // Exam Month Detect 
            $exam_month = 0;
            $quarterlyCount = count(array_intersect([3, 6, 9, 12], $checkedMonths));
            if ($quarterlyCount == 4) {
                $exam_month = 4;
            } elseif ($quarterlyCount == 2) {
                $exam_month = 2;
            } elseif ($quarterlyCount == 3) {
                $exam_month = 3;
            } elseif (in_array(1, $checkedMonths)) {
                $exam_month = 1;
            }


            $Student = Student::where('id',  $st_id)->first();
            $class = $Student->class;

            // Start Admission date
            $admission_date = Carbon::parse($Student->admission_date);
            $admission_year = $admission_date->year;

            $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
            $computer_fee = $FeestractureMonthly->computer_fee;



            $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
            $admission_fee = $FeestractureOnetime->admission_fee;
            $annual_charge = $FeestractureOnetime->annual_charge;
            $saraswati_puja = $FeestractureOnetime->saraswati_puja;


            $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();
            $exam_fee = $FeestractureQuarterly->exam_fee;

            $exam_fee_month = $FeestractureQuarterly->exam_fee * $exam_month;

            $computer_fee_month = 0;
            if (in_array('computer_fee', $checkedfeeType)) {
                $computer_fee_month = $FeestractureMonthly->computer_fee * count($checkedMonths);
            }

            $admission_fee = in_array('admission_fee', $checkedfeeType) ? $admission_fee : 0;
            $annual_charge = in_array('annual_charge', $checkedfeeType) ? $annual_charge : 0;
            $exam_fee = in_array('exam_fee', $checkedfeeType) ? $exam_fee : 0;
            $exam_fee_month = in_array('exam_fee', $checkedfeeType) ? $exam_fee_month : 0;
            $saraswati_puja = in_array('saraswati_puja_fee', $checkedfeeType) ? $saraswati_puja : 0;
            $computer_fee = in_array('computer_fee', $checkedfeeType) ? $computer_fee : 0;
 

            $capture_fix_amount = $admission_fee +  $annual_charge + $saraswati_puja + $exam_fee_month + $computer_fee_month;

    
            $fee_amount = $fee_amount - $capture_fix_amount;


            // Delete existing fee structures for the same st_id, year, and month
            StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->delete();

            // Calculate total number of checked months
            $totalMonths = count($checkedMonths);

            // Calculate amount per month
            $amountPerMonth = floor($fee_amount / $totalMonths);

            // Calculate remaining amount
            $remainingAmount = $fee_amount % $totalMonths;

            // Process each checked month
            foreach ($checkedMonths as $key => $month) {
                // Add remaining amount to each month
                $dividedAmount = $amountPerMonth;
                if ($remainingAmount > 0) {
                    $dividedAmount += 1;
                    $remainingAmount -= 1;
                }

                // Calculate amount per fee type for this month
                $filteredFees = array_diff($checkedfeeType, ['admission_fee', 'annual_charge', 'exam_fee', 'computer_fee', 'saraswati_puja_fee']);
                $FeeTypeCount = count($filteredFees);

                // Calculate amount per fee type
                $amountPerFeeType =  $dividedAmount / $FeeTypeCount;


                // // // Output divided amount
                // echo $FeeTypeCount.' -';


                /////////////////////////////////////  Fee Distribute //////////////////////////////////

                    // Distribute amount on Monthly Fee for each fee type   
                    foreach ($checkedfeeType as $feeType) {
                        // Check if the current fee type is one of the specified types
                        if (!in_array($feeType, ['admission_fee', 'annual_charge', 'exam_fee', 'computer_fee', 'saraswati_puja_fee'])) {
                            // Save the data to the database for these fee types
 
                            StudentsFeeStracture::create([
                                'st_id' => $st_id,
                                'year' =>  $year, 
                                'month' => $month,
                                'fee_type' => $feeType,
                                'amount' => $amountPerFeeType,
                                'fee_stracture_type' => 'deal', 
                            ]);
                        }
                    }
                    
                /////////////////////////////////////  Fee Distribute //////////////////////////////////
                                    

                // Find or create a record in StudentsFeeMonth table
                $studentsFeeMonth = StudentsFeeMonth::updateOrCreate(
                    ['st_id' => $st_id, 'year' => $year],
                    [
                        'month_' . ($month - 1) => $dividedAmount,
                        'total_fee' =>  $fee_amount,
                        'total_dues' =>  $fee_amount,
                    ]
                );
            }
                // Admission Fee  Create 
                if (in_array('admission_fee', $checkedfeeType)) {
                    StudentsFeeStracture::create([
                        'st_id' => $st_id,
                        'year' =>  $year, 
                        'month' => $start_month,
                        'fee_type' => 'Admission Fee',
                        'amount' => $admission_fee,
                        'fee_stracture_type' => 'deal', 
                    ]);
                } 

                // Annual Charge  Create 
                if (in_array('annual_charge', $checkedfeeType)) {
                    StudentsFeeStracture::create([
                        'st_id' => $st_id,
                        'year' =>  $year, 
                        'month' => $start_month,
                        'fee_type' =>  'Annual Charge',
                        'amount' => $annual_charge,
                        'fee_stracture_type' => 'deal', 
                    ]);
                } 

                // Saraswati Puja Fee Create
                if (in_array('saraswati_puja_fee', $checkedfeeType)) {
                    StudentsFeeStracture::create([
                        'st_id' => $st_id,
                        'year' =>  $year, 
                        'month' => 10,
                        'fee_type' =>  'Saraswati Puja Fee',
                        'amount' => $saraswati_puja,
                        'fee_stracture_type' => 'deal', 
                    ]);
                } 

                // Exam Fee Create          
                for ($i = 0; $i < $exam_month; $i++) {
                    $monthExam  = [12, 9, 6, 3];

                    StudentsFeeStracture::create([
                        'st_id' => $st_id,
                        'year' =>  $year, 
                        'month' => $monthExam[$i],
                        'fee_type' =>  'Exam Fee',
                        'amount' => $exam_fee,
                        'fee_stracture_type' => 'deal', 
                    ]);
       
                }

                // Set Computer Fee
                for ($i = 0; $i < $totalMonths; $i++) {
                    if (in_array('computer_fee', $checkedfeeType)) {

                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => (int)$checkedMonths[$i],
                            'fee_type' => 'Computer Fee',
                            'amount' => $computer_fee,
                            'fee_stracture_type' => 'deal', 
                        ]);
                    } 
                }

                StudentAccountFee::StudentsFeeMonthsCalculate($st_id);

            // Return a success response
            return response()->json(['status' => 'Data saved successfully'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function SaveDefault(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
            'checkedMonths' => 'required|array',
            'checkedMonths.*' => 'required|integer|min:1|max:12', // Assuming months range from 1 to 12
            'checkedfeeType' => 'required|array',
            'st_id' => 'required|integer',
            'year' => 'required|integer',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Return the validation errors as a JSON response
            return response()->json(['errors' => $validator->errors()], 422); // 422 is Unprocessable Entity status code
        }

          // Access the sent data
            $checkedMonths = $request->input('checkedMonths');
            $checkedfeeType = $request->input('checkedfeeType');
            $fee_amount = $request->input('fee_amount');
            $st_id =  $request->st_id;
            $year =  $request->year;
            $transport_root = $request->transport_root;

            $start_month =  $checkedMonths[0];

            // Calculate total number of checked months
            $totalMonths = count($checkedMonths);

 
            // Exam Month Detect 
            $exam_month = 0;
            $quarterlyCount = count(array_intersect([3, 6, 9, 12], $checkedMonths));
            if ($quarterlyCount == 4) {
                $exam_month = 4;
            } elseif ($quarterlyCount == 2) {
                $exam_month = 2;
            } elseif ($quarterlyCount == 3) {
                $exam_month = 3;
            } elseif (in_array(1, $checkedMonths)) {
                $exam_month = 1;
            }

            // Delete existing fee structures for the same st_id, year, and month
            StudentsFeeStracture::where('st_id', $st_id)->where('year', $year)->delete();

                    $Student = Student::where('id',  $st_id)->first();
                    $class = $Student->class;

                    $FeestractureMonthly = FeestractureMonthly::where('class', $class)->first();
                    $tuition_fee = $FeestractureMonthly->tuition_fee;
                    $full_hostel_fee = $FeestractureMonthly->full_hostel_fee;
                    $half_hostel_fee = $FeestractureMonthly->half_hostel_fee;
                    $computer_fee = $FeestractureMonthly->computer_fee;
                    $coaching_fee = $FeestractureMonthly->coaching_fee;


                    $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
                    $admission_fee = $FeestractureOnetime->admission_fee;
                    $annual_charge = $FeestractureOnetime->annual_charge;
                    $saraswati_puja = $FeestractureOnetime->saraswati_puja;

                    $FeestractureQuarterly = FeestractureQuarterly::where('class', $class)->first();
                    $exam_fee = $FeestractureQuarterly->exam_fee;


                    // tuition_fee Fee Create          
                    for ($i = 0; $i < $totalMonths; $i++) {
                        if (in_array('tuition_fee', $checkedfeeType)) {
                            StudentsFeeStracture::create([
                                'st_id' => $st_id,
                                'year' =>  $year, 
                                'month' => (int)$checkedMonths[$i],
                                'fee_type' =>  'Tuition Fee',
                                'amount' => $tuition_fee,
                                'fee_stracture_type' => 'default', 
                            ]);
                        } 
                    }

                    // full_hostel_fee Fee Create          
                    for ($i = 0; $i < $totalMonths; $i++) {
                       if (in_array('full_hostel_fee', $checkedfeeType)) {
                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => (int)$checkedMonths[$i],
                            'fee_type' =>  'Full Hostel Fee',
                            'amount' => $full_hostel_fee,
                            'fee_stracture_type' => 'default', 
                        ]);
                      } 
                    }

                    // Set half_hostel_fee Fee
                    for ($i = 0; $i < $totalMonths; $i++) {
                        if (in_array('half_hostel_fee', $checkedfeeType)) {

                            StudentsFeeStracture::create([
                                'st_id' => $st_id,
                                'year' =>  $year, 
                                'month' => (int)$checkedMonths[$i],
                                'fee_type' => 'Half Hostel Fee',
                                'amount' => $half_hostel_fee,
                                'fee_stracture_type' => 'default', 
                            ]);
                        } 
                    }    
                    
                    // Set Coaching Fee
                    for ($i = 0; $i < $totalMonths; $i++) 
                    {
                        if (in_array('coaching_fee', $checkedfeeType)) {

                            StudentsFeeStracture::create([
                                'st_id' => $st_id,
                                'year' =>  $year, 
                                'month' => (int)$checkedMonths[$i],
                                'fee_type' => 'Coaching Fee',
                                'amount' => $coaching_fee,
                                'fee_stracture_type' => 'default', 
                            ]);
                       } 
                    }    

                    // Set Computer Fee
                    for ($i = 0; $i < $totalMonths; $i++) {
                        if (in_array('computer_fee', $checkedfeeType)) {

                            StudentsFeeStracture::create([
                                'st_id' => $st_id,
                                'year' =>  $year, 
                                'month' => (int)$checkedMonths[$i],
                                'fee_type' => 'Computer Fee',
                                'amount' => $computer_fee,
                                'fee_stracture_type' => 'default', 
                            ]);
                       } 
                    }

                    
                    // Set Transport Fee
                    for ($i = 0; $i < $totalMonths; $i++) {
                        if (in_array('transport_fee', $checkedfeeType)) {

                            $VehicleRoot = VehicleRoot::where('id', $transport_root)->first();
                            if($VehicleRoot){
                                $RootAmount = $VehicleRoot->amount;


                                StudentsFeeStracture::create([
                                    'st_id' => $st_id,
                                    'year' =>  $year, 
                                    'month' => (int)$checkedMonths[$i],
                                    'fee_type' => 'Transport Fee',
                                    'amount' => $RootAmount,
                                    'fee_stracture_type' => 'default', 
                                ]);
                            }

                       } 
                    }

                    // Admission Fee  Create 
                    if (in_array('admission_fee', $checkedfeeType)) {
                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => $start_month,
                            'fee_type' => 'Admission Fee',
                            'amount' => $admission_fee,
                            'fee_stracture_type' => 'default', 
                        ]);
                    } 

                    // annual_charge  Create 
                    if (in_array('annual_charge', $checkedfeeType)) {
                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => $start_month,
                            'fee_type' => 'annual Charge',
                            'amount' => $annual_charge,
                            'fee_stracture_type' => 'default', 
                        ]);
                    } 

                    // Saraswati Puja Fee Create
                    if (in_array('saraswati_puja_fee', $checkedfeeType)) {
                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => 10,
                            'fee_type' =>  'Saraswati Puja Fee',
                            'amount' => $saraswati_puja,
                            'fee_stracture_type' => 'default', 
                        ]);
                    } 

                    // Exam Fee Create          
                    for ($i = 0; $i < $exam_month; $i++) {
                        $monthExam  = [12, 9, 6, 3];

                        StudentsFeeStracture::create([
                            'st_id' => $st_id,
                            'year' =>  $year, 
                            'month' => $monthExam[$i],
                            'fee_type' =>  'Exam Fee',
                            'amount' => $exam_fee,
                            'fee_stracture_type' => 'default', 
                        ]);
                    }


                    foreach ($checkedMonths as $key => $month) {
                        // Find or create a record in StudentsFeeMonth table
                        $studentsFeeMonth = StudentsFeeMonth::updateOrCreate(
                            ['st_id' => $st_id, 'year' => $year],
                            [
                                'month_' . ($month - 1) => 0,
                                'total_fee' =>  0,
                                'total_dues' =>  0,
                            ]
                        );
                    }

                    StudentAccountFee::StudentsFeeMonthsCalculate($st_id);


            // Return a success response
            return response()->json(['status' => 'Data saved successfully'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
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
