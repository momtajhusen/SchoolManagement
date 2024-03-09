<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\FeeStructure;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\DiscountComment;
use App\Models\FeeFree;
use App\Models\Student;


use App\Models\LastPaymentForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastDuesForReset;
use App\Models\LastFreeFeeForReset;

use App\Models\PaymentHistory;
 
use Carbon\Carbon;


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
    public function MonthlyfeeCollect(Request $request)
  {

    if(Student::where('id', $request->student_id)->where("admission_status", "admit")->first())
    {
      $Student = Student::where('id', $request->student_id)->where("admission_status", "admit")->first();
      $class = $Student->class;
      $roll = $Student->roll_no;
      
        $totalFee = $request->totalFee;
        $payment = $request->payment;
        $discount = $request->discount;
        $free_fee = $request->free_fee;  
        $comment_discount = $request->comment_discount;
        $comment_free_fee = $request->comment_free_fee;

        $select_month = $request->select_month;
        $payment_date = $request->payment_date;
        $already_pay = $request->already_pay;
        $already_free = $request->already_free;
        $feeType = $request->feeType;
        $student_id = $request->student_id;

        $totalClassFee = $request->totalClassFee;
        $totalClassPay = $request->totalClassPay;
        $totalClassDis = $request->totalClassDis;
        $totalFreeFee = $request->totalFreeFee;
        $totalClassDue = $request->totalClassDue;

        // date year 
        $dateSetting = DateSetting::first();
        $select_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->select_year ?? null);
    
        // Start LastPaymentStore For ReSet 
        $paymentconditions = ['class_year' => $select_year, 'st_id' => $student_id];
        $last_payment = FeePayment::where($paymentconditions)->first();
        $last_dues = DuesAmount::where($paymentconditions)->first();
        $last_discount = FeeDiscount::where($paymentconditions)->first();
        $last_freefee = FeeFree::where($paymentconditions)->first();

        $resetconditions = ['st_id' => $student_id];
        $last_payment_save = LastPaymentForReset::where($resetconditions)->first();
        $last_dues_save = LastDuesForReset::where($resetconditions)->first();
        $last_discount_save = LastDiscountsForReset::where($resetconditions)->first();
        $last_freefee_save = LastFreeFeeForReset::where($resetconditions)->first();

        for ($i = 0; $i <= 11; $i++) {
          $last_payment_save->{"month_$i"} = $last_payment->{"month_$i"};
          $last_dues_save->{"month_$i"} = $last_dues->{"month_$i"};
          $last_discount_save->{"month_$i"} = $last_discount->{"month_$i"};
          $last_freefee_save->{"month_$i"} = $last_freefee->{"month_$i"};
        }
        $last_payment_save->class = $class;
        $last_payment_save->class_year = $select_year;
        $last_payment_save->total_payment = $last_payment->total_payment;
        $last_payment_save->total_fee = $last_payment->total_fee;
        $last_payment_save->total_discount = $last_payment->total_discount;
        $last_payment_save->free_fee = $last_payment->free_fee;
        $last_payment_save->total_dues = $last_payment->total_dues;


        $last_payment_save->save();
        $last_dues_save->save();
        $last_discount_save->save();
        $last_freefee_save->save();
        // End LastPaymentStore For ReSet 
    
    
        // Payment Insert 
        $feePayment = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $select_year)->first();
        $feePayment->class = $class;
        $feePayment->class_year = $select_year;
        $feePayment->reset_status = "payment";
        $feePayment->$select_month = str_replace(',', '', number_format($payment +  $already_pay, 2));
        $feePayment->total_payment = $totalClassPay + $payment;
        $feePayment->total_fee = $totalClassFee;
        $feePayment->free_fee = $totalFreeFee + $free_fee;
        $feePayment->total_discount = $totalClassDis + $discount;
        $feePayment->total_dues = $totalClassDue - $payment - $free_fee - $discount;
        $feePayment->save();

        // Dues Insert 
        DuesAmount::updateOrCreate(
          ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year],
          ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year, $select_month => $totalFee - $payment - $discount - $free_fee]
        );

          // FeeFree Insert 
          FeeFree::updateOrCreate(
            ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year],
            ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year, $select_month => $free_fee + $already_free]
          );


          // Fee Discount Insert 
          $discountTable = FeeDiscount::where('class', $class)->where('st_id', $student_id)->where('class_year', $select_year)->first();
        if (is_numeric($payment) && is_numeric($already_pay)){
          FeeDiscount::updateOrCreate(
            ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year],
            ['class' => $class, 'st_id' => $student_id, 'class_year' => $select_year, $select_month => str_replace(',', '', number_format($discount+$discountTable->$select_month, 2))]
          );
        }

        $student = Student::where('id', $student_id)->where('class_year', $select_year)->first();


        // Payment History 
        PaymentHistory::create([
          'class' => $class,
          'student_id' => $student_id,
          'class_year' => $select_year,
          'roll_no' => $student->roll_no,
          'particular' => $feeType,
          'pay_month' => $select_month,
          'payment' => $payment,
          'discount' => $discount,
          'free_fee' => $free_fee,
          'comment_discount' => $comment_discount,
          'comment_free_fee' => $comment_free_fee,
          'dues' => $totalFee - $payment - $discount - $free_fee,
          'pay_with' => 'cash counter',
          'pay_date' => $payment_date
        ]);
    }
    else {
      return response()->json(['message' => 'Student not found']);
    }
  }

  public function MultiFeeCollect(Request $request)
  {
    try {
      if(Student::where('id', $request->student_id)->where("admission_status", "admit")->first())
      {
          $Student = Student::where('id', $request->student_id)->where("admission_status", "admit")->first();
          $class = $Student->class;
          $roll = $Student->roll_no;
          
          $totalFee = $request->totalFee;
          $payment = $request->payment;
          $discount = $request->discount;
          $free_fee = $request->free_fee;  
          $comment_free_fee = $request->comment_free_fee;
          $comment_discount = $request->comment_discount;
          $payment_date = $request->payment_date;
          $feeType = $request->feeType;
          $student_id = $request->student_id;
          $totalClassFee = $request->totalClassFee;

          // date year 
          $dateSetting = DateSetting::first();
          $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

          $months = json_decode($request->input('months'));
          $dues = json_decode($request->input('dues'));
          $paid = json_decode($request->input('paid'));
          $paid = is_null($paid) ? "0" : $paid;
          $length = count($months);

          // Discount Calculate on per month months 
          $discAmount = array(); 
          for ($i = 0; $i < $length; $i++) {
              $month_perce = $dues[$i] / $totalFee * 100;
              $get_perce = $month_perce / 100 * $discount;
              
              $discAmount[$months[$i]] = $get_perce; 
          }

          // Free_Fee Calculate on per month months 
          $FreeAmount = array(); 
          for ($i = 0; $i < $length; $i++) {
              $month_free = $dues[$i] / $totalFee * 100;
              $get_free = $month_free / 100 * $free_fee;
              
              $FreeAmount[$months[$i]] = $get_free; 
          }

          ////// Start Student LastPaymentStore For ReSet //////
            $paymentconditions = ['class_year' => $year, 'st_id' => $student_id];
            $last_payment = FeePayment::where($paymentconditions)->first();
            $last_dues = DuesAmount::where($paymentconditions)->first();
            $last_discount = FeeDiscount::where($paymentconditions)->first();
            $last_freefee = FeeFree::where($paymentconditions)->first();

            $resetconditions = ['st_id' => $student_id];
            $last_payment_save = LastPaymentForReset::where($resetconditions)->first();
            $last_dues_save = LastDuesForReset::where($resetconditions)->first();
            $last_discount_save = LastDiscountsForReset::where($resetconditions)->first();
            $last_freefee_save = LastFreeFeeForReset::where($resetconditions)->first();


            for ($i = 0; $i <= 11; $i++) {
              $last_payment_save->{"month_$i"} = $last_payment->{"month_$i"};
              $last_dues_save->{"month_$i"} = $last_dues->{"month_$i"};
              $last_discount_save->{"month_$i"} = $last_discount->{"month_$i"};
              $last_freefee_save->{"month_$i"} = $last_freefee->{"month_$i"};
            }

            $last_payment_save->class = $class;
            $last_payment_save->class_year = $year;
            $last_payment_save->total_payment = $last_payment->total_payment;
            $last_payment_save->total_fee = $last_payment->total_fee;
            $last_payment_save->total_discount = $last_payment->total_discount;
            $last_payment_save->free_fee = $last_payment->free_fee;
            $last_payment_save->total_dues = $last_payment->total_dues;

            
            $last_payment_save->save();
            $last_dues_save->save();
            $last_discount_save->save();
            $last_freefee_save->save();

          ////// End Student LastPaymentStore For ReSet //////

          // Start Multi Payment and Dues Code 
            for ($i = 0; $i < $length; $i++) {

            
              if ($i != $length - 1) {
                if (FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->exists()) 
                {
                      // Payment Update 
                      $feePayment = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                      $feePayment->class = $class;
                      $feePayment->class_year = $year;
                      if($free_fee == 0){
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] + (float)$paid[$i] - (float)$discAmount[$months[$i]] - (float)$FreeAmount[$months[$i]]);
                      }
                      if($free_fee != 0 & $payment != 0){
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] + (float)$paid[$i] - (float)$discAmount[$months[$i]] - (float)$FreeAmount[$months[$i]]);
                      }
                      $feePayment->reset_status = "payment";
                      $feePayment->save();

                  // Dues Update 
                  $DuesAmount = DuesAmount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $DuesAmount->class = $class;
                  $DuesAmount->class_year = $year;
                  $DuesAmount->{$months[$i]} =  0;
                  $DuesAmount->save();
                }
              } 
              // for loop last iteration in else last month payment
              else {
                if ($totalFee > $payment) {
                  $curent_dues = $totalFee - $payment;
                  $feePayment = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $feePayment->class =  $class;
                  $feePayment->class_year = $year;
                  $feePayment->total_discount = $feePayment->total_discount + $discount;
                  $feePayment->free_fee = $feePayment->free_fee + $free_fee;

                  if ($discount != 0) {
                      $TotalPayable = $payment +  $discount;
  
                      if($totalFee == $TotalPayable)
                      {
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] + (float)$paid[$i] - (float)$discAmount[$months[$i]]);
                        echo "With Discount";
                      }
                      else{
                        $DuesWithDisc = $totalFee - $TotalPayable;
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i]  - (float)$discAmount[$months[$i]] -  $DuesWithDisc) ;
                        echo "Discount with dues";
                      }

                  } else {
                      if($free_fee == 0){
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] - $curent_dues + $discount);
                        echo "With  Dues";
                      }
                      if($free_fee != 0 & $payment != 0){
                        $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] + (float)$paid[$i] - (float)$discAmount[$months[$i]] - (float)$FreeAmount[$months[$i]]);
                        echo "Free Payment";
                      }
                  }

                  $feePayment->total_payment = $feePayment->total_payment + str_replace(',', '', $payment);
                  $feePayment->total_fee = $totalClassFee;
                  $feePayment->total_dues =  $totalClassFee - $feePayment->total_payment -  $feePayment->free_fee - $feePayment->total_discount;
                  $feePayment->save();

                  // Dues Update 
                  $DuesAmount = DuesAmount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $DuesAmount->class = $class;
                  $DuesAmount->class_year = $year;
                  $DuesAmount->{$months[$i]} =  $DuesAmount->{$months[$i]} =  $totalFee - $payment - $discount - $free_fee;
                  $DuesAmount->save();
                } else {
                  $feePayment = FeePayment::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $feePayment->class = $class;
                  $feePayment->class_year = $year;
                  $feePayment->{$months[$i]} = str_replace(',', '', (float)$dues[$i] + (float)$paid[$i] - (float)$discAmount[$months[$i]] - (float)$FreeAmount[$months[$i]]);
                  $feePayment->total_payment = $feePayment->total_payment + str_replace(',', '', $payment - $discount - $free_fee);
                  $feePayment->total_fee = $totalClassFee;
                  $feePayment->total_dues =  $totalClassFee - $feePayment->total_payment -  $feePayment->free_fee - $feePayment->total_discount;
                  $feePayment->save();
                  echo "Total Payment";

                  $DuesAmount = DuesAmount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $DuesAmount->class = $class;
                  $DuesAmount->class_year = $year;
                  $DuesAmount->{$months[$i]} =  0;
                  $DuesAmount->save();
                }
              }
            }
          // End Multi Payment and Dues Code 

          // Start Multi FeeDiscount Code
            if ($discount != 0) {
              for ($i = 0; $i < $length; $i++) {
    
                $month_perce = $dues[$i] / $totalFee * 100;
                $get_perce =  $month_perce / 100 * $discount;

                if (FeeDiscount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->exists()) {
                  $FeeDiscount = FeeDiscount::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $FeeDiscount->class = $class;
                  $FeeDiscount->class_year = $year;
                  $FeeDiscount->{$months[$i]} =   (float)$get_perce + $FeeDiscount->{$months[$i]};
                  $FeeDiscount->save();
                } else {
                  $FeeDiscount = new FeeDiscount();
                  $FeeDiscount->class = $class;
                  $FeeDiscount->class_year = $year;
                  $FeeDiscount->{$months[$i]} =   (float)$get_perce + $FeeDiscount->{$months[$i]};
                  $FeeDiscount->save();
                }
              }
            }
          // End Multi FeeDiscount Code

          // Start Multi FreeFee Code
            if ($free_fee != 0) {
              for ($i = 0; $i < $length; $i++) {

                $month_free = $dues[$i] / $totalFee * 100;
                $get_free = $month_free / 100 * $free_fee;

                if (FeeFree::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->exists()) {
                  $FeeFree = FeeFree::where('class', $class)->where('st_id', $student_id)->where('class_year', $year)->first();
                  $FeeFree->class = $class;
                  $FeeFree->class_year = $year;
                  $FeeFree->{$months[$i]} = $get_free;
                  $FeeFree->save();
                } else {
                  $FeeFree = new FeeFree();
                  $FeeFree->class = $class;
                  $FeeFree->class_year = $year;
                  $FeeFree->{$months[$i]} = $get_free;
                  $FeeFree->save();
                }
              }
            }
          // End Multi FreeFee Code


        $student = Student::where('id', $student_id)->where('class_year', $year)->first();

        // Start Payment History 
          $PaymentHistory = new PaymentHistory();
          $PaymentHistory->student_id = $student_id;
          $PaymentHistory->class = $class;
          $PaymentHistory->class_year = $year;
          $PaymentHistory->roll_no =  $student->roll_no;
          $PaymentHistory->particular =  $feeType;
          $PaymentHistory->pay_month =   $request->input('months');
          $PaymentHistory->payment =  str_replace(',', '', number_format($payment, 2));
          $PaymentHistory->discount =  str_replace(',', '', number_format($discount, 2));
          $PaymentHistory->free_fee =  str_replace(',', '', number_format($free_fee, 2));
          $PaymentHistory->comment_free_fee = $comment_free_fee;
          $PaymentHistory->comment_discount = $comment_discount;
          $PaymentHistory->dues =  str_replace(',', '', number_format($totalFee - $payment - $discount - $free_fee, 2));
          $PaymentHistory->pay_with =  "cash counter";
          $PaymentHistory->pay_date =  $payment_date;
          $PaymentHistory->save();
        // Start Payment History 

      }
      else {
        return response()->json(['message' => 'Student not found']);
      }

    } catch (Exception $e) {
      // Code to handle the exception
      $message = "An exception occurred at line " . $e->getLine() . ": " . $e->getMessage();
      return response()->json(['ErrorMessage' => $message], 500);
  }
  
  }

  /**
   * Display the specified resource.
   */
  public function LastYearFeeCollect(Request $request)
  {
    try {
      if(Student::where('id', $request->student_select)->where("admission_status", "admit")->first())
      {
          $Student = Student::where('id', $request->student_select)->where("admission_status", "admit")->first();
          $class = $Student->class;
          $roll = $Student->roll_no;

          $student_id = $request->student_select;
          $actual_dues_year = $request->actual_dues_year;
          $payment_year = $request->payment_year;
          $payment_date = $request->payment_date;
          $dues_year = $request->dues_year;

          // date year 
          $dateSetting = DateSetting::first();
          $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);



          $feePayment = FeePayment::where('st_id', $student_id)->where('class_year', $dues_year)->first();
          $dues_class = $feePayment->class;



          // Start LastPaymentStore For ReSet 
          $paymentconditions = ['class_year' => $dues_year, 'st_id' => $student_id];
          $last_payment = FeePayment::where($paymentconditions)->first();

          $resetconditions = ['st_id' => $student_id];
          $last_payment_save = LastPaymentForReset::where($resetconditions)->first();


          for ($i = 0; $i <= 11; $i++) {
            $last_payment_save->{"month_$i"} = $last_payment->{"month_$i"};
          }
          $last_payment_save->class = $dues_class;
          $last_payment_save->class_year = $dues_year;
          $last_payment_save->total_payment = $last_payment->total_payment;
          $last_payment_save->total_fee = $last_payment->total_fee;
          $last_payment_save->total_discount = $last_payment->total_discount;
          $last_payment_save->save();

          // End LastPaymentStore For ReSet 


          $feePayment = FeePayment::where('st_id', $student_id)->where('class_year', $dues_year)->first();
          $total_pay = $feePayment->total_payment + $payment_year;
          $feePayment->total_payment = $total_pay;
          $feePayment->total_dues =  $feePayment->total_fee - $total_pay;

          $feePayment->save();


          $currentPayment = FeePayment::where('st_id', $student_id)->where('class_year', $current_year)->first();
          $currentPayment->reset_status = "payment";
          $currentPayment->save();


          // Payment History 
          PaymentHistory::create([
            'class' => $dues_class,
            'student_id' => $student_id,
            'class_year' => $dues_year,
            'roll_no' => $feePayment->roll_no,
            'particular' =>  "Previus Year",
            'pay_month' =>  "Previus Year",
            'payment' => $payment_year,
            'discount' =>  0,
            'dues' => $actual_dues_year - $payment_year,
            'pay_with' => 'cash counter',
            'pay_date' => $payment_date,
          ]);


          echo "Update Sucess";
      }
      else {
        return response()->json(['message' => 'Student not found']);
      }
    } catch (Exception $e) {
      // Code to handle the exception
      $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
      return response()->json(['status' => $message], 500);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
 
  


  public function BackyearManualDues(Request $request)
{
    try {
        $totalFee = $request->input('total');
        $payment = $request->input('payment');
        $discount = $request->input('discount');
        $free_fee = $request->input('free_fee');
        $dues = $request->input('dues');
        $year = $request->input('year'); 
        $class = $request->input('class'); 


        $st_id = $request->input('st_id');

        // Checking if the fee payment row exists for the student, year, and class
        $payment_year = FeePayment::where('st_id', $st_id)->where('class_year', $year)->first();

        // Updating payment details
        if ($payment_year) {
            if (!empty($totalFee)) {
                $payment_year->total_fee = $totalFee;
            }
            if (!empty($payment)) {
                $payment_year->total_payment = $payment;
            }
            if (!empty($discount)) {
                $payment_year->total_discount = $discount;
            }
            if (!empty($dues)) {
                $payment_year->total_dues = $dues;
            }
            if (!empty($free_fee)) {
                $payment_year->free_fee = '0';
            }
            
            if ($payment_year->save()) {
                echo "update success";
            }
        } else {
            // Create new payment entry for the student
            $newPaymentYear = new FeePayment();
            $newPaymentYear->st_id = $st_id;
            $newPaymentYear->class_year = $year;
            $newPaymentYear->class = $class;
            if (!empty($totalFee)) {
                $newPaymentYear->total_fee = $totalFee;
            }
            if (!empty($payment)) {
                $newPaymentYear->total_payment = $payment;
            }
            if (!empty($discount)) {
                $newPaymentYear->total_discount = $discount;
            }
            if (!empty($dues)) {
                $newPaymentYear->total_dues = $dues;
            }
            if (!empty($free_fee)) {
                $newPaymentYear->free_fee = '0';
            }
            if ($newPaymentYear->save()) {
                echo "New payment entry created successfully";
            }
        }
    } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
    }
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
