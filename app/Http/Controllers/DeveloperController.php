<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\StudentsFeeStracture;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
