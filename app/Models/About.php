<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_text_en',
        'main_text_ar',
        'gallery_images',
        'why_points_en',
        'why_points_ar',
        'why_title_en',
        'why_title_ar'
    ];
}
