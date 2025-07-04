<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    public function menuItems()
{
    return $this->hasMany(MenuItem::class);
}

    public function offers()
    {
        return $this->hasMany(Offer::class, 'category_id');
    }
}
