<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Student;
use App\Models\Parents;
use App\Models\ExamTerm;
use App\Models\ExamTimetable;
use App\Models\ExamStudentMarks;
use App\Models\ExamGrade;
use App\Models\SchoolDetails;







class ExamManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $parent_response;
    public $Exam_Term_Data = [];
    public function index_exam_term()
    {
        try {
            $response = ExamTerm::get();
            if (count($response) != "0") {
                foreach ($response as $data) {
                    array_push($this->Exam_Term_Data, $data);
                }

                return response(array("data" => $this->Exam_Term_Data), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function process_exam_term()
    {
        try {
            $response = ExamTerm::where("result_status", "process")->get();
            if (count($response) != "0") {
                foreach ($response as $data) {
                    array_push($this->Exam_Term_Data, $data);
                }

                return response(array("processTerm" => $this->Exam_Term_Data), 200);
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
    public function create_exam_term(Request $request)
    {
        try {

            $current_year = $request->current_year;

            $exam_name = $request->input("exam_name");


             if(!ExamTerm::where("exam_name", $exam_name)->where("year", $current_year)->first())
             {
                $exam_term = new ExamTerm;
                $exam_term->year  = $current_year;
                $exam_term->exam_name  = $request->input("exam_name");
                $exam_term->description  = $request->input("description") ?? '';
                $exam_term->session  = $request->input("session") ?? '';
    
                if ($exam_term->save()) {
                    return response()->json(['status' => "Add Successfully"]);
                } else {
                    return response()->json(['status' => "Failed Something Error"]);
                }
             }
             else{
                return response()->json(['status' => "Already create this term"]);
             }


        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function examStatus(Request $request)
    {
        $status = $request->status;
        $exam_id = $request->exam_id;

        $ExamTerm = ExamTerm::where("id", $exam_id)->first();
        $ExamTerm->result_status = $status;
        $ExamTerm->save();

        if ($ExamTerm->save()) {
            return response()->json(['status' => "Status Success"]);
        } else {
            return response()->json(['status' => "ExamTerm not Found"]);
        }


    
    }

    public function delete_exam_term(Request $request)
    {
        try {
            $exam_id = $request->exam_id;

            $ExamTerm = ExamTerm::find($exam_id);
            if ($ExamTerm->delete()) {
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

    /**
     * Store a newly created resource in storage.
     */
    public function create_exam_timetable(Request $request)
    {

        try {
            $exam_timetable = new ExamTimetable;
            $exam_timetable->exam = $request->input("exam");
            $exam_timetable->class = $request->input("class");
            $exam_timetable->subject = $request->input("subject");
            $exam_timetable->exam_date = $request->input("exam_date");

            // Format the starting_time and ending_time with AM/PM
            $starting_time = date("h:i A", strtotime($request->input("starting_time")));
            $ending_time = date("h:i A", strtotime($request->input("ending_time")));

            $exam_timetable->starting_time = $starting_time;
            $exam_timetable->ending_time = $ending_time;
            $exam_timetable->room_block = $request->input("room_block");

            if ($exam_timetable->save()) {
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

    /**
     * Display the specified resource.
     */
    public $Exam_Timetable_Data = [];
    public function index_exam_timetable(Request $request)
    {
        try {
            $select_class = $request->class;
            $select_exam = $request->select_exam;

            $response = ExamTimetable::orderBy('exam_date')->where("class", $select_class)->where("exam", $select_exam)->get();
            if (count($response) != "0") {
                foreach ($response as $data) {
                    array_push($this->Exam_Timetable_Data, $data);
                }

                return response(array("data" => $this->Exam_Timetable_Data), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function delete_timetable(Request $request)
    {
        try {
            $timetable_id = $request->timetable_id;

            $ExamTimetable = ExamTimetable::find($timetable_id);
            if ($ExamTimetable->delete()) {
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


    /**
     * Show the form for editing the specified resource.
     */
    public $student_marks;
    public $student_response;
    public function index_studen_mark_entry(Request $request)
    {
        try {

            $current_year = $request->current_year;
            $select_class = $request->select_class;
            $select_section = $request->select_section;
            $select_subject = $request->select_subject;
            $select_exam = $request->select_exam;

            $this->student_response = Student::orderBy('class')->orderBy('roll_no')->where("class", $select_class)->where("section", $select_section)->where("admission_status","admit")->get();

            if (count($this->student_response) != 0) {
                $this->student_marks = ExamStudentMarks::orderBy('class')->where("class", $select_class)->where("section", $select_section)->where("subject", $select_subject)->where("exam", $select_exam)->where("exam_year", $current_year)->get();

                foreach ($this->student_response as $student) {
                    $student->marks_obtained = '';
                    $student->total_marks = '';
                    $student->minimum_marks = '';
                    $student->attendance = '';

                    $student->total_th = 0;
                    $student->total_pr = 0;
                    $student->pass_th = 0;
                    $student->pass_pr = 0;
                    $student->obt_th_mark = 0;
                    $student->obt_pr_mark = 0;
                    $student->grade_name =  '';
                    $student->remark =   '';


                    foreach ($this->student_marks as $marks) {
                        if ($student->id == $marks->st_id) {
                            $student->marks_obtained = $marks->marks_obtained ?? ''; // Assign 0 if marks_obtained is null
                            $student->total_marks = $marks->total_marks ?? ''; // Assign 0 if marks_obtained is null
                            $student->minimum_marks = $marks->minimum_marks ?? ''; // Assign 0 if marks_obtained is null
                            $student->attendance = $marks->attendance ?? '';
                            $student->total_th = $marks->total_th ?? 0;
                            $student->total_pr = $marks->total_pr ?? 0;
                            $student->pass_th = $marks->pass_th ?? 0;
                            $student->pass_pr = $marks->pass_pr ?? 0;
                            $student->obt_th_mark = $marks->obt_th_mark ?? 0;
                            $student->obt_pr_mark = $marks->obt_pr_mark ?? 0;
                            $student->grade_name =  $marks->grade;
                            $student->remark =  $marks->remark;


                            break; // Match found, exit inner loop
                        }
                    }
                }

                return response(array("student_data" => $this->student_response), 200);
            } else {
                return response()->json(['message' => 'Data not found']);
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
    public function entry_mark(Request $request)
    {
        try {
            $current_year = $request->current_year;
            $select_exam = $request->select_exam;
            $class_select = $request->class_select;
            $section_select = $request->section_select;
            $select_subject = $request->select_subject;
    
            $st_id = $request->input('st_id');
            $obt_th_mark = $request->input('obt_th_mark');
            $obt_pr_mark = $request->input('obt_pr_mark');

            $total_th = $request->input('total_th');
            $total_pr = $request->input('total_pr');
            $pass_th = $request->input('pass_th');
            $pass_pr = $request->input('pass_pr');
    
            // Delete existing marks for the specified criteria
            $deletedRows = ExamStudentMarks::where("class", $class_select)
                ->where("section", $section_select)
                ->where("subject", $select_subject)
                ->where("exam", $select_exam)
                ->where("exam_year", $current_year)
                ->delete();
    
            // Insert new marks
            foreach ($obt_th_mark as $key => $value) {


               // Start Theory and Practical Grade 
                    $th_percentage = number_format(($obt_th_mark[$key] / $total_th) * 100, 2);
                    $pr_percentage = number_format(($obt_pr_mark[$key] / $total_pr) * 100, 2);

                    $obt_th_grade =  '';
                    $obt_pr_grade =  '';

                    if ($th_percentage > 0) {
                            if ($th_percentage >= 89 && $th_percentage <= 100) {
                                $obt_th_grade = 'A+';
                            } else {
                                // Fetch the matching grade from the grades table based on the subject percentage
                                $grade = ExamGrade::where('from', '<=', $th_percentage)
                                    ->where('to', '>=', $th_percentage)
                                    ->first();
                                if ($grade) {
                                    $obt_th_grade = $grade->grade_name;
                                }
                            }
                    }

                    if ($pr_percentage > 0) {
                        if ($pr_percentage >= 89 && $pr_percentage <= 100) {
                            $obt_pr_grade = 'A+';
                        } else {
                            // Fetch the matching grade from the grades table based on the subject percentage
                            $grade = ExamGrade::where('from', '<=', $pr_percentage)
                                ->where('to', '>=', $pr_percentage)
                                ->first();
                            if ($grade) {
                                $obt_pr_grade = $grade->grade_name;
                            }
                        }
                    }
               // End Theory and Practical Grade 



                // Start Total Grade
                    $total_subject_mark = $total_th + $total_pr;
                    $obtained_marks = $obt_th_mark[$key] + $obt_pr_mark[$key];

                    $total_obt_percentage = number_format(($obtained_marks / $total_subject_mark) * 100, 2);
 
                        $final_grade_point =  0;
                        $final_grade_name =  '';
                        $final_remarks =  '';

                        if ($total_obt_percentage > 0) {
 
                            // Check if the subject percentage is within the range of 90 to 100
                            if ($total_obt_percentage >= 89 && $total_obt_percentage <= 100) {
                                $final_grade_point = 4.0;
                                $final_grade_name = 'A+';
                                $final_remarks = 'Outstanding';
                            } else {
                                // Fetch the matching grade from the grades table based on the subject percentage
                                $grade = ExamGrade::where('from', '<=', $total_obt_percentage)
                                    ->where('to', '>=', $total_obt_percentage)
                                    ->first();
                                if ($grade) {
                                    $final_grade_point = $grade->grade_point;
                                    $final_grade_name = $grade->grade_name;
                                    $final_remarks = $grade->remarks;
                                }
                            }
                        }
                // End Total Grade Get


                ExamStudentMarks::create([
                    'st_id' => $st_id[$key],
                    'exam' => $select_exam,
                    'class' => $class_select,
                    'section' => $section_select,
                    'subject' => $select_subject,
                    'total_subject_mark' => $total_subject_mark, 
                    'exam_year' => $current_year,
                    'total_th' => $total_th,
                    'total_pr' => $total_pr,
                    'pass_th' => $pass_th,
                    'pass_pr' => $pass_pr,
                    'obt_th_mark' => $obt_th_mark[$key] ?? 0,
                    'obt_pr_mark' => $obt_pr_mark[$key] ?? 0,
                    'obt_th_grade' =>  $obt_th_grade,
                    'obt_pr_grade' =>  $obt_pr_grade,
                    'grade_point' => $final_grade_point,
                    'grade_name' => $final_grade_name,
                    'remark' => $final_remarks,
                ]);
            }
    
            return response()->json(['status' => 'Marks stored successfully!']);
        } catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    


    public $response;
    public $response_school;
    public $data;
    public $allData = [];
    public function index_exam_tabulation(Request $request)
    {
        try {
            // Extract request parameters
            $current_year = $request->current_year;
            $select_class = $request->select_class;
            $select_section = $request->select_section;
            $select_exam = $request->select_exam;
    
            // Retrieve student data and exam marks
            $students = Student::select('id', 'class', 'section', 'first_name', 'last_name', 'student_image')
                ->orderBy('class')
                ->orderBy('roll_no')
                ->where("class", $select_class)
                ->where("section", $select_section)
                ->where("admission_status", "admit")
                ->get();
    
            $exam_marks = ExamStudentMarks::where("class", $select_class)
                ->where("section", $select_section)
                ->where("exam", $select_exam)
                ->where("exam_year", $current_year)
                ->get();
    
            // Check if exam marks are found
            if (count($exam_marks) > 0) {
                // Check if student data is available
                if (count($students) > 0) {
                    $allData = [];
    
                    // Loop through each student
                    foreach ($students as $student) {
                        $marks = ExamStudentMarks::where("exam", $select_exam)
                            ->where("st_id", $student->id)
                            ->orderByRaw("CASE 
                                WHEN subject = 'English' THEN 1
                                WHEN subject = 'Nepali' THEN 2
                                WHEN subject = 'नेपाली' THEN 3
                                WHEN subject = 'Math' THEN 4
                                WHEN subject = 'Mathematics' THEN 5
                                WHEN subject = 'C. Mathematics' THEN 6
                                WHEN subject = 'O.P.t Mathematics' THEN 7
                                WHEN subject = 'Science' THEN 8
                                WHEN subject = 'Social' THEN 9
                                WHEN subject = 'Computer' THEN 10
                                WHEN subject = 'Moral Science' THEN 11
                                WHEN subject = 'G.K' THEN 12
                                WHEN subject = 'Social Stud.' THEN 13
                                WHEN subject = 'Drawing' THEN 14
                                WHEN subject = 'Oral' THEN 15
                                ELSE 16
                                END")
                            ->get();
    
                        // Calculate total marks and sort marks
                        $total_obt_marks = 0;
                        $total_exam_marks = 0;
                        foreach ($marks as $mark) {
                            $total_obt_marks += $mark->obt_th_mark + $mark->obt_pr_mark;
                            $total_exam_marks += $mark->total_th + $mark->total_pr;

                        }

                        $total_obt_percentage = number_format(($total_obt_marks / $total_exam_marks) * 100, 2);
                        if ($total_obt_percentage > 0) {
 
                            // Check if the subject percentage is within the range of 90 to 100
                            if ($total_obt_percentage >= 89 && $total_obt_percentage <= 100) {
                                $student->final_grade_point = 4.0;
                                $student->final_grade_name = 'A+';
                                $student->final_remarks = 'Outstanding';
                            } else {
                                // Fetch the matching grade from the grades table based on the subject percentage
                                $grade = ExamGrade::where('from', '<=', $total_obt_percentage)
                                    ->where('to', '>=', $total_obt_percentage)
                                    ->first();
                                if ($grade) {
                                    $student->final_grade_point = $grade->grade_point;
                                    $student->final_grade_name = $grade->grade_name;
                                    $student->final_remarks = $grade->remarks;
                                }
                            }
                        }
    
                        // Append obtained marks and total marks to student data
                        $student->obtained_marks = $total_obt_marks;
                        $student->exam_marks = $marks;
    
                        // Append student data to allData array
                        $allData[] = $student;
                    }
    
                    // Sort students based on obtained marks in descending order
                    usort($allData, function ($a, $b) {
                        return $b->obtained_marks - $a->obtained_marks;
                    });
    
                    // Add position rank to each student's data
                    foreach ($allData as $rank => $student) {
                        $student->position_rank = $rank + 1;
                    }
    
                    // Prepare response data
                    $responseData = [
                        "data" => $allData,
                        "school_details" => SchoolDetails::first(),
                    ];
    
                    return response()->json($responseData, 200);
                } else {
                    // No student data found
                    return response()->json(['message' => 'Student data not found'], 404);
                }
            } else {
                // No exam marks found
                return response()->json(['message' => 'Exam marks not found'], 404);
            }
        } catch (Exception $e) {
            // Handle exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    


    public function deleteTabulationSubject(Request $request)
    {
        try {

            $subject = $request->subject;
            $exam_year = $request->exam_year;
            $exam = $request->exam;
            $classes = $request->classes;

           $ExamStudentMarks = ExamStudentMarks::where("subject", $subject)->where("exam_year", $exam_year)->where("exam", $exam)->where("class", $classes)->delete();
             if($ExamStudentMarks){
                return response()->json(['message' => 'Delete Sucess']);
             }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    



    public function set_exam_grade(Request $request)
    {

        $ExamGrade = new ExamGrade;
        $ExamGrade->from  = $request->from;
        $ExamGrade->to  = $request->to;
        $ExamGrade->grade_name  = $request->grade_name;
        $ExamGrade->grade_point  = $request->grade_point;
        $ExamGrade->remarks  = $request->remarks;
        $ExamGrade->exam  = $request->exam;


        if ($ExamGrade->save()) {
            return response()->json(['status' => "Add Successfully"]);
        } else {
            return response()->json(['status' => "Failed Something Error"]);
        }
    }

    public $Exam_Grade = [];
    public function index_exam_grade(Request $request)
    {
        try {
            $response = ExamGrade::orderBy('grade_point', 'desc')->get();
            if (count($response) != "0") {
                foreach ($response as $data) {
                    array_push($this->Exam_Grade, $data);
                }

                return response(array("data" => $this->Exam_Grade), 200);
            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function delete_exam_grade(Request $request)
    {
        try {
            $grade_id = $request->grade_id;

            $ExamGrade = ExamGrade::find($grade_id);
            if ($ExamGrade->delete()) {
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

    public function index_admit_card(Request $request)
    {
        try {

            $select_exam = $request->select_exam;
            $select_class = $request->select_class;
            $select_section = $request->select_section;
            $current_year = $request->current_year;

            $this->response = Student::orderBy('class')->orderBy('roll_no')->where("class", $select_class)->where("section", $select_section)->where("admission_status","admit")->get();
            $this->response_school = SchoolDetails::get();

            if (count($this->response) != 0) {
                $ExamTimetable = ExamTimetable::orderBy('exam_date')->where("exam", $select_exam)->where("class", $select_class)->get();

                if (count($ExamTimetable) != 0) {
                    $data = [
                        "studentData" => $this->response,
                        "examTimetableData" => $ExamTimetable,
                        "school" => $this->response_school
                    ];

                    return response()->json($data, 200);
                } else {
                    return response()->json(['status' => "Timetable has not been created for this class"], 200);
                }
            } else {
                return response()->json(['status' => "No students found in this class"], 200);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function ResultAnnoucement(Request $request)
    {
        try {
 

            $current_year = $request->current_year;
            $select_exam = $request->select_exam;
            $position_no = $request->position_no;
            
            // Retrieve the list of students from sections A and B
            $this->response = Student::orderByRaw("CASE 
                WHEN class = 'PG' THEN 1
                WHEN class = 'NURSERY' THEN 2
                WHEN class = 'LKG' THEN 3
                WHEN class = 'UKG' THEN 4
                WHEN class = '1ST' THEN 5
                WHEN class = '2ND' THEN 6
                WHEN class = '3RD' THEN 7
                WHEN class = '4TH' THEN 8
                WHEN class = '5TH' THEN 9
                WHEN class = '6TH' THEN 10
                WHEN class = '7TH' THEN 11
                WHEN class = '8TH' THEN 12
                ELSE 13
                END")
                ->orderBy('section') // Add this line to further sort by section
                ->where("admission_status","admit")
                ->get();
            
            $this->student_marks = ExamStudentMarks::where("exam", $select_exam)
                ->where("exam_year", $current_year)
                ->get();
            
            if (count($this->student_marks) != 0) {
                if (count($this->response) != 0) {
                    $this->allData = [];
            
                    // Create an associative array to separate students by class and section
                    $studentsByClassAndSection = [];
            
                    foreach ($this->response as $this->data) {
                        // Retrieve subject marks for the current student
                        $marks = ExamStudentMarks::where("exam", $select_exam)
                            ->where("st_id", $this->data->id)
                            ->get();
            
                        // Calculate total subject marks for the student
                        $totalSubjectMarks = $marks->sum('marks_obtained');
            
                        // Add total subject marks to the student's data
                        $this->data->total_subject_marks = $totalSubjectMarks;
            
                        // Add the student's data to the allData array
                        array_push($this->allData, $this->data);
            
                        // Separate students by class and section
                        if (!isset($studentsByClassAndSection[$this->data->class])) {
                            $studentsByClassAndSection[$this->data->class] = [];
                        }
            
                        if (!isset($studentsByClassAndSection[$this->data->class][$this->data->section])) {
                            $studentsByClassAndSection[$this->data->class][$this->data->section] = [];
                        }
            
                        $studentsByClassAndSection[$this->data->class][$this->data->section][] = $this->data;
                    }
            
              // Sort students by position rank within each class and section
foreach ($studentsByClassAndSection as $class => $sections) {
    foreach ($sections as $section => $students) {
        // Sort students by total_subject_marks in descending order
        usort($students, function ($a, $b) {
            return $b->total_subject_marks - $a->total_subject_marks;
        });

        // Limit to the top 5 students with the highest total_subject_marks
        $top5Students = array_slice($students, 0, $position_no);

        // Update the sorted students in the $studentsByClassAndSection array
        $studentsByClassAndSection[$class][$section] = $top5Students;
    }
}

        // Reindex the $studentsByClassAndSection array by numerical indices
        $studentsByClassAndSection = array_values($studentsByClassAndSection);

        // Combine the data into a single response array
        $responseData = [
            "data" => $this->allData,
            "school_details" => $this->response_school,
            "students_by_class_and_section" => $studentsByClassAndSection,
        ];
                    
                    // Return the JSON response
                    return response($responseData, 200);
                } else {
                    return response()->json(['message' => 'Data not found']);
                }
            } else {
                return response()->json(['message' => 'Marks not Entry']);
            }
            
            
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


}
