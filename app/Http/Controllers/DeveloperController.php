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

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;

use Illuminate\Support\Facades\DB;

 

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
            $studentsData = $studentsQuery->forPage($page, $pageSize)->get();
    
            foreach ($studentsData as $student) {
                // Start Admission date
                $class_year = 2081;
                $class = $student->class;
    
                // Adjust admission year based on the student's actual admission year
                $admission_year = $student->admission_year; // Assuming there's a field for admission year in your Student model
    
                $start_month = -1;
    
                // End Admission date
                $st_id = $student->id;
    
                // Check if fee structure already exists for the student and year
                if (!StudentsFeeStracture::where('st_id', $st_id)->where('year', $class_year)->exists()) {
                    // Set Student Fees
                    StudentAccountFee::setStudentFees($class, $start_month, $class_year, $admission_year, $request, $st_id);
    
                    // Create fee structure for annual charge
                    $FeestractureOnetime = FeestractureOnetime::where('class', $class)->first();
    
                    // $studentFeeStructure = new StudentsFeeStracture();
                    // $studentFeeStructure->st_id = $st_id;
                    // $studentFeeStructure->year = $class_year;
                    // $studentFeeStructure->month = 1; // Assuming you want to set fees for the first month
                    // $studentFeeStructure->fee_type = 'annual charge';
                    // $studentFeeStructure->amount = $FeestractureOnetime->annual_charge;
                    // $studentFeeStructure->fee_stracture_type = 'prev_year';
                    // $studentFeeStructure->save();
    
                    // Delete any previous admission fee structure
                    StudentsFeeStracture::where('st_id', $st_id)
                        ->where('year', $class_year)
                        ->where('fee_type', 'admission_fee')
                        ->delete();

        
    
                    echo 'Fee set successfully.';
                } else {
                    echo 'Fee already set.';
                }
            }
        }
    }
    
    public function DateChange(Request $request)
    {
        // Set maximum execution time to 300 seconds (5 minutes) or higher if needed
        set_time_limit(300);
    
        // Process payment_histories in batches
        $this->processTableInBatches('payment_histories', 'pay_date');
        
        // Process pr_wallet_load_his in batches
        $this->processTableInBatches('pr_wallet_load_his', 'date');

        // Process expenses in batches
        $this->processTableInBatches('expenses', 'expenses_date');

        // Process employees in batches
        $this->processTableInBatches('employees', 'dob');
        $this->processTableInBatches('employees', 'joining_date');

        // Process employees in batches
        $this->processTableInBatches('employees_salaries', 'salary_date');

        // Process employees in batches
        $this->processTableInBatches('employees_salaries_payment_histories', 'payment_date');

        // Process employees in batches
        $this->processTableInBatches('exam_timetables', 'exam_date');

        // Process employees in batches
        $this->processTableInBatches('classes', 'start_date');
        $this->processTableInBatches('classes', 'end_date');

        // Process employees in batches
        $this->processTableInBatches('items_add_stock_histories', 'date');

        // Process employees in batches
        $this->processTableInBatches('items_sell_histories', 'pay_date');
 

        // Process employees in batches
        $this->processTableInBatches('pr_wallet_pay_his', 'date');

        // Process employees in batches
        $this->processTableInBatches('students', 'dob');
        $this->processTableInBatches('students', 'admission_date');

        // Process employees in batches
        $this->processTableInBatches('students_fee_paid_histories', 'pay_date');

        // Process employees in batches
        $this->processTableInBatches('teachers', 'dob');
        $this->processTableInBatches('teachers', 'joining_date');

        // Process employees in batches
        $this->processTableInBatches('teachers_attendances', 'date');
        
        return response()->json(['message' => 'Date conversion completed successfully']);
    }
    
    private function processTableInBatches($tableName, $dateColumn, $batchSize = 100)
    {
        $totalRecords = DB::table($tableName)->count();
        $batches = ceil($totalRecords / $batchSize);
    
        for ($i = 0; $i < $batches; $i++) {
            $records = DB::table($tableName)
                ->offset($i * $batchSize)
                ->limit($batchSize)
                ->get();
            
            $this->convertDates($records, $dateColumn, $tableName);
        }
    }
    
    private function convertDates($records, $dateColumn, $tableName)
    {
        foreach ($records as $record) {
            $bsDate = $record->$dateColumn;
    
            if (is_null($bsDate) || !preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $bsDate)) {
                continue; // Skip if date is null or not in 'YYYY-M-D' or 'YYYY-MM-DD' format
            }
    
            $parts = explode('-', $bsDate);
            
            if (count($parts) == 3) {
                $year = $parts[0];
                $month = str_pad($parts[1], 2, '0', STR_PAD_LEFT);
                $day = str_pad($parts[2], 2, '0', STR_PAD_LEFT);
                $bsDate = "$year-$month-$day";
            } else {
                continue;
            }
    
            try {
                $gregorianDate = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($bsDate)->toEnglishDate();
                DB::table($tableName)
                    ->where('id', $record->id)
                    ->update([$dateColumn => $gregorianDate]);
            } catch (\Exception $e) {
                \Log::error("Error converting date for record ID {$record->id} in table {$tableName}: " . $e->getMessage());
                continue;
            }
        }
    }
    
    
    
    
    


 
}
