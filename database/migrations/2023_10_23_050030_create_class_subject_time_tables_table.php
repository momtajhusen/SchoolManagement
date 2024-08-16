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
        Schema::create('class_subject_time_tables', function (Blueprint $table) {
            $table->id();
            $table->string("class", 20)->nullable();
            $table->string("section", 2)->nullable();
            $table->string("day", 20)->nullable();
            $table->string("period_1", 100)->nullable();
            $table->string("period_2", 100)->nullable();
            $table->string("period_3", 100)->nullable();
            $table->string("period_4", 100)->nullable();
            $table->string("period_5", 100)->nullable();
            $table->string("period_6", 100)->nullable();
            $table->string("period_7", 100)->nullable();
            $table->string("period_8", 100)->nullable();
            $table->string("period_9", 100)->nullable();
            $table->string("period_10", 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subject_time_tables');
    }
};
