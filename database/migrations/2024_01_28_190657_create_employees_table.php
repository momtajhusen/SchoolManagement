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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('department_role');
            $table->string('gender')->nullable();
            $table->string('dob', 10)->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->longText('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('qualification')->nullable();
            $table->string('joining_date', 10)->nullable();
            $table->text('image')->nullable();
            $table->string('email')->nullable();
            $table->string('password', 100)->nullable();
            $table->string('otp', 10)->nullable();
            $table->string('admit_status', 10)->default('admit');

            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
