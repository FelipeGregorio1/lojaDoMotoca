<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        Category::create($request->all());
        return redirect ('/category');
    }

    public function index(){
        return view('category.index', ['categories'=>Category::all()]);
    }

    public function edit(Category $category){
        return view('category.edit', ['category'=>$category]);
    }

    public function update(Request $request, Category $category){
        $category->update($request->all());
        return redirect ('/category');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect('/category');
    }
}
