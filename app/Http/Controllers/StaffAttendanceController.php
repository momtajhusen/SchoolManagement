<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employee;
use App\Models\StaffAttendance;
use App\Models\EmployeesSalaries;
use App\Models\bonus_epf_setting;
use App\Models\BonusSsfSetting;
use App\Models\BonusSsfApplyEmp;
use Carbon\Carbon;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getStaffForAttendance(Request $request)
    {
        try {
            $todayDate = $request->date;

            // Convert the string to a Carbon instance
            $date = Carbon::parse($todayDate);
            // Extract year, month, and day
            $AttendencYear = $date->year;
            $AttendencMonth = $date->month;
            $AttendencDay = $date->day;

            $ColumnDay = "day_".$AttendencDay;
            

            $staff = Employee::whereNotIn('department_role', ['Teacher'])->get();


            foreach ($staff as $employee) {
                $StaffAttendance = StaffAttendance::where("emp_id",  $employee->id)
                    ->where("year", $AttendencYear)
                    ->where("month", $AttendencMonth)
                    ->first();

                    $EmployeesSalaries = EmployeesSalaries::where("emp_id", $employee->id)->latest()->first();
                    if ($EmployeesSalaries && $EmployeesSalaries->salary) {
                        $Salary = $EmployeesSalaries->salary;
                    } else {
                        $Salary = 0;
                    }
            
                // Append StaffAttendance to each staff member
                $employee->attendance = $StaffAttendance->$ColumnDay ?? '';
                $employee->Salary = $Salary;
            }
            
            return response(['data' => $staff], 200);
                      

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function SaveStaffAttendance(Request $request)
    {
        try{
            // Retrieve data from the request
            $emp_id = $request->input('emp_id');
            $attendance = $request->input('attendance');
            $todayDate = $request->input('todayDate');
            $totalDayThisMonth = $request->input('totalDayThisMonth');

            // Convert the string to a Carbon instance
            $date = Carbon::parse($todayDate);

            // Extract year, month, and day
            $AttendencYear = $date->year;
            $AttendencMonth = $date->month;
            $AttendencDay = $date->day; 

            $StaffAttendance = StaffAttendance::where("emp_id", $emp_id)
            ->where("year", $AttendencYear)
            ->where("month", $AttendencMonth)
            ->first();

            // Start Get Current Salary 
                $firstDayOfMonth = Carbon::create($AttendencYear, $AttendencMonth, 1);
                $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();
                $EmployeesSalaries = EmployeesSalaries::where("emp_id", $emp_id)
                    ->where('salary_date', '>=', $firstDayOfMonth->toDateString())
                    ->where('salary_date', '<=', $lastDayOfMonth->toDateString())
                    ->first();

                if (!$EmployeesSalaries) {
                    $EmployeesSalaries = EmployeesSalaries::where("emp_id", $emp_id)
                        ->where('salary_date', '<', $firstDayOfMonth->toDateString())
                        ->latest('salary_date')
                        ->first();
                }
                $CurrentSalary = $EmployeesSalaries ? $EmployeesSalaries->salary : 0;
                $PerPerceSalary = (int)($CurrentSalary /  100);
            // End Get Current Salary


            // Applly BonusSsfApplyEmp
            $BonusSsfApplyEmp = BonusSsfApplyEmp::where('emp_id', $emp_id)->first();
            if ($BonusSsfApplyEmp) 
            {
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


            $CulumnName = "day_".$AttendencDay;
            if ($StaffAttendance) {
                // Update existing record
                $StaffAttendance->$CulumnName = $attendance ?? '';
                if($StaffAttendance->save()){

                    // Start Count totalFDP & totalHDP 
                        function calculateTotal($emp_id, $AttendencYear, $AttendencMonth, $type) {
                            $counts = array_map(function ($day) use ($emp_id, $AttendencYear, $AttendencMonth, $type) {
                                $column = "day_$day";
                                return StaffAttendance::where("emp_id", $emp_id)
                                    ->where("year", $AttendencYear)
                                    ->where("month", $AttendencMonth)
                                    ->whereIn($column, [$type])
                                    ->count();
                            }, range(1, 31));

                            return array_sum(array_filter($counts, fn($count) => $count > 0));
                        }
                        $totalFDP = calculateTotal($emp_id, $AttendencYear, $AttendencMonth, 'FDP');
                        $totalHDP = calculateTotal($emp_id, $AttendencYear, $AttendencMonth, 'HDP') / 2;
                        $TotalPersent = $totalFDP + $totalHDP;
                        $percentage = ($TotalPersent / $totalDayThisMonth) * 100;
                        $percentageDifference = 100 - $percentage;
                    // End Count totalFDP & totalHDP 

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
                            } else{
                                $GenerateSalary = (int)($CurrentSalary / $totalDayThisMonth * $TotalPersent);        
                            }
                        }else{
                            $GenerateSalary = (int)($CurrentSalary / $totalDayThisMonth * $TotalPersent);
                        }
                        // SSF Amount (SSF)
                        $GenerateSalaryBonus = $GenerateSalary + $BonusAmount;
                        $ssfAmount = 0;
                        if($ssf == "true"){
                            $ssfAmount = (int)($GenerateSalaryBonus / 100 * $ssf_per);
                        }
                        // Net Pay 
                        $NetPay = (int)($GenerateSalary + $BonusAmount)  - $ssfAmount;
                    
                        $StaffAttendance->attendance = $totalDayThisMonth.'/'.$TotalPersent;
                        $StaffAttendance->percent = $percentage;
                        $StaffAttendance->salary = $CurrentSalary;
                        $StaffAttendance->gen_salary = $GenerateSalaryBonus; 
                        $StaffAttendance->bonus = $BonusAmount;
                        $StaffAttendance->epf = $ssfAmount;
                        $StaffAttendance->net_pay = $NetPay;
                        $StaffAttendance->remaining = $StaffAttendance->net_pay - $StaffAttendance->paid;;
                        $StaffAttendance->save();
                    }
            } else {
                // Create new record
                $TotalPersent = 0;
                if ($attendance == 'FDP'){
                    $TotalPersent += 1;
                }
                if ($attendance == 'HDP'){
                    $TotalPersent += 0.5;
                }
                $percentage = ($TotalPersent / $totalDayThisMonth) * 100;

                $newRecord = new StaffAttendance();
                $newRecord->emp_id = $emp_id;
                $newRecord->year = $AttendencYear;
                $newRecord->month = $AttendencMonth;
                $newRecord->$CulumnName = $attendance;
                $newRecord->attendance = $totalDayThisMonth.'/'.$TotalPersent;
                $newRecord->percent = $percentage; 
                $newRecord->salary = $CurrentSalary; 
                $newRecord->gen_salary = ($CurrentSalary / $totalDayThisMonth * $TotalPersent);
                $newRecord->bonus = 0;
                $newRecord->epf = 0;
                $newRecord->net_pay = ($CurrentSalary / $totalDayThisMonth * $TotalPersent);
                $newRecord->paid = 0;
                $newRecord->remaining = ($CurrentSalary / $totalDayThisMonth * $TotalPersent);
                $newRecord->save();
            }

            // Respond with a JSON message and the attendance data
            return response()->json(['message' => 'Attendance data stored successfully'], 200);


            // Respond with a JSON message and the attendance data
            return response()->json(['message' => 'Attendance data stored successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
        }
    }


    public function getStaffAttendanceReports(Request $request)
    {
        try {
            $attendanceYear = $request->attendanceYear;
            $attendanceMonth = $request->attendanceMonth;
            
            $teachersAttendance = StaffAttendance::where('year', $attendanceYear)
                ->where('month', $attendanceMonth)
                ->get();
            
            foreach ($teachersAttendance as $teacherAttendance) {
                $emp_id = $teacherAttendance->emp_id;
                
                // Retrieve the teacher information
                $Teacher = Employee::where("id", $emp_id)->first();
                // $Teachers = Employee::where('department_role', 'Teacher')->orderBy('first_name')->get();
                
                // Check if the teacher is found before trying to access properties
                if ($Teacher) {
                    // Append TeacherName to the current item in the collection
                    $teacherAttendance->TeacherName = $Teacher->first_name . ' ' . $Teacher->last_name;
                }
            }

            return response(['Data' => $teachersAttendance], Response::HTTP_OK);
            
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
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
