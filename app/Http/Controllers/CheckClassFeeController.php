<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;



class CheckClassFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index(Request $request)
    {
        $class = $request->class;
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $year = $request->year;
        $student_roll = $request->student_roll;

        
        if($student_roll != ""){
            $this->response = Student::where("class", $class)->where("roll_no",  $student_roll)->where('admission_year', $year)->get();
        }
        else{
            $this->response = Student::where("class", $class)->where('admission_year', $year)->get();
        }


        if(count($this->response) != "0")
        {
 
                ///////////Start This Class All Student Details Data ///////////
                foreach($this->response as $this->data) {
                    array_push($this->allData,$this->data);
                }
                ///////////End  This Class All Student Data ///////////


                /////////// Start 12 Month fee Check and Add ///////////
                $feeData = array();
                for ($i = $start_month; $i <= $end_month; $i++) {
                    $month = 'month_'.$i;
                    $feeData[$month] = FeeStructure::where('class', $class)->sum($month);
                }
                /////////// End 12 Month fee Check and Add ///////////


                /////////// Start Selected Total Month Amount and add ///////////
                $totalFees = 0;
                foreach ($feeData as $month => $fee) {
                    $totalFees += intval($fee);
                }
                /////////// End Selected Total Month Amount and add ///////////


                /////////// Start Fee Type With Amount  ///////////
                $FeeTypeWithAmount = []; 
                $feeTypes = FeeStructure::select('fee_type')
                                ->where('class', $class)
                                ->distinct()
                                ->get()
                                ->pluck('fee_type');

                foreach ($feeTypes as $feeType) {
                    $total = 0;
                    $fee = FeeStructure::where('class', $class)
                            ->where('fee_type', $feeType)
                            ->first();

                    for ($i = $start_month; $i <= $end_month; $i++) {
                        $total += $fee->{'month_'.$i};
                    }

                    $FeeTypeWithAmount[$feeType] = $total;
                }
                /////////// End Fee Type With Amount  ///////////


                /////////// Start Payment Check ///////////
                    $FeePayment = []; 
                    $StudentRolls = FeePayment::select('roll_no')->where('class', $class)->distinct()->get()->pluck('roll_no');

                    foreach ($StudentRolls as $StudentRoll) {
                        $total = 0;
                        $fee = FeePayment::where('class', $class)->where('roll_no', $StudentRoll)->first();

                        for ($i = $start_month; $i <= $end_month; $i++) {
                            $total += $fee->{'month_'.$i};
                        }

                        $FeePayment[$StudentRoll] = $total;
                    }
                /////////// End Payment Check ///////////

                /////////// Start  Dues Check ///////////
                $DuesAmount = []; 
                $DuesRolls = DuesAmount::select('roll_no')->where('class', $class)->distinct()->get()->pluck('roll_no');
                foreach ($DuesRolls as $DuesRoll) 
                {
                    $totalDues = 0;
                    $dues = DuesAmount::where('class', $class)->where('roll_no', $DuesRoll)->first();

                    for ($i =  $start_month; $i <= $end_month-1; $i++) {
                        $totalDues += $dues->{'month_'.$i};
                    }

                    $DuesAmount[$DuesRoll] = $totalDues;
                }
                /////////// End  Dues Check ///////////


                /////////// Start  FeeDiscount Check ///////////
                $FeeDiscount = []; 
                $DiscountRolls = FeeDiscount::select('roll_no')->where('class', $class)->distinct()->get()->pluck('roll_no');
                foreach ($DiscountRolls as $DiscountRoll) 
                {
                    $totalDiscount = 0;
                    $Discount = FeeDiscount::where('class', $class)->where('roll_no', $DiscountRoll)->first();

                    for ($i =  $start_month; $i <= $end_month; $i++) 
                    {
                        $totalDiscount += $Discount->{'month_'.$i};
                    }

                    $FeeDiscount[$DiscountRoll] = $totalDiscount;
                }
                /////////// End  FeeDiscount Check ///////////

 
               return response(array("data"=>$this->allData, 'feeData' => $feeData, "totalFees" => $totalFees,"FeeTypeWithAmount"=>$FeeTypeWithAmount,"FeePayment"=>$FeePayment, "DuesAmount"=>$DuesAmount, "FeeDiscount"=>$FeeDiscount),200);
                
        }
        else{
            return response()->json(['message' => 'Student not found']); 
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        //
    }

    public function studentfee() 
    {
        echo "tudentfee";
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