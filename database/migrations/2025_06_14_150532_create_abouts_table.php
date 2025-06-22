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
            $table->text('النص الأساسي')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('صور المعرض')->nullable();  // مصفوفة من الصور
            $table->json('why_points')->nullable();
            $table->json('نقاط مربع النص')->nullable();     // نقاط البوكس
            $table->string('why_title')->nullable();
            $table->string('عنوان نربع النص')->nullable();
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
