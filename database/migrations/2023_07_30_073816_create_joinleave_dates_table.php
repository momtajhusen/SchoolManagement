<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('joinleave_dates', function (Blueprint $table) {
            $table->id();
            $table->string("st_id",10)->nullable();
            $table->year("class_year")->nullable();
            $table->string('admission_months',100)->nullable();
            $table->string('admission_start',100)->nullable();
            $table->string('transport_fee',100)->nullable();
            $table->string('tuition_fee',100)->nullable();
            $table->string('full_hostel_fee',100)->nullable();
            $table->string('half_hostel_fee',100)->nullable();
            $table->string('computer_fee',100)->nullable();
            $table->string('coaching_fee',100)->nullable();
            $table->string('admission_fee',100)->nullable();
            $table->string('annual_charge',100)->nullable();
            $table->string('saraswati_puja',100)->nullable();
            $table->string('exam_fee',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joinleave_dates');
    }
};
