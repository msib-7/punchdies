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
        Schema::create('approval_pengukurans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('req_id');
            $table->string('punch_id')->nullable();
            $table->string('dies_id')->nullable();
            $table->string('masa_pengukuran')->nullable();
            $table->uuid('user_id');
            $table->dateTime('tgl_submit');
            $table->dateTime('due_date');
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('approval_pengukurans');
    }
};
