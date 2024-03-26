<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HelperController\StudentAccountFee;
use App\Models\Parents;
use App\Models\Student;
use App\Models\SchoolDetails;
use App\Models\StudentsFeeStracture;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeePaid;
use App\Models\StudentsFeeDisc;
use App\Models\StudentsFeeDues;
use App\Models\StudentsFeePaidHistory;


class StudentsFeePayment extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function ParentStudentRetrive(Request $request)
    {
        try {
            $pr_id = $request->pr_id;
            $selectedMonth = $request->selectedMonth;
            $year = 2080;
    
            $parent_data = Parents::where("id", $pr_id)->first();
            if ($parent_data) {
                $student_data = Student::select('id', 'class', 'section', 'first_name', 'last_name', 'student_image', 'village')->where("parents_id", $pr_id)->get();
    
                // Initialize MonthFeePaidStatus array
                $MonthFeePaidStatus = [];

    
                // Check if $selectedMonth is null or empty
                if (is_array($selectedMonth) && count($selectedMonth) > 0) 
                {
                    // Loop through each student
                    foreach ($student_data as $student) {
                        $total_fee = 0;
                        $total_paid = 0;
                        $total_dues = 0;
                        $total_disc = 0;
    
                        foreach ($selectedMonth as $month) 
                        {
                            // Sum the fees for the selected months
                            $total_fee += StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                            $total_paid += StudentsFeePaid::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                            $total_dues += StudentsFeeDues::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                            $total_disc += StudentsFeeDisc::where('year', $year)->where('st_id', $student->id)->value($month) ?? 0;
                        }
    
                        $student->total_fee = $total_fee;
                        $student->total_paid = $total_paid;
                        $student->total_disc = $total_disc;
    
                        $dues_amount_sum = (int) ltrim((string) ($total_paid + $total_disc - $total_fee), '-');
                        $student->total_dues =  $dues_amount_sum;

                    }    
                } else {
                    // If $selectedMonth is not provided or empty, initialize totals to zero
                    foreach ($student_data as $student) {
                        $student->total_fee = 0;
                        $student->total_paid = 0;
                        $student->total_disc = 0;
                        $student->total_dues = 0;
                        $student->MonthFeePaidStatus = [];
                    }
                }

                $studentFeeStructure = StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->first();
                if ($studentFeeStructure) {
                    $StudentMonthFeeStracture = [];
                // Start Student Fee Structure Month 
                    foreach ($student_data as $student) {
                       $studentFeeStructure = StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->first();
                        $student_name = ($student->first_name ?? '') . ' ' . ($student->last_name ?? '');
                        $studentFeeStructure->student_name = $student_name;
                        $StudentMonthFeeStracture[] = $studentFeeStructure;
                    }
                }
                
             

             


                //Sum total_fee, total_paid, total_disc, total_dues
                StudentAccountFee::StudentsFeeMonthsCalculate();

                // After fetching $student_data
                $monthStatus = StudentAccountFee::feePaidMonthStatus($year, $student_data);


    
                return response()->json(['status' => 'success', 'parent_details' => $parent_data, 'student_details' => $student_data, 'month_status' => $monthStatus, 'StudentMonthFeeStracture'=>$StudentMonthFeeStracture], 200);
            } else {
                return response()->json(['status' => 'Parent not found'], 404);
            }
        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
 
    }
    
    public function StudentFeePaymentRetrive(Request $request)
    {
        try {
            $st_id = $request->st_id;
            $st_id_array = $request->st_id_array;
            $year = 2080;
        
            // Fetch the fee structures for the specified student ID and year
            $feeStructures = StudentsFeeMonth::where('year', $year)->where('st_id', $st_id)->first();

            $Student = Student::where('id', $st_id)->first();
        
            if ($feeStructures) {
                // Extract fee data from month_0 to month_12
                $feeArray = [];
                for ($i = 0; $i <= 11; $i++) {
                    $column = 'month_' . $i;
                    $feeArray[$i] = $feeStructures->$column;
                }

                $student = [
                    'fee_year'=>$year,
                    'st_id'=>$st_id,
                    'pr_id'=>$Student->id,
                ];
        
                // Return the fee array as JSON response
                return response()->json(['status' => 'success', 'fee_month' => $feeArray, 'student' => $student]);
            } else {
                // No fee structures found for the specified criteria
                return response()->json(['status' => 'No fee structures found for the specified criteria'], 404);
            }
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
        
    }

    public function StudentFeeMonthParticular(Request $request) {
        try {
            $month_array = $request->month_array;
            $st_id_array = $request->st_id_array;
            $fee_year = $request->fee_year;
    
            $fee_details = [];
            $common_fee_details = []; // Initialize array for common fee details
            $total_common_amount = 0; // Initialize total sum of common fee amounts
    
            // Iterate over each student
            foreach ($st_id_array as $student_id) {
                // Fetch student details
                $student_details = Student::where('id', $student_id)->first();
    
                $student_fee_details = [];
    
                // Initialize an array to store the total amount and months for each fee type
                $total_fee_details = [];
    
                // Iterate over each month
                foreach ($month_array as $month) {
                    // Query to fetch fee details for the student for the particular month
                    $fee_details_month = StudentsFeeStracture::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->where('month', $month)
                        ->get();
    
                    // Accumulate amounts and track months for each fee type
                    foreach ($fee_details_month as $fee_detail) {
                        $fee_type = $fee_detail->fee_type;
                        $amount = $fee_detail->amount;
    
                        // Sum the amount if the fee type already exists
                        if (isset($total_fee_details[$fee_type])) {
                            $total_fee_details[$fee_type]['amount'] += $amount;
                            $total_fee_details[$fee_type]['month']++; // Increment month count
                        } else {
                            $total_fee_details[$fee_type] = [
                                'amount' => $amount,
                                'month' => 1, // Initialize month count
                            ];
                        }
                    }
                }
    
                // Include common fee types in the common_fee_details array and calculate total common amount
                foreach ($total_fee_details as $fee_type => $details) {
                    // Add amount to total_common_amount
                    $total_common_amount += $details['amount'];
    
                    // Check if this fee type exists in common fee details, if yes, add the amount and month count
                    if (isset($common_fee_details[$fee_type])) {
                        $common_fee_details[$fee_type]['amount'] += $details['amount'];
                        $common_fee_details[$fee_type]['month'] += $details['month'];
                    } else {
                        $common_fee_details[$fee_type] = [
                            'amount' => $details['amount'],
                            'month' => $details['month'],
                        ];
                    }
                }
    
                // Sum up the total amount for this student
                $total_amount = 0;
                foreach ($total_fee_details as $details) {
                    $total_amount += $details['amount'];
                }
    
                // Include student details along with fee details
                $fee_details[$student_id] = [
                    'student_details' => $student_details,
                    'fee_details' => $total_fee_details,
                    'total_amount' => $total_amount,
                ];
            }

            $school_details = SchoolDetails::first();
    
            return response()->json(['status' => 'success', 'data' => $fee_details, 'common_fee_details' => $common_fee_details, 'total_common_amount' => $total_common_amount, 'school_details'=> $school_details]);
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    public function StudentFeePaid(Request $request)
    {
        try {
            $pay_month_array = $request->pay_month_array;
            $st_id_array = $request->st_id_array;
            $fee_year = $request->fee_year;
            $fee_amount = $request->fee_amount;
            $paid_amount = $request->paid_amount;
            $disc_amount = $request->disc_amount;
            $dues_amount = $request->dues_amount;
            $comment_disc = $request->comment_disc;
            $pay_date = $request->pay_date;
            $data_fee_particular = $request->data_fee_particular;
            $pr_id = $request->pr_id;

            ////////////////////// Start StudentsFeePaid //////////////////////
                // Loop through each student ID
                foreach ($st_id_array as $st_id) {
                    // Fetch fee details for the current student from StudentsFeeMonth table
                    $fee_details = StudentsFeeMonth::where('st_id', $st_id)->where('year', $fee_year)->first();

                    $per_st_paid = $paid_amount / count($st_id_array);
                    $per_st_disc = $disc_amount / count($st_id_array);
                    $per_st_dues = $dues_amount / count($st_id_array);
                    

                    if ($fee_details) {
                        // Check if there is a record in StudentsFeePaid for this student
                        $student_paid_record = StudentsFeePaid::where('st_id', $st_id)->where('year', $fee_year)->first();
                        $student_disc_record = StudentsFeeDisc::where('st_id', $st_id)->where('year', $fee_year)->first();
                        $student_dues_record = StudentsFeeDues::where('st_id', $st_id)->where('year', $fee_year)->first();

                        // If StudentsFeePaid no record exists, create one
                        if (!$student_paid_record) 
                        {
                            $student_paid_record = new StudentsFeePaid();
                            $student_paid_record->st_id = $st_id;
                            // Set all month columns to 0 as initial values
                            foreach ($pay_month_array as $pay_month) {
                                $student_paid_record->$pay_month = 0;
                                $student_paid_record->year = $fee_year;
                            }
                            $student_paid_record->save();

                        }
                        // If StudentsFeeDisc no record exists, create one
                        if (!$student_disc_record) 
                        {
                            $student_disc_record = new StudentsFeeDisc();
                            $student_disc_record->st_id = $st_id;
                            // Set all month columns to 0 as initial values
                            foreach ($pay_month_array as $pay_month) {
                                $student_disc_record->$pay_month = 0;
                                $student_disc_record->year = $fee_year;
                            }
                            $student_disc_record->save();
                        }
                        // If StudentsFeeDues no record exists, create one
                        if (!$student_dues_record) 
                        {
                            $student_dues_record = new StudentsFeeDues();
                            $student_dues_record->st_id = $st_id;
                            // Set all month columns to 0 as initial values
                            foreach ($pay_month_array as $pay_month) {
                                $student_dues_record->$pay_month = 0;
                                $student_dues_record->year = $fee_year;
                            }
                            $student_dues_record->save();
                        }
                
                        // Loop through each month in pay_month_array
                        foreach ($pay_month_array as $pay_month) {

                            $per_mon_paid = $per_st_paid / count($pay_month_array);
                            $per_mon_disc = $per_st_disc / count($pay_month_array);
                            $per_mon_dues = $per_st_dues / count($pay_month_array);

                            $disc_dues = $per_mon_disc+$per_mon_dues;

                            // Retrive Month Fee
                            $fee_month = $fee_details->$pay_month - $student_disc_record->$pay_month;
 
                            $payment = $fee_month - $disc_dues;
                            $discount = $per_mon_disc + $student_disc_record->$pay_month;

                            $student_paid_record->$pay_month  = $payment;
                            $student_disc_record->$pay_month  = $discount;

                        }
                        $student_paid_record->save();
                        $student_disc_record->save();
                    }
                }
            ////////////////////// End StudentsFeePaid //////////////////////

            // History Save
            $StudentsFeePaidHistory = new StudentsFeePaidHistory(); 
            $StudentsFeePaidHistory->st_id = json_encode($st_id_array);
            $StudentsFeePaidHistory->pr_id = $pr_id;
            $StudentsFeePaidHistory->fee_year = $fee_year;
            $StudentsFeePaidHistory->particular_data =  $data_fee_particular;
            $StudentsFeePaidHistory->pay_month = json_encode($pay_month_array);
            $StudentsFeePaidHistory->fee = $fee_amount;
            $StudentsFeePaidHistory->paid = $paid_amount - $disc_amount;
            $StudentsFeePaidHistory->disc = $disc_amount;
            $StudentsFeePaidHistory->dues = $dues_amount;
            $StudentsFeePaidHistory->comment_disc = $comment_disc;
            $StudentsFeePaidHistory->pay_with = 'Cash';
            $StudentsFeePaidHistory->pay_date = $pay_date;
            $StudentsFeePaidHistory->save();                        
            // History Save 

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate();

            return response()->json(['status' =>  'success'], 200);

        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function StudentFeePaidHistory(Request $request){
        $year = $request->year;
        $pr_id = $request->pr_id;

        $StudentsFeePaidHistory = StudentsFeePaidHistory::where('fee_year', $year)->where('pr_id', $pr_id)->orderBy('id','desc')->get();

        return response()->json(['status' => 'success', 'data' => $StudentsFeePaidHistory]);

    }

    public function StudentFeeInvoiceData(Request $request){
        try {
            $invoice_id = $request->invoice_id;
    
            $StudentsFeePaidHistory = StudentsFeePaidHistory::where('id', $invoice_id)->first();
            $st_ids_string = $StudentsFeePaidHistory->st_id;
            $particular_data = $StudentsFeePaidHistory->particular_data;

            // Convert the string data to an array of integers
            $st_ids_array = json_decode($st_ids_string);
            $particular_data = json_decode($particular_data);

            $fee = $StudentsFeePaidHistory->fee;
            $paid = $StudentsFeePaidHistory->paid;
            $disc = $StudentsFeePaidHistory->disc;
            $dues = $StudentsFeePaidHistory->dues;
            $pay_month = $StudentsFeePaidHistory->pay_month;
            $pay_date = $StudentsFeePaidHistory->pay_date;

            
            $total_fee = [
                'total_fee' => $fee,
                'fee' => $fee,
                'paid' => $paid,
                'disc' => $disc,
                'dues' => $dues,
                'pay_month' => $pay_month,
                'pay_date' => $pay_date,


            ];


    
            $students = Student::whereIn('id', $st_ids_array)->get();
            $SchoolDetails = SchoolDetails::first();
 
            return response()->json(['status'=>'success', 'total_fee'=> $total_fee, 'students' => $students, 'particular_data' => $particular_data, 'school_details' => $SchoolDetails], 200);
    
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function saveInvoice(Request $request)
    {
        try {
        // Check if image data is present in the request
        if ($request->has('image')) {
            // Get the image data from the request
            $imageData = $request->input('image');

            // Decode the base64 encoded image data
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageData = base64_decode($imageData);

            // Generate a unique filename for the image
            $filename = 'invoice_' . uniqid() . '.png';

            // Save the image to the public storage folder
            Storage::disk('public')->put('images/' . $filename, $imageData);

            // Construct the URL for the saved image
            $imageUrl = asset('storage/images/' . $filename);

            // Return the URL of the saved image
            return response()->json(['image_url' => $imageUrl]);
        }
            // Return error if image data is not present
            return response()->json(['error' => 'Image data not found'], 400);
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function StudentAllFeeReset(Request $request){
        try {
            $pr_id = $request->pr_id;
            $year = $request->year;
    
            $students = Student::where('parents_id', $pr_id)->get();
            foreach($students as $student){
                $st_id =  $student->id;
    
                // Delete records from StudentsFeePaid table
                StudentsFeePaid::where('year', $year)->where('st_id', $st_id)->delete();
    
                // Delete records from StudentsFeeDisc table
                StudentsFeeDisc::where('year', $year)->where('st_id', $st_id)->delete();
    
                // Delete records from StudentsFeeDues table
                StudentsFeeDues::where('year', $year)->where('st_id', $st_id)->delete(); 
            }
    
            // Delete records from StudentsFeePaidHistory table
            StudentsFeePaidHistory::where('fee_year', $year)->where('pr_id', $pr_id)->delete();

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate();
    
            return response()->json(['status' => 'success'], 200);
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function StudentFeeStractureMonth(Request $request){
        try {


            echo "Hello";

        } catch (Exception $e) {
            // Handle exceptions
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
