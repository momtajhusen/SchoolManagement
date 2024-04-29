<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\HostelFee;
use App\Models\TuitionFee;
use App\Models\AdmissionFee;



class HostelFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $HostelFee = [];
    public $TuitionFee = [];
    public $AdmissionFee = [];

    public function index()
    {
        try {
            $response_hostel = HostelFee::get();
            $response_tution = TuitionFee::get();
            $response_admission = AdmissionFee::get();

            if (count($response_hostel) != "0") {

                foreach ($response_hostel as $hostel_data) {
                    array_push($this->HostelFee, $hostel_data);
                }

                foreach ($response_tution as $tution_data) {
                    array_push($this->TuitionFee, $tution_data);
                }

                foreach ($response_admission as $admission_data) {
                    array_push($this->AdmissionFee, $admission_data);
                }

                return response(array("hostel_fee" => $this->HostelFee, "tution_fee" => $this->TuitionFee, "admission_fee" => $this->AdmissionFee), 200);
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
    public function create()
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
    public function update(Request $request)
    {
        try {
            $classes = $request->input('class');
            $hostel_fees = $request->input('hostel_fee');
            $tuition_fee = $request->input('tuition_fee');
            $admission_fee = $request->input('admission_fee');

            $hostel = HostelFee::whereIn('class', $classes)->get();
            $tuition = TuitionFee::whereIn('class', $classes)->get();
            $admission = AdmissionFee::whereIn('class', $classes)->get();

            foreach ($hostel as $key => $fee_data) {
                $fee_data->hostel_fee = $hostel_fees[$key];
                $fee_data->save();
            }

            foreach ($tuition as $key => $fee_data) {
                $fee_data->tuition_fee = $tuition_fee[$key];
                $fee_data->save();
            }

            foreach ($admission as $key => $fee_data) {
                $fee_data->admission_fee = $admission_fee[$key];
                $fee_data->save();
            }

            return response()->json(['status' => "Update Sucess !"]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
