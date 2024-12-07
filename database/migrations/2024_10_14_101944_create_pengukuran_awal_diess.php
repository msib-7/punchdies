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
            $table->uuid('id')->primary();
            $table->increments('no');
            $table->string('dies_id');
            $table->uuid('user_id');
            $table->double('outer_diameter')->nullable();
            $table->double('inner_diameter_1')->nullable();
            $table->double('inner_diameter_2')->nullable();
            $table->double('ketinggian_dies')->nullable();
            $table->string('visual')->nullable();
            $table->string('kesesuaian_dies')->nullable();
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
