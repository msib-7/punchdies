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
        Schema::create('form_punch_awal_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('jenis', ['atas', 'bawah']);
            $table->integer('head_outer_diameter');
            $table->integer('neck_diameter');
            $table->integer('barrel');
            $table->integer('overall_length');
            $table->integer('tip_diameter_1');
            $table->integer('tip_diameter_2');
            $table->integer('cup_depth');
            $table->integer('working_length');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_punch_awal_settings');
    }
};
