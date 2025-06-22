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
        Schema::create('hero_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('العنوان')->nullable();
            $table->text('main_text_en')->nullable();
            $table->text('النص الأساسي')->nullable();
            $table->string('image')->nullable();
            $table->string('الصورة')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_pages');
    }
};
