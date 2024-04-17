<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\DateSetting;
use App\Models\Classes;
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;
use App\Models\AdmissionFee;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index()
    {
        try {
            // Retrieve the classes ordered by 'Class' in ascending order
            $this->response = Classes::orderBy('Class')->get();
            
    
            if (count($this->response) !== 0) {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }
    
                return response(array("class" => $this->allData), Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function option_class()
    {
        try {
            $this->response = Classes::distinct()->orderBy('Class')->get(['class']);
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                return response(array("optionClass" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $classes = $request->input("class");
            $section = $request->input("section");

            // date year 
            $dateSetting = DateSetting::first();
            $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

            if (!Classes::where('class', $classes)->where('section', $section)->exists()) {
                $class = new Classes;
                $class->class  = $request->input("class");
                $class->section  = $request->input("section") ?? "";
                $class->class_teacher  = $request->input("class_teacher") ?? "";
                $class->capacity  = $request->input("capacity") ?? "";
                $class->year  = $year;
                $class->location  = $request->input("location") ?? "";

                if($section == "A"){
                    $FeestractureMonthly = new FeestractureMonthly;
                    $FeestractureMonthly->class = $request->input("class");
                    $FeestractureMonthly->tuition_fee = "0";
                    $FeestractureMonthly->full_hostel_fee = "0";
                    $FeestractureMonthly->half_hostel_fee = "0";
                    $FeestractureMonthly->computer_fee = "0";
                    $FeestractureMonthly->coaching_fee = "0";
                    $FeestractureMonthly->save();
    
                    $FeestractureOnetime = new FeestractureOnetime;
                    $FeestractureOnetime->class = $request->input("class");
                    $FeestractureOnetime->admission_fee = "0";
                    $FeestractureOnetime->annual_charge = "0";
                    $FeestractureOnetime->saraswati_puja = "0";
                    $FeestractureOnetime->save();
    
                    $FeestractureQuarterly = new FeestractureQuarterly;
                    $FeestractureQuarterly->class = $request->input("class");
                    $FeestractureQuarterly->exam_fee = "0";
                    $FeestractureQuarterly->save();
                }

                $totalFeeattributes = [
                    'class' => $request->input("class"),
                ];

                if ($class->save()) {
                    return response()->json(['status' => "Add Success"]);
                }
            } else {
                return response()->json(['status' => "exists class"]);
            }
        } catch (Exception $e) {
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
    public function update(Request $request)
    {
        $class_id = $request->input("class_id");
        $classes = $request->input("class");
        $section = $request->input("section");

        // date year 
        $dateSetting = DateSetting::first();
        $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);

        $class = Classes::find($class_id);
        $c_class = $class->class;
        $c_section = $class->section;

        if ($c_class != $classes || $c_section != $section) {
            if (!Classes::where('class', $classes)->where('section', $section)->exists()) {

                $class->class  = $request->input("class");
                $class->section  = $request->input("section") ?? "";
                $class->class_teacher  = $request->input("class_teacher") ?? "";
                $class->capacity  = $request->input("capacity") ?? "";
                $class->start_date  = $request->input("start_date") ?? "";
                $class->end_date  = $request->input("end_date") ?? "";
                $class->year  = $year;
                $class->location  = $request->input("location") ?? "";

                if ($class->save()) {
                    return response()->json(['status' => "Update Success"]);
                }
            } else {
                return response()->json(['status' => "exists class"]);
            }
        } else {
            $class->class  = $request->input("class");
            $class->section  = $request->input("section") ?? "";
            $class->class_teacher  = $request->input("class_teacher") ?? "";
            $class->capacity  = $request->input("capacity") ?? "";
            $class->start_date  = $request->input("start_date") ?? "";
            $class->end_date  = $request->input("end_date") ?? "";
            $class->year  = $year;
            $class->location  = $request->input("location") ?? "";

            if ($class->save()) {
                return response()->json(['status' => "Update Success"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        try {
            $class_id = $request->class_id;

            $Classes = Classes::find($class_id);

            if ($Classes->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Class not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
