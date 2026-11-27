<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'stock',
        'has_sizes',
        'sizes',
        'image',
        'brand',
        'warranty',
        'availability',
        'origin',
    ];

    protected $casts = [
        'has_sizes' => 'boolean',
        'sizes' => 'array',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getNumericPriceAttribute(): float
    {
        $price = (string) $this->price;

        if (str_contains($price, ',')) {
            $price = str_replace('.', '', $price);
            $price = str_replace(',', '.', $price);
        }

        $price = preg_replace('/[^0-9.]/', '', $price);

        return (float) $price;
    }
}
