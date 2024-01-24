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
        Schema::create('basket_positions', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->integer('amount');
            $table->foreignId('car_id')->references('id')->on('cars');
            $table->foreignId('basket_id')->references('id')->on('baskets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_positions');
    }
};
