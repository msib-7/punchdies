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
        Schema::create('punchs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('punch_id');
            $table->string('merk');
            $table->string('bulan_pembuatan');
            $table->integer('tahun_pembuatan');
            $table->string('nama_mesin_cetak');
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->string('line_id');
            $table->string('jenis');
            $table->string('masa_pengukuran');
            $table->string('is_draft');
            $table->string('is_delete_punch');
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
        Schema::dropIfExists('punchs');
    }
};
