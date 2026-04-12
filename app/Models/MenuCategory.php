<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

     protected $fillable = [
    'name',
    'status',
];

// العلاقة: الـ Category تحتوي على عدة Items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'Menu_Categories_ID');
    }

    // Cascade on Delete
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($menuCategory) {
            $menuCategory->menuItems()->delete();
        });
    }
}
