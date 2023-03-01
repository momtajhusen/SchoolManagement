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
            $table->text('student_image')->nullable();
            $table->string('first_name',20);
            $table->string('middle_name',20)->nullable();
            $table->string('last_name',20);
            $table->string('gender',10);
            $table->string('dob',20);
            $table->string('religion',20)->nullable();
            $table->string('blood_group',10)->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('email',50)->nullable();
            $table->string('id_number',30)->nullable();
            $table->text('id_image',100)->nullable();
            $table->string('admission_date',20);
            $table->string('admission_year',10);
            $table->string('class',10);
            $table->string('section',10)->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('district',30)->nullable();
            $table->string('municipality',30)->nullable();
            $table->string('village',30);
            $table->text('ward_no',10)->nullable();
            $table->string('login_email',30)->nullable();
            $table->string('login_password',100)->nullable();
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
