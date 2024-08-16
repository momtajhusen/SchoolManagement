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
        Schema::create('teacher_months_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger("year")->nullable();
            $table->string("month", 5)->nullable();
            $table->unsignedBigInteger("emp_id")->nullable();
            // Columns for days
            for ($i = 1; $i <= 32; $i++) {
                $table->string("day_" . $i, 10)->nullable();
            }
            $table->string("attendance", 10)->nullable();
            $table->decimal("percent", 5, 2)->nullable();
            $table->decimal("salary", 10, 2)->nullable();
            $table->decimal("gen_salary", 10, 2)->nullable();
            $table->decimal("bonus", 10, 2)->nullable();
            $table->decimal("epf", 10, 2)->nullable();
            $table->decimal("net_pay", 10, 2)->nullable();
            $table->decimal("paid", 10, 2)->nullable();
            $table->decimal("remaining", 10, 2)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_months_attendances');
    }
};
