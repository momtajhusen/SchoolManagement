<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Driver;
use App\Models\Employee;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\File;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $response;
    public $data;
    public $allData = [];
    public function index()
    {
        try {
            $this->response = Employee::where('department_role', 'Driver')->get();
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
        try {
            $driver_image_name = $request->input("driver_image_name");

            $image_id = time();
            $driver = new Driver;
            $driver->first_name  = $request->input("first_name");
            $driver->last_name  = $request->input("last_name");
            $driver->gender  = $request->input("gender");
            $driver->dob  = $request->input("dob");
            $driver->religion  = $request->input("religion");
            $driver->blood_group  = $request->input("blood_group");
            $driver->address  = $request->input("address");
            $driver->phone  = $request->input("phone");
            $driver->email  = $request->input("email");
            $driver->password  = Str::random(10);
            $driver->qualification  = $request->input("qualification");
            $driver->joining_date  = $request->input("joining_date");
            $driver->salary  = $request->input("salary");
            $driver->licence_no  = $request->input("licence_no");

            // Teacher Image Store
            $DriverCropImgPath = 'storage/CropingImage/SudentsAdmission/' . $driver_image_name . '.jpg';
            $destinationPath = 'storage/upload_assets/driver/' . "driver_image_" . $image_id . ".jpg";
            if (!File::exists(dirname($destinationPath))) {
                File::makeDirectory(dirname($destinationPath), 0755, true);
            }
            $driver->image =   "upload_assets/driver/driver_image_" . $image_id . ".jpg";
            File::move($DriverCropImgPath, $destinationPath);

            if ($driver->save()) {
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
    public function update(Request $request)
    {
        try {
            $driver_id = $request->input("driver_id");

            $driver = Driver::find($driver_id);
            $driver_image_path = $driver->image;

            if (!$driver) {
                return response()->json(['ErrorMessage' => 'Driver not found'], 404);
            }

            $driver->first_name = $request->input("first_name");
            $driver->last_name = $request->input("last_name");
            $driver->gender = $request->input("gender");
            $driver->dob = $request->input("dob");
            $driver->religion = $request->input("religion");
            $driver->blood_group = $request->input("blood_group");
            $driver->address = $request->input("address");
            $driver->phone = $request->input("phone");
            $driver->email = $request->input("email");
            $driver->qualification = $request->input("qualification");
            $driver->joining_date = $request->input("joining_date");
            $driver->salary = $request->input("salary");
            $driver->licence_no = $request->input("licence_no");


            // Update student image
            $driver_image = $request->file("image");

            if (!empty($driver_image)) {
                // Get the existing driver image path and filename
                $existing_image_path = $driver->image;
                $existing_image_filename = pathinfo($existing_image_path, PATHINFO_BASENAME);

                // Store the updated image file with the same filename
                $driver_image->storeAs('public/upload_assets/driver', $existing_image_filename);

                $StudentCropImgPath = 'storage/CropingImage/SudentsAdmission/driveradd.jpg';
                $destinationPath = public_path('storage/upload_assets/driver/' . $existing_image_filename);

                // Create the directory if it does not exist
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }

                $driver->image = "upload_assets/driver/" . $existing_image_filename;

                // Move the cropped image file to the desired location
                File::move($StudentCropImgPath, $destinationPath);
            }


            $driver->save();

            return response()->json(['status' => 'updated successfully'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {


        try {
            $driver_id = $request->driver_id;

            $Driver = Driver::find($driver_id);
            if ($Driver->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Driver not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
