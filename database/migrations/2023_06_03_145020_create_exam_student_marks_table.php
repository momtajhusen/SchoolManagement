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
        Schema::create('exam_student_marks', function (Blueprint $table) {
            $table->id();
            $table->string('st_id', 40)->nullable();
            $table->string('exam', 40)->nullable();
            $table->string('class', 10)->nullable();
            $table->string('section', 5)->nullable();
            $table->string('subject', 20)->nullable();
            $table->string('marks_obtained', 10)->nullable();
            $table->string('total_marks', 10)->nullable();
            $table->string('minimum_marks', 10)->nullable();
            $table->string('attendance', 10)->nullable();
            $table->string('exam_year', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_student_marks');
    }
};
