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
        Schema::create('role_and_permission_routes', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable();
            $table->string("route", 150)->nullable();
            $table->string("route_category", 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_and_permission_routes');
    }
};
