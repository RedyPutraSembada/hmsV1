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
            $table->dropForeign(['id_source_travel_agent']);
            $table->dropColumn('id_source_travel_agent');
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
