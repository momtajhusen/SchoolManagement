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
        Schema::create('exam_timetables', function (Blueprint $table) {
            $table->id();
            $table->string('exam', 40)->nullable();
            $table->string('class', 10)->nullable();
            $table->string('subject', 30)->nullable();
            $table->string('exam_date', 20)->nullable();
            $table->string('starting_time', 10)->nullable();
            $table->string('ending_time', 10)->nullable();
            $table->string('room_block', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_timetables');
    }
};
