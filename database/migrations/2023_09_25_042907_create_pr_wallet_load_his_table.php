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
        Schema::create('pr_wallet_load_his', function (Blueprint $table) {
            $table->id();
            $table->string("pr_id", 5)->nullable();
            $table->integer("load_amount")->nullable(); 
            $table->string("load_for", 100)->nullable();
            $table->string("load_by", 100)->nullable();
            $table->string("date", 30)->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_wallet_load_his');
    }
};
