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
        Schema::create('tbl_pengukuran_dies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dies_id');
            $table->foreign('dies_id')->references('id')->on('tbl_dies');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('outer_diameter');
            $table->double('inner_diameter_1');
            $table->double('inner_diameter_2');
            $table->double('ketinggian_dies');
            $table->string('visual');
            $table->string('kesesuaian_dies');
            $table->string('masa_pengukuran');
            $table->string('note');
            $table->string('is_draft');
            $table->string('is_delete_pd');
            $table->string('is_edit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
