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
        Schema::create('intentions', function (Blueprint $table) {
            $table->id();
            $table->char('user_pin', 5);
            $table->foreign('user_pin')->references('pin')->on('users')->cascadeOnDelete();
            $table->dateTime('mass_date');
            $table->jsonb('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intentions');
    }
};
