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
            $table->string('pay_id',50)->nullable();
            $table->string('student_id',5)->nullable();
            $table->string('class',10)->nullable();
            $table->string('class_year',10)->nullable();
            $table->string('roll_no',100)->nullable();
            $table->longText('particular')->nullable();
            $table->longText('pay_month')->nullable();
            $table->string('payment',50)->nullable();
            $table->string("hostel_deposite",50)->nullable();
            $table->string('discount',50)->nullable();
            $table->string('free_fee',50)->nullable();
            $table->string('comment_discount',100)->nullable();
            $table->string('comment_free_fee',70)->nullable();
            $table->string('dues',70)->nullable();
            $table->string('pay_with',50)->nullable();
            $table->date('pay_date',50)->nullable();
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