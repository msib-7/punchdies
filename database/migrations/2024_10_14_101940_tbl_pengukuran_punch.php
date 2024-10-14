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
        Schema::create('tbl_pengukuran_punch', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('punch_id');
            $table->foreign('punch_id')->references('id')->on('tbl_punch');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('head_outer_diameter');
            $table->double('neck_diameter');
            $table->double('barrel');
            $table->double('overall_length');
            $table->double('tip_diameter_1');
            $table->double('tip_diameter_2');
            $table->double('cup_depth');
            $table->double('working_length');
            $table->string('head_configuration');
            $table->string('masa_pengukuran');
            $table->string('note');
            $table->string('is_draft');
            $table->string('is_delete_pp');
            $table->string('is_edit');
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
