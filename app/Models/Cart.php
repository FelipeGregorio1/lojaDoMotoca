<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
<<<<<<< HEAD
    protected $fillable = ['user_id', 'product_id', 'size', 'quantity'];
=======
    protected $fillable = ['user_id', 'product_id', 'quantity'];
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01

    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
