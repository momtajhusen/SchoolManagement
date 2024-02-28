<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineActivitesController extends Controller
{
        public function getDeviceInfo(Request $request)
    {
        // Retrieve device information from the AJAX reques

        // You can store or process this information as needed
        // For counting active devices, you can use a database or cache

        return response()->json(['message' => 'Device information received successfully']);
    }
}
