<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\VehicleRoot;
use App\Models\JoinleaveDates;
use App\Models\Student;
use App\Models\Employee;



use Exception;

class VehicleController extends Controller
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
            $this->response = Vehicle::get();
            if (count($this->response) != "0") {
                foreach ($this->response as $this->data) {
                    array_push($this->allData, $this->data);
                }
                return response(array("vehicle" => $this->allData), 200);
            } else {
                return response()->json(['message' => 'vehicle not found']);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public $responseRoot;
    public $Rootdata;
    public $allRootData = [];
    public function GetVehicleRoot()
    {
        try {
            $responseRoot = VehicleRoot::get();

            if (count($responseRoot) != 0) {
                $allRootData = [];
            
                foreach ($responseRoot as $Rootdata) {
                    // Find all student IDs that match the vehicle_root in the Student table
                    $studentIds = Student::where('vehicle_root', $Rootdata->id)->pluck('id');
            
                    // Count the number of $TransportStudent records with st_id matching the student IDs
                    $studentCount = JoinleaveDates::where('transport_fee', 'like', '%"1"%')->whereIn('st_id', $studentIds)->count();
            
                    // Append data to the $allRootData array
                    $allRootData[] = [
                        'vehicle_root' => $Rootdata,
                        'root_student' => $studentCount,
                    ];
                }
            
                // Sort the $allRootData array by 'root_student' in descending order
                usort($allRootData, function ($a, $b) {
                    return $b['root_student'] - $a['root_student'];
                });
            
                return response(['VehicleRoot' => $allRootData], 200);
            } else {
                return response()->json(['message' => 'VehicleRoot not found']);
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
            if (!Vehicle::where('vehicle_number', $request->input("vehicle_number"))->exists()) {

                $driver = Employee::where("id", $request->input("driver_id"))->first();

                $vehicle = new Vehicle;
                $vehicle->vehicle_type  = $request->input("vehicle_type");
                $vehicle->vehicle_number  = $request->input("vehicle_number");
                $vehicle->driver_id  = $request->input("driver_id");
                $vehicle->driver_name  =  $driver->first_name . " " . $driver->last_name;

                if ($vehicle->save()) {
                    return response()->json(['status' => "vehicle Add Sucess"]);
                }
            } else {
                return response()->json(['status' => "exists vehicle"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AddVehicleRoot(Request $request)
    {
        try {
            if (!VehicleRoot::where('root_name', $request->input("root_name"))->exists()) {

                $vehicle = new VehicleRoot;
                $vehicle->root_name  = $request->input("root_name");
                $vehicle->vehicle  = $request->input("vehicle");
                $vehicle->timing  = $request->input("timing");
                $vehicle->amount  = $request->input("amount");
                if ($vehicle->save()) {
                    return response()->json(['status' => "Root Add Sucess"]);
                }
            } else {
                return response()->json(['status' => "Exists Root Name"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }




    public function UpdateVehicleRoot(Request $request)
    {
        try {


            $root_id = $request->input("root_id");

            $root = VehicleRoot::find($root_id);

            if (!$root) {
                return response()->json(['ErrorMessage' => 'Driver not found'], 404);
            }

            $root->root_name  = $request->input("root_name");
            $root->vehicle  = $request->input("vehicle");
            $root->timing  = $request->input("timing");
            $root->amount  = $request->input("amount");
            $root->save();

            return response()->json(['status' => 'Root Update Sucess'], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function DeleteVehicleRoot(Request $request)
    {
        try {
            $root_id = $request->root_id;

            $VehicleRoot = VehicleRoot::find($root_id);
            if ($VehicleRoot->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Vehicle not Found"]);
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
            $vehicle_id = $request->input("vehicle_id");

            $vehicle = Vehicle::find($vehicle_id);

            if (!$vehicle) {
                return response()->json(['ErrorMessage' => 'Driver not found'], 404);
            }

            $vehicle->vehicle_type = $request->input("vehicle_type");
            $vehicle->vehicle_number = $request->input("vehicle_number");
            $vehicle->driver_id = $request->input("driver_id");
            $vehicle->save();

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
    public function delete_vehicle(Request $request)
    {
        try {
            $vehicle_id = $request->vehicle_id;

            $Vehicle = Vehicle::find($vehicle_id);
            if ($Vehicle->delete()) {
                return response()->json(['status' => "Delete Success"]);
            } else {
                return response()->json(['status' => "Vehicle not Found"]);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
