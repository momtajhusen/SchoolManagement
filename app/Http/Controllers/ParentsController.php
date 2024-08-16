<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Storage;

use App\Models\Parents;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ParentsController extends Controller
{
 
    public function index(Request $request)
    {

        try {
            $parents_search_select = $request->parents_search_select;
            $parents_input_search = $request->parents_input_search;
            
            if ($parents_input_search != "child_no") {
                $parent_response = Parents::query();
        
                if ($parents_search_select == "father_mobile" || $parents_search_select == "login_email" || $parents_search_select == "id") {
                    $parent_response->where($parents_search_select, $parents_input_search);
                } elseif ($parents_search_select == "child_no") {
                    $students = Student::select('parents_id')->groupBy('parents_id')->havingRaw('COUNT(*) = ' . $parents_input_search)->pluck('parents_id');
                    $parent_response->whereIn('id', $students);
                } elseif ($parents_input_search != "") {
                    $parent_response->where($parents_search_select, 'LIKE', '%' . $parents_input_search . '%');
                }
                
                $parent_response = $parent_response->paginate(10);
        
                // Use isEmpty() to check if there are no results
                if ($parent_response->isEmpty()) {
                    return response()->json(['message' => 'Parent data not found']);
                }
        
                foreach ($parent_response as $parent) {
                    $parent->students = Student::where('parents_id', $parent->id)->get();
                }
        
                return response()->json(['parent_data' => $parent_response], 200);
            } else {
                return response()->json(['message' => 'Invalid search criteria']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
        
    }
 
    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        echo "store";
    }
 
    public function show(Request $request)
    {
        try {
            // Validate the parent ID parameter
            $validatedData = $request->validate([
                'parent_id' => 'required|integer'
            ]);

            // Sanitize the parent ID parameter
            $parent_id = filter_var($validatedData['parent_id'], FILTER_SANITIZE_NUMBER_INT);

            // Retrieve parent data from the database
            $parent_response = Parents::where('id', $parent_id)->first();

            // Check if the parent data was found
            if ($parent_response) {
                return response()->json(['data' => $parent_response], 200);
            } else {
                return response()->json(['message' => 'Data not found.'], 404);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
 
    public function update(Request $request)
    {
        try {
            $parent_id = $request->parent_id;

            $father_image_crope = $request->input("father_image_name");
            $mother_image_crope = $request->input("mother_image_name");

            $father_name = $request->father_name;
            $father_phone = $request->father_phone ?? "";
            $father_email = $request->father_email ?? "";
            $father_education = $request->father_education ?? "";

            $mother_name = $request->mother_name ?? "";
            $mother_phone = $request->mother_phone ?? "";
            $mother_education = $request->mother_education ?? "";

            $image_id = time();

            $Parents = Parents::findOrFail($parent_id);
            $Parents->forceFill([
                'father_name' => $father_name,
                'father_mobile' => $father_phone,
                'login_email' => $father_email,
                'father_education' => $father_education,
                'mother_name' => $mother_name,
                'mother_mobile' => $mother_phone,
                'mother_education' => $mother_education,
            ]);

            // Father Crop Image Store
            $father_image = $request->file("father_image");
            if (!empty($father_image)) {
                $FatherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $father_image_crope . '.jpg';
                $destinationPath = 'storage/upload_assets/father/' . "father_" . $image_id . ".jpg";
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $Parents->father_image = "upload_assets/father/father_" . $image_id . ".jpg";
                File::move($FatherCropImgPath, $destinationPath);
            } else {
                $Parents->father_image = "CommonImg/father.jpg";
            }

            // Mother Crop Image Store
            $mother_image = $request->file("mother_image");
            if (!empty($mother_image)) {
                $MotherCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $mother_image_crope . '.jpg';
                $destinationPath = 'storage/upload_assets/mother/' . "mother_" . $image_id . ".jpg";
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $Parents->mother_image = "upload_assets/mother/mother_" . $image_id . ".jpg";
                File::move($MotherCropImgPath, $destinationPath);
            } else {
                $Parents->mother_image = "CommonImg/mother.jpg";
            }



            if ($Parents->save()) {
                return response()->json(['status' => "Update Success"], 200);
            } else {
                return response()->json(['status' => "Update Failed Try Again"], 500);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function manualUpdateParent(Request $request){
       $father_name = $request->input('father-name');
       $mother_name = $request->input('mother-name');
       $father_contact = $request->input('father-contact');
       $address = $request->input('father-address');
       $pr_id = $request->input('pr_id');

 
       $Parent = Parents::where('id', $pr_id)->first();
       $Parent->father_name = $father_name;
       $Parent->mother_name = $mother_name;
       $Parent->father_mobile = $father_contact;




       $Students = Student::where('parents_id', $pr_id)->get();
       foreach($Students as $student){
          $student->village = $address;
          $student->save();
       }






       if($Parent->save()){
        echo 'Update Sucess';
       }
  
    }

    public function DeleteParent(Request $request)
    {
        try {

           $pr_id = $request->pr_id;

           $parents = Parents::find($pr_id);

            if($parents){

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

                    if($parents->delete()){
                        return response()->json(['message' => 'Parents deleted successfully']);
                    }

            }
            else{
                return response()->json(['message' => 'Parents not found']);
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function ChangeParent(Request $request)
    {
       $pr_id = $request->pr_id;
       $st_id = $request->st_id;

   
         $Student = Student::where('id', $st_id)->first();
         $Student->parents_id = $pr_id;
         if($Student->save()){
            echo 'change sucess';
         }else{
            echo 'failed';
         }
    }
}
