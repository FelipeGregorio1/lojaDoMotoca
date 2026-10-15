<form action="/category" method="POST">
    @csrf
    <div>Nome: <input type="text" name="name"></div>
    <button type="submit">Cadastrar Categoria</button>
</form>