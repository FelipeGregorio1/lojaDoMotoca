<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;


class ProductController extends Controller
{
    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Salva em storage/app/public/products e retorna "products/nome_hash.ext"
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect('/product');
    }

    public function index(){
        return view('product.index', ['products' => Product::all()]);
    }

    public function edit(Product $product){
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product){
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect('/product');
    }

    public function destroy(Product $product){
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect('/product');
    }
}