<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $currentCategory->name }} - Loja do Motoca</title>

  <!-- Fonte Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Mesmo CSS Externo da homeClient -->
  <link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>
<body>

  <!-- ================= 1. CABEÇALHO / NAVBAR ================= -->
  <header class="navbar">
    <div class="container navbar-content">
      
      <a href="{{ route('client.home') }}" class="navbar-logo" aria-label="Página Inicial Loja do Motoca">
        <img class="logo-img" src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=120" alt="Loja do Motoca">
      </a>

      <form class="search-form" action="{{ route('client.home') }}" method="GET">
        <div class="search-wrapper">
          <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="search" name="q" class="search-input" placeholder="Buscar produtos..." aria-label="Buscar produtos">
        </div>
      </form>

      <nav class="nav-actions" aria-label="Menu do usuário">
        <a href="#" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
          </div>
          <span>Favoritos</span>
        </a>

        <a href="#" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="cart-badge">2</span>
          </div>
          <span>Carrinho</span>
        </a>

        <a href="{{ auth()->check() ? route('profile.edit') : route('login') }}" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <span>Perfil</span>
        </a>

        @guest
          <a href="{{ route('login') }}" class="btn-login">ENTRAR</a>
        @endguest

        @auth
          <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-login">SAIR</button>
          </form>
        @endauth
      </nav>

    </div>

    <!-- ================= 2. SUB-MENU DE CATEGORIAS ================= -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-nav-list">
          @foreach($categories as $c)
            <li>
              <a href="{{ route('client.category', $c->id) }}" class="category-nav-link {{ $c->id === $currentCategory->id ? 'active' : '' }}">
                {{ $c->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </nav>
  </header>

  <main>
    <!-- ================= LISTAGEM DE PRODUTOS DA CATEGORIA ================= -->
    <section class="section-offers">
      <div class="container">
        
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('client.home') }}">Início</a>
          <span>/</span>
          <strong>{{ $currentCategory->name }}</strong>
        </nav>

        <header class="section-header">
          <div>
            <h1 class="section-title">CATEGORIA: <span>{{ $currentCategory->name }}</span></h1>
            <p class="category-page-subtitle">
              {{ $currentCategory->Products->count() }} {{ $currentCategory->Products->count() === 1 ? 'produto encontrado' : 'produtos encontrados' }}
            </p>
          </div>
          <a href="{{ route('client.home') }}" class="link-view-all">&larr; VOLTAR PARA A LOJA</a>
        </header>

        <div class="products-grid">
          @forelse($currentCategory->Products as $p)
            <article class="product-card">
              <div class="product-thumb">
                <img src="{{ $p->image ?? 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $p->name }}">
                <span class="badge-tag">OFERTA</span>
                <span class="badge-discount">-15%</span>
              </div>
              <div class="product-info">
                <span class="product-cat-label">{{ $currentCategory->name }}</span>
                <h2 class="product-title">{{ $p->name }}</h2>
                <div class="product-pricing">
                  <span class="price-current">R$ {{ number_format((float) $p->price, 2, ',', '.') }}</span>
                  <span class="price-old">R$ {{ number_format((float) $p->price * 1.18, 2, ',', '.') }}</span>
                </div>
                <button type="button" class="btn-add-cart">ADICIONAR</button>
              </div>
            </article>
          @empty
            <p class="empty-catalog-message">
              Ainda não há produtos cadastrados na categoria <strong>{{ $currentCategory->name }}</strong>.
            </p>
          @endforelse
        </div>

      </div>
    </section>

    <!-- ================= FAIXA DE BENEFÍCIOS ================= -->
    <section class="benefits-bar" aria-label="Vantagens da loja">
      <div class="container">
        <div class="benefits-grid">
          <div class="benefit-item">
            <h3>Frete Grátis</h3>
            <p>Acima de R$ 299</p>
          </div>
          <div class="benefit-item">
            <h3>12x Sem Juros</h3>
            <p>No cartão de crédito</p>
          </div>
          <div class="benefit-item">
            <h3>Troca Fácil</h3>
            <p>30 dias garantidos</p>
          </div>
          <div class="benefit-item">
            <h3>Compra Segura</h3>
            <p>Certificado SSL</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ================= RODAPÉ (FOOTER) ================= -->
  <footer class="site-footer">
    <div class="container footer-content">
      <div class="footer-brand">
        <img class="footer-logo" src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=100" alt="Loja do Motoca">
        <span class="footer-copy">&copy; 2026 Todos os direitos reservados.</span>
      </div>

      <nav aria-label="Links institucionais">
        <ul class="footer-links">
          <li><a href="#">Sobre nós</a></li>
          <li><a href="#">Política de privacidade</a></li>
          <li><a href="#">Termos de uso</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </nav>
    </div>
  </footer>

</body>
</html>