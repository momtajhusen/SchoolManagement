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
        Schema::create('exam_terms', function (Blueprint $table) {
            $table->id();
            $table->string('year', 40)->nullable();
            $table->string('exam_name', 40)->nullable();
            $table->string('description', 50)->nullable();
            $table->string('session', 10)->nullable();
            $table->string('result_status', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_terms');
    }
};
