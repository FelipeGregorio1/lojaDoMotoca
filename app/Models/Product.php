<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'stock', 'image'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    // Converte o preço para float mesmo se tiver sido salvo com vírgula ou ponto de milhar
    public function getNumericPriceAttribute(): float{
        $price = (string) $this->price;

        // Se tiver vírgula (ex: "1.500,00" ou "49,90"), tira os pontos de milhar e troca vírgula por ponto
        if (str_contains($price, ',')) {
            $price = str_replace('.', '', $price);
            $price = str_replace(',', '.', $price);
        }

        // Remove qualquer caractere que não seja número ou ponto (ex: "R$ ")
        $price = preg_replace('/[^0-9.]/', '', $price);

        return (float) $price;
    }
}
