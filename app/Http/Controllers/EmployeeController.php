<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\EmployeesSalaries;
use App\Models\TeachersPeriods;
use App\Models\TeachersAttendance;
use App\Models\TeacherMonthsAttendance;
use App\Models\EmployeesSalariesPaymentHistories;
use App\Models\TeacherSubject;
use App\Models\StaffAttendance;



use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function AddEmployee(Request $request)
    {
        try {
            $employee_image_name = $request->input("employee_image_name");

            $image_id = time();
            $employee = new employee;
            $employee->first_name  = $request->input("first_name");
            $employee->last_name  = $request->input("last_name");
            $employee->department_role  = $request->input("department_role");
            $employee->gender  = $request->input("gender");
            $employee->dob  = $request->input("dob");
            $employee->religion  = $request->input("religion");
            $employee->blood_group  = $request->input("blood_group");
            $employee->address  = $request->input("address");
            $employee->phone  = $request->input("phone");
            $employee->email  = $request->input("email") ?? '';
            $employee->password  = Str::random(10);
            $employee->qualification  = $request->input("qualification");
            $employee->joining_date  = $request->input("joining_date");
 
            // employee Image Store
            $employee_image = $request->file("image");
            if (!empty($student_image)) {
                $employeeCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $employee_image_name . '.jpg';
                $destinationPath = 'storage/upload_assets/employees/' . "employee_image_" . $image_id . ".jpg";
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $employee->image =   "upload_assets/employees/employee_image_" . $image_id . ".jpg";
                File::move($employeeCropImgPath, $destinationPath);
            }else{
                $employee->image = "CommonImg/employee.jpg";
            }

            if ($employee->save()) {

                if($request->input("department_role") == "Teacher"){
                    $TeachersPeriods = new TeachersPeriods;
                    $TeachersPeriods->tch_id = $employee->id;
                    $TeachersPeriods->teacher_name = $employee->first_name.' '.$employee->last_name;
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
    public function GetAllemployee(Request $request)
    {
        
        $Teachers = Employee::where('department_role', 'Teacher')->orderBy('first_name')->get();
        $Staffs = Employee::whereNotIn('department_role', ['Teacher'])->get();
        $AllEmployee = Employee::get();

        return response(['Teachers' => $Teachers,'Staffs' => $Staffs,'AllEmployee' => $AllEmployee], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json(['status' => 'success', 'employee' => $employee]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Employee not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $employee_image_crope = $request->input("employee_image_name");
        $employee_id = $request->employee_id;



        $Employee = Employee::findOrFail($employee_id);
        $Employee->forceFill([
            'first_name' =>  $request->input("first_name"),
            'last_name' => $request->input("last_name"),
            'department_role' => $request->input("department_role"),
            'gender' => $request->input("gender"),
            'dob' => $request->input("dob"),
            'religion' => $request->input("religion"),
            'blood_group' => $request->input("blood_group"),
            'address' => $request->input("address"),
            'phone' => $request->input("phone"),
            'email' => $request->input("email"),
            'qualification' => $request->input("qualification"),
            'joining_date' => $request->input("joining_date"),
        ]);


        // First Check if it already teacher than telete period and attendance 
            $CheckEmployee = Employee::where('id', $employee_id)->first();
            if ($CheckEmployee && $CheckEmployee->department_role == "Teacher") {
                if ($request->input("department_role") != "Teacher") {
                    TeachersPeriods::where('tch_id', $employee_id)->delete();
                    TeacherMonthsAttendance::where('emp_id', $employee_id)->delete();
                }
            } 
            if ($CheckEmployee && $CheckEmployee->department_role != "Teacher") {
                if ($request->input("department_role") == "Teacher") {
                    StaffAttendance::where("emp_id", $employee_id)->delete();
                }
            }         
        // End Check if it already teacher than telete period and attendance 

       
// Update employee image
$employee_image = $request->file("image");
$employee_image_path = $Employee->image;
$employee_image_name = basename($employee_image_path);

if (!empty($employee_image)) {
    // Generate a unique name if the current image name is default ("employee.jpg")
    if ($employee_image_name == "employee.jpg") {
        $employee_image_name = time() . ".jpg";
    }

    // Store the new employee image
    // $employee_image->storeAs('public/upload_assets/employee',  $employee_image_name);

    // Define paths for cropping and destination
    $EmployeeCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $employee_image_crope . '.jpg';
    $destinationPath = 'storage/upload_assets/employee/' . $employee_image_crope. '.jpg';

    // Create the destination directory if it doesn't exist
    if (!File::exists(dirname($destinationPath))) {
        File::makeDirectory(dirname($destinationPath), 0755, true);
    }

    // Update the employee's image path
    $Employee->image =  'upload_assets/employee/' . $employee_image_crope. '.jpg';

    // Move the cropped image to the destination
    File::move($EmployeeCropImgPath, $destinationPath);
}



        if ($Employee->save()) {
            if($Employee->department_role == "Teacher"){
                if(!TeachersPeriods::where("tch_id", $Employee->id)->first())
                {
                    $TeachersPeriods = new TeachersPeriods;
                    $TeachersPeriods->tch_id = $Employee->id;
                    $TeachersPeriods->teacher_name = $Employee->first_name.' '.$Employee->last_name;
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
            }


            return response()->json(['status' => "Update Success"], 200);
        } else {
            return response()->json(['status' => "Update Failed Try Again"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEmployee(Request $request)
    {
        $emp_id = $request->emp_id;
        $employee = Employee::find($emp_id);

        // Check if the employee exists
        if ($employee) {
            // Delete records from TeachersPeriods where tch_id matches
            TeachersPeriods::where("tch_id", $emp_id)->delete();
            // Delete records from TeachersAttendance where tr_id matches
            TeachersAttendance::where("tr_id", $emp_id)->delete();
            // Delete records from TeacherMonthsAttendance where tr_id matches
            TeacherMonthsAttendance::where("emp_id", $emp_id)->delete();
            // Delete records from EmployeesSalariesPaymentHistories where tr_id matches
            EmployeesSalariesPaymentHistories::where("tr_id", $emp_id)->delete();
            // Delete records from TeacherSubject where tr_id matches
            TeacherSubject::where("tr_id", $emp_id)->delete();
            // Delete records from StaffAttendance where emp_id matches
            StaffAttendance::where("emp_id", $emp_id)->delete();
            // Delete records from EmployeesSalaries where emp_id matches
            StaffAttendance::where("emp_id", $emp_id)->delete();
            // EmployeesSalaries, delete the employee record
            $employee->delete();
        }

        // Check if the Employee image exists in storage than delete
        if ($employee->image){
            if($employee->image != "CommonImg/employee.jpg")
            {
                $employee_image = 'public/' . $employee->image;
                if (Storage::exists($employee_image)) {
                    Storage::delete($employee_image);
                }
            }
        }
 
        return response()->json(['message' => 'Employee deleted successfully']);

    }
}
