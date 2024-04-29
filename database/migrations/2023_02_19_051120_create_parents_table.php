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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->text('father_image')->nullable();
            $table->string('father_name', 50)->nullable();
            $table->string('father_mobile', 10)->nullable();
            $table->string('father_education', 30)->nullable();
            $table->text('mother_image')->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('mother_mobile', 10)->nullable();
            $table->string('mother_education', 30)->nullable();
            $table->string('login_email', 100)->nullable();
            $table->string('login_password', 100)->nullable();
            $table->integer("wallet_balance")->nullable();
            $table->integer("admission_status")->nullable(); 
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
