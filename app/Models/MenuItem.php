<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /** @use HasFactory<\Database\Factories\MenuItemFactory> */
    use HasFactory;
     protected $fillable = [
        'Item_Name',
        'Description',
        'Price',
        'Status',
        'Spicy_Level',
        'Menu_Categories_ID',
    ];

    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'Menu_Categories_ID');
    }
    
    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class, 'Menu_Items_ID');
}
}
