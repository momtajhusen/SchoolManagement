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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class',20)->nullable();
            $table->string('section',20)->nullable();
            $table->string('class_teacher',30)->nullable();
            $table->string('total_student',10)->nullable();
            $table->string('capacity',10)->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('year')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
