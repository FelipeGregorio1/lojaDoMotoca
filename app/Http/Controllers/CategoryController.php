<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Salva em storage/app/public/categories e retorna "categories/nome_hash.ext"
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);
        return redirect('/category');
    }

    public function index(){
        return view('category.index', ['categories' => Category::all()]);
    }

    public function edit(Category $category){
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category){
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Apaga a imagem antiga se existir
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect('/category');
    }

    public function destroy(Category $category){
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        return redirect('/category');
    }
}