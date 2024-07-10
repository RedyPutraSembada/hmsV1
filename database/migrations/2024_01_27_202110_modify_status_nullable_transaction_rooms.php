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
            $table->string("type_transaction")->nullable()->change();
            $table->string("card_number")->nullable()->change();
            $table->date("exp_card")->nullable()->change();
            $table->string("folio_number")->nullable()->change();
            $table->text("notes")->nullable()->change();
            $table->date("arrival")->nullable()->change();
            $table->date("departure")->nullable()->change();
            $table->integer('status_transaction')->nullable()->change();
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
