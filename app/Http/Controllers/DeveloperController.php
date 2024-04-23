<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelperController\StudentAccountFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\StudentsFeeStracture;
use Carbon\Carbon;


use App\Models\JoinleaveDates;
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;

 

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function StudentFeeSet(Request $request)
    {
        try {

            $studentsdata = Student::get();
            $batchSize = 10; // Define the batch size
            
            // Chunk the students into batches
            $studentBatches = $studentsdata->chunk($batchSize);
            
            // Process each batch of students
            foreach ($studentBatches as $batch) {
                foreach ($batch as $student) {
                    $st_id = $student->id;
                    $st_class = $student->class;
            
                    $FeePayments = FeePayment::where('st_id', $st_id)->get();
            
                    $FeestractureOnetime = FeestractureOnetime::where('class', $st_class)->first();
            
                    for ($i = 0; $i < 11; $i++) { // Move the inner loop here
                        foreach ($FeePayments as $FeePayment) {
                            $class_year = $FeePayment->class_year;
            
                            // Check if StudentsFeeStracture exists for the student and year
                            $StudentsFeeStracture = StudentsFeeStracture::where('st_id', $st_id)
                                ->where('year', $class_year)->first();
            
                            if (!$StudentsFeeStracture) {
                                // Delete existing StudentsFeeStracture for the student
                                $joining_months = JoinleaveDates::where('st_id', $st_id)->first();
                                if ($joining_months) {
                                    // start admission_fee
                                    StudentsFeeStracture::where('st_id', $st_id)->where('year', $class_year)
                                        ->where('month', $i)->where('fee_type', 'admission_fee')->delete();
                                    $admission_months_array = json_decode($joining_months->admission_fee, true);
                                    if (($admission_months_array[$i] ?? null) == 1) {
                                        $studentFeeStructure = new StudentsFeeStracture();
                                        $studentFeeStructure->st_id = $st_id;
                                        $studentFeeStructure->year = $class_year;
                                        $studentFeeStructure->month = $i + 1;
                                        $studentFeeStructure->fee_type = 'admission_fee';
                                        $studentFeeStructure->amount = $FeestractureOnetime->admission_fee ?? 0;
                                        $studentFeeStructure->save();
                                    }
                                    // end admission_fee
            
                                    // start tuition_fee
                                    StudentsFeeStracture::where('st_id', $st_id)->where('year', $class_year)
                                        ->where('month', $i)->where('fee_type', 'tuition_fee')->delete();
                                    $tuition_fee_months_array = json_decode($joining_months->tuition_fee, true);
                                    if (($tuition_fee_months_array[$i] ?? null) == 1) {
                                        $studentFeeStructure = new StudentsFeeStracture();
                                        $studentFeeStructure->st_id = $st_id;
                                        $studentFeeStructure->year = $class_year;
                                        $studentFeeStructure->month = $i + 1;
                                        $studentFeeStructure->fee_type = 'tuition_fee';
                                        $studentFeeStructure->amount = $FeestractureOnetime->admission_fee ?? 0;
                                        $studentFeeStructure->save();
                                    }
                                    // end tuition_fee
                                } else {
                                    echo 'joining_months not found ' . $st_id . ' ';
                                }
                            } else {
                                echo 'StudentsFeeStracture already exists';
                            }
                        }
                    }
                }
            }
            
            
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function NewAccountStudentFeeSet(Request $request){
        $studentsQuery = Student::query();
        $pageSize = 100; // Number of records to process per batch
    
        $totalStudents = $studentsQuery->count();
        $totalPages = ceil($totalStudents / $pageSize);
    
        for ($page = 1; $page <= $totalPages; $page++) {
            $studentsdata = $studentsQuery->forPage($page, $pageSize)->get();
    
            foreach ($studentsdata as $student) {
                // Start Admission date
                $class_year = 2081;
                $class = $student->class;
    
                $admission_year =  '2081';
 
    
     
                    $start_month = 0;
    
                // End Admission date
                $st_id = $student->id;
    
                if (!StudentsFeeStracture::where('st_id', $st_id)->where('year', '2081')->first()) {
                    ///////////////// Start New Account Student Fee Set ////////////
                        StudentAccountFee::setStudentFees($class, $start_month, $class_year, $admission_year, $request, $st_id);
                    ///////////////// End New Account Student Fee Set ////////////

                    $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();

                    $studentFeeStructure = new StudentsFeeStracture();
                    $studentFeeStructure->st_id = $st_id;
                    $studentFeeStructure->year = $class_year;
                    $studentFeeStructure->month = 1;
                    $studentFeeStructure->fee_type = 'annual charge';
                    $studentFeeStructure->amount = $FeestractureOnetime->annual_charge;
                    $studentFeeStructure->fee_stracture_type = 'prev_year';
                    $studentFeeStructure->save();
                    $StudentsFeeStracture = StudentsFeeStracture::where('st_id', $st_id)->where('year', $class_year)->where('fee_type', 'admission_fee')->delete();
    
                    echo 'fee set success';
                } else {
                    echo 'already set';
                }
            }
        }
    }
    


 
}
