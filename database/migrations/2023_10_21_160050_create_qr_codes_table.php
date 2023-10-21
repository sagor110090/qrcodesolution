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
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('code')->unique();
            $table->string('qr_style')->nullable();
            $table->string('qr_logo')->nullable();
            $table->string('qr_color')->nullable();
            $table->string('qr_bg_color')->nullable();
            $table->string('qr_eye_border')->nullable();
            $table->string('qr_eye_center')->nullable();
            $table->string('qr_gradient')->nullable();
            $table->string('qr_eye_color_in')->nullable();
            $table->string('qr_eye_color_out')->nullable();
            $table->string('qr_eye_style_in')->nullable();
            $table->string('qr_eye_style_out')->nullable();
            $table->string('qr_logo_background')->nullable();
            $table->string('qr_bg_image')->nullable();
            $table->string('qr_custom_logo')->nullable();
            $table->string('qr_custom_background')->nullable();
            $table->string('frame')->nullable();
            $table->string('frame_label')->nullable();
            $table->string('frame_label_font')->nullable();
            $table->string('frame_label_text_color')->nullable();
            $table->string('is_dynamic')->nullable();
            $table->json('qr_code_info')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
