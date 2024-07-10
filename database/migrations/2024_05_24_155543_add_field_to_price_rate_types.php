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
        Schema::table('price_rate_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id_status_rate_type')->nullable();
            $table->foreign('id_status_rate_type')->references('id')->on('status_rate_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('price_rate_types', function (Blueprint $table) {
            //
        });
    }
};
