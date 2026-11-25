<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
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

=======
    protected $fillable = ['name', 'price', 'category_id', 'stock', 'image'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    // Converte o preço para float mesmo se tiver sido salvo com vírgula ou ponto de milhar
    public function getNumericPriceAttribute(): float{
        $price = (string) $this->price;

        // Se tiver vírgula (ex: "1.500,00" ou "49,90"), tira os pontos de milhar e troca vírgula por ponto
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
        if (str_contains($price, ',')) {
            $price = str_replace('.', '', $price);
            $price = str_replace(',', '.', $price);
        }

<<<<<<< HEAD
=======
        // Remove qualquer caractere que não seja número ou ponto (ex: "R$ ")
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
        $price = preg_replace('/[^0-9.]/', '', $price);

        return (float) $price;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
