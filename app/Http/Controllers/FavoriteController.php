<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    // Adiciona ou remove dos favoritos ao clicar no coração do produto
    public function toggle(Product $product){
        $favorite = Favorite::where('user_id', auth()->id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
            ]);
        }

        return back();
    }

    // Remove direto pela aba Favoritos do Perfil
    public function destroy(Favorite $favorite){
        if ($favorite->user_id === auth()->id()) {
            $favorite->delete();
        }

        return redirect()->route('profile.edit', ['tab' => 'favoritos']);
    }
}
