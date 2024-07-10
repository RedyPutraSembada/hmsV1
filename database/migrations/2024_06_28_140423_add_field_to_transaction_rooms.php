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
        Schema::table('transaction_rooms', function (Blueprint $table) {
            $table->boolean('status_breakfast')->nullable();
            $table->bigInteger('price_breakfast')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_rooms', function (Blueprint $table) {
            //
        });
    }
};
