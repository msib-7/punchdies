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
        Schema::create('tbl_rutin_dies', function (Blueprint $table) {
            $table->unsignedBigInteger('pengukuran_dies_id');
            $table->foreign('pengukuran_dies_id')->references('id')->on('tbl_pengukuran_dies');
            $table->string('is_cincin_berbayang');
            $table->string('is_gompal');
            $table->string('is_retak');
            $table->string('is_pecah');
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
