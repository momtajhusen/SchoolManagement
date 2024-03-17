<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Parents;
use App\Models\Student;

class SelectOption extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllAdmitParents(Request $request)
    {
        try {
            $parents = Parents::distinct()->get(['id', 'father_name', 'mother_name', 'father_mobile', 'mother_mobile']);

            if ($parents->isEmpty()) {
                return response()->json(['message' => 'parent not found']);
            }
            
            $parentsData = [];

            foreach ($parents as $parent) {
                if (!empty($parent->father_name)) {
                    $parentsData[] = [
                        'parent_id' => $parent->id,
                        'parent_name' => $parent->father_name,
                        'contact' => $parent->father_mobile,
                    ];
                }
                
                if (!empty($parent->mother_name)) {
                    $parentsData[] = [
                        'parent_id' => $parent->id,
                        'parent_name' => $parent->mother_name,
                        'contact' => $parent->mother_mobile,
                    ];
                }
            }
            
            return response()->json(['parentsData' => $parentsData], 200);
            
            

        }catch (Exception $e) {
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function AllAdmitStudents(Request $request)
    {
        try {

            $students = Student::distinct()->get(['id', 'parents_id', 'first_name', 'middle_name', 'last_name', 'phone']);

            if ($students->isEmpty()) {
                return response()->json(['message' => 'Students not found']);
            }
            
            $studentsData = [];
            
            foreach ($students as $student) {
                $studentsData[] = [
                    'student_id' => $student->id,
                    'parent_id' => $student->parents_id,
                    'student_name' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                    'contact' => $student->phone,
                ];
            }
            
            return response()->json(['studentsData' => $studentsData], 200);
            
        }catch (Exception $e) {
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
        //
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
