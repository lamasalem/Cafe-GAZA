<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'Order_Date',
        'Total_Amount',
        'Payment_Method',
        'Dining_Tables_ID',
    ];

    // الطلب يتبع طاولة واحدة
    public function diningTable()
    {
        return $this->belongsTo(DiningTable::class, 'Dining_Tables_ID');
    }

    // الطلب يحتوي على عدة تفاصيل (لاحقاً)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'Orders_ID');
    }
   

public function internetSessions()
{
    return $this->hasMany(InternetSession::class, 'Orders_ID');
}


protected static function boot()
{
    parent::boot();
    static::deleting(function ($order) {
        $order->orderDetails()->delete();
        $order->internetSessions()->delete();
    });
}
}

