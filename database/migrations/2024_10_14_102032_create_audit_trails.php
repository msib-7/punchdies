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
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->id();
            $table->string('model'); // Nama model yang diubah
            $table->uuid('model_id'); // UUID dari record yang diubah
            $table->string('action'); // Tipe operasi: created, updated, deleted
            $table->json('old_data')->nullable(); // Data sebelum perubahan
            $table->json('new_data')->nullable(); // Data setelah perubahan
            $table->uuid('user_id')->nullable(); // UUID dari user yang melakukan perubahan
            $table->timestamps(); // Waktu perubahan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
    // public function up(): void
    // {
    //     Schema::create('audit_trails', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('event');
    //         $table->datetime('logdate');
    //         $table->bigInteger('user_id');
    //         $table->string('line');
    //         $table->string('category'); //as action
    //         $table->string('detail');
    //         $table->timestamps();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('audit_trails');
    // }
};
