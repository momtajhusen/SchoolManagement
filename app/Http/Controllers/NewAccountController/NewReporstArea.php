<?php

namespace App\Http\Controllers\NewAccountController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Parents;

use App\Models\Expenses;
use App\Models\EmployeesSalariesPaymentHistories;


use App\Models\PrWalletLoadHis;
use App\Models\FeeGenerated;

use App\Models\StudentsFeePaid;
use App\Models\StudentsFeeMonth;
use App\Models\StudentsFeePaidHistory;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;



class NewReporstArea extends Controller
{
 
    public function CollectionDateWize(Request $request){
        try {
            // Validate the input dates
            $request->validate([
                'from_date' => 'required|string',
                'to_date' => 'required|string',
            ]);

            // Retrieve validated dates
            $from_date = LaravelNepaliDate::from($request->from_date)->toEnglishDate();
            $to_date = LaravelNepaliDate::from($request->to_date)->toEnglishDate();

  


            // Query the PaymentHistory model
            $paymentHistoryData = StudentsFeePaidHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$from_date, $to_date])
            ->orderBy('id', 'desc')
            ->get();


            $paymentHistoryData = $paymentHistoryData->map(function ($payment) {
                // Check if $payment->st_id is a string representing a JSON array
                if (is_string($payment->st_id)) {
                    $studentIds = json_decode($payment->st_id);
                    
                    // Initialize variables to concatenate student data
                    $student_name = '';
                    $all_last_names = '';
                    $all_classes = '';
                    $all_sections = '';
            
                    // Check if decoding was successful and $studentIds is an array
                    if (is_array($studentIds)) {
                        foreach ($studentIds as $studentId) {
                            $studentData = Student::find($studentId);
            
                            if ($studentData) {
     
                                // $student_name .= 'st_id : '.$studentData->id.' '.'cls : '.$studentData->class.' '.$studentData->first_name . ' '.$studentData->last_name.'<br>';
                                $student_name .=  $studentData->first_name . ' '.$studentData->last_name.'<br>';
    
               
            
                                $parentData = Parents::find($studentData->parents_id);
                                
                                // Assuming $payment->father_name should only be set once
                                if (!$payment->father_name && $parentData) {
                                    $payment->father_name = $parentData->father_name ?? '';
                                    $payment->mother_name = $parentData->mother_name ?? '';
                                    $payment->pr_id = $parentData->id ?? '';
                                }
                            }
                        }
            
                        // Assign concatenated values to payment object
                        $payment->student_name = trim($student_name);
     
                    } else {
                        // Handle the case where decoding failed or $studentIds is not an array
                        // You can log an error message or handle it according to your application's logic
                    }
                } else {
                    // Handle the case where $payment->st_id is not a string
                    // You can log an error message or handle it according to your application's logic
                }
                
                return $payment;
            });
            
            return response()->json(['paymentHistoryData' => $paymentHistoryData], 200);
            
        
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function CollectionStudentWize(Request $request){
        try {

            $request->validate([
                'parents_id' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
            ]);

            $parents_id = $request->parents_id;
            $from_date = LaravelNepaliDate::from($request->from_date)->toEnglishDate();
            $to_date = LaravelNepaliDate::from($request->to_date)->toEnglishDate();

    

            $studentData = Student::where('parents_id', $parents_id)->first();
            if ($studentData) {

                $PaymentHistory = StudentsFeePaidHistory::where('pr_id', $parents_id)
                ->whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$from_date, $to_date])
                ->orderBy('id', 'desc')
                ->get();
            
                // Loop through each payment history item
                foreach ($PaymentHistory as $payment) 
                {
                    // Assign additional properties from $studentData
                    $payment->first_name = $studentData->first_name ?? '';
                    $payment->last_name = $studentData->last_name ?? '';
                    $payment->class = $studentData->class ?? '';
                    $payment->section = $studentData->section ?? '';

                    $parentData = Parents::find($studentData->parents_id);
          
                    if ($parentData) {
                        $payment->father_name = $parentData->father_name ?? '';
                    } else {
                        $payment->father_name = '';
                    }
                }
            
                // Return the modified PaymentHistory array as JSON response
                return response()->json(['paymentHistoryData' => $PaymentHistory], 200);

            } 

 

          $paymentHistoryData = StudentsFeePaidHistory::whereBetween('pay_date', [$from_date, $to_date])
          ->orderBy('id', 'desc')
          ->get();

          
          $paymentHistoryData = $paymentHistoryData->map(function ($payment) {
            // Check if $payment->st_id is a string representing a JSON array
            if (is_string($payment->st_id)) {
                $studentIds = json_decode($payment->st_id);
                
                // Initialize variables to concatenate student data
                $student_name = '';
                $all_last_names = '';
                $all_classes = '';
                $all_sections = '';
        
                // Check if decoding was successful and $studentIds is an array
                if (is_array($studentIds)) {
                    foreach ($studentIds as $studentId) {
                        $studentData = Student::find($studentId);
        
                        if ($studentData) {
 
                            // $student_name .= 'st_id : '.$studentData->id.' '.'cls : '.$studentData->class.' '.$studentData->first_name . ' '.$studentData->last_name.'<br>';
                            $student_name .=  $studentData->first_name . ' '.$studentData->last_name.'<br>';

           
        
                            $parentData = Parents::find($studentData->parents_id);
                            
                            // Assuming $payment->father_name should only be set once
                            if (!$payment->father_name && $parentData) {
                                $payment->father_name = $parentData->father_name ?? '';
                                $payment->mother_name = $parentData->mother_name ?? '';
                                $payment->pr_id = $parentData->id ?? '';
                            }
                        }
                    }
        
                    // Assign concatenated values to payment object
                    $payment->student_name = trim($student_name);
 
                } else {
                    // Handle the case where decoding failed or $studentIds is not an array
                    // You can log an error message or handle it according to your application's logic
                }
            } else {
                // Handle the case where $payment->st_id is not a string
                // You can log an error message or handle it according to your application's logic
            }
            
            return $payment;
        });
          
          return response()->json(['paymentHistoryData' => $paymentHistoryData], 200);
          

        }catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function financialOverview(Request $request)
    {
        try {
            $startDate = LaravelNepaliDate::from($request->startDate)->toEnglishDate();
            $endDate = LaravelNepaliDate::from($request->endDate)->toEnglishDate();
            $currentYear = LaravelNepaliDate::toEnglishYear($request->currentYear);


            /////////////////// Start Expenses Retrive ///////////////////
                $expenses = Expenses::whereBetween("expenses_date", [$startDate, $endDate])->orderBy('id', 'desc')->get();
                $utilityExpenses = $expenses->sum('amount');

                $mployeesSalaries = EmployeesSalariesPaymentHistories::whereBetween("payment_date", [$startDate, $endDate])->orderBy('id', 'desc')->get();
                $salaryExpenses = $mployeesSalaries->sum('recive_salary');
            
                $totalExpenses = $utilityExpenses + $salaryExpenses;

                $ExpensesResult = [];

                foreach ($expenses as $expense) {
                    $category = $expense->expenses_category;
                    $amount = $expense->amount;

                    // Check if the category already exists in $ExpensesResult
                    if (isset($ExpensesResult[$category])) {
                        // If it exists, add the amount to the existing total
                        $ExpensesResult[$category]['amount'] += $amount;
                    } else {
                        // If it doesn't exist, create a new entry
                        $ExpensesResult[$category] = [
                            'expensesType' => $category,
                            'amount' => $amount,
                        ];
                    }
                }
                $ExpensesResult[] = [
                    'expensesType' =>  'Employees Salaries',
                    'amount' => $salaryExpenses,
                ];    
                // $ExpensesResult[] = [
                //     'expensesType' =>  'Total Expenses',
                //     'amount' => $totalExpenses,
                // ];
                
                
            /////////////////// End Expenses Retrive ///////////////////

            /////////////////// Start Revenue Retrive ///////////////////
                $paymentHistories = StudentsFeePaidHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])
                ->orderBy('id', 'desc')
                ->get();

                
                $feeTypeTotals = [];
                foreach ($paymentHistories as $paymentHistory) {
                    $particularData = json_decode($paymentHistory->particular_data, true); // Decode JSON data
 
                    
                    foreach ($particularData as $item) {
                        $feeType = key($item); // Get the fee type
                        $amount = $item[$feeType]; // Get the amount

                        
                        // Update total amounts based on fee type
                        if (!isset($feeTypeTotals[$feeType])) {
                            $feeTypeTotals[$feeType] = $amount;
                        } else {
                            $feeTypeTotals[$feeType] += $amount;
                        }
                    }
                }
                
 
                // Calculate the total revenue
                $totalRevenue = StudentsFeePaidHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('paid');

                // Transform the result into the desired structure
                $RevenueResult = [];
                foreach ($feeTypeTotals as $feeType => $amount) {
                    $RevenueResult[] = [
                        'feetype' => $feeType,
                        'amount' => $amount,
                    ];
                }
  

                $netProfit = [
                    'TotalRevenue' => $totalRevenue,
                    'TotalExpenses' => $totalExpenses,
                    'NetProfit' => $totalRevenue - $totalExpenses,
                ];
                
                usort($RevenueResult, function ($a, $b) {
                    return $b['amount'] - $a['amount'];
                });
                usort($ExpensesResult, function ($a, $b) {
                    return $b['amount'] - $a['amount'];
                });

            /////////////////// Start Revenue Retrive ///////////////////

            /////////////////// Start Chart Retrive ///////////////////
                $FinancialChart = [
                    'revenue' => [],
                    'expenses' => [],
                    'netprofit' => [],
                ];
                
                for ($month = 1; $month <= 12; $month++) {
                    $revenue = StudentsFeePaidHistory::whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$currentYear])
                        ->whereRaw("MONTH(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$month])
                        ->sum('paid');
                
                    $utilityExpensesChart = Expenses::whereRaw("YEAR(STR_TO_DATE(expenses_date, '%Y-%m-%d')) = ?", [$currentYear])
                        ->whereRaw("MONTH(STR_TO_DATE(expenses_date, '%Y-%m-%d')) = ?", [$month])
                        ->sum('amount');
                
                    $employeesSalaries = EmployeesSalariesPaymentHistories::whereRaw("STR_TO_DATE(payment_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])
                        ->sum('recive_salary');
                
                    // Ensure that $employeesSalaries is initialized with a default value if it's null
                    $employeesSalaries = $employeesSalaries ?? 0;
                
                    $totalExpensiveChart = $utilityExpensesChart + $employeesSalaries;
                
                    $FinancialChart['revenue'][] = $revenue;
                    $FinancialChart['expenses'][] = $totalExpensiveChart;
                    $FinancialChart['netprofit'][] = $revenue - $totalExpensiveChart;
                }            
            /////////////////// End Chart Retrive ///////////////////

            /////////////////// Start Staff | Wallet | Bank ///////////////////


            //////////////////////////////////////////////////////////////////

            // Return the result as a JSON response
            return response(['Revenue' => $RevenueResult,  'Expenses' =>$ExpensesResult, 'NetProfit' => $netProfit,  'FinancialChart'=>$FinancialChart], 200);
            

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
