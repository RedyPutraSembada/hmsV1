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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('identity_card_type');
            $table->string('identity_card_number');
            $table->date('exp_identity_card')->nullable();
            $table->string('nationality');
            $table->string('state');
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('postal')->nullable();
            $table->string('country');
            $table->date('birth_date');
            $table->string('city_birth');
            $table->string('state_birth');
            $table->string('country_birth');
            $table->string('gender');
            $table->string('guest_type');
            $table->foreignId('id_occupation')->constrained('accupations');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
