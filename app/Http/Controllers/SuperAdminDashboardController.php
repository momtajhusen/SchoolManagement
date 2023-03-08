<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Teacher;



class SuperAdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $Total_Student = Student::count();
        $Total_Parents = Parents::count();
        $Total_Teacher = Teacher::count();

        return response()->json([
            'Total_Student' => $Total_Student,
            'Total_Parents' => $Total_Parents,
            'Total_Teacher' => $Total_Teacher,
        ]);

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