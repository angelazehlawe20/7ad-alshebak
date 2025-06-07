<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class, 'menu_image');
    }

    public function offers() {
        return $this->belongsToMany(Offer::class, 'offer_image');
    }
}
