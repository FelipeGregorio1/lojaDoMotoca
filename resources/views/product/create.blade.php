<form action="/product" method="POST">
    @csrf
    <div>Nome: <input type="text" name="name"></div>
    <div>Preço: <input type="text" name="price"></div>
    <div>Estoque: <input type="number" name="stock"></div>
    <div>Categoria: 
        <select name="category_id">
            <option values="">Selecione uma Categoria</option>
            @foreach(\App\Models\Category::all() as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Cadastrar Produto</button>
</form>