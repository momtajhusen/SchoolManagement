<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Models\DateSetting;
use Carbon\Carbon;
use App\Models\Classes;
use App\Models\FeeGenerated;
use App\Models\FeePayment;
use App\Models\FeeDiscount;
use App\Models\Expenses;
use App\Models\PrWalletLoadHis;
use App\Models\Student;
use App\Models\Parents;
use App\Models\EmployeesSalariesPaymentHistories;

// use App\Models\ReportMonthCollection;


class ReporstArea extends Controller
{
    public function CollectionReport(Request $request) 
    {
        $option = $request->collection_option;

        $year = $request->year;
        $month = $request->month;
        $day = $request->day;

        $today = $year.'-'.$month.'-'.$day;


        // echo  $option;
        // return false;
 
        if ($option === 'month') {
            $paymentHistoryData = PaymentHistory::whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$year])
                                                ->whereRaw("MONTH(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$month])
                                                ->orderBy('id', 'desc')
                                                ->get();
        }
        if ($option === 'today') {
            $paymentHistoryData = PaymentHistory::whereDate('pay_date', $today)
                                                ->orderBy('id', 'desc')
                                                ->get();
        }
        if ($option === 'year') {
            $paymentHistoryData = PaymentHistory::where('pay_date', 'LIKE', $year.'%')
                                                ->orderBy('id', 'desc')
                                                ->get();
        }
        if ($option != 'month') {
            $paymentHistoryData = PaymentHistory::whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$year])
            ->whereRaw("MONTH(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$month])
            ->orderBy('id', 'desc')
            ->get();
        }
         
        
        $payment_History_sums = [];
        for ($month = 1; $month <= 12; $month++) {
            $payment_History_sums["month_".$month] = PaymentHistory::whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$year])
                                                                    ->whereRaw("MONTH(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$month])
                                                                    ->sum('payment');
        }
        
        $HostelDeposite_sums = [];
        for ($month = 1; $month <= 12; $month++) {
            $HostelDeposite_sums["month_".$month] = PrWalletLoadHis::where("load_for", "hostel_deposite")
                                                                    ->whereRaw("YEAR(date) = ?", [$year])
                                                                    ->whereRaw("MONTH(date) = ?", [$month])
                                                                    ->sum('load_amount');
        }
        
        // Start GenerateFee All Months
            $generateMonthsAmount = FeeGenerated::where("class_year", $year)->selectRaw('
                SUM(month_0) AS month_1,
                SUM(month_1) AS month_2,
                SUM(month_2) AS month_3,
                SUM(month_3) AS month_4,
                SUM(month_4) AS month_5,
                SUM(month_5) AS month_6,
                SUM(month_6) AS month_7,
                SUM(month_7) AS month_8,
                SUM(month_8) AS month_9,
                SUM(month_9) AS month_10,
                SUM(month_10) AS month_11,
                SUM(month_11) AS month_12
           ')->first();    
        // End GenerateFee All Months

        // Start PaymentAmount All Months
                $PaymentMounthsAmount = FeePayment::where("class_year", $year)->selectRaw('
                SUM(month_0) AS month_1,
                SUM(month_1) AS month_2,
                SUM(month_2) AS month_3,
                SUM(month_3) AS month_4,
                SUM(month_4) AS month_5,
                SUM(month_5) AS month_6,
                SUM(month_6) AS month_7,
                SUM(month_7) AS month_8,
                SUM(month_8) AS month_9,
                SUM(month_9) AS month_10,
                SUM(month_10) AS month_11,
                SUM(month_11) AS month_12
           ')->first();    
        // End PaymentAmount All Months


        // Assuming 'st_id' is the foreign key linking PaymentHistory and Student tables
        $paymentHistoryData = $paymentHistoryData->map(function ($payment) {
            $studentData = Student::find($payment->student_id);
        
            if ($studentData) {
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
            } else {
                $payment->first_name = '';
                $payment->last_name = '';
                $payment->last_name = '';
                $payment->class = '';
                $payment->section = '';
                $payment->father_name = '';
            }
        
            return $payment;
        });
        return response([
            "paymentHistoryData" => $paymentHistoryData,
            "PaymentHistoryAmount" => $payment_History_sums,
            "GenerateMonthsAmount" => $generateMonthsAmount,
            "PaymentMounthsAmount" => $PaymentMounthsAmount,
            "HostelDeposite" => $HostelDeposite_sums,
        ], 200);
        
 
    }

    public function CollectionDateWize(Request $request){
        try {
            // Validate the input dates
            $request->validate([
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
            ]);

            // Retrieve validated dates
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            // Query the PaymentHistory model
            $paymentHistoryData = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$from_date, $to_date])
            ->orderBy('id', 'desc')
            ->get();


            $paymentHistoryDataArray = $paymentHistoryData->map(function ($payment) {
                $studentData = Student::find($payment->student_id);
            
                if ($studentData) {
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
                } else {
                    $payment->first_name = '';
                    $payment->last_name = '';
                    $payment->class = '';
                    $payment->section = '';
                    $payment->father_name = '';
                }
            
                return $payment->toArray();
            });
            
            return response()->json(['paymentHistoryData' => $paymentHistoryDataArray], 200);
            
        
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function CollectionStudentWize(Request $request){
        try {

            $request->validate([
                'student_id' => 'required',
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
            ]);

            $student_id = $request->student_id;
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            $studentData = Student::find($student_id);
            if ($studentData) {

                $PaymentHistory = PaymentHistory::where('student_id', $student_id)
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



          return false;


          $paymentHistoryData = PaymentHistory::whereBetween('pay_date', [$from_date, $to_date])
          ->orderBy('id', 'desc')
          ->get();

          
          $paymentHistoryDataArray = $paymentHistoryData->map(function ($payment) {
              $studentData = Student::find($payment->student_id);
          
              if ($studentData) {
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
              } else {
                  $payment->first_name = '';
                  $payment->last_name = '';
                  $payment->class = '';
                  $payment->section = '';
                  $payment->father_name = '';
              }
          
              return $payment->toArray();
          });
          
          return response()->json(['paymentHistoryData' => $paymentHistoryDataArray], 200);
          

        }catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }


    public function MonthlyFeeGenerate(Request $request)
    {
       echo "Hello";
    }

    // public function CollectionMonths(Request $request)
    // {
    //     $year = $request->year;
    //     $month = $request->month;
    //     $day = $request->day;

    //    $CollectionMonths = ReportMonthCollection::where("year",$year)->first();
    //    $todayCollection = PaymentHistory::where('pay_date', 'LIKE', "$year/$month/$day%")->sum('payment');

    //    if($CollectionMonths){
    //      return response(array("CollectionMonths" => $CollectionMonths, "todayCollection" => $todayCollection), 200);
    //    }
    //    else{
    //     return response()->json(['message' => 'Student not found']);
    //    }

    // }

    public function ClassFinance(Request $request)
    {
        try {
            $months = json_decode($request->input('selectmonth'), true);
            $length = count($months) - 1;
            
            // Retrieve current date setting
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

            // Retrieve list of classes and initialize array
            $Classes = Classes::orderBy('Class')->get();
            $classData = [];

            // Start total FeeGenerated
            $feeGenerated = FeeGenerated::where('class_year', $current_year)->get();

            foreach ($feeGenerated as $generate) {
                $class = $generate->class;
                $totalAmount = 0;

                // Assuming $length is defined somewhere in your code
                for ($i = 0; $i <= $length; $i++) {
                    $propertyName = "month_" . $i;
                    $totalAmount += $generate->$propertyName;
                }

                // Update $classData array
                if (!isset($classData[$class])) {
                    $classData[$class] = [
                        'class' => $class,
                        'Generate' => $totalAmount,
                        'Payment' => 0,
                        'Discount' => 0,
                    ];
                } else {
                    $classData[$class]['Generate'] += $totalAmount;
                }
            }
            // End total FeeGenerated

            // Start TotalsClassPayment
            $feePayments = FeePayment::where('class_year', $current_year)->get();

            foreach ($feePayments as $payment) {
                $class = $payment->class;
                $totalAmount = 0;

                for ($i = 0; $i <= $length; $i++) {
                    $propertyName = "month_" . $i;
                    $totalAmount += $payment->$propertyName;
                }

                // Update $classData array
                if (!isset($classData[$class])) {
                    $classData[$class] = [
                        'class' => $class,
                        'Generate' => 0,
                        'Payment' => $totalAmount,
                        'Discount' => 0,
                    ];
                } else {
                    $classData[$class]['Payment'] += $totalAmount;
                }
            }
            // End TotalsClassPayment

            // Start TotalsClassDiscount
            $FeeDiscount = FeeDiscount::where('class_year', $current_year)->get();

            foreach ($FeeDiscount as $discount) {
                $class = $discount->class;
                $totalAmount = 0;

                for ($i = 0; $i <= $length; $i++) {
                    $totalAmount += $discount->{"month_$i"};
                }

                // Update $classData array
                if (!isset($classData[$class])) {
                    $classData[$class] = [
                        'class' => $class,
                        'Generate' => 0,
                        'Payment' => 0,
                        'Discount' => $totalAmount,
                    ];
                } else {
                    $classData[$class]['Discount'] += $totalAmount;
                }
            }
            // End TotalsClassDiscount

            // Calculate total payment, discount, and amount
            $TotalsAllGenerate = 0;
            $TotalsAllPayment = 0;
            $TotalsAllDiscount = 0;

            foreach ($classData as $classInfo) {
                $TotalsAllGenerate += $classInfo['Generate'];
                $TotalsAllPayment += $classInfo['Payment'];
                $TotalsAllDiscount += $classInfo['Discount'];
            }

            // Calculate total amount
            $TotalsAllAmount = $TotalsAllGenerate + $TotalsAllPayment + $TotalsAllDiscount;

            // Create separate variables for total payment, total discount, and total amount
            $totalPayment = $TotalsAllPayment;
            $totalDiscount = $TotalsAllDiscount;
            $totalAmount = $TotalsAllAmount;

            // Remove TotalPayment, TotalDiscount, and TotalAmount from classData
            unset($classData['TotalPayment']);
            unset($classData['TotalDiscount']);
            unset($classData['TotalAmount']);

            // Prepare and return the response
            return response([
                'classData' => array_values($classData),
                'TotalPayment' => $totalPayment,
                'TotalDiscount' => $totalDiscount,
                'TotalAmount' => $totalAmount,
            ], 200);
            


        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function expenseReports(Request $request)
    {
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $Expenses = Expenses:: whereRaw("STR_TO_DATE(expenses_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->orderBy('id', 'desc')->get();
            
            return response(array("data" => $Expenses), 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
        
    }

    public function financialOverview(Request $request)
    {
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $currentYear = $request->currentYear;


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
                $paymentHistories = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])
                ->orderBy('id', 'desc')
                ->get();

            
                $previousYearPaymentsSum = PaymentHistory::where('pay_month', 'Previus Year')->whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('payment');

                // Discount, Dues & Free 
                $collectionDiscount = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('discount');
                $collectionDues = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('dues');
                $collectionFree = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('free_fee');
                $totalException = $collectionDiscount + $collectionDues + $collectionFree;

                $feeTypeTotals = [];

                foreach ($paymentHistories as $paymentHistory) {
                    $particular = $paymentHistory->particular;
                
                    // Assuming the fee structure is a comma-separated string
                    $feeStructureArray = explode(',', $particular);
                
                    foreach ($feeStructureArray as $item) {
                        // Trim whitespace from the item
                        $item = trim($item);
                
                        // Split the item into fee type and amount using the last colon
                        $lastColonPosition = strrpos($item, ':');
                
                        if ($lastColonPosition !== false) {
                            $feeType = trim(substr($item, 0, $lastColonPosition));
                            $amount = (int)trim(substr($item, $lastColonPosition + 1));
                
                            // Update total amounts based on fee type
                            if (!isset($feeTypeTotals[$feeType])) {
                                $feeTypeTotals[$feeType] = $amount;
                            } else {
                                $feeTypeTotals[$feeType] += $amount;
                            }
                        }
                    }
                }
                $CollectionRevenue = array_sum($feeTypeTotals) + $previousYearPaymentsSum - $totalException;
 
                // Calculate the total revenue
                $totalRevenue = PaymentHistory::whereRaw("STR_TO_DATE(pay_date, '%Y-%m-%d') BETWEEN ? AND ?", [$startDate, $endDate])->sum('payment');

                // Transform the result into the desired structure
                $RevenueResult = [];
                foreach ($feeTypeTotals as $feeType => $amount) {
                    $RevenueResult[] = [
                        'feetype' => $feeType,
                        'amount' => $amount,
                    ];
                }
                if($previousYearPaymentsSum != 0){
                    $RevenueResult[] = [
                        'feetype' =>  'Previous Year',
                        'amount' => $previousYearPaymentsSum,
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
                    $revenue = PaymentHistory::whereRaw("YEAR(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$currentYear])
                        ->whereRaw("MONTH(STR_TO_DATE(pay_date, '%Y-%m-%d')) = ?", [$month])
                        ->sum('payment');
                
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
            return response(['Revenue' => $RevenueResult,  'Expenses' =>$ExpensesResult, 'NetProfit' => $netProfit, 'CollectionRevenue'=>$CollectionRevenue, 'FinancialChart'=>$FinancialChart], 200);
            

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
}
