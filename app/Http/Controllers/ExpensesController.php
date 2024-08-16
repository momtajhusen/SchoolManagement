<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Expenses;
use Exception;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;


class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $ExpensesData = [];
    public function index()
    {

        try {
            $response = Expenses::orderBy('id', 'desc')->get();
            if (count($response) != "0") {
                foreach ($response as $data) {
                    array_push($this->ExpensesData, $data);
                }

                return response(array("data" => $this->ExpensesData), 200);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $expenses = new Expenses;
            $expenses->expenses_name  = $request->input("expenses_name");
            $expenses->expenses_category  = $request->input("expenses_category");
            $expenses->amount  = $request->input("amount");
            $expenses->expenses_date  = LaravelNepaliDate::from($request->input("expenses_date"))->toEnglishDate();


            if ($expenses->save()) {
                return response()->json(['status' => "Expenses Add Sucess"]);
            } else {
                return response()->json(['status' => "Somethings Error"]);
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

        $ex_id = $request->input("ex_id");
        $ex_name = $request->input("expenses_name");
        $ex_category = $request->input("expenses_category");
        $ex_data = LaravelNepaliDate::from($request->input("expenses_date"))->toEnglishDate();
        $ex_amount = $request->input("amount");

        try {
            $expenses = Expenses::findOrFail($ex_id);
            $expenses->forceFill([
                'expenses_name' => $ex_name,
                'expenses_category' => $ex_category,
                'expenses_date' => $ex_data,
                'amount' => $ex_amount,
            ]);
            if ($expenses->save()) {
                return response()->json(['status' => "Expenses Update Success"], 200);
            } else {
                return response()->json(['status' => "Update Failed Try Again"], 500);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $expenses_id =  $request->expenses_id;

            $expenses = Expenses::find($expenses_id);
            if ($expenses->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Expenses not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
