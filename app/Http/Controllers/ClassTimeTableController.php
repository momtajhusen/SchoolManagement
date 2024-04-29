<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\Subject;
use App\Models\ClassPeriod;
use App\Models\ClassSubjectTimeTable;




class ClassTimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addClassPeriod(Request $request) 
    {
        try {
            if (!ClassPeriod::where('period', $request->input("period"))->exists()){
                $ClassPeriod = new ClassPeriod;
                $ClassPeriod->period  = $request->input("period");
                $ClassPeriod->start_time  = $request->input("start_time");
                $ClassPeriod->end_time  = $request->input("end_time");

                if ($ClassPeriod->save()) {
                    return response()->json(['status' => "Period Add Sucess"]);
                }
            } else {
                return response()->json(['status' => "period exists"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function getClassPeriod(Request $request) 
    {
        try {
 
             $ClassPeriod = ClassPeriod::orderBy("period")->get();
    
            if (count($ClassPeriod) != "0") {
                 return response(array("data"=> $ClassPeriod), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function getPeriodSubjects(Request $request) 
    {
        try {
            $select_class = $request->class;
 
             $ClassPeriod = ClassPeriod::orderBy("period")->get();

             $Subject = Subject::where("class", $select_class)->get();
    
            if (count($ClassPeriod) != "0") {
                 return response(array("data"=> $ClassPeriod, "subjects"=> $Subject), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function savePeriodSubjects(Request $request){
        try {

            $data = $request->all();
            $class = $request->input('class');
            $section = $request->input('section');
            $day = $request->input('day');

            // echo $day;

            // return false;

            if (!ClassSubjectTimeTable::where('class', $class)->where('section', $section)->where('day', $day)->exists()) 
            {
                $SubjectTimeTable = new ClassSubjectTimeTable();
                $SubjectTimeTable->class =  $class;
                $SubjectTimeTable->section = $section;
                $SubjectTimeTable->day = $day;
                $periods = $data['period'];
    
                $count = 0;
                for ($i = 1; $i <= 10; $i++) 
                {
                    $index = $count++;
                    $columnName = "period_$i";
                    $SubjectTimeTable->$columnName = $periods[$index] ?? "";
                }
                $SubjectTimeTable->save();
                return response()->json(['message' => 'Data saved successfully']);
            }
            else{
                return response()->json(['message' => 'This day already create this class']);  
            }


            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function getSubjectPeriod(Request $request)
    {
        try {
            $class = $request->class;
            $section = $request->section;
            
            $ClassSubjectTimeTable = ClassSubjectTimeTable::where("class", $class)->where("section", $section)->orderByRaw("FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")->get();
            
            if (count($ClassSubjectTimeTable) != "0") {
                $data = [];
            
                foreach ($ClassSubjectTimeTable as $row) {
                    $class = $row->class;
                    $teacherData = [];
            
                    for ($i = 1; $i <= 10; $i++) 
                    {
                        $periodColumnName = "period_" . $i;
                        $subject = $row->$periodColumnName;
            
                        if (!empty($subject)) {
                            $TeacherSubject = TeacherSubject::where('class', $class)->where('subject', $subject)->first();
            
                            if ($TeacherSubject) {

                                 $Teacher = Teacher::where('id', $TeacherSubject->tr_id)->first();
                                 if($Teacher){

                                    $teacher_name = $Teacher->first_name;
                                    $teacher_gender = $Teacher->gender;

                                    $sir_Mam = ($teacher_gender == "Male") ? "Sir" : "Mam";

                                    $teacherData[$periodColumnName] = $subject;
                                    $teacherData[$periodColumnName . "_teacher"] = $teacher_name.' '.$sir_Mam;
                                 }
                                 else{
                                    $teacherData[$periodColumnName] = $subject;
                                    $teacherData[$periodColumnName . "_teacher"] = "";
                                 }

                            } else {
                                $teacherData[$periodColumnName] = $subject;
                                $teacherData[$periodColumnName . "_teacher"] = "";
                            }
                        }
                    }

                    $data[] = [
                        'class' => $class,
                        'day' => $row->day,
                        'section' => $row->section,
                        'period_data' => $teacherData,
                    ];
                }

                $ClassPeriod = ClassPeriod::orderBy("period")->get();
            
                return response(['data' => $data, 'ClassPeriod' => $ClassPeriod], 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function deletePeriod(Request $request)
    {
        try {
            $period_id = $request->period_id;

            $ClassPeriod = ClassPeriod::find($period_id);
 
            if ($ClassPeriod->delete()) {
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

    public function deleteSubjectPeriod(Request $request)
    {
        try {
            $classes = $request->classes;
            $section = $request->section;
            $subject_period_id = $request->subject_period_id;


            $ClassSubjectTimeTable = ClassSubjectTimeTable::where("class", $classes)->where("section", $section)->where("id", $subject_period_id)->first();
 
            if ($ClassSubjectTimeTable->delete()) {
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
