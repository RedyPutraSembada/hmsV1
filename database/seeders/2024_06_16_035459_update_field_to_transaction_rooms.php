<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 3: Modify columns and add new columns
        Schema::table('transaction_rooms', function (Blueprint $table) {
            $table->integer('no_of_room')->nullable();
            $table->integer('no_of_person')->nullable();
            $table->string('arrival_flight_no')->nullable();
            $table->string('departure_flight_no')->nullable();
            $table->string('eta')->nullable();
            $table->string('etd')->nullable();
            $table->string('booked_by')->nullable();
            $table->string('tlp_by')->nullable();
            $table->string('fax_by')->nullable();
            $table->string('taken_by')->nullable();
            $table->string('taken_time')->nullable();
            $table->string('confirmation_by')->nullable();
            $table->string('confirmation_time')->nullable();
            $table->string('input_by')->nullable();
            $table->string('input_time')->nullable();
            $table->string('checked_by')->nullable();
            $table->string('checked_time')->nullable();
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
