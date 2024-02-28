<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;

use App\Models\LastPaymentForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastDuesForReset;
use App\Models\LastFreeFeeForReset;

use App\Models\PaymentHistory;
 
use Carbon\Carbon;


class ResetPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function resetPayment(Request $request)
    {
        try {
            $student_id = $request->student_id;
            $history_id = $request->history_id;
            $current_class = $request->class_select;

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);


            $reset_student = LastPaymentForReset::where('st_id', $student_id)->first();
            $reset_year =  $reset_student->class_year;
            $reset_class =  $reset_student->class;

            // Back Year Payment Reset 
            if ($current_year != $reset_year) { 
                // LastPaymentStore For ReSet 
                $last_payment = FeePayment::where(['class_year' => $reset_year, 'st_id' => $student_id])->first();

                $last_payment_save = LastPaymentForReset::where(['class' => $reset_class, 'class_year' => $reset_year, 'st_id' => $student_id])->first();

                $feePayment = FeePayment::where('class', $current_class)->where('st_id', $student_id)->where('class_year', $current_year)->first();
                $feePayment->reset_status = "reset";

                for ($i = 0; $i <= 11; $i++) {
                    $last_payment->{"month_$i"} = $last_payment_save->{"month_$i"};
                }

                $last_payment->total_payment = $last_payment_save->total_payment;
                $last_payment->total_fee = $last_payment_save->total_fee;
                $last_payment->total_discount = $last_payment_save->total_discount;
                

                if ($last_payment->save() && $feePayment->save()) {
                    if (PaymentHistory::destroy($history_id)) {
                        echo "Reset Success";
                    }
                } else {
                    echo "Reset Failed";
                }
            }
            // Monthly payment and Multi Payment Reset 
            else {
                // LastPaymentStore For ReSet 
                $last_payment = FeePayment::where(['class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_dues = DuesAmount::where(['class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_discount = FeeDiscount::where(['class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_free = FeeFree::where(['class_year' => $reset_year, 'st_id' => $student_id])->first();


                $last_payment_save = LastPaymentForReset::where(['class' => $reset_class, 'class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_dues_save = LastDuesForReset::where(['class' => $reset_class, 'class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_discount_save = LastDiscountsForReset::where(['class' => $reset_class, 'class_year' => $reset_year, 'st_id' => $student_id])->first();
                $last_free_save = LastFreeFeeForReset::where(['class' => $reset_class, 'class_year' => $reset_year, 'st_id' => $student_id])->first();


                $feePayment = FeePayment::where('class', $reset_class)->where('st_id', $student_id)->where('class_year', $reset_year)->first();
                $feePayment->reset_status = "reset";

                for ($i = 0; $i <= 11; $i++) {
                    $last_payment->{"month_$i"} = $last_payment_save->{"month_$i"};
                    $last_dues->{"month_$i"} = $last_dues_save->{"month_$i"};
                    $last_discount->{"month_$i"} = $last_discount_save->{"month_$i"};
                    $last_free->{"month_$i"} = $last_free_save->{"month_$i"};

                }

                $last_payment->total_payment = $last_payment_save->total_payment;
                $last_payment->total_fee = $last_payment_save->total_fee;
                $last_payment->total_discount = $last_payment_save->total_discount;
                $last_payment->free_fee = $last_payment_save->free_fee;
                $last_payment->total_dues = $last_payment_save->total_dues;

 

                if ($last_payment->save() && $last_dues->save() && $last_discount->save() && $last_free->save() && $feePayment->save()) {
                    if (PaymentHistory::destroy($history_id)) {
                        echo "Reset Success";
                    }
                } else {
                    echo "Reset Failed";
                }
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function resetAllPayment(Request $request)
    {
        try {
            $st_id = $request->st_id;

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

           
            $FeePayment = FeePayment::where(['class_year' => $current_year, 'st_id' => $st_id])->first(); 
            $FeeDiscount = FeeDiscount::where(['class_year' => $current_year, 'st_id' => $st_id])->first(); 
            $DuesAmount = DuesAmount::where(['class_year' => $current_year, 'st_id' => $st_id])->first(); 
            $FeeFree = FeeFree::where(['class_year' => $current_year, 'st_id' => $st_id])->first(); 

            for ($i = 0; $i <= 11; $i++) {
                $FeePayment->{"month_$i"} = null;
                $FeeDiscount->{"month_$i"} = null;
                $DuesAmount->{"month_$i"} = null;
                $FeeFree->{"month_$i"} = null;
            }
            PaymentHistory::where(['class_year' => $current_year,'student_id' => $st_id,])->where('pay_month', '!=', 'Previus Year')->delete();

            $FeePayment->total_discount = 0;
            $FeePayment->total_payment = 0;
            $FeePayment->total_dues = $FeePayment->total_fee;


            $FeePayment->save();
            $FeeDiscount->save();
            $DuesAmount->save();
            $FeeFree->save();

            echo "reset success";

        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
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
