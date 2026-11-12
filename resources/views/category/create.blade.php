<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Categoria</title>
  <link rel="stylesheet" href="../css/newCategory.css">
</head>
<body class="admin-container">

    <header class="admin-header">
        <div class="admin-header__container">
            
            <!-- Esquerda: Logo + Badge ADMIN -->
            <div class="admin-brand">
                <a href="img/logo.png" class="admin-brand__logo-link" title="Loja do Motoca">
                    <img src="{{ asset('img/logoLDM.png') }}" alt="Logo Loja do Motoca" class="admin-brand__logo">
                </a>
                <span class="admin-brand__badge">ADMIN</span>
            </div>

            <!-- Centro: Navegação Principal -->
            <nav class="admin-nav" aria-label="Menu Administrativo">
                <ul class="admin-nav__list">
                    
                    <!-- Visão Geral -->
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

                    <!-- Pedidos -->
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('*pedidos*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span>Pedidos</span>
                        </a>
                    </li>

                    <!-- Clientes -->
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.clients.index') }}" class="admin-nav__link {{ request()->routeIs('*clientes*') ? 'is-active' : '' }}">
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

    <header class="page-header">
        <span class="badge">PAINEL ADMINISTRATIVO</span>
        <h1>Nova categoria</h1>
        <p>Organize o catálogo e defina como esta categoria será apresentada na loja.</p>
    </header>

    <form action="/category" method="POST" enctype="multipart/form-data" class="category-form">
        @csrf
        
        <div class="card">
            <div class="card-header">
                <h2>Informações da categoria</h2>
                <p>Dados usados para identificar e apresentar a categoria.</p>
            </div>
            
            <hr class="divider">
            
            <div class="card-body">
                <div class="form-group">
                    <label for="name">
                        <span>Nome da categoria *</span>
                        <input type="text" id="name" name="name" required>
                    </label>

                    <label for="image">
                        <span>Imagem da categoria *</span>
                    <input type="file" name="image" id="image" accept="image/*" required>
                </label>
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