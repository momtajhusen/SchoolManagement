<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FeePayment;
use App\Models\DuesAmount;


class FeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        //
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
        $totalFee = $request->totalFee;
        $payment = $request->payment;
        $discount = $request->discount;

        $class = $request->class;
        $roll = $request->roll;
        $select_year = $request->select_year;
        $start_month = $request->start_month;
        $end_month = $request->end_month;

        $month = "month_".$end_month;
 
   //  Update Class FeePayment
        if(FeePayment::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->exists())
        {

            $FeePayment = FeePayment::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->first();
            if ($FeePayment) 
            {
            $FeePayment->class = $class;
            $FeePayment->class_year = $select_year;
            $FeePayment->$month = $payment+$discount;
            $FeePayment->save();
            echo "FeePayment Update Success";
            }

            if($payment+$discount == $totalFee)
            {
                if(DuesAmount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->exists())
                {

                }
            }
            else{
                echo "yes_dues :". $totalFee-$payment+$discount;
            }

        }
        else{
            $FeePayment = new FeePayment();
            $FeePayment->class = $class;
            $FeePayment->class_year = $select_year;
            $FeePayment->roll_no = $roll;
            $FeePayment->$month = $payment+$discount;

            $FeePayment->save();
            echo "Insert Sucess";
        }
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
