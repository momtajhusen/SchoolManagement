<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageCropController extends Controller
{
    // Student Image Crope 
    public function StudentProfileImg(Request $request)
    {
        $image = $request->input('image');
    
        // Validate that the input is a base64-encoded image
        if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) 
        {
            return response()->json(['error' => 'Invalid image data'], 400);
        }
        
        $imageBase64 = substr($image, strpos($image, ',') + 1);
        $imageName =  'student.jpg';
        $filePath = 'CropingImage/SudentsAdmission/' .  $imageName;
    
        // Store the image using Laravel's Storage facade
        Storage::disk('public')->put($filePath, base64_decode($imageBase64));
    
        return response()->json(['path' => $filePath]);
    }

    // Father Image Crope 
    public function FatherProfileImg(Request $request)
    {
        $image = $request->input('image');

        // Validate that the input is a base64-encoded image
        if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) 
        {
            return response()->json(['error' => 'Invalid image data'], 400);
        }
        
        $imageBase64 = substr($image, strpos($image, ',') + 1);
        $imageName =  'father.jpg';
        $filePath = 'CropingImage/SudentsAdmission/' .  $imageName;
    
        // Store the image using Laravel's Storage facade
        Storage::disk('public')->put($filePath, base64_decode($imageBase64));
    
        return response()->json(['path' => $filePath]);
    }

    // Mother Image Crope 
    public function MotherProfileImg(Request $request)
    {
        $image = $request->input('image');

    
        // Validate that the input is a base64-encoded image
        if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) 
        {
            return response()->json(['error' => 'Invalid image data'], 400);
        }
        
        $imageBase64 = substr($image, strpos($image, ',') + 1);
        $imageName =  'mother.jpg';
        $filePath = 'CropingImage/SudentsAdmission/' .  $imageName;
    
        // Store the image using Laravel's Storage facade
        Storage::disk('public')->put($filePath, base64_decode($imageBase64));
    
        return response()->json(['path' => $filePath]);
    }

    
    
}