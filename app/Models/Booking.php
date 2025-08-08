<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'birth_date',
        'guests_count',
        'booking_date',
        'booking_time',
        'message',
        'status',
        'is_notified'
    ];
}
