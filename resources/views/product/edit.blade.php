<form action="/product/update/{{$product->id}}" method="POST">
    @csrf
    <div>Nome: <input type="text" name="name" value="{{$product->name}}"></div>
    <div>Preço: <input type="text" name="price" value="{{$product->price}}"></div>
    <div>Categoria: 
        <select name="category_id">
            <option value="">Selecione uma Categoria</option>
            @foreach(\App\Models\Category::all() as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Alterar Produto</button>
</form>