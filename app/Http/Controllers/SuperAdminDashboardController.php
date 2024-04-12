<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\DateSetting;
use App\Models\PaymentHistory;
use App\Models\Expenses;
use App\Models\PrWalletLoadHis;

class SuperAdminDashboardController extends Controller
{
 
    public function index(Request $request)
    {
        try {
            $currentYear = $request->current_year;

            $Male_Student = Student::where("gender", "Male")->count();
            $Female_Student = Student::where("gender", "Female")->count();

            $Total_Student = Student::where('admission_status', 'admit')->count();
            $New_students = Student::whereYear('admission_date', $currentYear)->count();
            $kickout_students = Student::where('admission_status',  'kick-out')->count();



            $Total_Parents = Parents::count();
            $Total_Teacher = Employee::where("department_role", "Teacher")->count();

        
            $TotalExpenses = Expenses::whereRaw("YEAR(STR_TO_DATE(expenses_date, '%Y-%m-%d')) = ?", [$currentYear])->sum('amount');
            $ExpensesHistory = count(Expenses::whereRaw("YEAR(STR_TO_DATE(expenses_date, '%Y-%m-%d')) = ?", [$currentYear])->get());
            

            $TotalHostelDepositeAmount = PrWalletLoadHis::where("load_for", "hostel_deposite")->sum('load_amount');
            $TotalAdvancePaymentAmount = PrWalletLoadHis::where("load_for", "advance_payment")->sum('load_amount');


            return response()->json([
                'kickout_students' => $kickout_students,
                'New_Students' => $New_students,
                'Total_Student' => $Total_Student,
                'Male_Student' => $Male_Student,
                'Female_Student' => $Female_Student,
                'Total_Parents' => $Total_Parents,
                'Total_Teacher' => $Total_Teacher,
                'Total_Expenses' => $TotalExpenses,
                'Expenses_History' => $ExpensesHistory,
                'TotalHostelDepositeAmount' => $TotalHostelDepositeAmount,
                'TotalAdvancePaymentAmount' => $TotalAdvancePaymentAmount,

            ]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    public $historyData = [];
    public function month_earning_data(Request $request)
    {
        // date year 
        $dateSetting = DateSetting::first();
        $select_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);


        $PaymentHistory =  PaymentHistory::where("class_year", $select_year)->get();
        $totalHistory = count($PaymentHistory);

        if (count($PaymentHistory) != 0) {
            $totalPayment = 0;

            $baifee = 0;
            $jesfee = 0;
            $ashfee = 0;
            $shrfee = 0;
            $bhafee = 0;
            $asofee = 0;
            $karfee = 0;
            $manfee = 0;
            $poufee = 0;
            $magfee = 0;
            $falfee = 0;
            $chafee = 0;

            foreach ($PaymentHistory as $dataHistory) {
                $totalPayment += $dataHistory->payment;

                $dateParts = explode('-', $dataHistory->pay_date);

                if ($dateParts[0] == 1) {
                    $baifee += $dataHistory->payment;
                }

                if ($dateParts[0] == 2) {
                    $jesfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 3) {
                    $ashfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 4) {
                    $shrfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 5) {
                    $bhafee += $dataHistory->payment;
                }

                if ($dateParts[0] == 6) {
                    $asofee += $dataHistory->payment;
                }

                if ($dateParts[0] == 7) {
                    $karfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 8) {
                    $manfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 9) {
                    $poufee += $dataHistory->payment;
                }

                if ($dateParts[0] == 10) {
                    $magfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 11) {
                    $falfee += $dataHistory->payment;
                }

                if ($dateParts[0] == 12) {
                    $chafee += $dataHistory->payment;
                }
            }
            return response()->json(['totalpayment' => $totalPayment, 'totalhistory' => $totalHistory, "Bai" => $baifee, "Jes" => $jesfee, "Ash" => $ashfee, "Shr" => $shrfee, "Bha" => $bhafee, "Aso" => $asofee, "Kar" => $karfee, "Man" => $manfee, "Pou" => $poufee, "Mag" => $magfee, "Fal" => $falfee, "Cha" => $chafee]);
        } else {
            return response()->json(['message' => 'No history']);
        }


        // return response(array("PaymentHistory" => $this->historyData), 200);
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
