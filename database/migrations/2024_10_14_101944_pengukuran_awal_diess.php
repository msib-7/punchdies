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
        Schema::create('pengukuran_awal_diess', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dies_id');
            $table->bigInteger('user_id');
            $table->double('outer_diameter');
            $table->double('inner_diameter_1');
            $table->double('inner_diameter_2');
            $table->double('ketinggian_dies');
            $table->string('visual');
            $table->string('kesesuaian_dies');
            $table->string('masa_pengukuran');
            $table->string('note')->nullable();
            $table->string('is_draft');
            $table->string('is_delete_pd');
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
        Schema::dropIfExists('pengukuran_awal_diess');
    }
};
