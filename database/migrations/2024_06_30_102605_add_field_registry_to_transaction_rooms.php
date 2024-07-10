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
            $table->string("passport_no")->nullable();
            $table->string("purpose_of_visit")->nullable();
            $table->string("last_place_of_lodging")->nullable();
            $table->string("next_destination")->nullable();
            $table->string("clerk")->nullable();
            $table->date("date_of_issued")->nullable();
            $table->date("date_of_landing")->nullable();
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
