<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'Start_Time',
        'End_Time',
        'Access_Code',
        'Status',
        'Orders_ID',
        'Internet_Services_ID',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'Orders_ID');
    }

    public function internetService()
    {
        return $this->belongsTo(InternetService::class, 'Internet_Services_ID');
    }
}