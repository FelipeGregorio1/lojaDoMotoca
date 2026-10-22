<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Categoria</title>
  <link rel="stylesheet" href="../css/newCategory.css">
</head>
<body class="admin-container">

    <header class="page-header">
        <span class="badge">PAINEL ADMINISTRATIVO</span>
        <h1>Nova categoria</h1>
        <p>Organize o catálogo e defina como esta categoria será apresentada na loja.</p>
    </header>

    <form action="/category" method="POST" class="category-form">
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
                    <input type="text" id="name" name="name" required>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <div class="actions-container">
                <a href="/category" class="btn btn-cancel">CANCELAR</a>
                <button type="submit" class="btn btn-submit">CRIAR CATEGORIA</button>
            </div>
        </div>
    </form>
</body>
</html>