<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'capacity',
        'status',
    ];

    // الطاولة تحتوي على عدة طلبات
    public function orders()
    {
        return $this->hasMany(Order::class, 'Dining_Tables_ID');
    }

    // Cascade on Delete
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($diningTable) {
            $diningTable->orders()->delete();
        });
    }
}