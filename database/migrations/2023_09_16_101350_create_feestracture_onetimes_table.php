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
        Schema::create('feestracture_onetimes', function (Blueprint $table) {
            $table->id();
            $table->string('class',10)->nullable();
            $table->string('admission_fee',10)->nullable();
            $table->string('annual_charge',10)->nullable();
            $table->string('saraswati_puja',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feestracture_onetimes');
    }
};
