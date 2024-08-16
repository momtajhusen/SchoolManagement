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
        Schema::create('complaint_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('send_by', 100)->nullable();
            $table->string('message', 100)->nullable();
            $table->string('record_path', 150)->nullable();
            $table->string("type", 50)->nullable();
            $table->string("status", 50)->nullable();
            $table->string("date", 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_feedback');
    }
};
