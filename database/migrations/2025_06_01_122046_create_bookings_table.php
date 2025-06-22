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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('الاسم');
            $table->string('phone');
            $table->string('رقم الهاتف');
            $table->text('email')->nullable();
            $table->text('الايميل')->nullable();
            $table->integer('guests_count');
            $table->integer('عدد الاشخاص للحجز');
            $table->date('booking_date');
            $table->date('تاريخ الحجز');
            $table->time('booking_time');
            $table->time('وقت الحجز');
            $table->string('message')->nullable();
            $table->string('الرسالة')->nullable();
            $table->enum('status', ['pending','confirmed','cancelled'])->default('pending');
            $table->enum('الحالة', ['معلقة','مقبولة','مرفوضة'])->default('معلقة');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
