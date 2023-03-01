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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('class',10)->nullable();
            $table->string('class_year',10)->nullable();
            $table->string('roll_no',100)->nullable();
            $table->string('payment',10)->nullable();
            $table->string('discount',10)->nullable();
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
        Schema::dropIfExists('payment_histories');
    }
};
