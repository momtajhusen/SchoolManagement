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
        Schema::create('discount_exceptions', function (Blueprint $table) {
            $table->id();
            $table->string("st_id")->nullable();
            $table->year("class_year")->nullable();
            $table->string("pr_id")->nullable();
            $table->string("fee_type", 200)->nullable();
            $table->integer("dis")->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_exceptions');
    }
};
