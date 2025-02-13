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
        Schema::create('form_dies_awal_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('outer_diameter');
            $table->integer('inner_diameter_1');
            $table->integer('inner_diameter_2');
            $table->integer('ketinggian_dies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_dies_awal_settings');
    }
};
