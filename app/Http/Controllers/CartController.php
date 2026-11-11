<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    public function index(){
        return view('client.cart', [
            'carts' => Cart::where('user_id', auth()->id())->get(),
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request, Product $product){
        $quantity = (int) $request->input('quantity', 1);

        // Verifica se este produto já está no carrinho do usuário logado
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            // Se já estiver no carrinho, apenas soma a quantidade
            $cart->update([
                'quantity' => $cart->quantity + $quantity
            ]);
        } else {
            // Se não estiver, cria um novo registro na tabela carts
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $quantity
            ]);
        }

        return redirect('/cart');
    }

    public function update(Request $request, Cart $cart){
        if ($request->action === 'increase') {
            $cart->update(['quantity' => $cart->quantity + 1]);
        } elseif ($request->action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->update(['quantity' => $cart->quantity - 1]);
            } else {
                $cart->delete();
            }
        }

        return redirect('/cart');
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return redirect('/cart');
    }
}
