<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_page_id',
        'image_path'
    ];

    public function heroPage()
    {
        return $this->belongsTo(Hero_Page::class, 'hero_page_id');
    }
}
