<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'stock', 'image'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
