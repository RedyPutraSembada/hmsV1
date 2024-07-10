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
        Schema::create('source_travel_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_travel_agent')->constrained('travel_agents');
            $table->string('name');
            $table->bigInteger('comission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_travel_agents');
    }
};
