<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'subject_ar',
        'subject_en',
        'message_ar',
        'message_en',
        'is_read',
        'sent_at',
    ];
}
