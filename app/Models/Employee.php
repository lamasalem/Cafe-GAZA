<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'Job_Title',
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