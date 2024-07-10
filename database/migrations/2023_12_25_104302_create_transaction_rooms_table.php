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
        Schema::create('transaction_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guest')->constrained('guests');
            $table->string("type_transaction");
            $table->string("card_number");
            $table->date("exp_card");
            $table->string("folio_number");
            $table->text("notes");
            $table->date("arrival");
            $table->date("departure");
            $table->foreignId('id_room')->constrained('rooms');
            $table->foreignId('id_price_rate_type')->constrained('price_rate_types');
            $table->foreignId('id_travel_agent')->constrained('travel_agents');
            $table->foreignId('id_source_travel_agent')->constrained('source_travel_agents');
            $table->integer('status_transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_rooms');
    }
};
