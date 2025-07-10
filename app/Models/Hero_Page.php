<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero_Page extends Model
{
    use HasFactory;

    // Specify the table name explicitly
    protected $table = 'hero_pages';

    protected $fillable = [
        'title_en',
        'title_ar',
        'main_text_en',
        'main_text_ar',
    ];

    public function images()
{
    return $this->hasMany(Hero_image::class, 'hero_page_id'); 
}

}
