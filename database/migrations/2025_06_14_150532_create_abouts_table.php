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
            $table->text('main_text')->nullable();
            $table->json('gallery_images')->nullable(); // مصفوفة من الصور
            $table->json('why_points')->nullable();     // نقاط البوكس
            $table->string('why_title')->nullable();    // عنوان البوكس
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
