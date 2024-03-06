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
        Schema::create('students_fee_stractures', function (Blueprint $table) {
            $table->id();
            $table->integer('st_id')->nullable();
            $table->year('year');
            $table->integer('month')->nullable();
            $table->string("fee_type", 100)->nullable();
            $table->double("amount")->nullable();
            $table->string("fee_stracture_type", 10)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_fee_stractures');
    }
};
