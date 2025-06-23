<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_en',
        'address_ar',
        'email',
        'phone',
        'opening_hours',
        'facebook_url',
        'instagram_url',
        'whatsapp',
        'logo',
        'favicon',
    ];
}
