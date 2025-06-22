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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->text('العنوان')->nullable();
            $table->string('email')->unique();
            $table->string('الايميل')->unique();
            $table->string('phone', 10)->nullable();
            $table->string('رقم الهاتف', 10)->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('ساعات العمل')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('رابط حساب الفيسبوك')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('رابط حساب الانستغرام')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('رابط الواتساب')->nullable();
            $table->string('logo')->nullable();
            $table->string('شعار التطبيق')->nullable();
            $table->string('favicon')->nullable();
            $table->string('شعار ايقونة المتصفح')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
