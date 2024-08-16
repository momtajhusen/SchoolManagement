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
            $table->decimal('total_subject_mark', 10, 2)->default(0);
            $table->string('marks_obtained', 10)->nullable();
            $table->string('total_marks', 10)->nullable();
            $table->string('minimum_marks', 10)->nullable();
            $table->decimal('total_th', 10, 2)->default(0);
            $table->decimal('total_pr', 10, 2)->default(0);
            $table->decimal('pass_th', 10, 2)->default(0);
            $table->decimal('pass_pr', 10, 2)->default(0);
            $table->decimal('obt_th_mark', 10, 2)->default(0);
            $table->decimal('obt_pr_mark', 10, 2)->default(0);
            $table->string('obt_th_grade', 10)->default(0);
            $table->string('obt_pr_grade', 10)->default(0);
            $table->decimal('grade_point', 5, 1)->default(0);
            $table->string('grade_name', 10)->default(0);
            $table->string('remark', 10)->default('');
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
