<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;

use App\Models\Classes;
use App\Models\LastPaymentForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastFreeFeeForReset;
use App\Models\LastDuesForReset;
use App\Models\HostelFee;
use App\Models\TuitionFee;
use App\Models\VehicleRoot;

class StudentPromotionController extends Controller
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
            $this->response = Student::where("class", $class)->where("admission_status","admit")->get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                return response(array("Student" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'student not found']);
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
    public function StudentPromote(Request $request)
    {
        try {
            $from_class = $request->input('from_class');
            $promote_class = $request->input('promote_class');
            $current_year = $request->input('current_year');
            $PromotedStudents = json_decode($request->input('PromotedStudent'));
            $DemotionStudents = json_decode($request->input('DemotionStudent'));
    
            $ArrayPromotedStudent = [];
            $NotPromotedStudent = [];
    
            foreach ($PromotedStudents as $studentId) {
                $student = Student::where('class', $from_class)
                    ->where('id', $studentId)
                    ->where('class_year', $current_year)
                    ->first();
    
                if (!$student) {
                    continue;
                }
    
                $paymentStudent = FeePayment::where('st_id', $studentId)
                    ->where('class', $from_class)
                    ->first();
    
                // Promote if no payments are pending or if current_year is greater than or equal to class_year
                if ($paymentStudent->total_payment <= 0 || $student->class_year < $current_year) {
                    $this->promoteStudent($student, $promote_class, $current_year);
                    $ArrayPromotedStudent[] = $this->getFullName($student);
                } else {
                    $NotPromotedStudent[] = $this->getFullName($student);
                }
            }
    
            return response()->json([
                'Promoted' => $ArrayPromotedStudent,
                'NotPromoted' => $NotPromotedStudent,
            ], 200);
    
        } catch (Exception $e) {
            return response()->json([
                'status' => "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Promote a student by updating their class and year,
     * and resetting fee-related records.
     */
    private function promoteStudent($student, $promote_class, $current_year)
    {
        // Update student class and year
        $student->update([
            'class' => $promote_class,
            'class_year' => $current_year
        ]);
    
        // Update or create fee-related records
        $this->updateOrCreateFeeRelatedRecords($student->id, $promote_class, $current_year);
    }
    
    /**
     * Update or create fee-related records for the promoted student.
     */
    private function updateOrCreateFeeRelatedRecords($studentId, $promote_class, $current_year)
    {
        $models = [DuesAmount::class, FeeDiscount::class, FeeFree::class, FeePayment::class];
        foreach ($models as $model) {
            $model::updateOrCreate(
                ['st_id' => $studentId, 'class_year' => $current_year],
                ['class' => $promote_class]
            );
        }
    
        // Update other related models (LastPaymentForReset, LastDiscountsForReset, etc.)
        $this->updateRelatedModelsForReset($studentId, $promote_class, $current_year);
    }
    
    /**
     * Update other models related to payment reset.
     */
    private function updateRelatedModelsForReset($studentId, $promote_class, $current_year)
    {
        $models = [LastPaymentForReset::class, LastDiscountsForReset::class, LastDuesForReset::class, LastFreeFeeForReset::class];
        foreach ($models as $model) {
            $record = $model::where('st_id', $studentId)->first();
            if ($record) {
                $record->update([
                    'class' => $promote_class,
                    'class_year' => $current_year
                ]);
            }
        }
    }
    
    /**
     * Get the full name of a student.
     */
    private function getFullName($student)
    {
        return trim($student->first_name . " " . $student->middle_name . " " . $student->last_name);
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
