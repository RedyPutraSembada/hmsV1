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
        Schema::table('product_buyings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaction_pos')->nullable();
            $table->foreign('id_transaction_pos')->references('id')->on('transaction_pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_buyings', function (Blueprint $table) {
            //
        });
    }
};
