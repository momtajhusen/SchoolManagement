<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\DateSetting;
use App\Models\Student;
use App\Models\Classes;

use App\Models\FeePayment;
use App\Models\DuesAmount;
use App\Models\FeeDiscount;
use App\Models\FeeFree;

use App\Models\LastPaymentForReset;
use App\Models\LastDuesForReset;
use App\Models\LastDiscountsForReset;
use App\Models\LastFreeFeeForReset;

use App\Models\JoinleaveDates;


use App\Models\Parents;
use App\Models\HostelFee;
use App\Models\VehicleRoot;
use App\Models\FeeStructure;



use Illuminate\Support\Str;
use Faker\Provider\Avatar;
use Faker\Provider\Image as ImageProvider;


use Faker\Factory as Faker;


class students extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // date year 
        $dateSetting = DateSetting::first();
        $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ("2080" ?? null);



        $st_id = [1, 2, 3, 4, 5];
        $first_name = ["Sadam", "Momtaj", "Bijay", "Deepak", "Rehan"];
        $class = ["1ST", "2ND", "1ST", "2ND" , "2ND"];
        $section = ["A", "A", "B", "B", "A"];
        $middel_name = ["", "", "Kumar", "Kumar", ""];

        $last_name = ["Rain", "Husen", "Sharma", "Kushawaha", "Khan"];

        $image = [
            "upload_assets/students/profile_1679618037.jpg",
            "upload_assets/students/profile_1679571382.jpg",
            "upload_assets/students/profile_1679617384.jpg",
            "upload_assets/students/profile_1679618167.jpg",
            "upload_assets/students/profile_145796384.jpg"
        ];

        $index = 1;

        for ($i = 0; $i < 4; $i++) {
            $rolls = $index++;
            $faker = Faker::create();
            $student = new Student;
 
            $hostel_outi = $faker->randomElement(['full-hostel', 'outi']);

            $student->id  =  $st_id[$i];
            $student->parents_id  =  $st_id[$i];
            $student->first_name  = $first_name[$i];
            $student->middle_name  = $middel_name[$i];
            $student->last_name  =  $last_name[$i];
            $student->gender  =  $faker->randomElement(['Male']);
            $student->dob  =  $faker->date('Y/m/d', '-10 years');
            $student->religion  =  $faker->randomElement(['Muslim', 'Hindu']);
            $student->blood_group  =  $faker->randomElement(['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-']);
            $student->phone  =   9889;
            $student->email  =  $faker->email;
            $student->id_number  =  $faker->numberBetween(100000, 999999);
            $student->id_image  =  "upload_assets/students/document/proof_" . $faker->numberBetween(1000000000, 9999999999) . ".jpg";
            $student->admission_date  = "19/01/2080";
            $student->class_year =  $year;
            $student->class  = $class[$i];
            $student->section  = $section[$i];
            $student->roll_no  =  $rolls;
            $student->hostel_outi  =  'outi';
            $student->transport_use  =  "Yes";
            $student->vehicle_root  = 1;
            $student->coaching  =  "Yes";
            $student->district  =  $faker->state;
            $student->municipality  = $faker->city;
            $student->village  =  $faker->streetName;
            $student->ward_no  =  $faker->numberBetween(1, 15);
            $student->login_email  = $faker->email;
            $student->login_password  =  $faker->password;
            $student->student_image = $image[$i];
            $student->save();
            // $imageUrl = $faker->imageUrl(400, 400, 'people');



            //  Services_joinini
            $JoinleaveDates = new JoinleaveDates;
            $JoinleaveDates->st_id  =  $st_id[$i];
            $JoinleaveDates->admission_months  =  '["1","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->admission_start  = '["1","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->transport_fee  = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
            $JoinleaveDates->tuition_fee  = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
            $JoinleaveDates->full_hostel_fee  = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->half_hostel_fee  = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->computer_fee  = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->coaching_fee  = '["1","1","1","1","1","1","1","1","1","1","1","1"]';
            $JoinleaveDates->admission_fee  = '["1","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->annual_charge  =  '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->saraswati_puja  = '["0","0","0","0","0","0","0","0","0","0","0","0"]';
            $JoinleaveDates->exam_fee  =  '["0","0","1","0","0","1","0","0","1","0","0","1"]';
            $JoinleaveDates->save();


            //////// Start Total Fee set ////////
            // Monthly Check than Add 
            $feeData = array();
            for ($j = 0; $j <= 11; $j++) {
                $month = 'month_' . $j;
                $feeData[$month] = FeeStructure::where('class', $class)->sum($month);
            }
            $totalFees = 0;
            foreach ($feeData as $month => $fee) {
                $totalFees += intval($fee);
            }
            // Hostel Use Check than Add
            if (is_array($hostel_outi)) {
                for ($k = 0; $k < count($hostel_outi); $k++) {
                    if ($hostel_outi[$k] != "outi") {
                        $HostelFee = HostelFee::where('class', $class)->first();
                        $totalFees += $HostelFee->hostel_fee * 12;
                        break;
                    }
                }
            }


            // Create Table Row For This Student 
            $paymentRow = [
                'st_id' => $student->id,
                'class' => $class[$i],
                'class_year' => $year,
                'roll_no' => $rolls,
                'total_fee' => $totalFees,
                'total_payment' => 0,
                'total_discount' => 0,
                'free_fee' => 0,
                'total_dues' => $totalFees,
            ];
            $attributes = [
                'st_id' => $student->id,
                'class' => $class[$i],
                'class_year' => $year,
                'roll_no' => $rolls,
            ];
            FeePayment::create($paymentRow);
            DuesAmount::create($attributes);
            FeeDiscount::create($attributes);
            FeeFree::create($attributes);

            LastPaymentForReset::create($paymentRow);
            LastDuesForReset::create($attributes);
            LastDiscountsForReset::create($attributes);
            LastFreeFeeForReset::create($attributes);

            //////// End Total Fee set ////////
        }


        // Parents Add 
        $Parents = new Parents;
        $Parents->id  =  "1";
        $Parents->father_image  =  "upload_assets/father/1679618037.jpg";
        $Parents->father_name  =  "Jakir Husen";
        $Parents->father_mobile  =  "9878734743";
        $Parents->father_education  =  "Diploma";
        $Parents->mother_image  =  "upload_assets/mother/1679618037.jpg";
        $Parents->mother_name =  "Anisha Khootun";
        $Parents->mother_mobile  =  "9878734743";
        $Parents->mother_education  =  "Diploma";
        $Parents->login_email =  "jakir@gmail.com";
        $Parents->login_password =  "jakir@123";
        $Parents->save();
    }
}
