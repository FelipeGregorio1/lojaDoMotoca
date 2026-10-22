<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/category.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Definição reutilizável dos ícones SVG -->
  <svg style="display: none;" aria-hidden="true">
    <symbol id="icon-list" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="8" y1="6" x2="21" y2="6"></line>
      <line x1="8" y1="12" x2="21" y2="12"></line>
      <line x1="8" y1="18" x2="21" y2="18"></line>
      <line x1="3" y1="6" x2="3.01" y2="6"></line>
      <line x1="3" y1="12" x2="3.01" y2="12"></line>
      <line x1="3" y1="18" x2="3.01" y2="18"></line>
    </symbol>

    <symbol id="icon-edit" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
    </symbol>

    <symbol id="icon-trash" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="3 6 5 6 21 6"></polyline>
      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
    </symbol>
  </svg>

  <main class="categories-panel">
    <header class="panel-header">
      <div class="panel-title-group">
        <h1>Gerenciar categorias</h1>
        <p>{{ $categories->count() }} {{ $categories->count() === 1 ? 'categoria cadastrada' : 'categorias cadastradas' }}</p>
      </div>

      <!-- Ajuste a rota de criação conforme o seu arquivo web.php -->
      <a href="/category/create" class="btn-new-category">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        NOVA CATEGORIA
      </a>
    </header>

    <!-- Conteúdo Principal -->
    <section class="panel-body" aria-label="Lista de categorias">
      <!-- Barra de Busca -->
      <div class="search-bar">
        <input 
          type="search" 
          id="searchCategories"
          class="search-input" 
          placeholder="Buscar categorias..." 
          aria-label="Buscar categorias"
        >
      </div>

      <!-- Grade Dinâmica de Cartões -->
      <div class="categories-grid" id="categoriesGrid">
        @forelse($categories as $c)
          <article class="category-card" data-name="{{ strtolower($c->name) }}">
            <div class="card-top">
              <div class="category-icon" aria-hidden="true">
                <svg><use href="#icon-list"></use></svg>
              </div>
            </div>

            <div class="card-content">
              <h2 class="category-title">{{ $c->name }}</h2>
              {{-- Exibe a descrição do banco ($c->description) ou um texto padrão caso ainda não exista a coluna --}}
              <p class="category-description">{{ $c->description ?? 'Produtos e itens de ' . strtolower($c->name) }}</p>
            </div>

            <footer class="card-footer">
              <span class="product-count">
                {{ $c->Products->Count() }} {{ $c->Products->Count() === 1 ? 'produto' : 'produtos' }}
              </span>

              <div class="card-actions">
                <!-- Link de Editar original -->
                <a href="/category/edit/{{ $c->id }}" class="btn-icon btn-edit" title="Editar {{ $c->name }}" aria-label="Editar {{ $c->name }}">
                  <svg width="13" height="13"><use href="#icon-edit"></use></svg>
                </a>

                <!-- Link de Deletar original com confirmação de segurança -->
                <a href="/category/delete/{{ $c->id }}" 
                   class="btn-icon btn-delete" 
                   title="Deletar {{ $c->name }}" 
                   aria-label="Deletar {{ $c->name }}"
                   onclick="return confirm('Tem certeza que deseja deletar a categoria {{ addslashes($c->name) }}?')">
                  <svg width="13" height="13"><use href="#icon-trash"></use></svg>
                </a>
              </div>
            </footer>
          </article>
        @empty
          <div class="empty-state">
            Nenhuma categoria cadastrada até o momento.
          </div>
        @endforelse
      </div>
    </section>
  </main>

  <!-- Script simples para fazer o campo "Buscar categorias..." filtrar os cards em tempo real -->
  <script>
    document.getElementById('searchCategories').addEventListener('input', function (e) {
      const termo = e.target.value.toLowerCase().trim();
      const cards = document.querySelectorAll('.category-card');

      cards.forEach(card => {
        const nome = card.getAttribute('data-name');
        const descricao = card.querySelector('.category-description').textContent.toLowerCase();
        
        if (nome.includes(termo) || descricao.includes(termo)) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>