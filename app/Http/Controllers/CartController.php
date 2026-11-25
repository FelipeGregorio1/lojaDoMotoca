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

<<<<<<< HEAD
    public function store(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $size = $request->input('size');

        if ($product->has_sizes && empty($size)) {
            return back()->with('error', 'Selecione um tamanho antes de adicionar ao carrinho.');
        }

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->where('size', $size)
                    ->first();

        if ($cart) {
=======
    public function store(Request $request, Product $product){
        $quantity = (int) $request->input('quantity', 1);

        // Verifica se este produto já está no carrinho do usuário logado
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            // Se já estiver no carrinho, apenas soma a quantidade
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
            $cart->update([
                'quantity' => $cart->quantity + $quantity
            ]);
        } else {
<<<<<<< HEAD
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'size'       => $size,
=======
            // Se não estiver, cria um novo registro na tabela carts
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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
<<<<<<< HEAD

    private function getAvailableStock(?Product $product, ?string $size = null): int
    {
        if (!$product) {
            return 0;
        }

        if ($product->has_sizes && !empty($product->sizes) && !empty($size)) {
            foreach ($product->sizes as $item) {
                if (($item['size'] ?? '') == $size) {
                    return (int) ($item['stock'] ?? 0);
                }
            }
        }

        return (int) ($product->stock ?? 0);
    }
=======
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
}
