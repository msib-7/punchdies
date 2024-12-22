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
        Schema::create('diess', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('dies_id');
            $table->string('merk');
            $table->string('bulan_pembuatan');
            $table->integer('tahun_pembuatan');
            $table->string('nama_mesin_cetak');
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->string('line_id');
            $table->string('jenis');
            $table->string('masa_pengukuran');
            $table->string('referensi_drawing')->nullable();
            $table->string('catatan')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->date('kalibrasi_micrometer')->nullable();
            $table->date('kalibrasi_caliper')->nullable();
            $table->date('kalibrasi_dial_indicator')->nullable();
            $table->string('is_draft')->default('0');
            $table->string('is_waiting')->default('0');
            $table->string('is_delete_dies')->default('0');
            $table->string('is_edit')->default('0');
            $table->string('is_approved')->default('0');
            $table->string('is_rejected')->default('0');
            $table->string('is_disposal')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diess');
    }
};
