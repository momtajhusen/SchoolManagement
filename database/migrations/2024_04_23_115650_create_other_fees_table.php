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
        Schema::create('other_fees', function (Blueprint $table) {
            $table->id();
            $table->string('st_id', 100)->nullable();
            $table->integer('pr_id')->nullable();
            $table->year("fee_year")->nullable();
            $table->string("month")->nullable();
            $table->longText('particular')->nullable();
            $table->longText('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_fees');
    }
};
