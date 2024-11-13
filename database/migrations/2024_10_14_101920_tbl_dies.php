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
        Schema::create('tbl_dies', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('bulan_pembuatan');
            $table->integer('tahun_pembuatan');
            $table->string('nama_mesin_cetak');
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->string('line_id');
            $table->string('jenis');
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
