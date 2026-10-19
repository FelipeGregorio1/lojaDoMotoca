<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // 1. Tela Inicial do Cliente (homeClient)
    public function index(Request $request)
    {
        $categories = Category::all();

        // Se o cliente digitou algo na barra "Buscar produtos...", filtra os produtos
        $query = Product::with('Category');
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->get();

        return view('client.homeClient', compact('categories', 'products'));
    }

    // 2. Tela de uma Categoria Específica (quando o cliente clica em "Capacetes", por exemplo)
    public function showCategory($id)
    {
        // Todas as categorias para manter o menu do topo funcionando
        $categories = Category::all();

        // A categoria que o cliente clicou + os produtos dela
        $currentCategory = Category::with('Products')->findOrFail($id);

        return view('client.category', compact('categories', 'currentCategory'));
    }
}