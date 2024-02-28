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
        Schema::create('bonus_ssf_apply_emps', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->string('ssf', 10)->nullable();
            $table->string('ba', 10)->nullable();
            $table->string('ls', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus_ssf_apply_emps');
    }
};
