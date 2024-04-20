<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\EmployeesSalaries;
use App\Models\BonusSsfSetting;
use App\Models\BonusSsfApplyEmp;
use App\Models\TeachersPeriods;
use App\Models\TeacherSubject;
use App\Models\ClassPeriod;
use App\Models\ClassSubjectTimeTable;
use App\Models\TeachersAttendance;
use App\Models\TeacherMonthsAttendance;


class TeachersAttendanceController extends Controller
{
 
    public function getTeacherForPeriod(Request $request)
    {
        try {

           $Teacher = Employee::where('department_role', 'Teacher')->orderBy('first_name')->where('admit_status', 'admit')->get();
           $ClassPeriods = ClassPeriod::get();

           $TeachersPeriods = TeachersPeriods::orderBy('teacher_name')->get();

           return response(array("TeachersPeriods"=>$TeachersPeriods, "Teachers" => $Teacher, "ClassPeriods"=>$ClassPeriods), 200);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function updateTeacherPeriod(Request $request)
    {
        try{
            // Assuming request data is sent as an array
            $requestData = $request->all();

            // echo $requestData;

        
            // Extract the teacher ID from the request data
            $teacherId = $requestData['tch_id'];
        
            // Extract only the relevant columns (pr_1 to pr_10) from the request data
            $prData = array_intersect_key($requestData, array_flip(['period_1', 'period_2', 'period_3', 'period_4', 'period_5', 'period_6', 'period_7', 'period_8', 'period_9', 'period_10']));

        
            // Update the TeachersPeriods table for the given teacher ID
            TeachersPeriods::where('tch_id', $teacherId)->update($prData);
        
            // You can return a response or perform other actions as needed
            return response()->json(['message' => 'Teacher periods updated successfully']);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function getTeacherAttendancePeriod(Request $request)
    {
        try {

            $year = $request->year;
            $date = $request->date;


            $TeachersPeriods = TeachersPeriods::orderBy('teacher_name')->get();

            if (count($TeachersPeriods) != 0) {
                $response = [];
            
                foreach ($TeachersPeriods as $teacher) {
                    $TeacherData = Employee::where("id", $teacher->tch_id)->where('admit_status', 'admit')->first();
                     if($TeacherData){
                        $first_name = $TeacherData->first_name;
                        $gender = $TeacherData->gender;
                        $teacher_image = $TeacherData->image;
                        $id = $TeacherData->id;
                     }
                   



                    $TeachersAttendance = TeachersAttendance::where("tr_id", $id)->where("date", $date)->first();

                    $EmployeesSalaries = EmployeesSalaries::where("emp_id", $id)->latest()->first();
                    if ($EmployeesSalaries && $EmployeesSalaries->salary) {
                        $Salary = $EmployeesSalaries->salary;
                    } else {
                        $Salary = 0;
                    }
                    
                    $teacherPeriod = [];
                    $PeriodAttendance = [];
                    // Assuming pr_1 to pr_10 are the column names
                    for ($i = 1; $i <= 10; $i++) {
                        $columnName = "period_" . $i;
            
                        // Check if the value in the column is 1
                        if ($teacher->$columnName == 1) {
                            $teacherPeriod[] = $columnName;


                             if($TeachersAttendance){
                                $PeriodAttendance[] =  $TeachersAttendance->$columnName;
                             }

                        }

                    }
            
                    $response[] = [
                        'id' => $id,
                        'first_name' => $first_name,
                        'gender' => $gender,
                        'teacher_image' => $teacher_image,
                        'teacherPeriods' => $teacherPeriod,
                        'PeriodAttendance' => $PeriodAttendance,
                        'Salary' => $Salary,
                    ];
                }
            
                return response(['data' => $response], 200);
            } else {
                return response()->json(['message' => 'No teachers period data found']);
            }
            
            
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function SaveTeachersAttendance(Request $request)
    {
        try {
               // Validate the request data
                $this->validate($request, [
                    'tr_id' => 'required',
                    'total_period' => 'required',
                    'total_present' => 'required',
                    'total_absent' => 'required',
                    'todayDate' => 'required',
                    'totalDayThisMonth' => 'required',
                ]);

                // Retrieve data from the request
                $tr_id = $request->input('tr_id');
                $totalPeriod = $request->input('total_period');
                $totalPresent = $request->input('total_present');
                $totalAbsent = $request->input('total_absent');
                $todayDate = $request->input('todayDate');
                $totalDayThisMonth = $request->input('totalDayThisMonth');


                // Convert the string to a Carbon instance
                $date = Carbon::parse($todayDate);

                // Extract year, month, and day
                $AttendencYear = $date->year;
                $AttendencMonth = $date->month;
                $AttendencDay = $date->day; 

                // Individual period values
                $periods = [];
                for ($i = 1; $i <= 10; $i++) {
                    $periods["period_$i"] = $request->input("period_$i");
                }

                // Create or update the record in the teachers_attendances table
                TeachersAttendance::updateOrCreate(
                    ['tr_id' => $tr_id, 'year' => $AttendencYear, 'date' => $todayDate],
                    array_merge($periods, [
                        'total_period' => $totalPeriod,
                        'total_present' => $totalPresent,
                        'total_absent' => $totalAbsent,
                    ])
                );

 
            $TeacherMonthsAttendance = TeacherMonthsAttendance::where("emp_id", $tr_id)
            ->where("year", $AttendencYear)
            ->where("month", $AttendencMonth)
            ->first();

            // Teacher Salary 
                $firstDayOfMonth = Carbon::create($AttendencYear, $AttendencMonth, 1);
                $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
                $EmployeesSalaries = EmployeesSalaries::where("emp_id", $tr_id)
                    ->where('salary_date', '>=', $firstDayOfMonth->toDateString())
                    ->where('salary_date', '<=', $lastDayOfMonth->toDateString())
                    ->first();
                if (!$EmployeesSalaries) {
                    $EmployeesSalaries = EmployeesSalaries::where("emp_id", $tr_id)
                        ->where('salary_date', '<', $firstDayOfMonth->toDateString())
                        ->latest('salary_date')
                        ->first();
                }
                $CurrentSalary = $EmployeesSalaries ? $EmployeesSalaries->salary : 0;
                $PerPerceSalary = (int)($CurrentSalary /  100);

                // Applly BonusSsfApplyEmp
                $BonusSsfApplyEmp = BonusSsfApplyEmp::where('emp_id', $tr_id)->first();
                if ($BonusSsfApplyEmp) {
                    $ssf = $BonusSsfApplyEmp->ssf;
                    $ba = $BonusSsfApplyEmp->ba;
                    $ls = $BonusSsfApplyEmp->ls;
                }else{
                    $ssf = 'false';
                    $ba = 'false';
                    $ls = 'false'; 
                }

            // BonusSsfSetting Setting 
                $BonusSsfSetting = BonusSsfSetting::first();
                $ssf_per = $BonusSsfSetting->ssf_per;
                $bouns_attend =  $BonusSsfSetting->bouns_attend;
                $bouns_per = $BonusSsfSetting->bouns_per;
                $leave_per = $BonusSsfSetting->leave_per;
                $leave_salary = $BonusSsfSetting->leave_salary;


                $AllDayTotalPeriod = $totalDayThisMonth * $totalPeriod;
                $AllDayTotalPresent = TeachersAttendance::where("tr_id", $tr_id)
                ->where('date', 'LIKE', $AttendencYear.'-'.$AttendencMonth.'%')
                ->sum('total_present');

                $percentage = ($AllDayTotalPresent / $AllDayTotalPeriod) * 100;
                $percentageDifference = 100 - $percentage;

                //Get Bonus amount  (BS)
                $BonusAmount = 0;
                if($ba == "true"){
                    if ($percentage == $bouns_attend) {
                        $BonusAmount = (int)$PerPerceSalary * $bouns_per;
                    }
                }
                // Generate Salary On Whith (LS)
                if($ls == "true"){
                    if ($percentageDifference <= $leave_per) {
                        $GenerateSalary = (int)$CurrentSalary;
                    }
                    else{
                        $GenerateSalary = (int)($CurrentSalary / $AllDayTotalPeriod * $AllDayTotalPresent);        
                    }
                }
                else{
                    $GenerateSalary = (int)($CurrentSalary / $AllDayTotalPeriod * $AllDayTotalPresent);
                }

                // SSF Amount (SSF)
                $GenerateSalaryBonus = (int)$GenerateSalary + $BonusAmount;

                $ssfAmount = 0;
                if($ssf == "true"){
                    $ssfAmount = (int)($GenerateSalaryBonus / 100 * $ssf_per);
                }

                // Net Pay 
                $NetPay = (int)($GenerateSalary + $BonusAmount) - $ssfAmount;
                        
                $CulumnName = "day_".$AttendencDay;
                if ($TeacherMonthsAttendance) {
                    // Update existing record
                    $TeacherMonthsAttendance->$CulumnName = $totalPeriod.'/'.$totalPresent ?? '';
                    $TeacherMonthsAttendance->attendance = $AllDayTotalPeriod.'/'.$AllDayTotalPresent;
                    $TeacherMonthsAttendance->percent = $percentage;
                    $TeacherMonthsAttendance->salary = $CurrentSalary;
                    $TeacherMonthsAttendance->gen_salary = $GenerateSalary;
                    $TeacherMonthsAttendance->bonus = $BonusAmount;
                    $TeacherMonthsAttendance->epf = $ssfAmount;
                    $TeacherMonthsAttendance->net_pay = $NetPay;
                    $TeacherMonthsAttendance->remaining = $TeacherMonthsAttendance->net_pay - $TeacherMonthsAttendance->paid;
                    $TeacherMonthsAttendance->save();
                } else {
                    // Create new record
                    $newRecord = new TeacherMonthsAttendance();
                    $newRecord->emp_id = $tr_id;
                    $newRecord->year = $AttendencYear;
                    $newRecord->month = $AttendencMonth;
                    $newRecord->$CulumnName = $totalPeriod.'/'.$totalPresent ?? '';
                    $newRecord->attendance = $AllDayTotalPeriod.'/'.$totalPresent ?? '';
                    $newRecord->percent = $percentage;
                    $newRecord->salary = $CurrentSalary;
                    $newRecord->gen_salary = $GenerateSalary;
                    $newRecord->bonus = $BonusAmount;
                    $newRecord->epf = $ssfAmount;
                    $newRecord->net_pay = $NetPay;
                    $newRecord->paid = 0;
                    $newRecord->remaining = $NetPay;
                    $newRecord->save();
                }
            
                // Respond with a JSON message and the attendance data
                return response()->json(['message' => 'Attendance data stored successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
        }
    }
 
    public function getTeacherAttendanceReports(Request $request)
    {
        try {
            $attendanceYear = $request->attendanceYear;
            $attendanceMonth = $request->attendanceMonth;
            
            $teachersAttendance = TeacherMonthsAttendance::where('year', $attendanceYear)
                ->where('month', $attendanceMonth)
                ->get();
            
            foreach ($teachersAttendance as $teacherAttendance) {
                $emp_id = $teacherAttendance->emp_id;
                
                // Retrieve the teacher information
                $Teacher = Employee::where("id", $emp_id)->where('admit_status', 'admit')->first();
                // $Teachers = Employee::where('department_role', 'Teacher')->orderBy('first_name')->get();
                
                // Check if the teacher is found before trying to access properties
                if ($Teacher) 
                {
                    // Append TeacherName to the current item in the collection
                    $teacherAttendance->TeacherName = $Teacher->first_name . ' ' . $Teacher->last_name;
                }
            }
         
            return response(['Data' => $teachersAttendance], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
        }
    }
 
    public function teacherProfileAttendanceReport(Request $request)
    {
        try {
            $emp_id = $request->tr_id;
            $attendanceYear = $request->attendanceYear;
            $attendanceMonth = $request->attendanceMonth;

            $TeachersAttendance = TeachersAttendance::where("tr_id", $emp_id)
            ->where('date', 'LIKE', $attendanceYear.'-'.$attendanceMonth.'%')
            ->orderBy('date', 'desc')
            ->get();        

 
            $TeacherMonthsAttendance = TeacherMonthsAttendance::where("emp_id", $emp_id)->where('year', $attendanceYear)
            ->where('month', $attendanceMonth)
            ->first();
 
                $totalMonthPeriod = $TeacherMonthsAttendance->periods;
                $totalMonthPercent = $TeacherMonthsAttendance->percent;
 
            

            $responseData = [];
            foreach ($TeachersAttendance as $Attendance) {
                $recordData = [];

                for ($i = 1; $i <= 10; $i++) {
                    $columnName = "period_" . $i;

                    $TeachersPeriods = TeachersPeriods::where('tch_id', $tr_id)->first();

                    // Check if the value in the column is 1
                    $ClassPeriods = ClassPeriod::where("period", $columnName)->first();
                    if ($TeachersPeriods && $ClassPeriods && $TeachersPeriods->$columnName == 1) {

 
                        $recordData[] = [
                            'periodName' => $columnName,
                            'periodAttendance' => $Attendance->$columnName,
                            'periodTime' => $ClassPeriods->start_time,
                            'date' => $Attendance->date,
                        ];
                    }
                }
 
                $responseData[] = $recordData;
 
            }

            return response(['data' => $responseData, 'totalMonthPeriod' => $totalMonthPeriod, 'totalMonthPercent' => $totalMonthPercent,], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
        }

    }

  
}
