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
        Schema::create('qr_code_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreignId('qr_code_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_code_tracks');
    }
};
