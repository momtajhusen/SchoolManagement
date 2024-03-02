<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('developer_logins', function (Blueprint $table) {
            $table->id();
            $table->string('email',100)->nullable();
            $table->string('password',100)->nullable();
            $table->string('otp',10)->nullable();
            $table->timestamps();
        });

          // Insert initial record
        DB::table('developer_logins')->insert([
            'email' => 'scriptqube@gmail.com',
            'password' =>  'scriptqube#123',
            'otp' => null, // Assuming you don't have any OTP initially
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_logins');
    }
};
