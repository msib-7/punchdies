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
        Schema::create('pengukuran_rutin_diess', function (Blueprint $table) {
            $table->id();
            $table->string('dies_id');
            $table->uuid('user_id');
            $table->string('is_cincin_berbayang')->nullable();
            $table->string('is_gompal')->nullable();
            $table->string('is_retak')->nullable();
            $table->string('is_pecah')->nullable();
            $table->string('masa_pengukuran');
            $table->string('note')->nullable();
            $table->string('is_draft');
            $table->string('is_delete_pd');
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
        Schema::dropIfExists('pengukuran_rutin_diess');
    }
};
