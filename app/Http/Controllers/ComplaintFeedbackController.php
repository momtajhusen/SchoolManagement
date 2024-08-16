<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ComplaintFeedback;


class ComplaintFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ComplaintAudio(Request $request)
    {
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $current_date = $request->current_date;

    
            // Generate a number-based filename
            $number = time(); // Use a timestamp as a unique number
            $filename = $number . '.' . $file->getClientOriginalExtension();
    
            // Store the file with the new filename
            $path = $file->storeAs('public/upload_assets/complaint_records', $filename);

            $data_path = $file->storeAs('upload_assets/complaint_records', $filename);

            $ComplaintFeedback = new ComplaintFeedback;
            $ComplaintFeedback->send_by  =  session('user_name');
            $ComplaintFeedback->record_path  = $data_path;
            $ComplaintFeedback->type  = "audio";
           $ComplaintFeedback->date  = $current_date;
            $ComplaintFeedback->save();
    
            return response()->json(['success' => true, 'path' => Storage::url($path)]);
        }
    
        return response()->json(['success' => false, 'message' => 'No audio file found.']);
    }

    public function ComplaintMessage(Request $request){
        try {
           $message = $request->message;
           $current_date = $request->current_date;
           
           $ComplaintFeedback = new ComplaintFeedback;
           $ComplaintFeedback->send_by  =  session('user_name');
           $ComplaintFeedback->message  = $message;
           $ComplaintFeedback->type  = "message";
           $ComplaintFeedback->date  = $current_date;
           $ComplaintFeedback->save();

           
           return response()->json(['success' => true]);

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => 'error', 'message' => $message], 500);
        } 
    }

    public function getAllRetriveComplainList(Request $request) {
        try {
            $complaintFeedback = ComplaintFeedback::orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'data' => $complaintFeedback], 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => 'error', 'message' => $message], 500);
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
