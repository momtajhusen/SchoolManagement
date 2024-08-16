<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\SendMail;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;


use Illuminate\Http\Request;

class MailController extends Controller
{
    // function index()
    // {
    //     return view('Super_Admin/layouts/Message/message_contant');
    // }

    function send(Request $request)
    {

        $parents_input = $request->parents;
        $teachers_input = $request->teachers;

        $subject = $request->subject;
        $message = $request->message;

            try{
                $details = [
                    'title' => $subject,
                    'message' => $message,
                ];

                if($teachers_input == "message")
                {
                    $teacher_emails = Teacher::pluck('email');
                    foreach ($teacher_emails as $teacher_email) {
                        Mail::to($teacher_email)->send(new SendMail($details));
                    }   
                }

                else if($parents_input == "message")
                {
                    $teacher_emails = Parents::pluck('login_email');
                    foreach ($teacher_emails as $teacher_email) 
                    {
                        Mail::to($teacher_email)->send(new SendMail($details));
                    }   
                }
            }
            
            catch (Exception $e) 
            {
                // Code to handle the exception
                $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
                return response()->json(['status' => $message], 500);
            }
    }
}