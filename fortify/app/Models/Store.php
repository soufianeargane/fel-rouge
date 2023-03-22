<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'phone',
        'email',
        'city',
        'neighborhood',
        'image',
        'user_id',
    ];
}
