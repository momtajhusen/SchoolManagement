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
        Schema::create('account_logins', function (Blueprint $table) {
            $table->id();
            $table->string('account_management_username',100)->nullable();
            $table->string('account_management_password',100)->nullable();
            $table->string('student_management_username',100)->nullable();
            $table->string('student_management_password',100)->nullable();
            $table->string('super_admin_username',100)->nullable();
            $table->string('super_admin_password',100)->nullable();
            $table->string('school_management_username',100)->nullable();
            $table->string('school_management_password',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_logins');
    }
};