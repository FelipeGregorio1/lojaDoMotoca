<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="../css/newProduct.css">
</head>
<body class="admin-container">

    <header class="page-header">
        <span class="badge">PAINEL ADMINISTRATIVO</span>
        <h1>Novo produto</h1>
        <p>Preencha as informações comerciais e de estoque para manter o catálogo atualizado.</p>
    </header>

    <main>
        <form action="/product" method="POST" class="product-form">
            @csrf
            
            <section class="card">
                <legend class="card-title">Informações do produto</legend>
                <p class="card-subtitle">Dados principais exibidos no catálogo da loja.</p>
                
                <hr class="divider">
                
                <label class="form-group">
                    <span>Nome do produto *</span>
                    <input type="text" name="name" required>
                </label>

                <label class="form-group">
                    <span>Categoria *</span>
                    <select name="category_id" required>
                        <option value="">Selecione</option>
                        @foreach(\App\Models\Category::all() as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </label>
            </section>

            <section class="card">
                <legend class="card-title">Venda e estoque</legend>
                <p class="card-subtitle">Valores usados na operação da loja.</p>
                
                <hr class="divider">
                
                <label class="form-group">
                    <span>Preço (R$) *</span>
                    <input type="text" name="price" placeholder="0,00" required>
                </label>

                <label class="form-group">
                    <span>Estoque *</span>
                    <input type="number" name="stock" placeholder="0" required>
                </label>
            </section>

            <footer class="form-actions">
                <nav class="actions-container">
                    <a href="/product" class="btn btn-cancel">CANCELAR</a>
                    <button type="submit" class="btn btn-submit">CRIAR PRODUTO</button>
                </nav>
            </footer>
        </form>
    </main>

</body>
</html>