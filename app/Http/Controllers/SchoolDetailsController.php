<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\File;
use App\Models\SchoolDetails;
use App\Models\DateSetting;



class SchoolDetailsController extends Controller
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
            $this->response = SchoolDetails::get();
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

    public function dateSettingGet()
    {
        try {
            $this->response = DateSetting::get();
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Check if there are any records in the SchoolDetails table
            $schoolDetailsTable = SchoolDetails::count();
            $school = $schoolDetailsTable != 0 ? SchoolDetails::first() : new SchoolDetails;

            // Set the values of the school object
            $school->school_name  = $request->input("school_name");
            $school->phone  = $request->input("phone");
            $school->email  = $request->input("email");
            $school->address  = $request->input("address");
            $school->website  = $request->input("website");
            $school->pan_no  = $request->input("pan_no");
            $school->estd_year  = $request->input("estd_year");


            // Store the school logo if it exists in the request
            $logo_img = $request->file("logo_img");
            if (!empty($logo_img)) {
                $LogoCropImgPath = 'storage/CropingImage/SudentsAdmission/schoollogo.png';
                $destinationPath = 'storage/upload_assets/school/school_logo.png';
                if (!File::exists(dirname($destinationPath))) {
                    File::makeDirectory(dirname($destinationPath), 0755, true);
                }
                $school->logo_img = "upload_assets/school/school_logo.png";
                File::move($LogoCropImgPath, $destinationPath);
            }

            // Save the school object and return a response
            if ($school->save()) {
                return response()->json(['status' => "upload sucess"]);
            } else {
                return response()->json(['status' => "failed something error"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     **/
    public function dateSettingUpadet(Request $request)
    {
        try {
            $DateSettingTable = DateSetting::count();
            if ($DateSettingTable != 0) {
                $date = DateSetting::first();
                $date->using_date = $request->using_date;
                $date->year  = $request->select_year;
                $date->months  = $request->select_month;

                if ($date->save()) {
                    return response()->json(['status' => "upload sucess"]);
                } else {
                    return response()->json(['status' => "failed something error"]);
                }
            } else {
                $date = new DateSetting;
                $date->using_date = $request->using_date;
                $date->year = $request->select_year;
                $date->months  = $request->select_month;

                if ($date->save()) {
                    return response()->json(['status' => "upload sucess"]);
                } else {
                    return response()->json(['status' => "failed something error"]);
                }
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
