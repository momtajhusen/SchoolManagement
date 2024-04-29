<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Intervention\Image\Facades\Image;


class ImageCropController extends Controller
{
    // Student Image Crope 
    public function StudentProfileImg(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;


            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName = $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    // Docunemt Image Crope 
    public function DocumentImg(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;

            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 50)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName = $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    // Father Image Crope 
    public function FatherProfileImg(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;


            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName =  $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    // Mother Image Crope 
    public function MotherProfileImg(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;


            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName = $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    // Teacher Image Crope 
    public function TeacherImgCrope(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;



            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName =  $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }

    
    public function EmployeeImgCrope(Request $request){
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;


            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName =  $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }  
    }


    // Driver Image Crope 
    public function DriverImgCrope(Request $request)
    {
        try {
            $image = $request->input('image');
            $image_name = $request->image_name;


            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('jpg', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName = $image_name . '.jpg';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }


    // School Logo Image Crope 
    public function SchoolLogo(Request $request)
    {
        try {
            $image = $request->input('image');

            // Validate that the input is a base64-encoded image
            if (!preg_match('/^data:image\/(\w+);base64,/', $image, $imageType)) {
                return response()->json(['error' => 'Invalid image data'], 400);
            }

            // Decode the base64-encoded image data
            $imageBase64 = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($imageBase64);

            // Compress the image to a maximum size of 200 KB
            $compressedImage = Image::make($imageData)->encode('png', 80)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageName = 'schoollogo.png';
            $filePath = 'CropingImage/SudentsAdmission/' . $imageName;

            // Store the compressed image using Laravel's Storage facade
            Storage::disk('public')->put($filePath, (string) $compressedImage);

            return response()->json(['path' => $filePath]);
        } catch (Exception $e) {
            // Code to handle the exception
            $message = "An exception occurred on line " . $e->getLine() . ": " . $e->getMessage();
            return response()->json(['status' => $message], 500);
        }
    }
}
