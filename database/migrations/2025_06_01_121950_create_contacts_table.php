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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('الاسم');
            $table->string('email')->nullable();
            $table->string('الايميل')->nullable();
            $table->string('subject');
            $table->string('الموضوع');
            $table->text('message');
            $table->text('الرسالة');
            $table->boolean('is_read')->default(false);
            $table->boolean('تمت القراءة')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
