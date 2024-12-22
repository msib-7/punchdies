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
        Schema::table('approval_disposals', function (Blueprint $table) {
            $table->string('is_revisi')->default('0')->after('is_waiting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('approval_disposals', function (Blueprint $table) {
            $table->dropColumn('is_revisi');
        });
    }
};
