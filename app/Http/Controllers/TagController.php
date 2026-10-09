<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function create(){
        return view('tag.create');
    }

    public function store(Request $request){
        Tag::create($request->all());
        return redirect ('/tag');
    }

    public function index(){
        return view('tag.index', ['tags'=>Tag::all()]);
    }

    public function edit(Tag $tag){
        return view('tag.edit', ['tag'=>$tag]);
    }

    public function update(Request $request, Tag $tag){
        $tag->update($request->all());
        return redirect ('/tag');
    }

    public function destroy(Tag $tag){
        $tag->delete();
        return redirect('/tag');
    }
}
