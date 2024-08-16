<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\SchoolDetails;
use App\Models\EmployeesSalaries;
use App\Models\TeacherMonthsAttendance;
use App\Models\StaffAttendance;
use App\Models\EmployeesSalariesPaymentHistories;
use App\Models\BonusSsfSetting;
use App\Models\BonusSsfApplyEmp;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;


class EmployeesSalariesController extends Controller
{
    public function AddSalary(Request $request)
    {
        try {

            $EmployeesSalaries = new EmployeesSalaries;
            $EmployeesSalaries->emp_id  = $request->input("all-employee");
            $EmployeesSalaries->salary  = $request->input("salary_amount");
            $EmployeesSalaries->salary_date  = LaravelNepaliDate::from($request->input("salary_join_date"))->toEnglishDate();

            if ($EmployeesSalaries->save()) {
                return response()->json(['status' => "Salary Add Sucess"]);
            } else {
                return response()->json(['status' => "Somethings Error"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function GetSalary(Request $request)
    {
        try {
            $emp_id = $request->emp_id;
            $EmployeesSalaries = EmployeesSalaries::where("emp_id", $emp_id)->orderBy('salary_date', 'desc')->get();
            if (count($EmployeesSalaries) != "0") {

                // return response(array("data" => $EmployeesSalaries), 200);
                return response()->json(['data' => $EmployeesSalaries]);

            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function GetGenerateSalary(Request $request)
    {
        try {
            $attendanceYear = $request->attendanceYear;
            $attendanceMonth = $request->attendanceMonth;
            $currentdate = $request->currentdate;
            $teacherSelect = $request->teacherSelect;

            //// Start Update Attendance with Setting 

            TeacherMonthsAttendance::where('percent', '0')->delete();
            StaffAttendance::where('percent', '0')->delete();


              // Applly BonusSsfApplyEmp
                $BonusSsfApplyEmp = BonusSsfApplyEmp::where('emp_id', $teacherSelect)->first();
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

                $department_role = Employee::where('id', $teacherSelect)->first()->department_role;
                if($department_role == "Teacher"){
                    $EmpolyAttendance = TeacherMonthsAttendance::where('emp_id', $teacherSelect)->get();
                }
                else{
                    $EmpolyAttendance =  StaffAttendance::where('emp_id', $teacherSelect)->get();
                }

                foreach ($EmpolyAttendance as $attendance) {
                    $AttendencMonth = $attendance->month;
                    $AttendenPercentage = $attendance->percent;
                    $CurrentSalary = $attendance->salary;
                    $PerPerceSalary = (int) ($CurrentSalary / 100);
                    $attendanceData = $attendance->attendance;
                    $parts = explode('/', $attendanceData);
                    $totalDayThisMonth = $parts[0];
                    $TotalPersent = $parts[1];
                
                    //Get Bonus amount (BS)
                    $BonusAmount = 0;
                    if ($ba == "true" && $AttendenPercentage == $bouns_attend) {
                        $BonusAmount = (int) $PerPerceSalary * $bouns_per;
                    }
                
                    // Generate Salary On Whith (LS)
                    if ($ls == "true" && $AttendenPercentage <= $leave_per) {
                        $GenerateSalary = (int) $CurrentSalary;
                    } else {
                        $GenerateSalary = (int) ($CurrentSalary / $totalDayThisMonth * $TotalPersent);
                    }
                
                    // SSF Amount (SSF)
                    $GenerateSalaryBonus = $GenerateSalary + $BonusAmount;
                    $ssfAmount = 0;
                    if ($ssf == "true") {
                        $ssfAmount = (int) ($GenerateSalaryBonus / 100 * $ssf_per);
                    }
                
                    // Net Pay
                    $NetPay = (int) ($GenerateSalary + $BonusAmount) - $ssfAmount;
                
                    if ($department_role == "Teacher") {
                        $StaffAttendance = TeacherMonthsAttendance::where('emp_id', $teacherSelect)
                            ->where('year', $attendanceYear)
                            ->where('month', $AttendencMonth)
                            ->first();
                    } else {
                        $StaffAttendance = StaffAttendance::where('emp_id', $teacherSelect)
                            ->where('year', $attendanceYear)
                            ->where('month', $AttendencMonth)
                            ->first();
                    }
                
                    if ($StaffAttendance) {
                        $StaffAttendance->gen_salary = $GenerateSalaryBonus;
                        $StaffAttendance->bonus = $BonusAmount;
                        $StaffAttendance->epf = $ssfAmount;
                        $StaffAttendance->net_pay = $NetPay;
                        $StaffAttendance->remaining = $StaffAttendance->net_pay - $StaffAttendance->paid;
                        $StaffAttendance->save();
                    } else {
                        // Handle the case when no attendance record is found
                        // You can log an error or handle it based on your application logic
                    }
                }
                

                // return false;

            //// End Update Attendance with Setting 

            $department_role = Employee::where('id', $teacherSelect)->first()->department_role;
            if($department_role == "Teacher"){
                $teachersAttendance = TeacherMonthsAttendance::where('emp_id', $teacherSelect)->where('year', $attendanceYear)->orderByRaw("CAST(month AS UNSIGNED) ASC")->get();
            }
            else{
                $teachersAttendance = StaffAttendance::where('emp_id', $teacherSelect)->where('year', $attendanceYear)->orderByRaw("CAST(month AS UNSIGNED) ASC")->get();
            }

            // Check if there is any attendance data
            if ($teachersAttendance->count() > 0) {
                // Extract the teacher ID from the first attendance record
     
                    $teacherId = $teachersAttendance->first()->emp_id;

                // Get additional information from the Employee table using the extracted teacher ID
                $teacher = Employee::where('id', $teacherId)->first();

                // Append the additional information to each attendance record
                foreach ($teachersAttendance as $attendance) {
                    $attendance->teacher_info = $teacher;
                     // Adjust the property name as needed
                }
            }

            // Return the response
            return response(['Data' => $teachersAttendance], Response::HTTP_OK);
            
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error storing attendance data', 'message' => $e->getMessage()], 500);
        }

    }
    public function TeacherSalaryPayment(Request $request)
    {
       $tr_id = $request->tr_id;
       $periods = $request->periods;
       $percent = $request->percent;
       $salary = $request->salary;
       $generate_salary = $request->generate_salary;
       $bonus = $request->bonus;
       $epf = $request->epf;
       $net_pay = $request->net_pay;
       $payment = $request->payment;
       $payment_date = LaravelNepaliDate::from($request->payment_date)->toEnglishDate();

       $pay_mode = $request->pay_mode;
       $remark = $request->check_number;
       $remark = $request->transaction_id;
       $remark = $request->remark;

       $salaryYear = $request->salary_year;
       $salaryMonth = $request->salary_month;


       $department_role = Employee::where('id', $tr_id)->first()->department_role;
       if($department_role == "Teacher"){
           $TeacherMonthsAttendance = TeacherMonthsAttendance::where('emp_id', $tr_id)->where("year", $salaryYear)->where("month", $salaryMonth)->first();
       }else{
           $TeacherMonthsAttendance = StaffAttendance::where('emp_id', $tr_id)->where("year", $salaryYear)->where("month", $salaryMonth)->first();
       }

       if($TeacherMonthsAttendance)
       {

          $TeacherMonthsAttendance->paid = (int)$payment + (int)$TeacherMonthsAttendance->paid;
          $TeacherMonthsAttendance->remaining = $net_pay - $payment;
          $TeacherMonthsAttendance->save();

          $EmployeesSalariesPaymentHistories = new EmployeesSalariesPaymentHistories();
          $EmployeesSalariesPaymentHistories->py_id = $TeacherMonthsAttendance->id;
          $EmployeesSalariesPaymentHistories->tr_id = $tr_id;
          $EmployeesSalariesPaymentHistories->salary_year = $salaryYear;
          $EmployeesSalariesPaymentHistories->salary_month = $salaryMonth;
          $EmployeesSalariesPaymentHistories->total_period = $periods;
          $EmployeesSalariesPaymentHistories->percent = $percent;
          $EmployeesSalariesPaymentHistories->salary = $salary;
          $EmployeesSalariesPaymentHistories->generate_salary = $generate_salary;
          $EmployeesSalariesPaymentHistories->bonus = $bonus;
          $EmployeesSalariesPaymentHistories->epf = $epf;
          $EmployeesSalariesPaymentHistories->recive_salary = $payment;
          $EmployeesSalariesPaymentHistories->net_pay = (int)$net_pay;
          $EmployeesSalariesPaymentHistories->remaining = (int)$net_pay - (int)$payment;
          $EmployeesSalariesPaymentHistories->payment_date = $payment_date;

          $EmployeesSalariesPaymentHistories->pay_mode = $pay_mode;
          $EmployeesSalariesPaymentHistories->check_number = $check_number ?? "";
          $EmployeesSalariesPaymentHistories->transaction_id = $transaction_id ?? "";
          $EmployeesSalariesPaymentHistories->remark = $remark ?? "";

          $EmployeesSalariesPaymentHistories->save();
        }
      
        return response()->json(['status' => 'Payment successfully'], 200);
    }
    public function SalaryHistory(Request $request){
        try {

            $tr_id = $request->tr_id;
            $salaryYear = $request->salary_year;
            $salaryMonth = $request->salary_month;

            $EmployeesSalariesPaymentHistories = EmployeesSalariesPaymentHistories::where("tr_id", $tr_id)->where("salary_year", $salaryYear)->where("salary_month", $salaryMonth)->orderBy('id', 'desc')->get();
            if (count($EmployeesSalariesPaymentHistories) != "0") {
                return response()->json(['data' => $EmployeesSalariesPaymentHistories]);
            } else {
                return response()->json(['message' => 'No history available.']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function AllSalaryHistory(Request $request){
        try {
            $EmployeesSalariesPaymentHistories = EmployeesSalariesPaymentHistories::orderBy('id', 'asc')->get();
            foreach($EmployeesSalariesPaymentHistories as $Employees){
                $emp_id = $Employees->tr_id;

                $employee = Employee::where('id', $emp_id)->first();
                $employee_first_name = $employee->first_name;
                $employee_last_name = $employee->last_name;
                $image = $employee->image;


                $Employees->employee_name =  $employee_first_name.' '.$employee_last_name;
                $Employees->employee_image =  $image;

            }
            if (count($EmployeesSalariesPaymentHistories) != "0") {
                return response()->json(['EmployeesSalaries' => $EmployeesSalariesPaymentHistories]);
            } else {
                return response()->json(['message' => 'No history available.']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function SalaryHistoryReset(Request $request){
        try {
            $hs_id = $request->hs_id;

            $EmployeesSalariesPaymentHistories = EmployeesSalariesPaymentHistories::where("id", $hs_id)->first();
            if($EmployeesSalariesPaymentHistories)
            {
                $HsNetPay = $EmployeesSalariesPaymentHistories->net_pay;
                $HsReciveSalary = $EmployeesSalariesPaymentHistories->recive_salary;
                $HsRemining = $EmployeesSalariesPaymentHistories->remaining;
                $salaryYear = $EmployeesSalariesPaymentHistories->salary_year;
                $salaryMonth = $EmployeesSalariesPaymentHistories->salary_month;
                $tr_id = $EmployeesSalariesPaymentHistories->tr_id;


                $department_role = Employee::where('id', $tr_id)->first()->department_role;
                if($department_role == "Teacher"){
                    $TeacherMonthsAttendance = TeacherMonthsAttendance::where('emp_id', $tr_id)->where("year", $salaryYear)->where("month", $salaryMonth)->first();
                }else{
                    $TeacherMonthsAttendance = StaffAttendance::where('emp_id', $tr_id)->where("year", $salaryYear)->where("month", $salaryMonth)->first();
                }

                if($TeacherMonthsAttendance){
                    $PyReciveSalary =  $EmployeesSalariesPaymentHistories->recive_salary;
                    $PyRemining = $EmployeesSalariesPaymentHistories->remaining;

                      $TeacherMonthsAttendance->paid = $TeacherMonthsAttendance->net_pay - $HsNetPay;
                      $TeacherMonthsAttendance->remaining = $TeacherMonthsAttendance->remaining + $HsNetPay;

                    if($TeacherMonthsAttendance->save())
                    {
                        EmployeesSalariesPaymentHistories::where('id', $hs_id)->delete();
                        return response()->json(['status' => "Reset Sucess"]);
                    }

                }


            }

 
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function SalarySlipData(Request $request){
        try {
            $hs_id = $request->hs_id;

            $EmployeesSalariesPaymentHistories = EmployeesSalariesPaymentHistories::where("id", $hs_id)->first();
            $Teacher = Employee::where("id", $EmployeesSalariesPaymentHistories->tr_id)->first();
            $SchoolDetails = SchoolDetails::first();
            if ($EmployeesSalariesPaymentHistories) {
                return response()->json(['SlipData' => $EmployeesSalariesPaymentHistories, 'Teacher'=> $Teacher, 'SchoolDetails'=> $SchoolDetails]);
            } else {
                return response()->json(['message' => 'No history available.']);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function SaveBonusSsfSetting(Request $request)
    {
        try {        
            $ssf = $request->ssf_per;
            $bouns_attend = $request->bouns_attend;
            $bouns_per = $request->bouns_per;
            $leave_per = $request->leave_per;
            $leave_salary = $request->leave_salary;
            
            $existingSetting = BonusSsfSetting::first();
            
            if ($existingSetting) {
                BonusSsfSetting::truncate();
            } 

            BonusSsfSetting::create([
                'ssf_per' => $ssf,
                'bouns_attend' => $bouns_attend,
                'bouns_per' => $bouns_per,
                'leave_per' => $leave_per,
                'leave_salary' => $leave_salary,
            ]);

            return response()->json(['status' => "Update Sucess"]);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }
    public function GetBonusSsfSetting(Request $request)
    {
        try { 
            $existingSetting = BonusSsfSetting::first();
            if($existingSetting){
                return response()->json(['data' => $existingSetting]);   
            }
        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function GetAllEmployeeBonusSetting(Request $request){
        try {   
            $Employees = Employee::get();
            foreach ($Employees as $employee) {
                $emp_id = $employee->id;
            
                // Check if a record with the specified emp_id exists
                $bonusSsfApplyEmp = BonusSsfApplyEmp::where('emp_id', $emp_id)->first();
            
                if ($bonusSsfApplyEmp) {
                    $ssf = $bonusSsfApplyEmp->ssf;
                    $ba = $bonusSsfApplyEmp->ba;
                    $ls = $bonusSsfApplyEmp->ls;
                    // Append the retrieved values to the $employee object
                    $employee->ssf = $ssf;
                    $employee->ba = $ba;
                    $employee->ls = $ls;
                }
                else{
                    $employee->ssf =  'false';
                    $employee->ba = 'false';
                    $employee->ls = 'false'; 
                }
            }
            
            // Return the modified array as a JSON response
            return response()->json(['AllEmployee' => $Employees], Response::HTTP_OK);



         }catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    public function SaveEpmBonusSetting(Request $request)
    {
        try {        

            $emp_id = $request->emp_id;
            $ssf = $request->ssf;
            $ba = $request->ba;
            $ls = $request->ls;

 
            // Check if a record with the specified emp_id exists
            $bonusSsfApplyEmp = BonusSsfApplyEmp::where('emp_id', $emp_id)->first();

            if ($bonusSsfApplyEmp) {
                // If the record exists, update the values
                $bonusSsfApplyEmp->update([
                    'ssf' => $ssf,
                    'ba' => $ba,
                    'ls' => $ls,
                ]);
            } else {
                // If the record doesn't exist, create a new one
                BonusSsfApplyEmp::create([
                    'emp_id' => $emp_id,
                    'ssf' => $ssf,
                    'ba' => $ba,
                    'ls' => $ls,
                ]);
            }

         // Return a JSON response with a success message and a 200 status code
        return response()->json(['message' => 'Save successful'], Response::HTTP_OK);

        }catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
