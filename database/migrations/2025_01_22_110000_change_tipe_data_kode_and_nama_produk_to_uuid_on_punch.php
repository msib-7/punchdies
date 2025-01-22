<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, we need to alter the columns with raw SQL
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk TYPE uuid USING kode_produk::uuid');
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk DROP NOT NULL');
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk DROP DEFAULT');

        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk TYPE uuid USING nama_produk::uuid');
        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk DROP NOT NULL');
        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk DROP DEFAULT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the changes if necessary
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk TYPE varchar USING kode_produk::varchar');
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk DROP NOT NULL');
        DB::statement('ALTER TABLE punchs ALTER COLUMN kode_produk DROP DEFAULT');

        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk TYPE varchar USING nama_produk::varchar');
        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk DROP NOT NULL');
        DB::statement('ALTER TABLE punchs ALTER COLUMN nama_produk DROP DEFAULT');
    }
};