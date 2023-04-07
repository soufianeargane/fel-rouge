<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;
    use Rateable;
    protected $fillable = [
        'title',
        'phone',
        'neighborhood',
        'image',
        'user_id',
        'city_id',
        'deleted_at',
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

    // city
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
