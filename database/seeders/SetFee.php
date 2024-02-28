<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 
use App\Models\VehicleRoot;
use App\Models\FeestractureMonthly;
use App\Models\FeestractureOnetime;
use App\Models\FeestractureQuarterly;




class SetFee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fee stracture
        $class = ["1ST", "2ND", "3RD", "4TH", "5TH"];
 
        // Start Monthly Fee Stracture
            $TuitionFee = ["1300", "1400", "1500", "1600", "1700"];
            $FullHostelFee = ["6000", "6000", "6000", "6000", "6000"];
            $HalfHostelFee = ["3500", "3500", "3500", "3500", "3500"];
            $ComputerFee = ["800", "800", "800", "800", "800"];
            $CoachingFee = ["0", "0", "0", "0", "0"];

            for ($i = 0; $i < 4; $i++) {
                $MonthlyFee = new FeestractureMonthly;
                $MonthlyFee->class = $class[$i];
                $MonthlyFee->tuition_fee = $TuitionFee[$i];
                $MonthlyFee->full_hostel_fee = $FullHostelFee[$i];
                $MonthlyFee->half_hostel_fee = $HalfHostelFee[$i];
                $MonthlyFee->computer_fee = $ComputerFee[$i];
                $MonthlyFee->coaching_fee = $CoachingFee[$i];
                $MonthlyFee->save();
            }
        // Start Monthly Fee Stracture

        // Start One Times Fee Stracture
            $admission_fee = ["6000", "6000", "6000", "6000", "6000"];
            $annual_charge = ["3500", "3500", "3500", "3500", "3500"];
            $saraswati_puja = ["800", "800", "800", "800", "800"];

            for ($i = 0; $i < 4; $i++) {
                $OneTimeFee = new FeestractureOnetime;
                $OneTimeFee->class = $class[$i];
                $OneTimeFee->admission_fee = $admission_fee[$i];
                $OneTimeFee->annual_charge = $annual_charge[$i];
                $OneTimeFee->saraswati_puja = $saraswati_puja[$i];
                $OneTimeFee->save();
            }
        // Start One Times Fee Stracture

        // Start Quarterly Fee Stracture
            $exam_fee = ["400", "400", "400", "400", "400"];

            for ($i = 0; $i < 4; $i++) {
                $QuarterlyFee = new FeestractureQuarterly;
                $QuarterlyFee->class = $class[$i];
                $QuarterlyFee->exam_fee = $exam_fee[$i];
                $QuarterlyFee->save();
            }
        // Start Quarterly Fee Stracture

        // Start Transport Root
              $rootName = ["Janakpur", "Mirchaiya", "Kalyanpur", "Arang", "Dumri"];
              $rootid = [1, 2, 3, 4, 5];
              $rootAmount = ["800", "300", "900", "400", "500"];

              for ($i = 0; $i < 4; $i++) {
                  $Transport = new VehicleRoot;
                  $Transport->id = $rootid[$i];
                  $Transport->root_name = $rootName[$i];
                  $Transport->vehicle =  "Bus: janakpur";
                  $Transport->timing =  "10:30";
                  $Transport->amount =  $rootAmount[$i];
                  $Transport->save();
              }
        // End Transport Root
    }
}
