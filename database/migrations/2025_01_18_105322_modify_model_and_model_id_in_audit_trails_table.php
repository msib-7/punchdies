<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyModelAndModelIdInAuditTrailsTable extends Migration
{
    public function up(): void
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            $table->string('model')->nullable()->change(); // Make model nullable
            $table->uuid('model_id')->nullable()->change(); // Make model_id nullable
        });
    }

    public function down(): void
    {
        Schema::table('audit_trails', function (Blueprint $table) {
            $table->string('model')->nullable(false)->change(); // Revert model to not nullable
            $table->uuid('model_id')->nullable(false)->change(); // Revert model_id to not nullable
        });
    }

};
