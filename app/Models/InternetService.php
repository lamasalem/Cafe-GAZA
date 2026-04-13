<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'speed',
        'price',
    ];

    public function internetSessions()
{
    return $this->hasMany(InternetSession::class, 'Internet_Services_ID');
}

protected static function boot()
{
    parent::boot();
    static::deleting(function ($internetService) {
        $internetService->internetSessions()->delete();
    });
}
}