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
        Schema::create('fee_discounts', function (Blueprint $table) {
            $table->id();
            $table->string("st_id",10)->nullable();
            $table->string('class',10)->nullable();
            $table->string('class_year',10)->nullable();
            $table->string('month_0',50)->nullable();
            $table->string('month_1',50)->nullable();
            $table->string('month_2',50)->nullable();
            $table->string('month_3',50)->nullable();
            $table->string('month_4',50)->nullable();
            $table->string('month_5',50)->nullable();
            $table->string('month_6',50)->nullable();
            $table->string('month_7',50)->nullable();
            $table->string('month_8',50)->nullable();
            $table->string('month_9',50)->nullable();
            $table->string('month_10',50)->nullable();
            $table->string('month_11',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_discounts');
    }
};