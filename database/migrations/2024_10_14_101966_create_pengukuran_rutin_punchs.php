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
        Schema::create('pengukuran_rutin_punchs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->increments('no');
            $table->string('punch_id');
            $table->uuid('user_id');
            $table->double('overall_length')->nullable();
            $table->double('working_length_awal')->nullable();
            $table->double('working_length_rutin')->nullable();
            $table->double('cup_depth')->nullable();
            $table->string('head_configuration')->nullable();
            $table->string('status')->nullable();
            $table->string('masa_pengukuran');
            $table->string('note')->nullable();
            $table->string('is_draft');
            $table->string('is_waiting')->default('0');
            $table->string('is_delete_pp');
            $table->string('is_edit');
            $table->string('is_approved');
            $table->string('is_rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_rutin_punchs');
    }
};
