<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Teacher;
use App\Models\Employee;

use App\Models\TeachersPeriods;
use App\Models\ClassPeriod;
use App\Models\TeacherSubject;
use App\Models\ClassSubjectTimeTable;
use Illuminate\Support\Facades\Schema;



use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\File;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response_teacher;
    public $data;
    public $TeacherData = [];
    public function index()
    {
        try {
            $this->response_teacher = Employee::where('department_role', 'Teacher')->orderBy('first_name')->get();
            if (count($this->response_teacher) != "0") {
                foreach ($this->response_teacher as $this->data) {
                    array_push($this->TeacherData, $this->data);
                }

                return response(array("data" => $this->TeacherData), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function searchTeacher(Request $request){
        try {
            $teacher_search_select = $request->teacher_search_select;
            $teacher_input_search = $request->teacher_input_search;
            
            $teacher_response = Employee::where('department_role', 'Teacher')->query();
            
            if ($teacher_search_select == "first_name") {
                $teacher_response->where($teacher_search_select, 'LIKE', '%' . $teacher_input_search . '%');
            } else {
                $teacher_response->where($teacher_search_select, $teacher_input_search)->orderBy('first_name')->get();
            }
            
            if ($teacher_response->count() !== 0) {
                foreach ($teacher_response->get() as $this->data) {
                    array_push($this->TeacherData, $this->data);
                }
                return response(array("data" => $this->TeacherData), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function getTeacherTimetable(Request $request)
    {
        try {
            $response_teacher = Employee::where('department_role', 'Teacher')->orderBy('first_name')->get();
            $currentDate = now();
            $day = $currentDate->format('l');
            $response = [];
            
            if (count($response_teacher) != 0) {
                foreach ($response_teacher as $teacher) {
                    $teacherId = $teacher->id;
                    $TeacherSubject = TeacherSubject::where("tr_id", $teacherId)->first();
                    $matchingColumns = [];
            
                    if ($TeacherSubject) {
                        $Subject = $TeacherSubject->subject;
                        $Class = $TeacherSubject->class;
                        $columns = Schema::getColumnListing('class_subject_time_tables');
            
                        foreach ($columns as $column) {
                            $result = ClassSubjectTimeTable::where("day",  "Sunday")->where($column, $Subject)->first();
            
                            if ($result) {
                                // Include 'class' and 'section' data in the matchingColumns
                                $matchingColumns[$column] = [
                                    'class' => $result->class,
                                    'section' => $result->section,
                                    'subject' => $Subject,
                                ];
                            }
                        }
                    }
            
                    $teacherInfo = [
                        'first_name' => $teacher->first_name,
                        'last_name' => $teacher->last_name,
                        'gender' => $teacher->gender,
                        'id' => $teacher->id,
                        'teacherPeriods' => $matchingColumns,
                        'totalPeriods' => count($matchingColumns)
                    ];
            
                    $response[] = $teacherInfo;
                }
        
                $classPeriods = ClassPeriod::orderBy('period')->get();
        
                return response(['data' => $response, 'ClassPeriod' => $classPeriods], 200);
            } else {
                return response()->json(['message' => 'No teachers found']);
            }


        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
        
    }
 
    public function store(Request $request)
    {

        try {
            $teacher_image_name = $request->input("teacher_image_name");

            $image_id = time();
            $teacher = new Teacher;
            $teacher->first_name  = $request->input("first_name");
            $teacher->last_name  = $request->input("last_name");
            $teacher->gender  = $request->input("gender");
            $teacher->dob  = $request->input("dob");
            $teacher->religion  = $request->input("religion");
            $teacher->blood_group  = $request->input("blood_group");
            $teacher->address  = $request->input("address");
            $teacher->phone  = $request->input("phone");
            $teacher->email  = $request->input("email");
            $teacher->password  = Str::random(10);
            $teacher->qualification  = $request->input("qualification");
            $teacher->joining_date  = $request->input("joining_date");
            $teacher->salary  = $request->input("salary");
            $teacher->class_teacher  = $request->input("class_teacher");
            $teacher->section  = $request->input("section");

            // Teacher Image Store
            $TeacherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $teacher_image_name . '.jpg';
            $destinationPath = 'storage/upload_assets/teachers/' . "teacher_image_" . $image_id . ".jpg";
            if (!File::exists(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0755, true);
            }
            $teacher->image =   "upload_assets/teachers/teacher_image_" . $image_id . ".jpg";
            File::move($TeacherCropImgPath, $destinationPath);

            if ($teacher->save()) {

                $TeachersPeriods = new TeachersPeriods;
                $TeachersPeriods->tch_id = $teacher->id;
                $TeachersPeriods->teacher_name = $teacher->first_name.' '.$teacher->last_name;
                $TeachersPeriods->period_1 = 0;
                $TeachersPeriods->period_2 = 0;
                $TeachersPeriods->period_3 = 0;
                $TeachersPeriods->period_4 = 0;
                $TeachersPeriods->period_5 = 0;
                $TeachersPeriods->period_6 = 0;
                $TeachersPeriods->period_7 = 0;
                $TeachersPeriods->period_8 = 0;
                $TeachersPeriods->period_9 = 0;
                $TeachersPeriods->period_10 = 0;
                $TeachersPeriods->save();

                return response()->json(['status' => "Add Successfully"]);
            } else {
                return response()->json(['status' => "Failed Something Error"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function show(string $id)
    {


        $teacher = Teacher::find($id);

        if ($teacher) {
            return response()->json(['status' => 'success', 'teacher' => $teacher]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Teacher not found'], 404);
        }
    }
 
    public function assignTeacherSubject(Request $request)
    {
        try {

            $tr_id  = $request->input("teacher");
            $teacher_name  = $request->input("teacher_name");
            $class  = $request->input("class");
            $subject  = $request->input("subject");

            if(!TeacherSubject::where("class", $class)->where("subject", $subject)->first())
            {
                $teacherSubject = new TeacherSubject;
                $teacherSubject->tr_id  = $tr_id;
                $teacherSubject->teacher_name  = $teacher_name;
                $teacherSubject->class  = $class;
                $teacherSubject->subject  = $subject;
   
                if ($teacherSubject->save()) {
                   return response()->json(['status' => "Add Successfully"]);
               } else {
                   return response()->json(['status' => "Failed Something Error"]);
               }
            }
            else{
                $teacher = TeacherSubject::where("class", $class)->where("subject", $subject)->first();
                $teacher_name = $teacher->teacher_name;
                return response()->json(['message' => "this subject already assign ".$teacher_name." Sir"]);
            }



        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function getTeacherSubject(Request $request)
    {
        try {

            $tr_id = $request->tr_id;
            $response = TeacherSubject::where("tr_id", $tr_id)->get();
            if (count($response) != "0") {
                return response(array("data" => $response), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }  

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function deleteTeacherSubject(Request $request)
    {
        try {
            $subject_id = $request->subject_id;

            $Subject = TeacherSubject::find($subject_id);
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

    public function update(Request $request)
    {
        $teacher_image_crope = $request->input("teacher_image_name");
        $teacher_id = $request->teacher_id;


        $Teacher = Teacher::findOrFail($teacher_id);
        $Teacher->forceFill([
            'first_name' =>  $request->input("first_name"),
            'last_name' => $request->input("last_name"),
            'gender' => $request->input("gender"),
            'dob' => $request->input("dob"),
            'religion' => $request->input("religion"),
            'blood_group' => $request->input("blood_group"),
            'address' => $request->input("address"),
            'phone' => $request->input("phone"),
            'email' => $request->input("email"),
            'qualification' => $request->input("qualification"),
            'joining_date' => $request->input("joining_date"),
            'salary' => $request->input("salary"),
            'class_teacher' => $request->input("class_teacher"),
        ]);

        $teacher_image_path = $Teacher->image;
        $teacher_image_name = basename($teacher_image_path);

        $teacher_image = $request->file("image");
        if (!empty($teacher_image)) {
            $teacher_image->storeAs('public/upload_assets/teachers',  $teacher_image_name);

            $StudentCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $teacher_image_crope . '.jpg';
            $destinationPath = 'storage/upload_assets/teachers/' . $teacher_image_name;
            if (!File::exists(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0755, true);
            }
            $Teacher->image = "upload_assets/teachers/" . $teacher_image_name;
            File::move($StudentCropImgPath, $destinationPath);
        }


        if ($Teacher->save()) {

            if(!TeachersPeriods::where("tch_id", $Teacher->id)->first())
            {
                $TeachersPeriods = new TeachersPeriods;
                $TeachersPeriods->tch_id = $Teacher->id;
                $TeachersPeriods->teacher_name = $Teacher->first_name.' '.$Teacher->last_name;
                $TeachersPeriods->period_1 = 0;
                $TeachersPeriods->period_2 = 0;
                $TeachersPeriods->period_3 = 0;
                $TeachersPeriods->period_4 = 0;
                $TeachersPeriods->period_5 = 0;
                $TeachersPeriods->period_6 = 0;
                $TeachersPeriods->period_7 = 0;
                $TeachersPeriods->period_8 = 0;
                $TeachersPeriods->period_9 = 0;
                $TeachersPeriods->period_10 = 0;
                $TeachersPeriods->save();
            }

            return response()->json(['status' => "Update Success"], 200);
        } else {
            return response()->json(['status' => "Update Failed Try Again"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "destroy";
    }
}
