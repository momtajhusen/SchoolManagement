<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\HelperController\StudentAccountFee;
use Illuminate\Support\Facades\Storage;
use App\Models\DateSetting;
use App\Models\Student;
use App\Models\Parents;
use App\Models\FeeStructure;
use App\Models\ManageFreeStudents;



use App\Models\FeeGenerated;
use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;

use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;

use App\Models\LastPaymentForReset;
use App\Models\LastDuesForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastFreeFeeForReset;

use App\Models\HostelFee;
use App\Models\TuitionFee;

use App\Models\DiscountExceptions;

use App\Models\JoinleaveDates;
use Carbon\Carbon;

use App\Models\SchoolDetails;

use App\Models\VehicleRoot;
use App\Models\Classes;

use App\Models\StudentsFeeStracture;
use App\Models\StudentsFeeMonth;


use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $parent_response;
    public $student_response;
    public $data;
    public $allData = [];
    public function index(Request $request)
    {


        try {

            $student_search_select = $request->student_search_select;
            $student_input_search = $request->student_input_search;

            if ($student_input_search != "") {
                if ($student_search_select == "phone" || $student_search_select == "email" || $student_search_select == "id" || $student_search_select == "parents_id") 
                {
                    $this->student_response = Student::where($student_search_select, $student_input_search)->where("admission_status", "admit")->paginate(10);

                    // Parents
                    $this->parent_response = Parents::whereIn('id', $this->student_response->pluck('parents_id'))->get();
                    $data = $this->student_response->toArray();
                    $parentData = $this->parent_response->toArray();
                    foreach ($data['data'] as &$student) {
                        $parentId = $student['parents_id'];
                        $parent = collect($parentData)->firstWhere('id', $parentId);
                        $student['parent_data'] = $parent;
                    }
                } else {
                    $this->student_response = Student::orderBy('class')->orderBy('roll_no')->where($student_search_select, 'LIKE', '%' . $student_input_search . '%')->where("admission_status", "admit")->paginate(10);

                    // Parents
                    $this->parent_response = Parents::whereIn('id', $this->student_response->pluck('parents_id'))->get();
                    $data = $this->student_response->toArray();
                    $parentData = $this->parent_response->toArray();
                    foreach ($data['data'] as &$student) {
                        $parentId = $student['parents_id'];
                        $parent = collect($parentData)->firstWhere('id', $parentId);
                        $student['parent_data'] = $parent;
                    }
                }
            } else {
                $this->student_response = Student::orderByRaw("FIELD(class, 'PG', 'NURSERY', 'LKG', 'UKG', '1ST', '2ND', '3RD'), roll_no")->where("admission_status", "admit")->paginate(10);

                // Parents
                $this->parent_response = Parents::whereIn('id', $this->student_response->pluck('parents_id'))->get();
                $data = $this->student_response->toArray();
                $parentData = $this->parent_response->toArray();
                foreach ($data['data'] as &$student) {
                    $parentId = $student['parents_id'];
                    $parent = collect($parentData)->firstWhere('id', $parentId);
                    $student['parent_data'] = $parent;
                }
            }

            if (count($this->student_response) != 0) {
                return response(array("data" => $data), 200);
            } else {
                return response()->json(['message' => 'Data not found']);
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
            $parent_check =  $request->input("parent_check");
            $parent_existing_id = $request->input("parent_existing_id");
            $student_image_name = $request->input("student_image_name");
            $document_image_name = $request->input("document_image_name");
            $father_image_name = $request->input("father_image_name");
            $mother_image_name = $request->input("mother_image_name");

            $vehicle_root = $request->input("vehicle_root") ?? 'No'; 
            $transport_use = $request->input("transport_use") ?? 'No';
            $coaching_use = $request->input("coaching_use") ?? 'No';

            $class = $request->input("class");


            $image_id = time();

            // date year 
            $dateSetting = DateSetting::first();
            $class_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->class_year ?? null);

            $student = new Student;
            $student->first_name  = $request->input("student_first_name");
            $student->middle_name  = $request->input("student_middle_name") ?? "";
            $student->last_name  = $request->input("student_last_name");
            $student->gender  = $request->input("student_gender") ?? "";
            $student->dob  = $request->input("student_dob");
            $student->religion  = $request->input("student_religion") ?? "";
            $student->blood_group  = $request->input("student_blood_group") ?? "";
            $student->phone  = $request->input("student_phone") ?? "";
            $student->email  = $request->input("student_email");
            $student->id_number  = $request->input("student_id_number") ?? "";
            $student->id_image  = $request->file("student_id_image");
            $student->admission_date  = $request->input("admission_date");
            $student->class_year = $class_year;
            $student->class  = $request->input("class");
            $student->section  = $request->input("section");
            $student->roll_no  = $request->input("roll_no");
            $student->hostel_outi  = $request->input("hostel_outi");
            $student->hostel_deposite  = $request->input("hostel_deposite");
            $student->transport_use  = $transport_use;
            $student->vehicle_root  = $vehicle_root;
            $student->coaching  = $coaching_use;
            $student->district  = $request->input("district");
            $student->municipality  = $request->input("municipality");
            $student->village  = $request->input("village");
            $student->ward_no  = $request->input("ward_no") ?? "";
            $student->login_password  = Str::random(10);
            $student->admission_status  =  "new";

            $dymamic_email_student = strtolower(str_replace(" ", "", $request->input("student_first_name"))) . "_" . Student::where('class', $request->input("class"))->count() + 1;
            $student->login_email  = $request->input("student_email") ?? $dymamic_email_student . "@gmail.com";
 
            // Start Student Crop Image Store
                $student_image = $request->file("student_image");
                if (!empty($student_image)) {
                    $StudentCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $student_image_name . '.jpg';
                    $destinationPath = 'storage/upload_assets/students/' . "profile_" . $image_id . ".jpg";
                    if (!File::exists(dirname($destinationPath))) {
                        File::makeDirectory(dirname($destinationPath), 0755, true);
                    }
                    $student->student_image = "upload_assets/students/profile_" . $image_id . ".jpg";
                    File::move($StudentCropImgPath, $destinationPath);
                } else {
                    if($request->input("student_gender") == "Male"){
                        $student->student_image = "CommonImg/boy.jpg";
                    }
                    if($request->input("student_gender") == "Female"){
                        $student->student_image = "CommonImg/girl.jpg";
                    }
                }
            // End Student Crop Image Store
        
            // Start Document Crop Image Store
                $student_id_image = $request->file("student_id_image");
                if (!empty($student_id_image)) {
                    $DocumentCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $document_image_name . '.jpg';
                    $destinationPath = 'storage/upload_assets/students/document/' . "proof_" . $image_id . ".jpg";

                    if (!File::exists(dirname($destinationPath))) {
                        File::makeDirectory(dirname($destinationPath), 0755, true);
                    }
                    $student->id_image = "upload_assets/students/document/proof_" . $image_id . ".jpg";
                    File::move($DocumentCropImgPath, $destinationPath);
                } else {
                    $student->id_image = "upload_assets/students/document/proof_" . $image_id . ".jpg";
                }
            // End Document Crop Image Store
            
            // Parent Data save 
            if ($parent_check == "new_parent") {

                // Parent Data Save 
                    $parent = new Parents;
                    $parent->father_image  = $request->file("father_image");
                    $parent->father_name  = $request->input("father_name");
                    $parent->father_mobile  = $request->input("father_phone") ?? "";
                    $parent->father_education  = $request->input("father_education") ?? "";
                    $parent->mother_image  = $request->file("mother_image");
                    $parent->mother_name  = $request->input("mother_name") ?? "";
                    $parent->mother_mobile  = $request->input("mother_phone") ?? "";
                    $parent->mother_education  = $request->input("mother_education") ?? "";
                    $parent->login_password  = Str::random(10);

                    $dymamic_email_father = strtolower(str_replace(" ", "", $request->input("father_name"))) . "_" .  Student::where('class', $request->input("class"))->count() + 1;
                    $parent->login_email  = $request->input("father_email") ?? $dymamic_email_father . "@gmail.com";

                // Start Father Crop Image Store
                    $father_image = $request->file("father_image");
                    if (!empty($father_image)) {
                        $FatherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $father_image_name . '.jpg';
                        $destinationPath = 'storage/upload_assets/father/' . "father_" . $image_id . ".jpg";
                        if (!File::exists(dirname($destinationPath))) {
                            File::makeDirectory(dirname($destinationPath), 0755, true);
                        }
                        $parent->father_image = "upload_assets/father/father_" . $image_id . ".jpg";
                        File::move($FatherCropImgPath, $destinationPath);
                    } else {
                        $parent->father_image = "CommonImg/father.jpg";
                    }
                // End Father Crop Image Store

                // Start Mother Crop Image Store
                    $mother_image = $request->file("mother_image");
                    if (!empty($mother_image)) {
                        $MotherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $mother_image_name . '.jpg';
                        $destinationPath = 'storage/upload_assets/mother/' . "mother_" . $image_id . ".jpg";
                        if (!File::exists(dirname($destinationPath))) {
                            File::makeDirectory(dirname($destinationPath), 0755, true);
                        }
                        $parent->mother_image = "upload_assets/mother/mother_" . $image_id . ".jpg";
                        File::move($MotherCropImgPath, $destinationPath);
                    } else {
                        $parent->mother_image = "CommonImg/mother.jpg";
                    }
                // End Mother Crop Image Store
                
                if ($parent->save()) {
                    $parentId = $parent->id;
                    // Associate the parent with the student
                    $student->parents_id = $parentId;
                    $student->save();
                } else {
                    return response()->json(['status' => "Failed Something Error"]);
                }
            } 
            else {
                $student->parents_id = $parent_existing_id;
                $student->save();
            }



                // Start Admission date
                    $admission_date = Carbon::parse($request->input("admission_date"));
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month - 1;
                    
                    if($class_year != $admission_year)
                    {
                        $start_month = 0;
                    }
                    else{
                      $start_month = $admission_month-1;
                    } 
                // End Admission date
                $st_id = $student->id;
                
                ///////////////// Start New Account Student Fee Set ////////////
                    StudentAccountFee::setStudentFees($class, $start_month, $class_year, $admission_year, $request, $st_id);
                ///////////////// End New Account Student Fee Set ////////////


                ///////////////// Start Old Account Student Fee Set ////////////
                    StudentAccountFee::setJoiningData($student, $class_year, $admission_month, $request);
                    StudentAccountFee::setStudentFeesOldAccount($class, $class_year, $st_id, $request);
                ///////////////// End Old Account Student Fee Set ////////////
 
               return response()->json(['status' => "Add Successfull", 'student_id' => $student->id]);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function MultipleStudentStore(Request $request){
        try {

            $parent_check =  $request->input("parent_check");
            $parent_existing_id = $request->input("parent_existing_id");
            $student_image_name = $request->input("student_image_name");
            $document_image_name = $request->input("document_image_name");
            $father_image_name = $request->input("father_image_name");
            $mother_image_name = $request->input("mother_image_name");

            $vehicle_root = $request->input("vehicle_root") ?? 'No'; 
            $transport_use = $request->input("transport_use") ?? 'No';
            $coaching_use = $request->input("coaching_use") ?? 'No';

            $class = $request->input("class") ?? '1ST';
 
            // Start Admission date
                $admission_date = Carbon::parse($request->input("admission_date"));
                $admission_year = $admission_date->year;
                $class_year = $admission_date->year;
                $admission_month = $admission_date->month - 1;
            // End Admission date

            $image_id = time();

            // date year 
            $dateSetting = DateSetting::first();
            $class_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($class_year ?? null);

            $student = new Student;
            if($request->input("gender") == "Male"){
                $student->student_image = "CommonImg/boy.jpg";
            }
            if($request->input("gender") == "Female"){
                $student->student_image = "CommonImg/girl.jpg";
            }
            $student->first_name  = $request->input("first_name");
            $student->middle_name  = $request->input("middle_name") ?? "";
            $student->last_name  = $request->input("last_name");
            $student->gender  = $request->input("gender") ?? "";
            $student->dob  = $request->input("dob");
            $student->religion  = $request->input("religion") ?? "";
            $student->blood_group  = $request->input("blood_group") ?? "";
            $student->phone  = $request->input("phone") ?? "";
            $student->email  = $request->input("email");
            $student->id_number  = $request->input("id_number") ?? "";
            $student->id_image  = $request->file("student_id_image");
            $student->admission_date  = $request->input("admission_date");
            $student->class_year = $class_year;
            $student->class  = $request->input("class") ?? '1ST';
            $student->section  = $request->input("section") ?? 'A';
            $student->roll_no  = $request->input("roll_no") ?? '1';
            $student->hostel_outi  = $request->input("hostel_outi") ?? 'outi';
            $student->hostel_deposite  = $request->input("hostel_deposite");
            $student->transport_use  = $transport_use;
            $student->vehicle_root  = $vehicle_root;
            $student->coaching  = $request->input("coaching")  ?? "No";
            $student->district  = $request->input("district") ?? "";
            $student->municipality  = $request->input("municipality") ?? "";
            $student->village  = $request->input("village") ?? "";
            $student->ward_no  = $request->input("ward_no") ?? "";
            $student->login_password  = Str::random(10);
            $student->admission_status  =  "new";

            $dymamic_email_student = strtolower(str_replace(" ", "", $request->input("first_name"))) . "_" . Student::where('class', $request->input("class"))->count() + 1;
            $student->login_email  = $request->input("email") ?? $dymamic_email_student . "@gmail.com";
 
            // Parent Data Save 
            $parent = new Parents;
            $parent->father_image  =  'CommonImg/father.jpg';
            $parent->father_name  = $request->input("father_name");
            $parent->father_mobile  = $request->input("father_phone") ?? "";
            $parent->father_education  = $request->input("father_education") ?? "";
            $parent->mother_image  = 'CommonImg/mother.jpg';
            $parent->mother_name  = $request->input("mother_name") ?? "";
            $parent->mother_mobile  = $request->input("mother_phone") ?? "";
            $parent->mother_education  = $request->input("mother_education") ?? "";
            $parent->login_password  = Str::random(10);

            $dymamic_email_father = strtolower(str_replace(" ", "", $request->input("father_name"))) . "_" .  Student::where('class', $request->input("class"))->count() + 1;
            $parent->login_email  = $request->input("father_email") ?? $dymamic_email_father . "@gmail.com";

            if ($parent->save()) {
                $parentId = $parent->id;
                // Associate the parent with the student
                $student->parents_id = $parentId;
                $student->save();
            } else {
                return response()->json(['status' => "Failed Something Error"]);
            }

            // Start Admission date
                $admission_date = Carbon::parse($request->input("admission_date"));
                $admission_year = $admission_date->year;
                $admission_month = $admission_date->month - 1;
                
                if($class_year != $admission_year)
                {
                    $start_month = 0;
                }
                else{
                $start_month = $admission_month-1;
                } 
            // End Admission date
            $st_id = $student->id;
            
            
            ///////////////// Start New Account Student Fee Set ////////////
                StudentAccountFee::setStudentFees($class, $start_month, $class_year, $admission_year, $request, $st_id);
            ///////////////// End New Account Student Fee Set ////////////

            ///////////////// Start Old Account Student Fee Set ////////////
                StudentAccountFee::setJoiningData($student, $class_year, $admission_month, $request);
                StudentAccountFee::setStudentFeesOldAccount($class, $class_year, $st_id, $request);
            ///////////////// End Old Account Student Fee Set ////////////


            return response()->json(['status' => "Add Successfully", 'student_id' => $student->id]);
        }
        catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }



    public function RegistrationList(Request $request){
        try{

            $students = Student::where("admission_status", "new")->get();

            if ($students->isNotEmpty()) {
                // Iterate through each student
                foreach ($students as $student) {
                    // Retrieve parent details using parent_id
                    $parent = Parents::find($student->parents_id);
                    
                    // If parent exists, append father's name to the student's array
                    if ($parent) {
                        $student->father_name = $parent->father_name;
                        $student->father_contact = $parent->father_mobile;
                    } else {
                        // If parent doesn't exist, set father's name as null
                        $student->father_name = null;
                        $student->father_contact = null;

                    }
                }
                // Return the response with appended data
                return response(array("data" => $students));
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
            

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function show($id)
    {

        try {
            if (Student::where('id', $id)->exists()) {

                $student = Student::find($id);
                $class = $student->class;

                $fee_structure = FeeStructure::where('class', $class)->get();


                return response(array("StudentData" => $student, "fee_structure" => $fee_structure));
            } else {
                return response()->json(['StudentData' => 'student not avable']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function delete_student(Request $request)
    {
        try {
            $st_id = $request->st_id;
            $parent_id = Student::where('id', $st_id)->first()->parents_id;
        
            $student = Student::find($st_id);
            $parents = Parents::find($parent_id);
        
            if (!$student) {
                return response()->json(['message' => 'Student not found'], 404);
            }
        
            if (!$parents) {
                return response()->json(['message' => 'Parent not found'], 404);
            }
        
            // Check if the student's image and document exists in storage than delete
            if ($student->student_image) {
                $student_image = 'public/' . $student->student_image;
                $id_image = 'public/' . $student->id_image;

                if ($student->student_image != "CommonImg/boy.jpg" && $student->student_image != "CommonImg/girl.jpg" && Storage::exists($student->student_image)) {
                    Storage::delete($student->student_image);
                }
            
                if (Storage::exists($id_image)) {
                    Storage::delete($id_image);
                }
            }

            // Check if the student's image and document exists in storage than delete
            if ($parents->father_image) {
                $father_image = 'public/' . $parents->father_image;
                $mother_image = 'public/' . $parents->mother_image;

                if (($parents->father_image != "CommonImg/father.jpg")) {
                    Storage::delete($father_image);
                }
                if ($parents->mother_image != "CommonImg/mother.jpg") {
                    Storage::delete($mother_image);
                }
            }

        
            // Check if there are other students associated with the same parent
            $studentsWithSameParentCount = Student::where('parents_id', $parent_id)->count();
            if ($studentsWithSameParentCount <= 1) {
                // If there's only one student with this parent, delete the parent too
                  $parents->delete();
            }
        
            // Delete other related records
                $relatedModels = [
                    FeePayment::class,
                    DuesAmount::class,
                    FeeDiscount::class,
                    FeeFree::class,
                    LastPaymentForReset::class,
                    LastDuesForReset::class,
                    LastDiscountsForReset::class,
                    LastFreeFeeForReset::class,
                ];
            
                foreach ($relatedModels as $model) {
                    $model::where('st_id', $st_id)->delete();
                }
            
                $student->delete();
        
            return response()->json(['message' => 'Student deleted successfully']);


        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function registration_list()
    {
        try {
            $this->response = Student::get();
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

    public function RegistrationConform(Request $request)
    {
        try {
            $st_id = $request->st_id;

            $student = Student::where('id', $st_id)->first();
            $student->admission_status = 'admit';
            if($student->save())
            {
                return response()->json(['message' => 'conform sucess']); 
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AllRegistrationConform(Request $request){
        try {     
 
            $students = Student::where('admission_status', 'new')->get(); // Retrieve students with 'new' admission status
            foreach ($students as $student) {
                $student->admission_status = 'admit';
                $student->save();
            }
            return response()->json(['message' => 'conform sucess']); 

           } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AllRegistrationDelete(Request $request){
        try {     
            // Fetch all students with admission status 'new'
            $students = Student::where('admission_status', 'new')->get();
    
            // Loop through each student and delete their records and associated images/documents
            foreach ($students as $student) {
                // Delete the student's image and document if they exist
                if ($student->student_image) {
                    $student_image = 'public/' . $student->student_image;
                    $id_image = 'public/' . $student->id_image;
    
                    if ($student->student_image != "CommonImg/boy.jpg" && $student->student_image != "CommonImg/girl.jpg" && Storage::exists($student->student_image)) {
                        Storage::delete($student->student_image);
                    }
                    
                    if (Storage::exists($id_image)) {
                        Storage::delete($id_image);
                    }
                }
    
                // Check if the student's parents' images exist and delete them if they do

                $parents = Parents::find($student->id);

                if ($parents) {
                    if ($parents->father_image && $parents->father_image != "CommonImg/father.jpg") {
                        $father_image = 'public/' . $parents->father_image;
                        Storage::delete($father_image);
                    }
                    if ($parents->mother_image && $parents->mother_image != "CommonImg/mother.jpg") {
                        $mother_image = 'public/' . $parents->mother_image;
                        Storage::delete($mother_image);
                    }
                    
                    // Check if there are other students associated with the same parent
                    $studentsWithSameParentCount = Student::where('parents_id', $parents->id)->count();
                    if ($studentsWithSameParentCount <= 1) {
                        // If there's only one student with this parent, delete the parent too
                        $parents->delete();
                    }
                }
    
                // Delete other related records
                $relatedModels = [
                    FeePayment::class,
                    DuesAmount::class,
                    FeeDiscount::class,
                    FeeFree::class,
                    LastPaymentForReset::class,
                    LastDuesForReset::class,
                    LastDiscountsForReset::class,
                    LastFreeFeeForReset::class,
                ];
                
                foreach ($relatedModels as $model) {
                    $model::where('st_id', $student->id)->delete();
                }
                
                // Finally, delete the student record
                $student->delete();
            }
    
            // Return success message
            return response()->json(['message' => 'delete success']); 
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
    

    public function class_section(Request $request)
    {
        try {

            $class = $request->class;

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->current_year ?? null);

            $response = Classes::where('class', $class)->get();

            if ($response->count() > 0) {
                $allData = $response->toArray();
                return response()->json(['data' => $allData], 200);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function admission_roll(Request $request)
    {
        try {
            $class = $request->class;
            $class_section = $request->sectionvalue;


            // date year 
            $dateSetting = DateSetting::first();
            $date = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->admission_date ?? null);


            $student_count = Student::where('class', $class)->where('section', $class_section)->where('class_year', $date)->count();

            return response()->json(['student_count' => $student_count]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function getclassroll(Request $request)
    {
        try {

            $class = $request->class;

            // date year 
            $dateSetting = DateSetting::first();
            $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);


            if($class == 'all_class'){
                $rolls = Student::where('class_year', $year)->where("admission_status", "admit")->get();
            }else{
                $rolls = Student::where('class', $class)->where('class_year', $year)->where("admission_status", "admit")->get();
            }
            return response()->json(['classrolls' => $rolls]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public $response;
    public $parentdata;
    public $ParentData = [];
    public $TotalPayment = [];
    public function GetSingleStudent(Request $request)
    {
        try {
            $student_id = $request->student_id;

            // date year 
            $dateSetting = DateSetting::first();
            $current_year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ($request->year ?? null);


            $this->response = Student::where('id', $student_id)->get();

            if (count($this->response) != "0") {
                $student = Student::where('id', $student_id)->first();
                $parents_id = $student->parents_id;

                $vehicle_root = $student->vehicle_root;

                if($vehicle_root != "No")
                {
                  $responseRoot = VehicleRoot::where("id", $vehicle_root)->first();
                  if($responseRoot)
                  {
                    $root_name = $responseRoot->root_name;
                    $root_amount = $responseRoot->amount;

                     // Append $root_name and $root_amount to the "Studentdata" array
                    $this->allData['TransportRoot']['root_name'] = $root_name;
                    $this->allData['TransportRoot']['root_amount'] = $root_amount;
                  }
                  else{
                    $this->allData['TransportRoot']['root_name'] =  "No";
                    $this->allData['TransportRoot']['root_amount'] =  "";
                }
                }
                else{
                    $this->allData['TransportRoot']['root_name'] =  "No";
                    $this->allData['TransportRoot']['root_amount'] =  "";
                }


                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }

                $this->parent_response = Parents::where('id', $parents_id)->get();
                if (count($this->parent_response) != "0") {
                    foreach ($this->parent_response as $this->parentdata) {
                        array_push($this->ParentData, $this->parentdata);
                    }

                    $this->TotalPayment = FeePayment::where('class_year', $student->class_year)->where('st_id', $student_id)->first();

                    return response(array("Studentdata" => $this->allData, "Parentsdata" => $this->ParentData, "TotalPayment" => $this->TotalPayment), 200);
                }

            } else {
                return response()->json(['message' => 'data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function GetTransportStudent(Request $request)
    {
        try {

          $select_root = $request->select_root;

            $TransportStudent = JoinleaveDates::where('transport_fee', 'like', '%"1"%')->get();

            if ($TransportStudent->isNotEmpty()) {

                $studentIds = $TransportStudent->pluck('st_id')->toArray();

                if($select_root == "all_roots"){
                    $students = Student::whereIn('id', $studentIds)->where("admission_status","admit")->get();
                }
                else{
                    $students = Student::whereIn('id', $studentIds)->where("vehicle_root", $select_root)->where("admission_status","admit")->get();
                }
            
                return response(array("Studentdata" => $students), 200);
            } else {
                return response()->json(['message' => 'Data not found']);
            }
            

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }

    }

    public function UpdateStudent(Request $request)
    {

        try {
            $student_id = $request->student_id;
            $st_id = $request->student_id;
            $current_year = $request->current_year;
            $year = $request->current_year;

           $vehicle_root = $request->input("vehicle_root") ?? 'No'; 
           $transport_use = $request->input("transport_use") ?? 'No';
           $coaching_use = $request->input("coaching_use") ?? 'No';



            $student_image_crope = $request->input("student_image_name");
            $document_image_crope = $request->input("document_image_name");
            $father_image_crope = $request->input("father_image_name");
            $mother_image_crope = $request->input("mother_image_name");

            $student_image = Student::find($student_id);
            $student_image_path = $student_image->student_image;
            $student_proof_image_path = $student_image->id_image;

            $student_image_name = basename($student_image_path);
            $id_image_name = basename($student_proof_image_path);

            $parent_check =  $request->input("parent_check");
            $parent_existing_id = $request->input("parent_existing_id");
            $image_id = time();

            $FeestractureMonthly = FeestractureMonthly::where('class', $request->input("class"))->first();

            // return false;
            $student = Student::findOrFail($student_id);
            $studentUpdated = $student->update([
                'student_image' => $student_image_path,
                'first_name' => $request->input("student_first_name"),
                'middle_name' => $request->input("student_middle_name") ?? "",
                'last_name' => $request->input("student_last_name"),
                'gender' => $request->input("student_gender"),
                'dob' => $request->input("student_dob") ?? "",
                'religion' => $request->input("student_religion") ?? "",
                'blood_group' => $request->input("student_blood_group") ?? "",
                'phone' => $request->input("student_phone") ?? "",
                'email' => $request->input("student_email"),
                'id_number' => $request->input("student_id_number"),
                'id_image' => $student_proof_image_path,
                'admission_date' => $request->input("admission_date"),
                'class' => $request->input("class"),
                'section' => $request->input("section"),
                'roll_no' => $request->input("roll_no"),
                'district' => $request->input("district"),
                'municipality' => $request->input("municipality"),
                'village' => $request->input("village"),
                'ward_no' => $request->input("ward_no"),
                'coaching' => $coaching_use,
                'hostel_outi' => $request->input("hostel_outi"),
                'transport_use' => $transport_use,
                'vehicle_root' => $vehicle_root,
            ]);

                            
                /////// Start JoininhData Set ///////
                    // Admission date
                    $admission_date = Carbon::parse($request->input("admission_date"));
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month - 1;
                    
 
                    
                    $admissionStartMonthsArray = array_fill(0, 12, "0");

                    // Define an array with 12 elements initialized to "0"
                    $admissionStartMonthsArray = array_fill(0, 12, "0");
        
                    // Set the admission month and subsequent months to "1"
                    for ($i = $admission_month; $i < 12; $i++) {
                        $admissionStartMonthsArray[$i] = "1";
                    }
        
                    $admissionMonthsArray = array_fill(0, 12, "0");
                    $admissionMonthsArray[$admission_month] = "1";
                    $serializedAdmissionArray = json_encode($admissionMonthsArray);
                    
                    $serializedStartAdmissionArray = json_encode($admissionStartMonthsArray);

                    $JoinleaveDates = JoinleaveDates::where('st_id', $student->id)->first();
                    if ($JoinleaveDates) {
                        $JoinleaveDates->delete();
                    }
 

                    // Exam Joining
                    $exam_json = '["0","0","1","0","0","1","0","0","1","0","0","1"]';
                    if($admission_month >= 2){
                        $exam_json = '["0","0","1","0","0","1","0","0","1","0","0","1"]';
                    }
                    if($admission_month >= 3){
                        $exam_json = '["0","0","0","0","0","1","0","0","1","0","0","1"]';
                    }
                    if($admission_month >= 6){
                        $exam_json = '["0","0","0","0","0","0","0","0","1","0","0","1"]';
                    }
                    if($admission_month >= 9){
                        $exam_json = '["0","0","0","0","0","0","0","0","0","0","0","1"]';
                    }

                    $joinLeaveEntry = new JoinleaveDates;
                    $joinLeaveEntry->st_id  = $student->id;
                    $joinLeaveEntry->class_year  = $year;
                    $joinLeaveEntry->admission_months = $serializedAdmissionArray;
                    $joinLeaveEntry->admission_start = $serializedStartAdmissionArray;
                    $joinLeaveEntry->tuition_fee = $serializedStartAdmissionArray;
                    
                    $joinLeaveEntry->transport_fee = ($vehicle_root == "No") ? '["0","0","0","0","0","0","0","0","0","0","0","0"]' : $JoinleaveDates->transport_fee;
                    $joinLeaveEntry->full_hostel_fee = ($request->input("hostel_outi") != "full-hostel") ? '["0","0","0","0","0","0","0","0","0","0","0","0"]' : $JoinleaveDates->full_hostel_fee;
                    $joinLeaveEntry->half_hostel_fee = ($request->input("hostel_outi") != "half-hostel") ? '["0","0","0","0","0","0","0","0","0","0","0","0"]' : $JoinleaveDates->half_hostel_fee;
                    $joinLeaveEntry->coaching_fee = ($coaching_use != "Yes") ? '["0","0","0","0","0","0","0","0","0","0","0","0"]' : $JoinleaveDates->coaching_fee;
                       
                    $joinLeaveEntry->computer_fee  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->admission_fee = ($current_year == $admission_year) ? $serializedAdmissionArray : ($JoinleaveDates->admission_fee ?? '["0","0","0","0","0","0","0","0","0","0","0","0"]');
                    $joinLeaveEntry->annual_charge = $JoinleaveDates->annual_charge ?? '["1","0","0","0","0","0","0","0","0","0","0","0"]';
                    $joinLeaveEntry->saraswati_puja = $JoinleaveDates->saraswati_puja ?? '["0","0","0","0","0","0","0","0","0","1","0","0"]';
                    
                    $joinLeaveEntry->exam_fee = $exam_json;
                    $joinLeaveEntry->save();
                /////// End JoininhData Set  /////////////

                $TotalFee = 0;
                ///////////////////// Start Total Feee Retrive ///////////////////////////
                    $student = Student::where('class', $request->input("class"))->where('id', $st_id)->where('class_year', $current_year)->first();

                    $FeestractureMonthly = FeestractureMonthly::where('class', $request->input("class"))->first();
                    $FeestractureOnetime = FeestractureOnetime::where('class', $request->input("class"))->first();
                    $FeestractureQuarterly = FeestractureQuarterly::where('class', $request->input("class"))->first();

                    $joining_months = JoinleaveDates::where('st_id', $st_id)->first();
                    $StudentsFreeFee = ManageFreeStudents::where('st_id', $st_id)->first();

                    $student = Student::where('id', $st_id)->first();
                    $admission_date = Carbon::parse($student->admission_date);
                    $admission_year = $admission_date->year;
                    $admission_month = $admission_date->month;

                    if($year != $admission_year)
                    {
                        $start_month = 0;
                    }
                    else{
                    $start_month = $admission_month-1;
                    }  

                    for ($i = $start_month; $i <= 11; $i++) {
                        $MonthFeeGenerate = 0;  
                        ////////// Start Check Tuition Fee /////////
                          // Start tuition joining month check than add amount
                            if ($joining_months) {
                                $tuition_months_array = json_decode($joining_months->tuition_fee, true);
                                if($tuition_months_array[$i] == 1)
                                {
                                    $tuition_fee =  $FeestractureMonthly->tuition_fee;
                                }
                                else{
                                    $tuition_fee = 0; 
                                }
                            }
                            else{
                                $tuition_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Tuition Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $tuition_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Tuition Fee")->first();
                                    if($DiscountExceptions){
                                        $tuitionDisc = $DiscountExceptions->dis; 
                                        $tutionDiscAmount = ($tuition_fee * $tuitionDisc) / 100;
                                        $tuition_fee = $tuition_fee - $tutionDiscAmount;
                                    }
                                // End Check Discount Exception 

                            if ($tuition_fee != 0) {
                                $TotalFee += $tuition_fee;
                                $MonthFeeGenerate += $tuition_fee;
                            }
                        /////////// End Check Tuition Fee /////////

                        /////////// Start Check Transport Fee ///////////
                                if ($student->vehicle_root != "No") {
                                    // Outi Use Transport
                                    $VehicleRoot = VehicleRoot::where('id', $student->vehicle_root)->first();
                                    if ($joining_months) {
                                        $transport_months_array = json_decode($joining_months->transport_fee, true);
                                        if($transport_months_array[$i] == 1)
                                        {
                                            $transport_amount =  $VehicleRoot->amount ?? 0;
                                        }
                                        else{
                                            $transport_amount = 0; 
                                        }
                                    }
                                    else{
                                        $transport_amount = 0;
                                    }
                                } else {
                                    // Outi Not use Transport
                                    $transport_amount = 0;
                                }

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("Transport Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $transport_amount = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Transport Fee")->first();
                                        if($DiscountExceptions){
                                            $transportDisc = $DiscountExceptions->dis; 
                                            $transportDiscAmount = ($transport_amount * $transportDisc) / 100;
                                            $transport_amount = $transport_amount - $transportDiscAmount;
                                        }
                                    // End Check Discount Exception

                            if ($transport_amount != 0) {
                                $TotalFee += $transport_amount;
                                $MonthFeeGenerate += $transport_amount;
                            }
                
                        /////////// End Check Transport Fee /////////// 
                        
                        /////////// Start Check Full Hostel Fee ///////////
                            // Start coaching joining month check than add amount
                            if ($joining_months) {
                                $fullhostel_months_array = json_decode($joining_months->full_hostel_fee, true);
                                if($fullhostel_months_array[$i] == 1)
                                {
                                    $full_hostel_fee =  $FeestractureMonthly->full_hostel_fee;
                                }
                                else{
                                    $full_hostel_fee = 0; 
                                }
                                }
                                else{
                                    $full_hostel_fee = 0;
                                }

                                    ///// Start Fee Exceptionss 
                                        if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("F Hostel Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $full_hostel_fee = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "F Hostel Fee")->first();
                                        if($DiscountExceptions){
                                            $fhostelDisc = $DiscountExceptions->dis; 
                                            $fhostelDiscAmount = ($full_hostel_fee * $fhostelDisc) / 100;
                                            $full_hostel_fee = $full_hostel_fee - $fhostelDiscAmount;
                                        }
                                    // End Check Discount Exception 

                                if ($full_hostel_fee != 0) {
                                    $TotalFee += $full_hostel_fee;
                                    $MonthFeeGenerate += $full_hostel_fee;
                                }
                        /////////// End Check Full Hostel Fee ///////////

                        /////////// Start Check Half Hostel Fee ///////////
                            // Start coaching joining month check than add amount
                            if ($joining_months) {
                                $halfhostel_months_array = json_decode($joining_months->half_hostel_fee, true);
                                if($halfhostel_months_array[$i] == 1)
                                {
                                    $half_hostel_fee =  $FeestractureMonthly->half_hostel_fee;
                                }
                                else{
                                    $half_hostel_fee = 0; 
                                }
                                }
                                else{
                                    $half_hostel_fee = 0;
                                }

                                    ///// Start Fee Exceptionss 
                                            if ($StudentsFreeFee) {
                                            $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                            $index = array_search("H Hostel Fee", $freeFeeArray);
                                            if ($index !== false) {
                                                $half_hostel_fee = 0;
                                            }
                                        } 
                                    ///// End Fee Exceptionss

                                    // Start Check Discount Exception 
                                        $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "H Hostel Fee")->first();
                                        if($DiscountExceptions){
                                            $hhostelDisc = $DiscountExceptions->dis; 
                                            $hhostelDiscAmount = ($half_hostel_fee * $hhostelDisc) / 100;
                                            $half_hostel_fee = $half_hostel_fee - $hhostelDiscAmount;
                                        }
                                    // End Check Discount Exception 

                                if ($half_hostel_fee != 0) {
                                    $TotalFee += $half_hostel_fee;
                                    $MonthFeeGenerate += $half_hostel_fee;
                                }
                        /////////// End Check Half Hostel Fee ///////////

                        /////////// Start Check Coaching Fee ///////////
                            if ($student->coaching == "Yes") {
                                // Start coaching joining month check than add amount
                                if ($joining_months) {
                                $coaching_months_array = json_decode($joining_months->coaching_fee, true);
                                if($coaching_months_array[$i] == 1)
                                {
                                    $coaching_fee =  $FeestractureMonthly->coaching_fee;
                                }
                                else{
                                    $coaching_fee = 0; 
                                }
                            }
                            else{
                                $coaching_fee = 0;
                            }

                            } else {
                                $coaching_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Coaching Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $coaching_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Coaching Fee")->first();
                                    if($DiscountExceptions){
                                        $coachingDisc = $DiscountExceptions->dis; 
                                        $transportDiscAmount = ($coaching_fee * $coachingDisc) / 100;
                                        $coaching_fee = $coaching_fee - $transportDiscAmount;
                                    }
                                // End Check Discount Exception

                            if ($coaching_fee != 0) {
                                $TotalFee += $coaching_fee;
                                $MonthFeeGenerate += $coaching_fee;
                            }
                        /////////// End Check CoachingFee Fee ///////////

                        /////////// Start Check Computer Fee ///////////
                            // Start computer joining month check than add amount
                            if ($joining_months) {
                                $computer_months_array = json_decode($joining_months->computer_fee, true);
                                if($computer_months_array[$i] == 1)
                                {
                                    $computer_fee =  $FeestractureMonthly->computer_fee;
                                }
                                else{
                                    $computer_fee = 0; 
                                }
                            }
                            else{
                                $computer_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Computer Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $computer_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Computer Fee")->first();
                                    if($DiscountExceptions){
                                        $computergDisc = $DiscountExceptions->dis; 
                                        $computerDiscAmount = ($computer_fee * $computergDisc) / 100;
                                        $computer_fee = $computer_fee - $computerDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($computer_fee != 0) {
                                $TotalFee += $computer_fee;
                                $MonthFeeGenerate += $computer_fee;
                            }
                        /////////// End Check CoachingFee Fee ///////////

                        /////////// Start Check Admission Fee ///////////
                            // Start admission joining month check than add amount
                            if ($joining_months) {
                                $admission_months_array = json_decode($joining_months->admission_fee, true);
                                if($admission_months_array[$i] == 1)
                                {
                                    $admission_fee =  $FeestractureOnetime->admission_fee;
                                }
                                else{
                                    $admission_fee = 0; 
                                }
                            }
                            else{
                                $admission_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Admission Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $admission_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Admission Fee")->first();
                                    if($DiscountExceptions){
                                        $admissionDisc = $DiscountExceptions->dis; 
                                        $admissionDiscAmount = ($admission_fee * $admissionDisc) / 100;
                                        $admission_fee = $admission_fee - $admissionDiscAmount;
                                    }
                                // End Check Discount Exception 
                    
                            if ($admission_fee != 0) {
                                $TotalFee += $admission_fee;
                                $MonthFeeGenerate += $admission_fee;
                            }
                        /////////// End Check Admission Fee ///////////

                        /////////// Start Check Annual Charge ///////////
                            // Start annual joining month check than add amount
                            if ($joining_months) {
                                $annual_months_array = json_decode($joining_months->annual_charge, true);
                                if($annual_months_array[$i] == 1)
                                {
                                    $annual_charge =  $FeestractureOnetime->annual_charge;
                                }
                                else{
                                    $annual_charge = 0; 
                                }
                            }
                            else{
                                $annual_charge = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Annual Charge", $freeFeeArray);
                                        if ($index !== false) {
                                            $annual_charge = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Annual Charge")->first();
                                    if($DiscountExceptions){
                                        $annualDisc = $DiscountExceptions->dis; 
                                        $annualDiscAmount = ($annual_charge * $annualDisc) / 100;
                                        $annual_charge = $annual_charge - $annualDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($annual_charge != 0) {
                                $TotalFee += $annual_charge;
                                $MonthFeeGenerate += $annual_charge;
                            }
                        /////////// End Check Annual Charge ///////////

                        /////////// Start Check Saraswati Puja Charge ///////////
                            // Start Saraswati joining month check than add amount
                            if ($joining_months) {
                                $saraswati_months_array = json_decode($joining_months->saraswati_puja, true);
                                if($saraswati_months_array[$i] == 1)
                                {
                                    $saraswati_puja =  $FeestractureOnetime->saraswati_puja;
                                }
                                else{
                                    $saraswati_puja = 0; 
                                }
                            }
                            else{
                                $saraswati_puja = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Saraswati Puja", $freeFeeArray);
                                        if ($index !== false) {
                                            $saraswati_puja = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Saraswati Puja")->first();
                                    if($DiscountExceptions){
                                        $saraswatiDisc = $DiscountExceptions->dis; 
                                        $examDiscAmount = ($saraswati_puja * $saraswatiDisc) / 100;
                                        $saraswati_puja = $saraswati_puja - $examDiscAmount;
                                    }
                                // End Check Discount Exception
                    
                            if ($saraswati_puja != 0) {
                                $TotalFee += $saraswati_puja;
                                $MonthFeeGenerate += $saraswati_puja;
                            }
                        /////////// End Check Saraswati Puja Charge ///////////

                        /////////// Start Check Exam Fee ///////////
                            // Start exam joining month check than add amount
                            if ($joining_months) {
                                $exam_months_array = json_decode($joining_months->exam_fee, true);
                                if($exam_months_array[$i] == 1)
                                {
                                    $exam_fee =  $FeestractureQuarterly->exam_fee;
                                }
                                else{
                                    $exam_fee = 0; 
                                }
                            }
                            else{
                                $exam_fee = 0;
                            }

                                ///// Start Fee Exceptionss 
                                    if ($StudentsFreeFee) {
                                        $freeFeeArray = json_decode($StudentsFreeFee->free_fee, true);
                                        $index = array_search("Exam Fee", $freeFeeArray);
                                        if ($index !== false) {
                                            $exam_fee = 0;
                                        }
                                    } 
                                ///// End Fee Exceptionss

                                // Start Check Discount Exception 
                                    $DiscountExceptions = DiscountExceptions::where('st_id', $st_id)->where("fee_type", "Exam Fee")->first();
                                    if($DiscountExceptions){
                                        $examDisc = $DiscountExceptions->dis; 
                                        $examDiscAmount = ($exam_fee * $examDisc) / 100;
                                        $exam_fee = $exam_fee - $examDiscAmount;
                                    }
                                // End Check Discount Exception

                                if ($exam_fee != 0) {
                                    $TotalFee += $exam_fee;
                                    $MonthFeeGenerate += $exam_fee;
                                }
                        /////////// End Check Exam Fee  ///////////

                        $feeGenerated = FeeGenerated::where("class_year", $year)->where('st_id', $st_id)->first();
                        if ($feeGenerated) {
                            $feeGenerated->{'month_'.$i} = $MonthFeeGenerate;
                            $feeGenerated->save();
                        } else {
                            $newRecord = new FeeGenerated();
                            $newRecord->st_id = $st_id;
                            $newRecord->class = $student->class;
                            $newRecord->class_year = $year; 
                            $newRecord->{'month_'.$i} = $MonthFeeGenerate; 
                            $newRecord->save();
                        }                        
                    }
                ///////////////////// End Total Feee Retrive ///////////////////////////
                  
            // Update student image
            $student_image = $request->file("student_image");
            if (!empty($student_image)) {

                if($student_image_name == "boy.jpg" || "girl.jpg"){
                    $student_image_name = time().".jpg";
                }

                $student_image->storeAs('public/upload_assets/students',  $student_image_name);
                $StudentCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $student_image_crope . '.jpg';
                $destinationPath = 'storage/upload_assets/students/' . $student_image_name;
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $student->student_image = "upload_assets/students/" . $student_image_name;
                File::move($StudentCropImgPath, $destinationPath);
            }

            //Update Student Proof Image
            $proof_id = $request->file("student_id_image");
            if (!empty($proof_id)) {
                $DocumentCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $document_image_crope . '.jpg';
                $destinationPath = 'storage/upload_assets/students/document/' . $id_image_name;

                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $student->id_image = "upload_assets/students/document/" . $id_image_name;
                File::move($DocumentCropImgPath, $destinationPath);
            }

            // Parent Data save 
            if ($parent_check == "new_parent") {

                $father_image_name = $request->input("father_image_name");
                $mother_image_name = $request->input("mother_image_name");

                // Parent Data Store
                $parent = new Parents;
                $parent->father_image  = $request->file("father_image");
                $parent->father_name  = $request->input("father_name");
                $parent->father_mobile  = $request->input("father_phone") ?? "";
                $parent->father_education  = $request->input("father_education") ?? "";
                $parent->mother_image  = $request->file("mother_image");
                $parent->mother_name  = $request->input("mother_name") ?? "";
                $parent->mother_mobile  = $request->input("mother_phone") ?? "";
                $parent->mother_education  = $request->input("mother_education") ?? "";
                $parent->login_password  = Str::random(10);

                $dymamic_email_father = strtolower(str_replace(" ", "", $request->input("father_name"))) . "_" .  Student::where('class', $request->input("class"))->count() + 1;

                $parent->login_email  = $request->input("father_email") ?? $dymamic_email_father . "@gmail.com";


                // Father Crop Image Store
                $father_image = $request->file("father_image");
                if (!empty($father_image)) {
                    $FatherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $father_image_name . '.jpg';
                    $destinationPath = 'storage/upload_assets/father/' . "father_" . $image_id . ".jpg";
                    if (!File::exists(dirname($destinationPath))) {
                        File::makeDirectory(dirname($destinationPath), 0755, true);
                    }
                    $parent->father_image = "upload_assets/father/father_" . $image_id . ".jpg";
                    File::move($FatherCropImgPath, $destinationPath);
                } else {
                    $parent->father_image = "CommonImg/father.jpg";
                }


                // Mother Crop Image Store
                $mother_image = $request->file("mother_image");
                if (!empty($mother_image)) {
                    $MotherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $mother_image_name . '.jpg';
                    $destinationPath = 'storage/upload_assets/mother/' . "mother_" . $image_id . ".jpg";
                    if (!File::exists(dirname($destinationPath))) {
                        File::makeDirectory(dirname($destinationPath), 0755, true);
                    }
                    $parent->mother_image = "upload_assets/mother/mother_" . $image_id . ".jpg";
                    File::move($MotherCropImgPath, $destinationPath);
                } else {
                    $parent->mother_image = "CommonImg/mother.jpg";
                }

                if ($parent->save()) {
                    $parentId = $parent->id;
                    // Associate the parent with the student
                    $student->parents_id = $parentId;
                    if ($student->save()) {
                        return response()->json(['status' => "Add Successfully"]);
                    } else {
                        return response()->json(['status' => "Failed Something Error"]);
                    }
                } else {
                    return response()->json(['status' => "Failed Something Error"]);
                }
            } else {
                $student->parents_id = $parent_existing_id;
                if ($student->save()) {
                    return response()->json(['status' => "Update Successfully"]);
                } else {
                    return response()->json(['status' => "Failed Something Error"]);
                }
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function student_for_card(Request $request)
    {
        try {
            $class =  $request->classes;
            $section = $request->section;
            $this->student_response = Student::where("class", $class)->where("section", $section)->paginate(10);
            $this->parent_response = Parents::whereIn('id', $this->student_response->pluck('parents_id'))->get();

            $data = $this->student_response->toArray();
            $parentData = $this->parent_response->toArray();

            foreach ($data['data'] as &$student) {
                $parentId = $student['parents_id'];
                $parent = collect($parentData)->firstWhere('id', $parentId);
                $student['parent_data'] = $parent;
            }

            $SchoolDetails = SchoolDetails::get();
            $data['school_details'] = $SchoolDetails;

            if (count($this->student_response) != 0) {
                return response(array("data" => $data), 200);
            } else {
                return response()->json(['message' => 'Data not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function admission_print(Request $request)
    {
        try {
            $st_id = $request->st_id;

            $student = Student::where("id", $st_id)->first();

            $parent = Parents::where("id", $student->parents_id)->first();

            $school = SchoolDetails::first();

            return response()->json(['student' => $student, 'parent' => $parent, 'school' => $school]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
