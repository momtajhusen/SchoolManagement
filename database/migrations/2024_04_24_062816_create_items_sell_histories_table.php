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
        Schema::create('items_sell_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('st_id')->nullable()->length(10); // Changed to 'length' for defining integer length
            $table->year('fee_year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('months')->nullable();
            $table->longtext('particulars_data')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('paid', 10, 2)->default(0);
            $table->decimal('disc', 10, 2)->default(0);
            $table->string('comment_disc', 100)->default('');
            $table->decimal('dues', 10, 2)->default(0);
            $table->string('pay_date', 15)->nullable();
            $table->string('status', 10)->nullable();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_sell_histories');
    }
};


