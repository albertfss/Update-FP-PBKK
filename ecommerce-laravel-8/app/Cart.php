<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use app\Product;
use app\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function customer()
    {
    	return $this->belongsTo(Product::class);
    }
}
