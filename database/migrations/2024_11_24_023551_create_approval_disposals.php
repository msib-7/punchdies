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
            $table->bigInteger('punch_id')->nullable();
            $table->bigInteger('dies_id')->nullable();
            $table->uuid('user_id');
            $table->dateTime('tgl_submit');
            $table->dateTime('due_date');
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('approved_note')->nullable();
            $table->string('attach_1')->default('-')->nullable();
            $table->string('attach_2')->default('-')->nullable();
            $table->string('attach_3')->default('-')->nullable();
            $table->string('attach_4')->default('-')->nullable();
            $table->string('attach_5')->default('-')->nullable();
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
        Schema::dropIfExists('approval_disposals');
    }
};
