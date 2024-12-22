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
        Schema::create('approval_disposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('req_id');
            $table->string('punch_id')->nullable();
            $table->string('dies_id')->nullable();
            $table->uuid('user_id');
            $table->dateTime('tgl_submit');
            $table->dateTime('due_date');
            $table->string('req_note')->default('-');
            $table->string('approved_note')->default('-');
            $table->string('attach_1')->default('-')->nullable();
            $table->string('attach_2')->default('-')->nullable();
            $table->string('attach_3')->default('-')->nullable();
            $table->string('attach_4')->default('-')->nullable();
            $table->string('attach_5')->default('-')->nullable();
            $table->string('is_draft')->default('1');
            $table->string('is_waiting')->default('0');
            $table->string('is_approved')->default('0');
            $table->string('is_rejected')->default('0');
            $table->string('by')->nullable();
            $table->timestamp('at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_disposals');
    }
};
