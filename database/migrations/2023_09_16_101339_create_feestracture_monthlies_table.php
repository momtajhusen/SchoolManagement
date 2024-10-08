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
        Schema::create('feestracture_monthlies', function (Blueprint $table) {
            $table->id();
            $table->string('class',10)->nullable();
            $table->string('tuition_fee',10)->nullable();
            $table->string('full_hostel_fee',10)->nullable();
            $table->string('half_hostel_fee',10)->nullable();
            $table->string('computer_fee',10)->nullable();
            $table->string('coaching_fee',10)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feestracture_monthlies');
    }
};
