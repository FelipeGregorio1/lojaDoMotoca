<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/product.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Definição reutilizável dos ícones SVG -->
  <svg style="display: none;" aria-hidden="true">
    <symbol id="icon-edit" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
    </symbol>

    <symbol id="icon-trash" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="3 6 5 6 21 6"></polyline>
      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
    </symbol>
  </svg>

  <header class="admin-header">
    <div class="admin-header__container">
        
          <!-- Esquerda: Logo + Badge ADMIN -->
          <div class="admin-brand">
              <a href="{{ url('/') }}" class="admin-brand__logo-link" title="Loja do Motoca">
                  <img src="{{ asset('img/logoLDM.png') }}" alt="Logo Loja do Motoca" class="admin-brand__logo">
              </a>
              <span class="admin-brand__badge">ADMIN</span>
          </div>

          <!-- Centro: Navegação Principal -->
          <nav class="admin-nav" aria-label="Menu Administrativo">
              <ul class="admin-nav__list">
                  
                  <!-- Visão Geral (Futuro) -->
                  <li class="admin-nav__item">
                      <a href="#" class="admin-nav__link {{ request()->routeIs('admin.dashboard*') ? 'is-active' : '' }}">
                          <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                              <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                              <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                              <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                          </svg>
                          <span>Visão geral</span>
                      </a>
                  </li>

                  <!-- Categorias (Ativo em index, create, edit, etc.) -->
                  <li class="admin-nav__item">
                      <a href="{{ route('category.index') }}" class="admin-nav__link {{ request()->routeIs('*category.*') ? 'is-active' : '' }}">
                          <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <line x1="8" y1="6" x2="21" y2="6"></line>
                              <line x1="8" y1="12" x2="21" y2="12"></line>
                              <line x1="8" y1="18" x2="21" y2="18"></line>
                              <line x1="3" y1="6" x2="3.01" y2="6"></line>
                              <line x1="3" y1="12" x2="3.01" y2="12"></line>
                              <line x1="3" y1="18" x2="3.01" y2="18"></line>
                          </svg>
                          <span>Categorias</span>
                      </a>
                  </li>

                  <!-- Produtos (Ativo em index, create, edit, etc.) -->
                  <li class="admin-nav__item">
                      <a href="{{ route('product.index') }}" class="admin-nav__link {{ request()->routeIs('*product.*') ? 'is-active' : '' }}">
                          <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                              <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                              <line x1="12" y1="22.08" x2="12" y2="12"></line>
                          </svg>
                          <span>Produtos</span>
                      </a>
                  </li>

                  <!-- Pedidos (Futuro) -->
                  <li class="admin-nav__item">
                      <a href="#" class="admin-nav__link {{ request()->routeIs('*pedidos*') ? 'is-active' : '' }}">
                          <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                              <line x1="3" y1="6" x2="21" y2="6"></line>
                              <path d="M16 10a4 4 0 0 1-8 0"></path>
                          </svg>
                          <span>Pedidos</span>
                      </a>
                  </li>

                  <!-- Clientes (Futuro) -->
                  <li class="admin-nav__item">
                      <a href="#" class="admin-nav__link {{ request()->routeIs('*clientes*') ? 'is-active' : '' }}">
                          <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                              <circle cx="9" cy="7" r="4"></circle>
                              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                          </svg>
                          <span>Clientes</span>
                      </a>
                  </li>

              </ul>
          </nav>

          <!-- Direita: Ações (Ver Loja e Sair) -->
          <div class="admin-actions">
              <a href="{{ url('/') }}" class="admin-actions__btn admin-actions__btn--outline">
                  VER LOJA
              </a>

              <form action="{{ route('logout') }}" method="POST" class="admin-actions__form">
                  @csrf
                  <button type="submit" class="admin-actions__btn admin-actions__btn--dark">
                      SAIR
                  </button>
              </form>
          </div>

      </div>
  </header>

  <main class="catalog-panel">
    <!-- Cabeçalho do Catálogo -->
    <header class="panel-header">
      <div class="panel-title-group">
        <h1>Catálogo de produtos</h1>
        <p>{{ $products->count() }} {{ $products->count() === 1 ? 'produto cadastrado' : 'produtos cadastrados' }}</p>
      </div>

      <a href="/product/create" class="btn-new-product">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        NOVO PRODUTO
      </a>
    </header>

    <!-- Corpo com Busca e Tabela -->
    <section class="panel-body" aria-label="Lista de produtos">
      <div class="search-bar">
        <input 
          type="search" 
          id="searchProducts" 
          class="search-input" 
          placeholder="Buscar produtos..." 
          aria-label="Buscar produtos"
        >
      </div>

      <div class="table-responsive">
        <table class="products-table">
          <thead>
            <tr>
              <th scope="col" class="col-product">PRODUTO</th>
              <th scope="col" class="col-category">CATEGORIA</th>
              <th scope="col" class="col-price">PREÇO</th>
              <th scope="col" class="col-stock">ESTOQUE</th>
              <th scope="col" class="col-actions">AÇÕES</th>
            </tr>
          </thead>
          <tbody id="productsTableBody">
            @forelse($products as $p)
              @php
                // Obtém o estoque (caso a coluna exista no model; se não, assume 10 como padrão)
                $stock = $p->stock ?? $p->quantity ?? 10;

                // Define se o produto está ativo (inativo se active == 0 ou se estoque for 0)
                $isActive = isset($p->active) ? (bool) $p->active : ($stock > 0);

                // Gera um código SKU visual caso ainda não tenha coluna 'sku' na tabela
                $sku = $p->sku ?? strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $p->name), 0, 3)) . '-' . str_pad($p->id, 3, '0', STR_PAD_LEFT);
              @endphp

              <tr class="product-row">
                <!-- Coluna 1: Nome e Código SKU -->
                <td>
                  <span class="product-name">{{ $p->name }}</span>
                  <span class="product-sku">{{ $sku }}</span>
                </td>

                <!-- Coluna 2: Categoria -->
                <td class="product-category">
                  {{ $p->Category?->name ?? 'Sem categoria' }}
                </td>

                <!-- Coluna 3: Preço formatado em Real -->
                <td class="product-price">
                  R$ {{ number_format((float) $p->price, 2, ',', '.') }}
                </td>

                <!-- Coluna 4: Estoque (Fica vermelho se for <= 5 unidades, igual à imagem) -->
                <td>
                  <span class="product-stock {{ $stock <= 5 ? 'low-stock' : '' }}">
                      {{ $stock }} un.
                  </span>
                </td>

                <!-- Coluna 6: Ações (Editar e Deletar) -->
                <td>
                  <div class="row-actions">
                    <a href="/product/edit/{{ $p->id }}" 
                       class="btn-icon btn-edit" 
                       title="Editar {{ $p->name }}" 
                       aria-label="Editar {{ $p->name }}">
                      <svg width="13" height="13"><use href="#icon-edit"></use></svg>
                    </a>

                    <a href="/product/delete/{{ $p->id }}" 
                       class="btn-icon btn-delete" 
                       title="Deletar {{ $p->name }}" 
                       aria-label="Deletar {{ $p->name }}"
                       onclick="return confirm('Tem certeza que deseja deletar o produto {{ addslashes($p->name) }}?')">
                      <svg width="13" height="13"><use href="#icon-trash"></use></svg>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="empty-state">
                  Nenhum produto cadastrado até o momento.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Filtro de busca em tempo real por nome, SKU ou categoria -->
  <script>
    document.getElementById('searchProducts').addEventListener('input', function (e) {
      const termo = e.target.value.toLowerCase().trim();
      const linhas = document.querySelectorAll('.product-row');

      linhas.forEach(linha => {
        const textoLinha = linha.textContent.toLowerCase();
        linha.style.display = textoLinha.includes(termo) ? '' : 'none';
      });
    });
  </script>

</body>
</html>