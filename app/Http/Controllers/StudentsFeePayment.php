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
use App\Models\StudentsFeeForReset;




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

                $StudentMonthFeeStracture = [];
                $studentFeeStructure = StudentsFeeMonth::where('year', $year)->where('st_id', $student->id)->first();
                if ($studentFeeStructure) {
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
    
    public function StudentFeeMonthParticular(Request $request) {
        try {
            $month_array = $request->month_array;
            $pr_id = $request->pr_id;
            $fee_year = $request->fee_year;
            $fee_details = [];
            $common_fee_details = []; 
            $total_common_amount = 0; 
    
            $students = Student::where('parents_id', $pr_id)->get();
    
            // Iterate over each student
            foreach ($students as $student) {
                // Fetch student details
                $student_id = $student->id;
    
                $student_details = [
                    'id' => $student->id,
                    'student_name' => $student->first_name . ' ' . $student->last_name,
                    'class' => $student->class,
                    'section' => $student->section,
                ];
    
                // Initialize an array to store the total amount and months for each fee type
                $total_fee_details = [];
    
                // Iterate over each month
                foreach ($month_array as $month) {
                    // Query to fetch fee details for the student for the particular month
                    $fee_details_month = StudentsFeeStracture::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->where('month', $month)
                        ->get();
    
                    $dues_column = 'month_' . ($month - 1);
                    $dues_amount_month = StudentsFeeDues::where('st_id', $student_id)
                        ->where('year', $fee_year)
                        ->value($dues_column) ?? 0;
    
                    if ($dues_amount_month <= 0) {
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
                    } else {
                        // Sum the dues amount for each month in the $month_array
                        $prev_balance_amount = 0;
                        foreach ($month_array as $month) {
                            $dues_column = 'month_' . ($month - 1); // Adjusting month to match column index
                            $prev_balance_amount += StudentsFeeDues::where('st_id', $student_id)
                                ->where('year', $fee_year)
                                ->value($dues_column) ?? 0;
                        }
                        $total_fee_details['Previous Balance'] = [
                            'amount' => $prev_balance_amount,
                            'month' => 1, // Initialize month count
                        ];
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
                $total_amount = array_sum(array_column($total_fee_details, 'amount'));
    
                // Include student details along with fee details
                $fee_details[$student_id] = [
                    'student_details' => $student_details,
                    'fee_details' => $total_fee_details,
                    'total_amount' => $total_amount,
                ];
            }
    
            $school_details = SchoolDetails::first();
    
            return response()->json([
                'status' => 'success',
                'data' => $fee_details,
                'common_fee_details' => $common_fee_details,
                'total_common_amount' => $total_common_amount,
                'school_details' => $school_details
            ]);
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



            ////////////////////// Start History Save //////////////////////
                $StudentsFeePaidHistory = new StudentsFeePaidHistory(); 
                $StudentsFeePaidHistory->st_id = json_encode($st_id_array);
                $StudentsFeePaidHistory->pr_id = $pr_id;
                $StudentsFeePaidHistory->fee_year = $fee_year;
                $StudentsFeePaidHistory->particular_data =  $data_fee_particular;
                $StudentsFeePaidHistory->pay_month = json_encode($pay_month_array);
                $StudentsFeePaidHistory->fee = $fee_amount;
                $StudentsFeePaidHistory->paid = $paid_amount;
                $StudentsFeePaidHistory->disc = $disc_amount;
                $StudentsFeePaidHistory->dues = $dues_amount;
                $StudentsFeePaidHistory->comment_disc = $comment_disc;
                $StudentsFeePaidHistory->pay_with = 'Cash';
                $StudentsFeePaidHistory->pay_date = $pay_date;
                $StudentsFeePaidHistory->save();                        
            ////////////////////// End History Save ////////////////////// 

            /////////////////////// Start Fee Data Save For Reset ///////////////
                foreach ($st_id_array as $st_id) {
                    // Fetch corresponding records for Paid, Disc, and Dues
                    $StudentsFeePaid = StudentsFeePaid::where('st_id', $st_id)->where('year', $fee_year)->first();
                    $StudentsFeeDisc = StudentsFeeDisc::where('st_id', $st_id)->where('year', $fee_year)->first();
                    $StudentsFeeDues = StudentsFeeDues::where('st_id', $st_id)->where('year', $fee_year)->first();

                    // Iterate through different fee types (Paid, Disc, Dues)
                    $feeTypes = ['students_fee_paids', 'students_fee_disc', 'students_fee_dues'];
                    foreach ($feeTypes as $feeType) {
                        $StudentsFeeForReset = new StudentsFeeForReset();
                        $StudentsFeeForReset->hs_id = $StudentsFeePaidHistory->id;
                        $StudentsFeeForReset->st_id = $st_id;
                        $StudentsFeeForReset->year = $feeType === 'students_fee_paids' ? ($StudentsFeePaid->year ?? $fee_year) : ($StudentsFeeDisc->year ?? $fee_year);
                        
                        // Assign month values dynamically based on fee type
                        for ($i = 0; $i < 12; $i++) {
                            $monthField = "month_$i";
                            $monthValue = $feeType === 'students_fee_paids' ? ($StudentsFeePaid->$monthField ?? 0) : ($StudentsFeeDisc->$monthField ?? 0);
                            $StudentsFeeForReset->$monthField = $monthValue;
                        }

                        $StudentsFeeForReset->table = $feeType;
                        $StudentsFeeForReset->save();
                    }
                }
            /////////////////////// End Fee Data Save For Reset ///////////////

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

                            // Retrive Month Fee
                            $payment = $fee_details->$pay_month - $per_mon_dues;

                            $discount = $per_mon_disc + $student_disc_record->$pay_month;

                            $student_paid_record->$pay_month  = $payment - $per_mon_disc;
                            $student_disc_record->$pay_month  = $discount;
                            $student_dues_record->$pay_month = $per_mon_dues;

                        }
                        $student_paid_record->save();
                        $student_disc_record->save();
                        $student_dues_record->save();

                    }
                }
            ////////////////////// End StudentsFeePaid //////////////////////

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

                // Delete records from StudentsFeeForReset table
                StudentsFeeForReset::where('year', $year)->where('st_id', $st_id)->delete(); 
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

    public function StudentSingleFeeReset(Request $request){
        try {

            $invoice_id = $request->invoice_id;

            $StudentsFeePaidHistory = StudentsFeePaidHistory::where('id', $invoice_id)->first();
            $st_ids_string = $StudentsFeePaidHistory->st_id;
            $st_ids_array = json_decode($st_ids_string);

    
            foreach ($st_ids_array as $st_id) {

                $PaidResetData = StudentsFeeForReset::where('hs_id', $invoice_id)->where('st_id', $st_id)->where('table', 'students_fee_paids')->first();
                $DiscResetData = StudentsFeeForReset::where('hs_id', $invoice_id)->where('st_id', $st_id)->where('table', 'students_fee_disc')->first();
                $DuesResetData = StudentsFeeForReset::where('hs_id', $invoice_id)->where('st_id', $st_id)->where('table', 'students_fee_dues')->first();



                $StudentsFeePaid = StudentsFeePaid::where('st_id', $st_id)->where('year', $PaidResetData->year)->first();
                $StudentsFeePaid->month_0 = $PaidResetData->month_0;
                $StudentsFeePaid->month_1 = $PaidResetData->month_1;
                $StudentsFeePaid->month_2 = $PaidResetData->month_2;
                $StudentsFeePaid->month_3 = $PaidResetData->month_3;
                $StudentsFeePaid->month_4 = $PaidResetData->month_4;
                $StudentsFeePaid->month_5 = $PaidResetData->month_5;
                $StudentsFeePaid->month_6 = $PaidResetData->month_6;
                $StudentsFeePaid->month_7 = $PaidResetData->month_7;
                $StudentsFeePaid->month_8 = $PaidResetData->month_8;
                $StudentsFeePaid->month_9 = $PaidResetData->month_9;
                $StudentsFeePaid->month_10 = $PaidResetData->month_10;
                $StudentsFeePaid->month_11 = $PaidResetData->month_11;
                $StudentsFeePaid->save();
                $PaidResetData->delete();

                $StudentsFeeDisc = StudentsFeeDisc::where('st_id', $st_id)->where('year', $PaidResetData->year)->first();
                $StudentsFeeDisc->month_0 = $DiscResetData->month_0;
                $StudentsFeeDisc->month_1 = $DiscResetData->month_1;
                $StudentsFeeDisc->month_2 = $DiscResetData->month_2;
                $StudentsFeeDisc->month_3 = $DiscResetData->month_3;
                $StudentsFeeDisc->month_4 = $DiscResetData->month_4;
                $StudentsFeeDisc->month_5 = $DiscResetData->month_5;
                $StudentsFeeDisc->month_6 = $DiscResetData->month_6;
                $StudentsFeeDisc->month_7 = $DiscResetData->month_7;
                $StudentsFeeDisc->month_8 = $DiscResetData->month_8;
                $StudentsFeeDisc->month_9 = $DiscResetData->month_9;
                $StudentsFeeDisc->month_10 = $DiscResetData->month_10;
                $StudentsFeeDisc->month_11 = $DiscResetData->month_11;
                $StudentsFeeDisc->save();
                $DiscResetData->delete();


                $StudentsFeeDues = StudentsFeeDues::where('st_id', $st_id)->where('year', $PaidResetData->year)->first();
                $StudentsFeeDues->month_0 = $DuesResetData->month_0;
                $StudentsFeeDues->month_1 = $DuesResetData->month_1;
                $StudentsFeeDues->month_2 = $DuesResetData->month_2;
                $StudentsFeeDues->month_3 = $DuesResetData->month_3;
                $StudentsFeeDues->month_4 = $DuesResetData->month_4;
                $StudentsFeeDues->month_5 = $DuesResetData->month_5;
                $StudentsFeeDues->month_6 = $DuesResetData->month_6;
                $StudentsFeeDues->month_7 = $DuesResetData->month_7;
                $StudentsFeeDues->month_8 = $DuesResetData->month_8;
                $StudentsFeeDues->month_9 = $DuesResetData->month_9;
                $StudentsFeeDues->month_10 = $DuesResetData->month_10;
                $StudentsFeeDues->month_11 = $DuesResetData->month_11;
                $StudentsFeeDues->save();
                $DuesResetData->delete();

            }

            StudentsFeePaidHistory::where('id', $invoice_id)->delete();

            //Sum total_fee, total_paid, total_disc, total_dues
            StudentAccountFee::StudentsFeeMonthsCalculate();

            return response()->json(['status'=>'success'], 200);
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function StudentFeeDuesList(Request $request){
        try {
            $class = $request->select_class;
            $section = $request->select_section;
            $months = json_decode($request->input('selectmonth'));
            $monthLength = count($months);
            $current_year = $request->current_year;
    
            $students = Student::where('class', $class)
                               ->where('section', $section)
                               ->get();
    
            if ($students->isNotEmpty()) {
                $response_data = array();
                $grouped_students = array();
                foreach ($students as $student) {
                    $pr_id = $student->parents_id;
    
                    $student_details = array(
                        'id' => $student->id,
                        'student_name' => $student->first_name.' '.$student->last_name,
                        'class' => $student->class,
                        'section' => $student->section,
                    );
    
                    // Call StudentFeeMonthParticular function for each student
                    // $fee_details_response = $this->StudentFeeMonthParticular($months, $pr_id, $current_year);

                     $fee_details_response = StudentAccountFee::StudentFeeMonthParticular($months, $pr_id, $current_year);

    
                    // Add student details to the response data
                    $response_data[] = array(
                        'student_details' => $student_details,
                        'fee_details' => $fee_details_response->getData(), // Extracting JSON response data
                    );
                }
    
                return response()->json($response_data, 200);
            } else {
                return response()->json(['message' => 'No students found'], 404);
            }
    
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    

}
