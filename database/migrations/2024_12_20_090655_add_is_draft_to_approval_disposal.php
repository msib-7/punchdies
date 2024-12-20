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
            // You probably want to make the new column nullable
            $table->string('is_draft')->default('0')->after('attach_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('approval_disposal', function (Blueprint $table) {
            //
        });
    }
};
