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
        Schema::create('transaction_pos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction')->constrained('transaction_rooms');
            $table->foreignId('id_guest')->constrained('guests');
            $table->string("type_transaction");
            $table->string("card_number");
            $table->date("date");
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->decimal('total_transaction', 15, 2)->nullable();
            $table->decimal('paid_transaction', 15, 2)->nullable();
            $table->integer('status_transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_pos');
    }
};
