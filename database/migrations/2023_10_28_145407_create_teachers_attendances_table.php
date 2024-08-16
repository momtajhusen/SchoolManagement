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
        Schema::create('teachers_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer("tr_id")->nullable();
            $table->integer("period_1")->nullable();
            $table->integer("period_2")->nullable();
            $table->integer("period_3")->nullable();
            $table->integer("period_4")->nullable();
            $table->integer("period_5")->nullable();
            $table->integer("period_6")->nullable();
            $table->integer("period_7")->nullable();
            $table->integer("period_8")->nullable();
            $table->integer("period_9")->nullable();
            $table->integer("period_10")->nullable();
            $table->integer("total_period")->nullable();
            $table->integer("total_present")->nullable();
            $table->integer("total_absent")->nullable();
            $table->year("year")->nullable();
            $table->string("date", 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_attendances');
    }
};
