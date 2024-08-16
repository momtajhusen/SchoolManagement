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
        Schema::create('items_in_stocks', function (Blueprint $table) {
            $table->id();
            $table->string("items", 50)->nullable();
            $table->string("categories", 50)->nullable();
            $table->integer("stock")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_in_stocks');
    }
};
