<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
