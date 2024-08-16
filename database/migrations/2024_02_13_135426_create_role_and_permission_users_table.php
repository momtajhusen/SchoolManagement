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
        Schema::create('role_and_permission_users', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100)->nullable();
            $table->bigInteger("number")->nullable();
            $table->string("email", 100)->nullable();
            $table->string("password", 50)->nullable();
            $table->string("role_type", 100)->nullable();
            $table->string("email_verification", 5)->default('off');
            $table->integer("otp")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_and_permission_users');
    }
};
