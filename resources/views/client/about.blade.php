<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre Nós - Loja do Motoca</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>

  <!-- NAVBAR PRINCIPAL -->
  <header class="navbar">
    <div class="container navbar-content">
      
      <a href="{{ route('client.home') }}" class="navbar-logo" aria-label="Página Inicial Loja do Motoca">
        <img class="logo-img" src="{{ asset('img/logoLDM.png') }}" alt="Loja do Motoca">
      </a>

      <form class="search-form" action="{{ route('client.home') }}" method="GET">
        <div class="search-wrapper">
          <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="search" name="q" value="{{ request('q') }}" class="search-input" placeholder="Buscar produtos..." aria-label="Buscar produtos">
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

        @auth
          @if(auth()->user()->is_admin)
            <a href="{{ route('product.index') }}" class="action-item action-admin">
              <div class="action-icon-box">
                <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="3" width="7" height="7"></rect>
                  <rect x="14" y="3" width="7" height="7"></rect>
                  <rect x="14" y="14" width="7" height="7"></rect>
                  <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
              </div>
              <span>Admin</span>
            </a>
          @endif
        @endauth

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

    <!-- BARRA DE CATEGORIAS -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-list">
          <li><a href="#">CAPACETES</a></li>
          <li><a href="#">EQUIPAMENTOS</a></li>
          <li><a href="#">PEÇAS</a></li>
          <li><a href="#">PNEUS</a></li>
          <li><a href="#">ÓLEOS</a></li>
          <li><a href="#">FERRAMENTAS</a></li>
          <li><a href="#">OFERTAS</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="about-page">
    
    <!-- HERO BANNER -->
    <section class="about-hero">
      <div class="container hero-content">
        <nav aria-label="Breadcrumb" class="breadcrumb">
          <ol>
            <li><a href="{{ route('client.home') }}">Início</a></li>
            <li aria-current="page">Sobre nós</li>
          </ol>
        </nav>

        <h1 class="hero-title">
          SOBRE A<br>
          <span>LOJA DO MOTOCA</span>
        </h1>

        <p class="hero-subtitle">
          Desde 2012 equipando motociclistas com o melhor do mercado — de capacetes premium a peças de performance.
        </p>
      </div>
    </section>

    <!-- CONTAINER CENTRAL DO CONTEÚDO -->
    <div class="about-container">

      <!-- MÉTRICAS / ESTATÍSTICAS -->
      <section class="stats-section" aria-label="Nossos números">
        <ul class="stats-grid">
          <li class="stat-card">
            <strong class="stat-value">2026</strong>
            <span class="stat-label">Fundada em</span>
          </li>
          <li class="stat-card">
            <strong class="stat-value">4.000+</strong>
            <span class="stat-label">Produtos</span>
          </li>
          <li class="stat-card">
            <strong class="stat-value">80.000+</strong>
            <span class="stat-label">Clientes</span>
          </li>
          <li class="stat-card">
            <strong class="stat-value">4.8★</strong>
            <span class="stat-label">Avaliação média</span>
          </li>
        </ul>
      </section>

      <!-- NOSSA HISTÓRIA -->
      <section class="story-card" aria-labelledby="story-heading">
        <div class="story-content">
          <h2 id="story-heading" class="section-title">NOSSA HISTÓRIA</h2>
          <p>
            <strong>A Loja do Motoca</strong> nasceu em 2012 na garagem de Carlos Mendes — um mecânico apaixonado por motos que não encontrava os acessórios que precisava com facilidade e preço justo. O que começou como uma pequena revenda de capacetes em São Paulo cresceu para se tornar uma das maiores plataformas de acessórios para motociclistas do Brasil.
          </p>
          <p>
            Hoje, com mais de <strong>4.000 produtos catalogados</strong> e um time de especialistas motociclistas, oferecemos tudo: de capacetes das melhores marcas mundiais a peças de reposição, pneus de alta performance, óleos e ferramentas profissionais.
          </p>
          <p>
            Cada produto é selecionado com rigor técnico e testado por nossa equipe. Não vendemos o que não usaríamos nós mesmos.
          </p>
        </div>

        <figure class="story-image-wrapper">
          <img 
            src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=600&auto=format&fit=crop&q=80" 
            alt="Moto esportiva vermelha" 
            class="story-image"
          >
        </figure>
      </section>

      <!-- NOSSOS VALORES -->
      <section class="values-section" aria-labelledby="values-heading">
        <h2 id="values-heading" class="section-title">NOSSOS VALORES</h2>

        <div class="values-grid">
          <article class="value-card">
            <span class="value-icon" aria-hidden="true">🏍️</span>
            <div class="value-text">
              <h3>Paixão por motos</h3>
              <p>Somos motociclistas antes de sermos lojistas. Entendemos cada peça que vendemos.</p>
            </div>
          </article>

          <article class="value-card">
            <span class="value-icon" aria-hidden="true">✅</span>
            <div class="value-text">
              <h3>Qualidade garantida</h3>
              <p>Só trabalhamos com marcas homologadas. Cada produto passa por controle de qualidade.</p>
            </div>
          </article>

          <article class="value-card">
            <span class="value-icon" aria-hidden="true">🚀</span>
            <div class="value-text">
              <h3>Entrega expressa</h3>
              <p>Logística própria para São Paulo e parceria com os maiores transportadores do Brasil.</p>
            </div>
          </article>

          <article class="value-card">
            <span class="value-icon" aria-hidden="true">🤝</span>
            <div class="value-text">
              <h3>Suporte especializado</h3>
              <p>Nossa equipe é formada por mecânicos e entusiastas prontos para te ajudar.</p>
            </div>
          </article>
        </div>
      </section>

      <!-- BANNER CTA -->
      <section class="cta-banner" aria-labelledby="cta-heading">
        <h2 id="cta-heading" class="cta-title">PRONTO PARA EQUIPAR SUA MOTO?</h2>
        <p class="cta-subtitle">Mais de 4.000 produtos com entrega expressa e parcelamento em 12x sem juros.</p>
        <a href="{{ route('client.home') }}" class="btn-cta">VER CATÁLOGO</a>
      </section>

    </div>
  </main>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container footer-content">
      <div class="footer-brand">
        <span class="footer-copy">© 2026 Todos os direitos reservados.</span>
      </div>

      <nav aria-label="Links institucionais">
        <ul class="footer-links">
          <li><a href="{{ route('client.about') }}">Sobre nós</a></li>
          <li><a href="{{ route('client.privacy') }}">Política de privacidade</a></li>
          <li><a href="{{ route('client.terms') }}">Termos de uso</a></li>
          <li><a href="{{ route('client.contact') }}">Contato</a></li>
        </ul>
      </nav>
    </div>
  </footer>

</body>
</html>