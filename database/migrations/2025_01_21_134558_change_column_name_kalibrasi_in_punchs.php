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
        Schema::table('punchs', function (Blueprint $table) {
            $table->renameColumn('kalibrasi_micrometer', 'kalibrasi_tools_1');
            $table->renameColumn('kalibrasi_caliper', 'kalibrasi_tools_2');
            $table->renameColumn('kalibrasi_dial_indicator', 'kalibrasi_tools_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('punchs', function (Blueprint $table) {
            $table->renameColumn('kalibrasi_tools_1', 'kalibrasi_micrometer');
            $table->renameColumn('kalibrasi_tools_2', 'kalibrasi_caliper');
            $table->renameColumn('kalibrasi_tools_3', 'kalibrasi_dial_indicator');
        });
    }
};
