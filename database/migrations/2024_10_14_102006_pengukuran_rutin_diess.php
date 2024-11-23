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
        Schema::create('pengukuran_rutin_diess', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengukuran_dies_id');
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
        Schema::dropIfExists('pengukuran_rutin_diess');
    }
};
