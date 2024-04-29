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
        Schema::create('students_fee_months', function (Blueprint $table) {
            $table->id();
            $table->integer("st_id")->nullable();
            $table->year('year')->nullable();
            // Define columns for each month
            for ($i = 0; $i < 12; $i++) {
                $table->decimal('month_' . $i, 10, 2)->default(0);
            }
            // Define total columns
            $table->decimal('total_fee', 10, 2)->default(0);
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->decimal('total_disc', 10, 2)->default(0);
            $table->decimal('total_dues', 10, 2)->default(0);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_fee_months');
    }
};
