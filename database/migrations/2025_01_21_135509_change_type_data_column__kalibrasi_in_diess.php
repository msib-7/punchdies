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
            $table->string('kalibrasi_tools_1')->nullable()->change();
            $table->string('kalibrasi_tools_2')->nullable()->change();
            $table->string('kalibrasi_tools_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diess', function (Blueprint $table) {
            //
        });
    }
};
