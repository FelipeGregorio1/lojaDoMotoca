<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - Loja do Motoca</title>
    <link rel="stylesheet" href="../../css/newCategory.css">
</head>
<body class="admin-container">

    <header class="page-header">
        <span class="badge">PAINEL ADMINISTRATIVO</span>
        <h1>Editar categoria</h1>
        <p>Atualize a organização do catálogo de peças e acessórios.</p>
    </header>

    <form action="/category/update/{{ $category->id }}" method="POST" class="category-form">
        @csrf
        
        <div class="card">
            <div class="card-header">
                <h2>Informações da categoria</h2>
                <p>Dados usados para identificar e apresentar a categoria.</p>
            </div>
            
            <hr class="divider">
            
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome da categoria *</label>
                    <!-- O atributo value preenche o input com o dado atual vindo do banco -->
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <div class="actions-container">
                <!-- Transformado em link para voltar à listagem, mantendo a classe do botão -->
                <a href="/category" class="btn btn-cancel" style="text-decoration: none; display: inline-flex; align-items: center;">CANCELAR</a>
                <button type="submit" class="btn btn-submit">SALVAR ALTERAÇÕES</button>
            </div>
        </div>
    </form>
</body>
</html>