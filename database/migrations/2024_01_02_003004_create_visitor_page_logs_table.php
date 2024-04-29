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
        Schema::create('visitor_page_logs', function (Blueprint $table) {
            $table->id();
            $table->integer("visitorid")->nullable();
            $table->string("name", 50)->nullable();
            $table->string("date", 15)->nullable();;
            $table->string("page", 50)->nullable();
            $table->integer("wating_second")->nullable();
            $table->integer("load_count")->nullable();
            $table->string("device", 50)->nullable();
            $table->string("browser", 50)->nullable();
            $table->time("last_time")->nullable();
            $table->string("address", 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_page_logs');
    }
};
