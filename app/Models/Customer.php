<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'Email',
        'Password',
    ];

    protected $hidden = [
        'Password',
    ];
    public function user() {
    return $this->morphOne(User::class, 'actor');
}
}