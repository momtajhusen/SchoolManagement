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
        Schema::create('fee_payments', function (Blueprint $table) {
            $table->id();
            $table->string('class',10)->nullable();
            $table->string('class_year',10)->nullable();
            $table->string('roll_no',100)->nullable();
            $table->string('month_0',10)->nullable();
            $table->string('month_1',10)->nullable();
            $table->string('month_2',10)->nullable();
            $table->string('month_3',10)->nullable();
            $table->string('month_4',10)->nullable();
            $table->string('month_5',10)->nullable();
            $table->string('month_6',10)->nullable();
            $table->string('month_7',10)->nullable();
            $table->string('month_8',10)->nullable();
            $table->string('month_9',10)->nullable();
            $table->string('month_10',10)->nullable();
            $table->string('month_11',10)->nullable();
            $table->string('payment',10)->nullable();
            $table->string('dues',10)->nullable();
            $table->string('pay_with',10)->nullable();
            $table->string('pay_date',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_payments');
    }
};
