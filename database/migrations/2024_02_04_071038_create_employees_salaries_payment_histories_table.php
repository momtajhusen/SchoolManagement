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
        Schema::create('employees_salaries_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('py_id')->nullable();
            $table->unsignedBigInteger('tr_id')->nullable();
            $table->string('salary_year', 5)->nullable();
            $table->string('salary_month', 3)->nullable();
            $table->string("total_period", 10)->nullable();
            $table->string("percent", 10)->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->decimal('generate_salary', 8, 2)->nullable();
            $table->decimal('bonus', 8, 2)->nullable();
            $table->decimal("epf", 10, 2)->nullable();
            $table->decimal('recive_salary', 8, 2)->nullable();
            $table->decimal('remaining', 8, 2)->nullable();
            $table->decimal('dues_salary', 8, 2)->nullable();
            $table->string('payment_date', 10)->nullable();
            $table->string('pay_mode', 50)->nullable();
            $table->string('check_number', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('remark', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_salaries_payment_histories');
    }
};
