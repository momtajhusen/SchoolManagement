<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\PrWalletLoadHis;
use App\Models\PrWalletPayHis;

class ParrentWallet extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loadBlanceSave(Request $request)
    {
        try{

            $parent_id = $request->input("parent_id");

            $loadAmount =  $request->input("amount");
            $loadFor =  $request->input("load_for");
            $loadBy = $request->input("load_by");
            $loadDate = $request->input("load_date");


            $Parents = Parents::where("id", $parent_id)->first();

            if ($loadFor == "advance_payment") {
                $advance_amount = $Parents->advance_amount ?? 0;
                $TotalAdvanceAmount = $advance_amount + $loadAmount;
            
                $Parents->advance_amount = $TotalAdvanceAmount;
            }
            if($loadFor == "hostel_deposite"){
                $hostel_deposite = $Parents->hostel_deposite ?? 0;
                $TotalHostelDeposit = $hostel_deposite + $loadAmount;
            
                $Parents->hostel_deposite = $TotalHostelDeposit;
            }
            

            $PrWalletLoadHis = new PrWalletLoadHis;
            $PrWalletLoadHis->pr_id = $parent_id;
            $PrWalletLoadHis->load_amount = $loadAmount;
            $PrWalletLoadHis->load_for = $loadFor;
            $PrWalletLoadHis->load_by = $loadBy;
            $PrWalletLoadHis->date = $loadDate;

            if($Parents->save() && $PrWalletLoadHis->save()){
                return response()->json(['status' => "load sucess"], 200);
            }
 
        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function walletData(Request $request)
    {
        try{
            $pr_id = $request->pr_id;

            // Check if any rows exist for Hostel Deposite History
            if (PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "hostel_deposite")->exists()) {
                $HostelDepositeHistory = PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "hostel_deposite")->get();
                $TotalHostelDepositeAmount = PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "hostel_deposite")->sum('load_amount'); // Specify the column to sum
            } else {
                $HostelDepositeHistory = [];
                $TotalHostelDepositeAmount = 0;
            }
            
            // Check if any rows exist for Advance Payment History
            if (PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "advance_payment")->exists()) {
                $AdvancePaymentHistory = PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "advance_payment")->get();
                $TotalAdvancePaymentAmount = PrWalletLoadHis::where("pr_id", $pr_id)->where("load_for", "advance_payment")->sum('load_amount'); // Specify the column to sum
            } else {
                $AdvancePaymentHistory = [];
                $TotalAdvancePaymentAmount = 0;
            }
            
            return response()->json([
                'HostelDepositeHistory' => $HostelDepositeHistory,
                'TotalHostelDepositeAmount' => $TotalHostelDepositeAmount,
                'AdvancePaymentHistory' => $AdvancePaymentHistory,
                'TotalAdvancePaymentAmount' => $TotalAdvancePaymentAmount
            ], 200);
            
            
        }
        catch (Exception $e) {
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
