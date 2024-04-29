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
        Schema::create('students_fee_paid_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer("st_id")->nullable();
            $table->year('year')->nullable();
            // Define columns for each month
            for ($i = 0; $i < 12; $i++) {
                $table->string('month_' . $i, 10)->default('unpaid');
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_fee_paid_statuses');
    }
};
