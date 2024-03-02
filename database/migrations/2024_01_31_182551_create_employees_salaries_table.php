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
        Schema::create('employees_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->string('salary_date', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_salaries');
    }
};
