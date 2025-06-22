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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('العنوان');
            $table->string('title_en');
            $table->text('الوصف')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('الحالة')->default(true);
            $table->datetime('valid_until');
            $table->datetime('تاريخ انتهاء العرض');
            $table->decimal('price');
            $table->decimal('السعر');
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
        Schema::dropIfExists('offers');
    }
};
