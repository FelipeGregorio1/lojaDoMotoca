<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Carrinho - Loja do Motoca</title>

  <!-- Fonte Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS Principal + CSS do Carrinho -->
  <link rel="stylesheet" href="{{ asset('css/client.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

  @php
    // Calcula a quantidade total de itens e o valor subtotal
    $totalItems = $carts->sum('quantity');
    $subtotal = $carts->sum(fn($item) => $item->Product->price * $item->quantity);
  @endphp

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

  <!-- ================= CONTEÚDO PRINCIPAL DO CARRINHO ================= -->
  <main class="cart-main">
    <div class="container">

      <header class="cart-header">
        <h1 class="cart-title">
          CARRINHO <span>({{ $totalItems }} {{ $totalItems === 1 ? 'ITEM' : 'ITENS' }})</span>
        </h1>
      </header>

      @if($carts->count() > 0)
        <!-- Alerta de Frete Grátis -->
        @if($subtotal >= 299)
          <div class="free-shipping-alert" role="status">
            <span class="check-box-icon">✓</span>
            <strong>Parabéns! Você ganhou frete grátis!</strong>
          </div>
        @else
          <div class="free-shipping-alert pending" role="status">
            <span>🚚</span>
            <span>Faltam <strong>R$ {{ number_format(299 - $subtotal, 2, ',', '.') }}</strong> para você ganhar <strong>Frete Grátis</strong>!</span>
          </div>
        @endif

        <div class="cart-grid">
          
          <!-- COLUNA ESQUERDA: LISTA DE PRODUTOS -->
          <section class="cart-items-section" aria-label="Itens no carrinho">
            <div class="cart-items-list">
              @foreach($carts as $cart)
                <article class="cart-item-card">
                  
                  <a href="{{ route('client.product.show', $cart->Product->id) }}" class="cart-item-thumb">
                    <img src="{{ $cart->Product->image ? asset('storage/' . $cart->Product->image) : '' }}" alt="{{ $cart->Product->name }}">
                  </a>

                  <div class="cart-item-details">
                    <span class="cart-item-category">{{ $cart->Product->Category?->name ?? 'Equipamentos' }}</span>
                    <h2 class="cart-item-name">
                      <a href="{{ route('client.product.show', $cart->Product->id) }}">{{ $cart->Product->name }}</a>
                    </h2>

                    <div class="cart-item-actions-row">
                      <!-- Botões - e + -->
                      <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="cart-qty-control">
                        @csrf
                        <button type="submit" name="action" value="decrease" class="qty-btn">−</button>
                        <span class="qty-value">{{ $cart->quantity }}</span>
                        <button type="submit" name="action" value="increase" class="qty-btn">+</button>
                      </form>

                      <!-- Preço e Remover -->
                      <div class="cart-item-price-block">
                        <strong class="cart-item-price">
                          R$ {{ number_format($cart->Product->price * $cart->quantity, 2, ',', '.') }}
                        </strong>
                        <a href="{{ route('cart.destroy', $cart->id) }}" class="cart-remove-link">Remover</a>
                      </div>
                    </div>
                  </div>

                </article>
              @endforeach
            </div>

            <a href="{{ route('client.home') }}" class="continue-shopping-link">
              ← CONTINUAR COMPRANDO
            </a>
          </section>

          <!-- COLUNA DIREITA: RESUMO DO PEDIDO -->
          <aside class="cart-summary-card" aria-label="Resumo do pedido">
            <h2 class="summary-title">RESUMO DO PEDIDO</h2>

            <div class="summary-rows">
              <div class="summary-line">
                <span>Subtotal ({{ $totalItems }} {{ $totalItems === 1 ? 'item' : 'itens' }})</span>
                <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong>
              </div>
              <div class="summary-line">
                <span>Frete</span>
                @if($subtotal >= 299)
                  <strong class="shipping-free">GRÁTIS</strong>
                @else
                  <strong>R$ 29,90</strong>
                @endif
              </div>
            </div>

            @php
              $finalTotal = $subtotal >= 299 ? $subtotal : $subtotal + 29.90;
            @endphp

            <div class="summary-total-block">
              <div class="summary-total-line">
                <span>Total</span>
                <strong class="total-value">R$ {{ number_format($finalTotal, 2, ',', '.') }}</strong>
              </div>
              <span class="installment-note">
                12x de R$ {{ number_format($finalTotal / 12, 2, ',', '.') }}
              </span>
            </div>

            <form action="{{ route('cart.checkout') }}" method="POST">
              @csrf
              <button type="submit" class="btn-checkout">
                FINALIZAR COMPRA
              </button>
            </form>

            <div class="secure-checkout-info">
              <p class="secure-text">🔒 Compra 100% segura</p>
              <div class="payment-badges">
                <span class="pay-badge">Visa</span>
                <span class="pay-badge">Master</span>
                <span class="pay-badge">Pix</span>
                <span class="pay-badge">Boleto</span>
              </div>
            </div>
          </aside>

        </div>
      @else
        <section class="empty-cart-box">
          <h2>Seu carrinho está vazio</h2>
          <p>Explore nosso catálogo e adicione equipamentos e peças para a sua moto.</p>
          <a href="{{ route('client.home') }}" class="btn-checkout" style="max-width: 260px; margin: 20px auto 0; text-decoration: none;">
            EXPLORAR PRODUTOS
          </a>
        </section>
      @endif

    </div>
  </main>

  <!-- ================= RODAPÉ (FOOTER) ================= -->
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