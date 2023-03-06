<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FeeStructure;


class FeeStructureController extends Controller
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

        $this->response = FeeStructure::where('class', $class)->get();
        if(count($this->response) != "0")
        {
            foreach($this->response as $this->data)
            {
                array_push($this->allData,$this->data);
            }   


            
                /////////// Start 12 Month fee Check and Add ///////////
                $MonthTotalFee = array();
                for ($i = 0; $i <= 11; $i++) 
                {
                    $month = 'month_'.$i;
                    $MonthTotalFee[$month] = FeeStructure::where('class', $class)->sum($month);
                }
                /////////// End 12 Month fee Check and Add ///////////


                /////////// Start Selected Total Month Amount and add ///////////
                $totalFees = 0;
                foreach ($MonthTotalFee as $month => $fee) {
                    $totalFees += intval($fee);
                }
                /////////// End Selected Total Month Amount and add ///////////
            
            return response(array("data"=>$this->allData,'MonthTotalFee'=>$MonthTotalFee),200);
        }
        else{
            return response()->json(['message' => 'data not found']); 
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
    
       $class = $request->class;

      //  Update Class Fee After Delete
       if(FeeStructure::where('class', $class)->exists())
       {
            $class_data = FeeStructure::where("class", $class);
            if($class_data->delete())
            {
                $feeTypes = $request->input('fee-type');
                $months = $request->only([
                    'month_0', 'month_1', 'month_2', 'month_3', 'month_4',
                    'month_5', 'month_6', 'month_7', 'month_8', 'month_9',
                    'month_10', 'month_11'
                ]);


                foreach ($feeTypes as $key => $feeType) 
                {
                    $feePayment = new FeeStructure();
                    $feePayment->class = $class;
                    $feePayment->fee_type = $feeType;
                    foreach ($months as $month => $values) {
                        $feePayment->{$month} = $values[$key];
                    }
                    $feePayment->save();
                }
                return response()->json(['message' => 'Update Success']); 
            }
       }

    // New Class Fee Add 
       else{
        $feeTypes = $request->input('fee-type');
        $months = $request->only([
            'month_0', 'month_1', 'month_2', 'month_3', 'month_4',
            'month_5', 'month_6', 'month_7', 'month_8', 'month_9',
            'month_10', 'month_11'
        ]);


        foreach ($feeTypes as $key => $feeType) 
        {
            $feePayment = new FeeStructure();
            $feePayment->class = $class;
            $feePayment->fee_type = $feeType;
            foreach ($months as $month => $values) {
                $feePayment->{$month} = $values[$key];
            }
            $feePayment->save();
        }

        return response()->json(['message' => 'Ceeate Success']); 

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