<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'phone',
        'email',
        'guests_count',
        'booking_date',
        'booking_time',
        'message_ar',
        'message_en',
        'status'
    ] ;
}
