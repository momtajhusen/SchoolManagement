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
        Schema::create('demo_visitor_details', function (Blueprint $table) {
            $table->id();
            $table->string("visitor_name", 50)->nullable();
            $table->string("school_name", 100)->nullable();
            $table->string("address", 150)->nullable();
            $table->bigInteger("contact_number")->nullable();
            $table->bigInteger("visitoridbrowser")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demo_visitor_details');
    }
};
