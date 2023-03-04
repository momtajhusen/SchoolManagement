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
            $table->string('Kids_id',10)->nullable();
            $table->text('father_image')->nullable();
            $table->string('father_name',20)->nullable();
            $table->bigInteger('father_mobile')->nullable();
            $table->string('father_education',30)->nullable();
            $table->text('mother_image')->nullable();
            $table->string('mother_name',20)->nullable();
            $table->bigInteger('mother_mobile')->nullable();
            $table->string('mother_education',30)->nullable();
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
        Schema::dropIfExists('parents');
    }
};
