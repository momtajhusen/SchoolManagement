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
        Schema::create('exam_grades', function (Blueprint $table) {
            $table->id();

            $table->string('from', 5)->nullable();
            $table->string('to', 5)->nullable();
            $table->string('grade_name', 5)->nullable();
            $table->string('grade_point', 5)->nullable();
            $table->string('remarks', 20)->nullable();
            $table->string('exam', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_grades');
    }
};
