<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\ClassTotalFeePayment;
use App\Models\ClassTotalFeePaymentReset;
use App\Models\ClassTotalFeeDiscount;
use App\Models\ClassTotalFeeDiscountReset;
use App\Models\DateSetting;


class ClassAdd extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // date year 
        $dateSetting = DateSetting::first();
        $year = ($dateSetting && $dateSetting->using_date != "internet-date") ? $dateSetting->year : ("2079" ?? null);


        // Class Add 
        $class = ["1ST", "1ST", "2ND", "2ND", "3RD"];
        $section = ["A", "B", "A", "B", "A"];

        for ($i = 0; $i < 4; $i++) {
            $student = new Classes;
            $student->class  =  $class[$i];
            $student->section  =   $section[$i];
            $student->capacity  =  "300";
            $student->year  =  $year;
            $student->save();
            $totalFeeattributes = [
                'class' => $class[$i],
            ];
            ClassTotalFeePayment::create($totalFeeattributes);
            ClassTotalFeePaymentReset::create($totalFeeattributes);
            ClassTotalFeeDiscount::create($totalFeeattributes);
            ClassTotalFeeDiscountReset::create($totalFeeattributes);
        }
    }
}
