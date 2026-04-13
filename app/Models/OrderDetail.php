<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'Quantity',
        'Unit_Price',
        'Notes',
        'Orders_ID',
        'Menu_Items_ID',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'Orders_ID');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'Menu_Items_ID');
    }
}