<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolDetails;


class SchoolDetailsSet extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // school detail 
        $school = new SchoolDetails;
        $school->school_name  =  "Polar Star English Boarding School.";
        $school->phone  =  "033550611";
        $school->email  = "polarstarschool@gmail.com";
        $school->address  =  "Mirchaiya - 8, Sirha, Nepal.";
        $school->website  =  "www.polarstarschool.com";
        $school->logo_img = "upload_assets/school/school_logo.jpg";
        $school->save();
    }
}
