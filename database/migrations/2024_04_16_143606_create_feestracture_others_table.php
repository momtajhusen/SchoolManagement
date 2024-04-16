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
        Schema::create('feestracture_others', function (Blueprint $table) {
            $table->id();
            $table->string('class',10)->nullable();
            $table->string('fee_name',10)->nullable();
            $table->integer('amount',10)->nullable();
            $table->string('fee_type',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feestracture_others');
    }
};
