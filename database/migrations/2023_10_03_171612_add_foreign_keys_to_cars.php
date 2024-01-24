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
        Schema::table('cars', function (Blueprint $table) {
            $table->foreignId('car_engine_id')->references('id')->on('car_engines');
            $table->foreignId('car_class_id')->references('id')->on('car_classes');
            $table->foreignId('car_body_id')->references('id')->on('car_bodies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('car_engine_id');
            $table->dropColumn('car_class_id');
            $table->dropColumn('car_body_id');
        });
    }
};
