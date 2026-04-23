<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'Order_Date',
        'Total_Amount',
        'Payment_Method',
        'Dining_Tables_ID',
    ];

    public function diningTable()
    {
        return $this->belongsTo(DiningTable::class, 'Dining_Tables_ID');
    }

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

