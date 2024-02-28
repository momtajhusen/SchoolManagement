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
        Schema::create('bonus_ssf_settings', function (Blueprint $table) {
            $table->id();
            $table->float("ssf_per")->nullable();
            $table->integer("bouns_attend")->nullable();
            $table->float("bouns_per")->nullable();
            $table->float("leave_per")->nullable();
            $table->integer("leave_salary")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus_ssf_settings');
    }
};
