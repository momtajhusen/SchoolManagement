<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Subject;

use Exception;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index(Request $request)
    {
        try {
            $select_class = $request->class;

            $this->response = Subject::where("class", $select_class)->get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                return response(array("data" => $this->allData), 200);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (!Subject::where('class', $request->input("class"))->where('subject_name', $request->input("subject_name"))->exists()) {
                $subject = new Subject;
                $subject->class  = $request->input("class");
                $subject->subject_name  = $request->input("subject_name");
                $subject->subject_teacher  = $request->input("subject_teacher");
                $subject->subject_code  = $request->input("subject_code");

                if ($subject->save()) {
                    return response()->json(['status' => "Subject Add Sucess"]);
                }
            } else {
                return response()->json(['status' => "exists subject"]);
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
    public function update(Request $request)
    {
        $subject_id = $request->subject_id;
        $subject_name = $request->subject_name;
        $class_name = $request->class_name;
        $subject_teacher = $request->subject_teacher;
        $subject_code = $request->subject_code;

        try {
            $subject = Subject::findOrFail($subject_id);
            $subject->forceFill([
                'subject_name' => $subject_name,
                'subject_teacher' => $subject_teacher,
                'subject_code' => $subject_code,
                'class' => $class_name, // use $class_name directly here
            ]);
            if ($subject->save()) {
                return response()->json(['status' => "Update Success"], 200);
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
            $subject_id = $request->subject_id;

            $Subject = Subject::find($subject_id);
            if ($Subject->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Subject not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
            
        }
    }
}
