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
        Schema::table('total_payments', function (Blueprint $table) {
            $table->longText('notes_from_fo')->nullable()->default(null);
            $table->decimal('compensation', 15, 2)->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('total_payments', function (Blueprint $table) {
            //
        });
    }
};
