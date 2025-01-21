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
        Schema::table('diess', function (Blueprint $table) {
            $table->date('tgl_kalibrasi_tools_1')->nullable();
            $table->date('tgl_kalibrasi_tools_2')->nullable();
            $table->date('tgl_kalibrasi_tools_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diess', function (Blueprint $table) {
            $table->dropColumn(['tgl_kalibrasi_tools_1', 'tgl_kalibrasi_tools_2', 'tgl_kalibrasi_tools_3']);
        });
    }
};
