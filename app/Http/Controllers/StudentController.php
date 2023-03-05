<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Parents;
use App\Models\FeeStructure;
use Exception;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index() 
    {
        $this->response = Student::get();
        if(count($this->response) != "0")
        {
            foreach($this->response as $this->data)
            {
                array_push($this->allData,$this->data);
            }   
            
            return response(array("data"=>$this->allData),200);
        }
        else{
            return response()->json(['message' => 'data not found']); 
        }
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
    public function store(Request $request) 
    {
        
        $student = new Student;
        $student->first_name  = $request->input("student_first_name");
        $student->middle_name  = $request->input("student_middle_name");
        $student->last_name  = $request->input("student_last_name");
        $student->gender  = $request->input("student_gender");
        $student->dob  = $request->input("student_dob");
        $student->religion  = $request->input("student_religion");
        $student->blood_group  = $request->input("student_blood_group");
        $student->phone  = $request->input("student_phone");
        $student->email  = $request->input("student_email");
        $student->id_number  = $request->input("student_id_number");
        $student->id_image  = $request->file("student_id_image");
        $student->admission_date  = $request->input("admission_date");
        $student->admission_year = $request->admission_year;
        $student->class  = $request->input("class");
        $student->section  = $request->input("section");
        $student->roll_no  = $request->input("roll_no");
        $student->district  = $request->input("district");
        $student->municipality  = $request->input("municipality");
        $student->village  = $request->input("village");
        $student->ward_no  = $request->input("ward_no");
        $student->login_email  = $request->input("student_email");
        $student->login_password  = time();

        // Student Image Store
        $image_id = time();
        $student->student_image =   "upload_assets/students/profile_".$image_id.".jpg";
        $student_image = $request->file("student_image");
        $student_image->storeAs('public/upload_assets/students',  "profile_".$image_id.".jpg");
 
        // Student Proof Image Store
        $student->id_image =   "upload_assets/students/proof_".$image_id.".jpg";
        $proof_id = $request->file("student_id_image");
        $proof_id->storeAs('public/upload_assets/students',  "proof_".$image_id.".jpg");

        if($student->save())
        {
            $studentId = $student->id;
            echo "Add Successfully";
        }
        else{
           echo "Failed Something Error";
        } 

        // Parent Data Store 
        $parent = new Parents;
        $parent->Kids_id  = $studentId;
        $parent->father_image  = $request->file("father_image");
        $parent->father_name  = $request->input("father_name");
        $parent->father_mobile  = $request->input("father_phone");
        $parent->father_education  = $request->input("father_education");
        $parent->mother_image  = $request->file("mother_image");
        $parent->mother_name  = $request->input("mother_name");
        $parent->mother_mobile  = $request->input("mother_phone");
        $parent->mother_education  = $request->input("mother_education");
        $parent->login_email  = $request->input("login_email");
        $parent->login_password  = $request->input("login_password");

        // Father Image Store
        $parent->father_image =   "upload_assets/parent/father_".$image_id.".jpg";
        $father_image = $request->file("father_image");
        $father_image->storeAs('public/upload_assets/parent',  "father_".$image_id.".jpg");

        // Mother Image Store
        $parent->mother_image =   "upload_assets/parent/mother_".$image_id.".jpg";
        $mother_image = $request->file("mother_image");
        $mother_image->storeAs('public/upload_assets/mother',  "mother_".$image_id.".jpg");


        if($parent->save())
        {
            echo "Add Successfully";
        }
        else{
           echo "Failed Something Error";
        } 



    }

    /**
     * Display the specified resource.
     */
    public function show($id) 
    {

 
            if (Student::where('id', $id)->exists()) 
            {

               $student = Student::find($id);
               $class = $student->class;
 
               $fee_structure = FeeStructure::where('class', $class)->get();
               

               return response(array("StudentData"=>$student,"fee_structure"=>$fee_structure));
            } 
            
            else 
            {
             return response()->json(['StudentData' => 'student not avable']); 
            }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     */
    
    public function registration_list()
    {
        $this->response = Student::get();
        if(count($this->response) != "0")
        {
            foreach($this->response as $this->data)
            {
                array_push($this->allData,$this->data);
            }   
            
            return response(array("data"=>$this->allData),200);
        }
        else{
            return response()->json(['message' => 'data not found']); 
        }
    }

    

 
   public function admission_roll(Request $request)
   {
     $date = $request->admission_date;
     $class = $request->class;

     $student_roll = Student::where('class', $class)->where('admission_year', $date)->orderBy('id', 'desc')->value('roll_no');
     return response()->json(['student' => $student_roll]); 

   }


   public function getclassroll(Request $request)
   {
    $class = $request->class;
    $year = $request->year;
    $rolls = Student::where('class', $class)->where('admission_year', $year)->pluck('roll_no');
    return response()->json(['classrolls' => $rolls]);   
   }

    /**
     * Update the specified resource in storage.
     */
    public $parent_response;
    public $parentdata;
    public $ParentData = [];
    public function GetSingleStudent(Request $request) 
    {
         $class = $request->class;
         $roll = $request->roll;

        $this->response = Student::where('class', $class)->where('roll_no', $roll)->get();
        if(count($this->response) != "0")
        {
            foreach($this->response as $this->data)
            {
                array_push($this->allData,$this->data);
                $student_id = $this->data->id;
            }  
            
       
            
            $this->parent_response = Parents::where('Kids_id', $student_id)->get();
            if(count($this->parent_response) != "0")
            {
                foreach($this->parent_response as $this->parentdata)
                {
                    array_push($this->ParentData,$this->parentdata);
                }   
                
                return response(array("Studentdata"=>$this->allData, "Parentsdata"=>$this->ParentData),200);
            }

        }
        else{
            return response()->json(['message' => 'data not found']); 
        }




        

    }

    public function UpdateStudent(Request $request)
    {
        $student_id = $request->student_id;

        $student_image = Student::find($student_id);
        $student_image_path = $student_image->student_image;
        $student_proof_image_path = $student_image->id_image;

        $student_image_name = basename($student_image_path);
        $id_image_name = basename($student_proof_image_path);


        try {
            $student = Student::findOrFail($student_id);
            $studentUpdated = $student->update([
                'student_image' => $student_image_path,
                'first_name' => $request->input("student_first_name"),
                'middle_name' => $request->input("student_middle_name"),
                'last_name' => $request->input("student_last_name"),
                'gender' => $request->input("student_gender"),
                'dob' => $request->input("student_dob"),
                'religion' => $request->input("student_religion"),
                'blood_group' => $request->input("student_blood_group"),
                'phone' => $request->input("student_phone"),
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
                'ward_no' => $request->input("ward_no")

            ]);

               // Update student image
                $student_image = $request->file("student_image");
                if (!empty($student_image)) 
                {
                    $student_image->storeAs('public/upload_assets/students',  $student_image_name);
                }

                //Update Student Proof Image
                $proof_id = $request->file("student_id_image");
                if (!empty($proof_id)) 
                {
                    $proof_id->storeAs('public/upload_assets/students',  $id_image_name);
                }

                ///////// Update Parents /////////
                $parent_id = $request->parent_id;
                $parents_image = Parents::find($parent_id);
                $father_image_path = $parents_image->father_image;
                $mother_image_path = $parents_image->mother_image;

                $father_image_name = basename($father_image_path);
                $mother_image_name = basename($mother_image_path);
                
                $parents = Parents::findOrFail($parent_id);
                $studentUpdated = $parents->update([ 
                    'father_image' => $father_image_path,
                    'father_name' => $request->input("father_name"),
                    'father_phone' => $request->input("father_phone"),
                    'father_education' => $request->input("father_education"),
                    'mother_image' => $mother_image_path,
                    'mother_name' => $request->input("mother_name"),
                    'mother_phone' => $request->input("mother_phone"),
                    'mother_education' => $request->input("mother_education"),
                ]);

                // Update Father image
                $father_image = $request->file("father_image");
                if (!empty($father_image)) 
                {
                    $father_image->storeAs('public/upload_assets/parent',  $father_image_name);
                }

                // Update Mother image
                $mother_image = $request->file("mother_image");
                if (!empty($mother_image)) 
                {
                    $mother_image->storeAs('public/upload_assets/parent',  $mother_image_name);
                }

                        
            if ($studentUpdated) 
            {
                return response()->json(['status' => "Update Success"], 200);
 
            } else {
                return response()->json(['status' => "Update Failed Try Again"], 500);
            }
        } 
        catch (Exception $e) 
        {
            // Code to handle the exception
            $message = "An exception occurred: " . $e->getMessage();
            return response()->json(['ststus' => $message], 500);
        }
        
        
          
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        //
    }
}
