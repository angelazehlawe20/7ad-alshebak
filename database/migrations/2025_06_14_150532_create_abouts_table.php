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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('main_text_en')->nullable();
            $table->text('main_text_ar')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('why_points_en')->nullable();
            $table->json('why_points_ar')->nullable();
            $table->string('why_title_en')->nullable();
            $table->string('why_title_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
