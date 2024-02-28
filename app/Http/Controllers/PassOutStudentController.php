<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FeePayment;
use App\Models\Student;
use App\Models\PassOutStudent;


class PassOutStudentController extends Controller
{
 
    public function passout(Request $request)
    {
        $class = $request->input('class');
        $studentIds = json_decode($request->input('student'));

        foreach ($studentIds as $studentId) {
            $studentdata = Student::where('class', $class)->whereIn('id', [$studentId])->first();
            if ($studentdata) {

                $studentdata->admission_status = "pass-out";

                if ($studentdata->save()) {
                  echo "Student Passout Success";
                }
                
            }
        }
    }

    public function PassoutYear(Request $request)
    {
        $year =  Student::where("admission_status", "pass-out")->distinct('class_year')->orderBy('class_year', 'desc')->pluck('class_year');

        return response()->json(['YearData' => $year]);
    }

    public function GetPassoutClass(Request $request)
    {
        $select_year = $request->select_year;
        $class =  Student::where("admission_status", "pass-out")->where("class_year", $select_year)->distinct('class')->orderBy('class_year', 'desc')->pluck('class');

        return response()->json(['ClassData' => $class]);
    }

    public function GetPassoutStudent(Request $request)
    {
        $select_year = $request->select_year;
        $select_class = $request->select_class;

        $student =  Student::where("admission_status", "pass-out")->where("class_year", $select_year)->where("class", $select_class)->get();

        $StudentData = [];
        if (count($student) != "0") {
            foreach ($student as $data) {
                array_push($StudentData, $data);
            }

            return response(array("StudentData" => $StudentData), 200);
        }
    }

    public function GetPassoutStudentDetails(Request $request)
    {
        $select_year = $request->select_year;
        $select_class = $request->select_class;
        $student_id = $request->student_id;


        $StudentDetails =  Student::where("admission_status", "pass-out")->where("class_year", $select_year)->where("id", $student_id)->where("class", $select_class)->first();

        /////////// Start Back Year Fee ///////////
        $YearFee = [];
        $YearFeeResponse = FeePayment::where('st_id', $student_id)->orderBy('class_year', 'desc')->get();
        if (count($YearFeeResponse) != "0") {

            foreach ($YearFeeResponse as $data) {
                array_push($YearFee, $data);
            }
        }
        /////////// End Back Year Fee ///////////

        return response(array("StudentDetails" => $StudentDetails, "YearFee" => $YearFee), 200);
    }
 
}