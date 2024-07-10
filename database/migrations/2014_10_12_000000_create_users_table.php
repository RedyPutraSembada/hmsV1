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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('identity_card_type')->nullable();
            $table->string('identity_card_number')->nullable();
            $table->date('exp_identity_card')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal')->nullable();
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('city_birth')->nullable();
            $table->string('state_birth')->nullable();
            $table->string('country_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('user_type')->nullable();
            $table->text('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
