<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FeeStructure;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;




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

        $month = "month_".$end_month-1;
 
      // Update FeePayment
        if(FeePayment::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->exists())
        {

            $FeePayment = FeePayment::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->first();
            if ($FeePayment) 
            {
            $FeePayment->class = $class;
            $FeePayment->class_year = $select_year;
 
            $MonthFeeAmount =  0;
            for ($i = $start_month; $i <= $end_month; $i++) 
            {
                $month = 'month_'.$i;
                $FeePayment->$month =  FeeStructure::where('class', $class)->sum($month);
                $MonthFeeAmount = $MonthFeeAmount + FeeStructure::where('class', $class)->sum($month);
                
                // check if it is the last iteration of the loop
                if ($i == $end_month) {
                    $MonthFeeAmount = $MonthFeeAmount + FeeStructure::where('class', $class)->sum($month);
                    $LastMonth = $totalFee - $payment;

                    $FeePayment->$month = FeeStructure::where('class', $class)->sum($month) - $LastMonth; 
                }
            }

            $FeePayment->save();
            echo "FeePayment Update Success";
            }
            
        }
        // Insert FeePayment
        else{
            $FeePayment = new FeePayment();
            $FeePayment->class = $class;
            $FeePayment->class_year = $select_year;
            $FeePayment->roll_no = $roll;
 
            $MonthFeeAmount =  0;
            for ($i = $start_month; $i <= $end_month; $i++) 
            {
                $month = 'month_'.$i;
                $FeePayment->$month =  FeeStructure::where('class', $class)->sum($month);
                $MonthFeeAmount = $MonthFeeAmount + FeeStructure::where('class', $class)->sum($month);
                
                // check if it is the last iteration of the loop
                if ($i == $end_month) {
                    $MonthFeeAmount = $MonthFeeAmount + FeeStructure::where('class', $class)->sum($month);
                    $LastMonth = $totalFee - $payment;
                    $FeePayment->$month = FeeStructure::where('class', $class)->sum($month) - $LastMonth; 
                }
            }


            $FeePayment->save();
            echo "Insert Sucess";


        }

        // Dues Amount Insert 
          if(DuesAmount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->exists())
          {
              echo "old_yes_dues :". $totalFee-$payment+$discount;

              $FeeDue = DuesAmount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->first();
              $FeeDue->class = $class;
              $FeeDue->class_year = $select_year;
              $FeeDue->roll_no = $roll;

              for ($i = 0; $i <= $end_month; $i++) 
              {
                $month = 'month_'.$i;
                $FeeDue->$month =  "0"; 


                if ($i == $end_month) 
                {
                  if($discount == "0")
                  {
                    $FeeDue->$month = $totalFee - $payment; 
                  }
                  else{
                    $FeeDue->$month =  "0"; 
                  }
                }
              }

              $FeeDue->save();


          }
          else{
              $FeeDue = new DuesAmount();
              $FeeDue->class = $class;
              $FeeDue->class_year = $select_year;
              $FeeDue->roll_no = $roll;

              for ($i = 0; $i <= $end_month; $i++) 
              {
                $month = 'month_'.$i;
                $FeeDue->$month =  "0"; 

                if ($i == $end_month) 
                {
                  if($discount == "0")
                  {
                    $FeeDue->$month = $totalFee - $payment; 
                  }
                  else{
                    $FeeDue->$month =  "0"; 
                  }
                }
              }

              $FeeDue->save();
          }
  

        // Discount Insert 
          if(FeeDiscount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->exists())
          {
  
              // $FeeDiscount = FeeDiscount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->first();
              // $FeeDiscount->class = $class;
              // $FeeDiscount->class_year = $select_year;
              // $FeeDiscount->roll_no = $roll;
               
              // for ($i = 0; $i <= $end_month; $i++) 
              // {
              //   $month = 'month_'.$i;
              //   $FeeDiscount->$month =  "0"; 
  
              //   if ($i == $end_month) 
              //   {
              //     if($discount != "0")
              //     {
              //       $FeeDiscount->$month = $totalFee - $payment; 
              //     }
              //     else{
              //       $FeeDiscount->$month =  "0"; 
              //     }
              //   }
              // }
  
              // $FeeDiscount->save();

              $FeeDiscount = FeeDiscount::where('class', $class)->where('roll_no', $roll)->where('class_year', $select_year)->first();
              $FeeDiscount->class = $class;
              $FeeDiscount->class_year = $select_year;
              $FeeDiscount->roll_no = $roll;
   
              $MonthFeeAmount =  0;
              for ($i = $start_month; $i <= $end_month; $i++) 
              {
                  $month = 'month_'.$i;
                  $FeeDiscount->$month =  FeeDiscount::where('class', $class)->sum($month);
                  $MonthFeeAmount = $MonthFeeAmount + FeeDiscount::where('class', $class)->sum($month);
                  
                  // check if it is the last iteration of the loop
                  if ($i == $end_month) {
                    if($discount != "0")
                    {
                      $FeeDiscount->$month = $totalFee - $payment; 
                    }
                    else{
                      $FeeDiscount->$month =  "0"; 
                    }
                  }
              }
              
              $FeeDiscount->save();
              // echo "Update Sucess";
          }
          else{
              echo "new_yes_dues :". $totalFee-$payment+$discount;
  
              $FeeDiscount = new FeeDiscount();
              $FeeDiscount->class = $class;
              $FeeDiscount->class_year = $select_year;
              $FeeDiscount->roll_no = $roll;
              
              for ($i = 0; $i <= $end_month; $i++) 
              {
                $month = 'month_'.$i;
                $FeeDiscount->$month =  "0"; 
  
                if ($i == $end_month) 
                {
                  if($discount != "0")
                  {
                    $FeeDiscount->$month = $totalFee - $payment; 
                  }
                  else{
                    $FeeDiscount->$month =  "0"; 
                  }
                }
              }
  
              $FeeDiscount->save();  
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