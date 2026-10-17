<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loja do Motoca - Equipamentos e Peças</title>
  <link rel="stylesheet" href="css/homeClient.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- ================= 1. CABEÇALHO / NAVBAR ================= -->
  <header class="navbar">
    <div class="container navbar-content">
      
      <!-- Logo -->
      <a href="{{ url('/') }}" class="navbar-logo" aria-label="Página Inicial Loja do Motoca">
        <img class="logo-img" src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=120" alt="Loja do Motoca">
      </a>

      <!-- Barra de Busca -->
      <form class="search-form" action="{{ url('/products') }}" method="GET">
        <div class="search-wrapper">
          <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="search" name="q" class="search-input" placeholder="Buscar produtos..." aria-label="Buscar produtos">
        </div>
      </form>

      <!-- Ações do Usuário -->
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

        <!-- Ícone de Perfil integrado com o Laravel Breeze -->
        <a href="{{ auth()->check() ? url('/profile') : route('login') }}" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <span>Perfil</span>
        </a>

        <!-- Integração do Botão ENTRAR com o Laravel Breeze -->
        @guest
          <a href="{{ route('login') }}" class="btn-login">ENTRAR</a>
        @endguest

        @auth
          <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-login" title="Sair da conta">SAIR</button>
          </form>
        @endauth
      </nav>

    </div>

    <!-- ================= 2. SUB-MENU DE CATEGORIAS ================= -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-nav-list">
          @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $c)
              <li><a href="#categoria-{{ $c->id }}" class="category-nav-link">{{ $c->name }}</a></li>
            @endforeach
          @else
            <li><a href="#" class="category-nav-link">CAPACETES</a></li>
            <li><a href="#" class="category-nav-link">EQUIPAMENTOS</a></li>
            <li><a href="#" class="category-nav-link">PEÇAS</a></li>
            <li><a href="#" class="category-nav-link">PNEUS</a></li>
            <li><a href="#" class="category-nav-link">ÓLEOS</a></li>
            <li><a href="#" class="category-nav-link">FERRAMENTAS</a></li>
            <li><a href="#ofertas" class="category-nav-link">OFERTAS</a></li>
          @endif
        </ul>
      </div>
    </nav>
  </header>

  <main>
    <!-- ================= 3. HERO BANNER ================= -->
    <section class="hero" aria-label="Destaque principal">
      <div class="container">
        <div class="hero-content">
          <h1 class="hero-title">
            EQUIPAMENTOS
            <span class="highlight-red">QUE</span>
            <span class="highlight-red">PROTEGEM</span>
            E PERFORMAM
          </h1>
          <p class="hero-subtitle">
            +4.000 produtos. Peças de reposição, capacetes e equipamentos EPI com compatibilidade verificada para a sua moto.
          </p>
          <div class="hero-actions">
            <a href="#ofertas" class="btn-hero-primary">VER OFERTAS</a>
            <a href="#categorias" class="btn-hero-outline">BUSCAR PRODUTOS</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= 4. CATEGORIAS PRINCIPAIS ================= -->
    <section id="categorias" class="section-categories">
      <div class="container">
        <header class="section-header">
          <h2 class="section-title">CATEGORIAS <span>PRINCIPAIS</span></h2>
        </header>

        <div class="categories-showcase-grid">
          <a href="#" class="category-showcase-card">
            <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80" alt="Capacetes">
            <div class="category-showcase-overlay"></div>
            <h3 class="category-showcase-title">CAPACETES</h3>
          </a>

          <a href="#" class="category-showcase-card">
            <img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?auto=format&fit=crop&w=600&q=80" alt="Equipamentos">
            <div class="category-showcase-overlay"></div>
            <h3 class="category-showcase-title">EQUIPAMENTOS</h3>
          </a>

          <a href="#" class="category-showcase-card">
            <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=600&q=80" alt="Peças">
            <div class="category-showcase-overlay"></div>
            <h3 class="category-showcase-title">PEÇAS</h3>
          </a>

          <a href="#" class="category-showcase-card">
            <img src="https://images.unsplash.com/photo-1578844251758-2f71da64c96f?auto=format&fit=crop&w=600&q=80" alt="Pneus">
            <div class="category-showcase-overlay"></div>
            <h3 class="category-showcase-title">PNEUS</h3>
          </a>

          <a href="#" class="category-showcase-card">
            <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=600&q=80" alt="Ferramentas">
            <div class="category-showcase-overlay"></div>
            <h3 class="category-showcase-title">FERRAMENTAS</h3>
          </a>
        </div>
      </div>
    </section>

    <!-- ================= 5. OFERTAS EM DESTAQUE ================= -->
    <section id="ofertas" class="section-offers">
      <div class="container">
        <header class="section-header">
          <h2 class="section-title">OFERTAS <span>EM DESTAQUE</span></h2>
          <a href="#" class="link-view-all">VER TODAS &rarr;</a>
        </header>

        <div class="products-grid">
          @if(isset($products) && $products->count() > 0)
            {{-- Quando você passar $products pelo Controller, ele listará do banco automaticamente --}}
            @foreach($products->take(4) as $p)
              <article class="product-card">
                <div class="product-thumb">
                  <img src="{{ $p->image_url ?? 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $p->name }}">
                  <span class="badge-tag">OFERTA</span>
                  <span class="badge-discount">-15%</span>
                </div>
                <div class="product-info">
                  <span class="product-cat-label">{{ $p->Category?->name ?? 'Acessórios' }}</span>
                  <h3 class="product-title">{{ $p->name }}</h3>
                  <div class="product-pricing">
                    <span class="price-current">R$ {{ number_format((float) $p->price, 0, ',', '.') }}</span>
                    <span class="price-old">R$ {{ number_format((float) $p->price * 1.18, 0, ',', '.') }}</span>
                  </div>
                  <button type="button" class="btn-add-cart">ADICIONAR</button>
                </div>
              </article>
            @endforeach
          @else
            {{-- Visual idêntico ao protótipo enquanto não houver produtos vinculados na rota --}}
            <!-- Card 1 -->
            <article class="product-card">
              <div class="product-thumb">
                <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=600&q=80" alt="Capacete Arai RX-7V">
                <span class="badge-tag">OFERTA</span>
                <span class="badge-discount">-17%</span>
              </div>
              <div class="product-info">
                <span class="product-cat-label">Capacetes</span>
                <h3 class="product-title">Capacete Arai RX-7V</h3>
                <div class="product-pricing">
                  <span class="price-current">R$ 2.890</span>
                  <span class="price-old">R$ 3.490</span>
                </div>
                <button type="button" class="btn-add-cart">ADICIONAR</button>
              </div>
            </article>

            <!-- Card 2 -->
            <article class="product-card">
              <div class="product-thumb">
                <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=600&q=80" alt="Jaqueta Alpinestars T-GP Plus">
                <span class="badge-tag">MAIS VENDIDO</span>
                <span class="badge-discount">-19%</span>
              </div>
              <div class="product-info">
                <span class="product-cat-label">Equipamentos</span>
                <h3 class="product-title">Jaqueta Alpinestars T-GP Plus</h3>
                <div class="product-pricing">
                  <span class="price-current">R$ 1.290</span>
                  <span class="price-old">R$ 1.590</span>
                </div>
                <button type="button" class="btn-add-cart">ADICIONAR</button>
              </div>
            </article>

            <!-- Card 3 -->
            <article class="product-card">
              <div class="product-thumb">
                <img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?auto=format&fit=crop&w=600&q=80" alt="Luvas Dainese Full Metal 7">
                <span class="badge-tag">OFERTA</span>
                <span class="badge-discount">-21%</span>
              </div>
              <div class="product-info">
                <span class="product-cat-label">Equipamentos</span>
                <h3 class="product-title">Luvas Dainese Full Metal 7</h3>
                <div class="product-pricing">
                  <span class="price-current">R$ 489</span>
                  <span class="price-old">R$ 620</span>
                </div>
                <button type="button" class="btn-add-cart">ADICIONAR</button>
              </div>
            </article>

            <!-- Card 4 -->
            <article class="product-card">
              <div class="product-thumb">
                <img src="https://images.unsplash.com/photo-1578844251758-2f71da64c96f?auto=format&fit=crop&w=600&q=80" alt="Pneu Michelin Pilot Road 5">
                <span class="badge-discount">-17%</span>
              </div>
              <div class="product-info">
                <span class="product-cat-label">Pneus</span>
                <h3 class="product-title">Pneu Michelin Pilot Road 5</h3>
                <div class="product-pricing">
                  <span class="price-current">R$ 740</span>
                  <span class="price-old">R$ 890</span>
                </div>
                <button type="button" class="btn-add-cart">ADICIONAR</button>
              </div>
            </article>
          @endif
        </div>
      </div>
    </section>

    <!-- ================= 6. FAIXA DE BENEFÍCIOS ================= -->
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

  <!-- ================= 7. RODAPÉ (FOOTER) ================= -->
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