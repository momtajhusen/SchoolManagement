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
        Schema::create('manage_free_students', function (Blueprint $table) {
            $table->id();
            $table->string("st_id")->nullable();
            $table->year("class_year")->nullable();
            $table->string("pr_id")->nullable();
            $table->string("free_fee",200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_free_students');
    }
};
