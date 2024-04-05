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
        Schema::create('students_fee_paid_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('reset_id')->nullable();
            $table->string('st_id', 100)->nullable();
            $table->integer('pr_id')->nullable();
            $table->year("fee_year")->nullable();
            $table->longText('particular_data')->nullable();
            $table->longText('pay_month')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->decimal('paid', 10, 2)->default(0);
            $table->decimal('disc', 10, 2)->default(0);
            $table->decimal('dues', 10, 2)->default(0);
            $table->string('comment_disc', 100)->nullable();
            $table->string('pay_with', 50)->nullable();
            $table->string('pay_date', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_fee_paid_histories');
    }
};
