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
        Schema::create('school_details', function (Blueprint $table) {
            $table->id();
            $table->string("logo_img", 100)->nullable();
            $table->string('school_name', 50)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->integer('pan_no')->nullable(); 
            $table->integer('estd_year')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_details');
    }
};