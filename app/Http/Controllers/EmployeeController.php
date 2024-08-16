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
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use Illuminate\Support\Facades\Validator;




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
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department_role' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date_format:Y-m-d',
            'religion' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:3',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'qualification' => 'nullable|string|max:255',
            'joining_date' => 'required|date_format:Y-m-d',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
 

        // Prepare image ID and image name
        $image_id = time();
        $employee_image_name = $request->input("employee_image_name", 'default_name');

        // Create a new employee record
        $employee = new Employee;
        $employee->first_name = $request->input("first_name");
        $employee->last_name = $request->input("last_name");
        $employee->department_role = $request->input("department_role");
        $employee->gender = $request->input("gender");
        $employee->dob = LaravelNepaliDate::from($request->input("dob"))->toEnglishDate();
        $employee->religion = $request->input("religion");
        $employee->blood_group = $request->input("blood_group");
        $employee->address = $request->input("address");
        $employee->phone = $request->input("phone");
        $employee->email = $request->input("email", '');
        $employee->password = Str::random(10);
        $employee->qualification = $request->input("qualification");
        $employee->joining_date = LaravelNepaliDate::from($request->input("joining_date"))->toEnglishDate();

        // Employee Image Store
        if ($request->hasFile('image')) {
            $employee_image = $request->file("image");
            $employeeCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $employee_image_name . '.jpg';
            $destinationPath = 'storage/upload_assets/employees/' . "employee_image_" . $image_id . ".jpg";
            if (!File::exists(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0755, true);
            }
            $employee->image = "upload_assets/employees/employee_image_" . $image_id . ".jpg";
            File::move($employeeCropImgPath, $destinationPath);
        } else {
            $employee->image = "CommonImg/employee.jpg";
        }

        // Save the employee record
        if ($employee->save()) {
            // If the department role is Teacher, create an entry in TeachersPeriods
            if ($request->input("department_role") == "Teacher") {
                $TeachersPeriods = new TeachersPeriods;
                $TeachersPeriods->tch_id = $employee->id;
                $TeachersPeriods->teacher_name = $employee->first_name . ' ' . $employee->last_name;
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

            return response()->json(['status' => "Add Successfully"], 200);
        } else {
            return response()->json(['status' => "Failed to add employee"], 500);
        }
    } catch (ValidationException $e) {
        // Handle validation exceptions
        $errors = $e->validator->errors()->messages();
        return response()->json(['status' => 'Validation Error', 'errors' => $errors], 422);
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
        
        $Teachers = Employee::where('department_role', 'Teacher')->orderBy('first_name')->where('admit_status', 'admit')->get();
        $Staffs = Employee::whereNotIn('department_role', ['Teacher'])->where('admit_status', 'admit')->get();
        $AllEmployee = Employee::where('admit_status', 'admit')->get();

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
            'dob' => LaravelNepaliDate::from($request->input("dob"))->toEnglishDate(),
            'religion' => $request->input("religion"),
            'blood_group' => $request->input("blood_group"),
            'address' => $request->input("address"),
            'phone' => $request->input("phone"),
            'email' => $request->input("email"),
            'qualification' => $request->input("qualification"),
            'joining_date' => LaravelNepaliDate::from($request->input("joining_date"))->toEnglishDate(),
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

    public function EmployeeLeaved(Request $request)
    {
        try {
            $emp_id = $request->emp_id;

            $employee = Employee::where('id', $emp_id)->first();
            $employee->admit_status = 'leaved';
            if($employee->save())
            {
                return response()->json(['message' => 'leaved success']); 
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    
    
    
 public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'department_role' => 'required|string|max:255',
                'gender' => 'required|string|max:10',
                'dob' => 'required|date_format:Y-m-d',
                'religion' => 'nullable|string|max:255',
                'blood_group' => 'nullable|string|max:3',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'nullable|email|max:255',
                'qualification' => 'nullable|string|max:255',
                'joining_date' => 'required|date_format:Y-m-d',
                'image' => 'nullable|image|mimes:jpg,jpeg,png'
            ]);

            // Handle file upload
            $photoPath = "CommonImg/employee.jpg";
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $timestamp = time();
                $uniqueName = uniqid() . '_' . $timestamp . '.' . $image->getClientOriginalExtension();
                $photoPath = $image->storeAs('upload_assets/employee', $uniqueName, 'public');
            }

            // Create a new employee
            $employee = new Employee();
            $employee->first_name = $validated['first_name'];
            $employee->last_name = $validated['last_name'];
            $employee->department_role = $validated['department_role'];
            $employee->gender = $validated['gender'];
            $employee->dob = $validated['dob'];
            $employee->religion = $validated['religion'];
            $employee->blood_group = $validated['blood_group'];
            $employee->address = $validated['address'];
            $employee->phone = $validated['phone'];
            $employee->email = $validated['email'];
            $employee->qualification = $validated['qualification'];
            $employee->joining_date = $validated['joining_date'];
            $employee->image = $photoPath;

            // Save employee data to the database
            if ($employee->save()) {
                if ($employee->department_role == "Teacher") {
                    $teachersPeriods = new TeachersPeriods();
                    $teachersPeriods->tch_id = $employee->id;
                    $teachersPeriods->teacher_name = $employee->first_name . ' ' . $employee->last_name;
                    $teachersPeriods->period_1 = 0;
                    $teachersPeriods->period_2 = 0;
                    $teachersPeriods->period_3 = 0;
                    $teachersPeriods->period_4 = 0;
                    $teachersPeriods->period_5 = 0;
                    $teachersPeriods->period_6 = 0;
                    $teachersPeriods->period_7 = 0;
                    $teachersPeriods->period_8 = 0;
                    $teachersPeriods->period_9 = 0;
                    $teachersPeriods->period_10 = 0;
                    $teachersPeriods->save();
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Employee added successfully',
                    'employee' => $employee,
                ], 201);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add employee'
            ], 500);

        } catch (ValidationException $e) {
            // Handle validation exceptions
            $errors = $e->validator->errors()->messages();
            return response()->json(['status' => 'Validation Error', 'errors' => $errors], 422);
        } catch (Exception $e) {
            // Handle generic exceptions
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => 'Server Error', 'message' => $message], 500);
        }
    }

    
    
}
