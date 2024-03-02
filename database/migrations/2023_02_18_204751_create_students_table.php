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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('parents_id', 5)->nullable();
            $table->text('student_image')->nullable();
            $table->string('first_name', 20)->nullable();
            $table->string('middle_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('dob', 15)->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('blood_group', 30)->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('id_number', 30)->nullable();
            $table->text('id_image', 100)->nullable();
            $table->string('admission_date', 20)->nullable();
            $table->string('class_year', 10)->nullable();
            $table->string('class', 10)->nullable();
            $table->string('section', 10)->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('hostel_outi', 20)->nullable();
            $table->integer("hostel_deposite")->nullable();
            $table->string('transport_use', 10)->nullable();
            $table->string('vehicle_root', 100)->nullable();
            $table->string('coaching', 10)->nullable();
            $table->string('district', 30)->nullable();
            $table->string('municipality', 30)->nullable();
            $table->string('village', 30)->nullable();
            $table->text('ward_no', 10)->nullable();
            $table->string('login_email', 100)->nullable();
            $table->string('login_password', 100)->nullable();
            $table->string('admission_status', 50)->nullable();
            $table->string('status_date', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
