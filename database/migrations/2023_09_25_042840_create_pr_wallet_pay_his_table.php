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
        Schema::create('pr_wallet_pay_his', function (Blueprint $table) {
            $table->id();
            $table->string("pr_id", 5)->nullable();
            $table->string("st_id", 5)->nullable();
            $table->string("st_name", 100)->nullable();
            $table->integer("Load_Amount")->nullable();
            $table->string("pay_by", 100)->nullable();
            $table->string("date", 30)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_wallet_pay_his');
    }
};
