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
        Schema::create('items_add_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->string("items", 50)->nullable();
            $table->string("categories", 50)->nullable();
            $table->integer("quantity")->nullable();
            $table->date("date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_add_stock_histories');
    }
};
