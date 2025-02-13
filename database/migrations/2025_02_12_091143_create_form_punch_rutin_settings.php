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
        Schema::create('form_punch_rutin_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('jenis', ['atas', 'bawah']);
            $table->integer('overall_length');
            $table->integer('working_length');
            $table->integer('cup_depth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_punch_rutin_settings');
    }
};
