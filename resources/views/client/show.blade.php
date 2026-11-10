<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->name }} - Loja do Motoca</title>
  <!-- Importe aqui o mesmo arquivo CSS que você usa na Home -->
  <link rel="stylesheet" href="{{ asset('css/client.css') }}">
  <link rel="stylesheet" href="{{ asset('css/productShow.css') }}">
</head>
<body>

  <!-- SUA NAVBAR AQUI (Use asset() na imagem da logo para não quebrar em sub-rotas) -->
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

  <!-- ================= CONTEÚDO DA PÁGINA DO PRODUTO ================= -->
  <main class="product-page-wrapper">
    <div class="container">

      <!-- BLOCO 1: CARD PRINCIPAL (GALERIA + COMPRA) -->
      <section class="product-main-card">
        
        <!-- Coluna Esquerda: Galeria de Imagens -->
        <div class="product-gallery">
          <div class="main-image-box">
            
            @php
              // Ajuste o caminho da imagem conforme você salva no banco (ex: storage/ ou img/)
              $imgUrl = $product->image ? asset('storage/' . $product->image) : asset('img/placeholder.jpg');
            @endphp
            
            <img id="mainProductImage" src="{{ $imgUrl }}" alt="{{ $product->name }}">
          </div>
        </div>

        <!-- Coluna Direita: Informações de Compra -->
        <div class="product-details">
          <span class="product-category-tag">
            {{ $product->category->name ?? 'EQUIPAMENTOS' }}
          </span>

          <h1 class="product-title">{{ $product->name }}</h1>

          <div class="product-rating-row">
            <div class="stars">★★★★★</div>
            <span class="rating-count">4.9 (128 avaliações)</span>
            <span class="divider">|</span>
            <span class="product-sku">Cód. C{{ $product->id }}-MOT</span>
          </div>

          <div class="product-price-box">
            @php
              $oldPrice = $product->price * 1.20; // Simula o preço antigo (+20%) caso não tenha no banco
              $installment = $product->price / 12;
            @endphp
            <div class="price-Line">
              <span class="current-price">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
            </div>
            <p class="installments-text">
              ou 12x de <strong>R$ {{ number_format($installment, 2, ',', '.') }}</strong> sem juros
            </p>
          </div>

          <div class="stock-badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Em estoque e pronto para envio</span>
          </div>

          <hr class="section-divider">

          <!-- Ações de Compra (Quantidade + Botão) -->
          <form action="#" method="POST" class="purchase-actions">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="size" id="selectedSizeInput" value="">

            <div class="actions-row">
              <div class="qty-selector">
                <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                <input type="number" name="quantity" id="qtyInput" value="1" min="1" readonly>
                <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
              </div>

              <button type="submit" id="addToCartBtn" class="btn-add-cart">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="9" cy="21" r="1"></circle>
                  <circle cx="20" cy="21" r="1"></circle>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>ADICIONAR AO CARRINHO</span>
              </button>
            </div>
          </form>

          <!-- Benefícios -->
          <div class="trust-features">
            <div class="trust-item">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#e11d48" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
              </svg>
              <strong>Envio rápido</strong>
              <span>Em até 24h</span>
            </div>
            <div class="trust-item">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#e11d48" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 4 23 10 17 10"></polyline>
                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
              </svg>
              <strong>Troca fácil</strong>
              <span>Até 30 dias</span>
            </div>
            <div class="trust-item">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#e11d48" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <polyline points="9 12 11 14 15 10"></polyline>
              </svg>
              <strong>Compra segura</strong>
              <span>Site protegido</span>
            </div>
          </div>

        </div>
      </section>

      <!-- BLOCO 2: SOBRE O PRODUTO E FICHA TÉCNICA -->
      <section class="product-bottom-grid">
        
        <!-- Card Branco: Sobre o Produto -->
        <div class="about-product-card">
          <span class="section-subtitle-red">SOBRE O PRODUTO</span>
          <h2 class="about-title">Desempenho e segurança para sua pilotagem</h2>
          
          <p class="about-description">
            {{ $product->description ?? "O {$product->name} foi desenvolvido para motociclistas que exigem qualidade, conforto e confiança em cada trajeto. Construído com materiais selecionados e acabamento de alto padrão, entrega excelente desempenho tanto no uso urbano quanto em viagens." }}
          </p>

          <div class="highlights-grid">
            <div class="highlight-item">
              <span class="check-circle">✓</span>
              <strong>Materiais de alta resistência</strong>
            </div>
            <div class="highlight-item">
              <span class="check-circle">✓</span>
              <strong>Acabamento premium</strong>
            </div>
            <div class="highlight-item">
              <span class="check-circle">✓</span>
              <strong>Produto original e homologado</strong>
            </div>
            <div class="highlight-item">
              <span class="check-circle">✓</span>
              <strong>Garantia de 12 meses</strong>
            </div>
          </div>
        </div>

        <!-- Card Preto: Ficha Técnica -->
        <div class="tech-specs-card">
          <span class="section-subtitle-red">FICHA TÉCNICA</span>

          <ul class="specs-list">
            <li>
              <span class="spec-label">Marca</span>
              <strong class="spec-value">{{ $product->brand ?? 'LDM' }}</strong>
            </li>
            <li>
              <span class="spec-label">Categoria</span>
              <strong class="spec-value">{{ $product->Category?->name ?? 'Acessórios' }}</strong>
            </li>
            <li>
              <span class="spec-label">Garantia</span>
              <strong class="spec-value">12 meses</strong>
            </li>
            <li>
              <span class="spec-label">Disponibilidade</span>
              <strong class="spec-value">Pronta entrega</strong>
            </li>
            <li>
              <span class="spec-label">Origem</span>
              <strong class="spec-value">Produto original</strong>
            </li>
          </ul>
        </div>

      </section>

    </div>
  </main>
  <footer class="site-footer">
    <div class="container footer-content">
      <div class="footer-brand">
        <span class="footer-copy">&copy; 2026 Todos os direitos reservados.</span>
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

  <!-- Script para seleção de tamanho, quantidade e troca de imagem -->
  <script>
    function selectSize(button, size) {
      document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      
      document.getElementById('selectedSizeInput').value = size;
      
      const cartBtn = document.getElementById('addToCartBtn');
      cartBtn.disabled = false;
      cartBtn.classList.add('enabled');
      
      document.getElementById('sizeHelperText').style.visibility = 'hidden';
    }

    function changeQty(amount) {
      const input = document.getElementById('qtyInput');
      let current = parseInt(input.value) || 1;
      if (current + amount >= 1) {
        input.value = current + amount;
      }
    }

    function changeImage(src, thumbButton) {
      document.getElementById('mainProductImage').src = src;
      document.querySelectorAll('.thumb-item').forEach(btn => btn.classList.remove('active'));
      thumbButton.classList.add('active');
    }
  </script>
</body>
</html>