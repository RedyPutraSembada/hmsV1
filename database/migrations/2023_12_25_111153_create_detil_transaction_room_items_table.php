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
        Schema::create('detil_transaction_room_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction_room')->constrained('transaction_rooms');
            $table->foreignId('id_additional_item')->constrained('additional_items');
            $table->integer('qty_item');
            $table->bigInteger('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_transaction_room_items');
    }
};
