<form action="/category/update/{{$category->id}}" method="POST">
    @csrf
    <div>Nome: <input type="text" name="name" value="{{$category->name}}"></div>
    <button type="submit">Alterar Categoria</button>
</form>