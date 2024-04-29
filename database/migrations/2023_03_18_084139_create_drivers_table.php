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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->longtext('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('qualification')->nullable();
            $table->string('joining_date')->nullable();
            $table->integer('salary')->nullable();
            $table->string('licence_no')->nullable();
            $table->text('image')->nullable();
            $table->string('email')->nullable();
            $table->string('password',100)->nullable();
            $table->string('otp',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};