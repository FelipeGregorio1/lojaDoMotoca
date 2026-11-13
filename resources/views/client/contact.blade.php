<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fale Conosco - Loja do Motoca</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

    <!-- ================= 1. CABEÇALHO / NAVBAR ================= -->
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

        @php
          $cartCount = auth()->check() ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : 0;
        @endphp

        <a href="{{ route('cart.index') }}" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
            @endif
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

    <!-- ================= 2. SUB-MENU DE CATEGORIAS ================= -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-nav-list">
          @forelse($categories as $c)
            <li>
              <a href="{{ route('client.category', $c->id) }}" class="category-nav-link">
                {{ $c->name }}
              </a>
            </li>
          @empty
            <li><span class="category-nav-link">Nenhuma categoria cadastrada</span></li>
          @endforelse
        </ul>
      </div>
    </nav>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="contact-page">

    <!-- HERO CABEÇALHO -->
    <section class="contact-hero">
      <div class="container">

        <h1 class="hero-title">
          FALE <span>CONOSCO</span>
        </h1>

        <p class="hero-subtitle">
          Nossa equipe de especialistas está pronta para te ajudar. Escolha o canal mais conveniente ou envie uma mensagem diretamente.
        </p>
      </div>
    </section>

    <!-- CANAIS DE ATENDIMENTO -->
    <section class="contact-container" aria-label="Canais de atendimento">
      <address class="contact-grid">

        <!-- CARD WHATSAPP -->
        <article class="contact-card">
          <span class="contact-icon" aria-hidden="true">💬</span>
          <h2 class="contact-label">WHATSAPP</h2>
          <strong class="contact-value">(11) 99000-1234</strong>
          <p class="contact-meta">Seg–Sex, 8h–20h · Sáb, 9h–17h</p>
          <a href="https://wa.me/5511990001234" target="_blank" rel="noopener noreferrer" class="btn-channel">
            Abrir WhatsApp <span aria-hidden="true">→</span>
          </a>
        </article>

        <!-- CARD E-MAIL -->
        <article class="contact-card">
          <span class="contact-icon" aria-hidden="true">📩</span>
          <h2 class="contact-label">E-MAIL</h2>
          <strong class="contact-value">ctt@lojadomotoca.com</strong>
          <p class="contact-meta">Resposta em até 24h úteis</p>
          <a href="mailto:contato@lojadomotoca.com" class="btn-channel">
            Enviar e-mail <span aria-hidden="true">→</span>
          </a>
        </article>

        <!-- CARD TELEFONE -->
        <article class="contact-card">
          <span class="contact-icon" aria-hidden="true">📞</span>
          <h2 class="contact-label">TELEFONE</h2>
          <strong class="contact-value">0800 123 4567</strong>
          <p class="contact-meta">Gratuito · Seg–Sex, 8h–18h</p>
          <a href="tel:08001234567" class="btn-channel">
            Ligar agora <span aria-hidden="true">→</span>
          </a>
        </article>

        <!-- CARD ENDEREÇO -->
        <article class="contact-card">
          <span class="contact-icon" aria-hidden="true">📍</span>
          <h2 class="contact-label">ENDEREÇO</h2>
          <strong class="contact-value">Av. das Motocicletas, 2048</strong>
          <p class="contact-meta">Interlagos · São Paulo – SP</p>
          <a href="https://maps.google.com/?q=Interlagos,Sao+Paulo" target="_blank" rel="noopener noreferrer" class="btn-channel">
            Ver no mapa <span aria-hidden="true">→</span>
          </a>
        </article>

      </address>
    </section>

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