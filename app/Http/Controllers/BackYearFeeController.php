<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\FeePayment;
use App\Models\PaymentHistory;
use App\Models\Student;
use App\Models\SchoolDetails;
use App\Models\Parents;
use App\Models\DateSetting;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;




class BackYearFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function GetBackYearFee(Request $request)
    {
        try {
            $student_id = $request->student_id;

            // date year 
            $dateSetting = DateSetting::first();
            $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

            $this->response = FeePayment::where("st_id", $student_id)->whereNot('class_year', $year)->get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) 
                {
                    array_push($this->allData, $this->data);
                }

                return response(array("YearPaymentFee" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'data not found']);
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
    public $history_response;
    public $Datahistory;
    public $historyData = [];
    public function BillData(Request $request)
    {

        $student_id = $request->student_id;
        $history_id = $request->history_id;

        // date year 
        $dateSetting = DateSetting::first();
        $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

        /////////// Start Retrive PaymentHistory Data ///////////

        $this->response = PaymentHistory::where("id", $history_id)->where("student_id",  $student_id)->get();
        foreach ($this->response as $paymentHistory) {
            // Set new date value for pay_date
            $paymentHistory->pay_date = LaravelNepaliDate::from($paymentHistory->pay_date)->toNepaliDate();
        }

        if (count($this->response) != "0") {
            foreach ($this->response as $this->Datahistory) {
                array_push($this->historyData, $this->Datahistory);
            }
        }

        $Student = Student::where('id', $student_id)->get();

        $SchoolDetails = SchoolDetails::get();

        return response(array("PaymentHistory" => $this->historyData, "Student" => $Student, "SchoolDetails" => $SchoolDetails), 200);

        /////////// End Retrive PaymentHistory Data ///////////
    }

    /**
     * Store a newly created resource in storage.
     */
    public function YearFeeDetails(Request $request)
    {
        $student_id = $request->student_id;
        $back_year = $request->year;

        /////////// Start Retrive PaymentHistory Data ///////////
        $FeeDetails = [];
        $response = PaymentHistory::where("student_id",  $student_id)->where('class_year', $back_year)->get();
        if (count($response) != "0") {
            foreach ($response as $Datahistory) {
                array_push($FeeDetails, $Datahistory);
            }
        }
        /////////// End Retrive PaymentHistory Data ///////////

        return response(array("PaymentHistory" => $FeeDetails), 200);
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
