<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Carbon\Carbon;
use App\Models\VisitorDetails;
use App\Models\VisitorPageLogs;
use App\Models\VisitorbuttonClick;
use App\Models\DemoVisitorDetails;

use Illuminate\Database\QueryException;
 



class VisitorLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
 

    public function VisitorPageLogs(Request $request){
        try { 
 

            $visitorid = $request->visitorid;
            $visitorname = $request->visitorname;
            $current_date = $request->current_date;
            $page = $request->page;
            $device = $request->device;
            $browser = $request->browser;
            $watingtime = $request->watingtime;
            $visitorAddress = $request->visitorAddress;

            $currentDateTimeNepal = Carbon::now('Asia/Kathmandu');
            $currentTimeNepal = $currentDateTimeNepal->format('H:i:s');

            $VisitorPageLogs = VisitorPageLogs::where("visitorid",  $visitorid)->where("date", $current_date)->where("page", $page)->first();
            if($VisitorPageLogs){
                $VisitorPageLogs->wating_second = $VisitorPageLogs->wating_second + $watingtime;
                $VisitorPageLogs->load_count = $VisitorPageLogs->load_count + 1;
                $VisitorPageLogs->last_time = $currentTimeNepal;
                $VisitorPageLogs->save();
            }
            else{
                $visitorNewPageLog = new VisitorPageLogs;
                $visitorNewPageLog->visitorid = $visitorid;
                $visitorNewPageLog->name = $visitorname;
                $visitorNewPageLog->date = $current_date;
                $visitorNewPageLog->page = $page;
                $visitorNewPageLog->wating_second = $watingtime;
                $visitorNewPageLog->load_count = 1;
                $visitorNewPageLog->device = $device;
                $visitorNewPageLog->browser = $browser;
                $visitorNewPageLog->last_time = $currentTimeNepal;
                $visitorNewPageLog->address = $visitorAddress;
                $visitorNewPageLog->save();
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
    public function GetPageActivity(Request $request)
    {
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $orderBy = $request->orderBy;
            $visitorName = $request->visitorName;

            if($visitorName == "A-Z"){
                $VisitorPageLogs = VisitorPageLogs::whereBetween("date", [$startDate, $endDate])->orderBy('name')->orderBy($orderBy, 'DESC')->get();
            }
            else{
                $VisitorPageLogs = VisitorPageLogs::whereBetween("date", [$startDate, $endDate])->where("name", $visitorName)->orderBy('name')->orderBy($orderBy, 'DESC')->get();
            }
            $VisitorName = VisitorPageLogs::whereBetween("date", [$startDate, $endDate])->orderBy('name')->orderBy($orderBy, 'DESC')->distinct('name')->pluck('name');

            return response(array("data" => $VisitorPageLogs, "VisitorName" => $VisitorName), 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function VisitorButtonClicking(Request $request)
    {
        try { 
 

            $visitorid = $request->visitorid;
            $visitorname = $request->visitorname;
            $current_date = $request->current_date;
            $page = $request->page;
            $btn_name = $request->btn_name;
            $device = $request->device;
            $browser = $request->browser;
            $visitorAddress = $request->visitorAddress;

            $currentDateTimeNepal = Carbon::now('Asia/Kathmandu');
            $currentTimeNepal = $currentDateTimeNepal->format('H:i:s');

            $VisitorbuttonClick = VisitorbuttonClick::where("visitorid",  $visitorid)->where("date", $current_date)->where("page", $page)->where("button", $btn_name)->first();
            if($VisitorbuttonClick){
                $VisitorbuttonClick->clicking = $VisitorbuttonClick->clicking + 1;
                $VisitorbuttonClick->last_time = $currentTimeNepal;
                $VisitorbuttonClick->save();
            }
            else{
                $visitorNewButtonLog = new VisitorbuttonClick;
                $visitorNewButtonLog->visitorid = $visitorid;
                $visitorNewButtonLog->name = $visitorname;
                $visitorNewButtonLog->date = $current_date;
                $visitorNewButtonLog->page = $page;
                $visitorNewButtonLog->button = $btn_name;
                $visitorNewButtonLog->clicking = 1;
                $visitorNewButtonLog->device = $device;
                $visitorNewButtonLog->browser = $browser;
                $visitorNewButtonLog->last_time = $currentTimeNepal;
                $visitorNewButtonLog->address = $visitorAddress;
                $visitorNewButtonLog->save();
            }

        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    public function GetButtonActivity(Request $request)
    {
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $orderBy = $request->orderBy;
            $visitorName = $request->visitorName;

            if($visitorName == "A-Z"){
                $VisitorbuttonClick = VisitorbuttonClick::whereBetween("date", [$startDate, $endDate])->orderBy('name')->orderBy($orderBy, 'DESC')->get();
            }
            else{
                $VisitorbuttonClick = VisitorbuttonClick::whereBetween("date", [$startDate, $endDate])->where("name", $visitorName)->orderBy('name')->orderBy($orderBy, 'DESC')->get();
            }
            $VisitorName = VisitorbuttonClick::whereBetween("date", [$startDate, $endDate])->orderBy('name')->orderBy($orderBy, 'DESC')->distinct('name')->pluck('name');

            return response(array("data" => $VisitorbuttonClick, "VisitorName" => $VisitorName), 200);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function DemoVisitorSave(Request $request)
    {
        try {

            $visitor_name = $request->visitor_name;
            $school_name = $request->school_name;  
            $address = $request->address;  
            $contact_number = $request->contact_number;
            $visitorId = $request->visitorId;

            $DemoVisitorDetails = new DemoVisitorDetails;
            $DemoVisitorDetails->visitor_name = $visitor_name;
            $DemoVisitorDetails->school_name = $school_name;
            $DemoVisitorDetails->address = $address;
            $DemoVisitorDetails->contact_number = $contact_number;
            $DemoVisitorDetails->visitoridbrowser = $visitorId;
            if($DemoVisitorDetails->save())
            {
                return response()->json(['status' =>  "save sucess"], 200);
            }
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
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
