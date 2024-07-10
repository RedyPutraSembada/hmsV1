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
            $table->bigInteger('extra_adult');
            $table->bigInteger('extra_child');
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
