<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // get the user who owns the store
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get all products of this store
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
