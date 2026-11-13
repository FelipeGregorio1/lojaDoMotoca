<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra - Loja do Motoca</title>

  <!-- Fonte Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS Principal + CSS do Checkout -->
  <link rel="stylesheet" href="{{ asset('css/client.css') }}">
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

  @php
    $totalItems = $carts->sum('quantity');
    $subtotal = $carts->sum(fn($item) => $item->Product->price * $item->quantity);
    $shipping = $subtotal >= 299 ? 0 : 29.90;
    $finalTotal = $subtotal + $shipping;
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
        @php
          $favNavbarCount = auth()->check() ? \App\Models\Favorite::where('user_id', auth()->id())->count() : 0;
        @endphp

        <a href="{{ auth()->check() ? route('profile.edit', ['tab' => 'favoritos']) : route('login') }}" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            @if($favNavbarCount > 0)
              <span class="cart-badge">{{ $favNavbarCount }}</span>
            @endif
          </div>
          <span>Favoritos</span>
        </a>

        <a href="{{ route('cart.index') }}" class="action-item">
          <div class="action-icon-box">
            <svg class="action-icon" viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="cart-badge">{{ $totalItems }}</span>
          </div>
          <span>Carrinho</span>
        </a>

        <a href="{{ route('profile.edit') }}" class="action-item">
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
            <a href="{{ route('admin.dashboard') }}" class="action-item action-admin">
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

        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
          @csrf
          <button type="submit" class="btn-login">SAIR</button>
        </form>
      </nav>
    </div>

    <!-- SUB-MENU DE CATEGORIAS -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-nav-list">
          @forelse($categories as $c)
            <li>
              <a href="{{ route('client.category', $c->id) }}" class="category-nav-link">{{ $c->name }}</a>
            </li>
          @empty
            <li><span class="category-nav-link">Nenhuma categoria cadastrada</span></li>
          @endforelse
        </ul>
      </div>
    </nav>
  </header>

  <!-- ================= CONTEÚDO PRINCIPAL DO CHECKOUT ================= -->
  <main class="checkout-main">
    <div class="container">

      <header class="checkout-page-header">
        <a href="{{ route('cart.index') }}" class="back-to-cart">← Voltar para o carrinho</a>
        <h1 class="checkout-title">FINALIZAR <span>COMPRA</span></h1>
      </header>

      <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST" class="checkout-grid">
        @csrf
        <input type="hidden" name="payment_method" id="paymentMethodInput" value="credit_card">

        <!-- COLUNA ESQUERDA: ENDEREÇO + PAGAMENTO -->
        <div class="checkout-steps">

          <!-- BLOCO 1: ENDEREÇO DE ENTREGA -->
          <section class="checkout-card" aria-labelledby="address-heading">
            <header class="checkout-card-header">
              <span class="step-number">1</span>
              <div>
                <h2 id="address-heading" class="checkout-card-title">ENDEREÇO DE ENTREGA</h2>
                <p class="checkout-card-subtitle">Onde devemos entregar os seus equipamentos</p>
              </div>
            </header>

            <div class="checkout-form-grid">
              <div class="form-group">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" id="cep" name="cep" class="form-control" placeholder="00000-000" value="{{ $user->cep ?? '' }}" required>
              </div>

              <div class="form-group">
                <label for="street" class="form-label">Rua / Avenida</label>
                <input type="text" id="street" name="street" class="form-control" placeholder="Ex: Av. Interlagos" value="{{ $user->street ?? '' }}" required>
              </div>

              <div class="form-group">
                <label for="number" class="form-label">Número</label>
                <input type="text" id="number" name="number" class="form-control" placeholder="Ex: 1250" value="{{ $user->number ?? '' }}" required>
              </div>

              <div class="form-group">
                <label for="complement" class="form-label">Complemento (Opcional)</label>
                <input type="text" id="complement" name="complement" class="form-control" placeholder="Apto, Bloco, Casa..." value="{{ $user->complement ?? '' }}">
              </div>

              <div class="form-group">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" id="neighborhood" name="neighborhood" class="form-control" placeholder="Seu bairro" value="{{ $user->neighborhood ?? '' }}" required>
              </div>

              <div class="form-group-row">
                <div class="form-group" style="flex: 2;">
                  <label for="city" class="form-label">Cidade</label>
                  <input type="text" id="city" name="city" class="form-control" placeholder="São Paulo" value="{{ $user->city ?? '' }}" required>
                </div>

                <div class="form-group" style="flex: 1;">
                  <label for="state" class="form-label">UF</label>
                  <input type="text" id="state" name="state" class="form-control" placeholder="SP" maxlength="2" value="{{ $user->state ?? '' }}" required>
                </div>
              </div>
            </div>
          </section>

          <!-- BLOCO 2: FORMA DE PAGAMENTO -->
          <section class="checkout-card" aria-labelledby="payment-heading">
            <header class="checkout-card-header">
              <span class="step-number">2</span>
              <div>
                <h2 id="payment-heading" class="checkout-card-title">FORMA DE PAGAMENTO</h2>
                <p class="checkout-card-subtitle">Escolha entre Cartão de Crédito ou PIX com aprovação imediata</p>
              </div>
            </header>

            <!-- Abas de seleção (Cartão ou PIX) -->
            <div class="payment-tabs">
              <button type="button" class="payment-tab-btn active" onclick="selectPayment('credit_card', this)">
                <span>💳</span>
                <strong>Cartão de Crédito</strong>
              </button>

              <button type="button" class="payment-tab-btn" onclick="selectPayment('pix', this)">
                <span>💠</span>
                <strong>PIX (Instantâneo)</strong>
              </button>
            </div>

            <!-- Opção A: Formulário de Cartão de Crédito -->
            <div id="box-credit_card" class="payment-method-box active">
              <div class="checkout-form-grid">
                <div class="form-group full-width">
                  <label for="card_number" class="form-label">Número do Cartão</label>
                  <input type="text" id="card_number" class="form-control card-input" placeholder="0000 0000 0000 0000" maxlength="19" required>
                </div>

                <div class="form-group full-width">
                  <label for="card_holder" class="form-label">Nome impresso no cartão</label>
                  <input type="text" id="card_holder" class="form-control card-input" placeholder="COMO ESTÁ NO CARTÃO" required>
                </div>

                <div class="form-group">
                  <label for="card_expiry" class="form-label">Validade</label>
                  <input type="text" id="card_expiry" class="form-control card-input" placeholder="MM/AA" maxlength="5" required>
                </div>

                <div class="form-group">
                  <label for="card_cvv" class="form-label">CVV</label>
                  <input type="text" id="card_cvv" class="form-control card-input" placeholder="123" maxlength="4" required>
                </div>

                <div class="form-group full-width">
                  <label for="installments" class="form-label">Parcelamento</label>
                  <select id="installments" class="form-control">
                    @for($i = 1; $i <= 12; $i++)
                      <option value="{{ $i }}">
                        {{ $i }}x de R$ {{ number_format($finalTotal / $i, 2, ',', '.') }} sem juros
                      </option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>

            <!-- Opção B: Área do PIX -->
            <div id="box-pix" class="payment-method-box">
              <div class="pix-container">
                <div class="pix-qr-placeholder" aria-hidden="true">
                  <!-- QR Code -->
                  <img src="../img/QRCodePIX.png" alt="QR code" width="130" height="130">
                </div>

                <div class="pix-instructions">
                  <strong>Escaneie o QR Code ou copie a chave abaixo</strong>
                  <p>O pagamento via PIX é aprovado em poucos segundos e libera o envio imediatamente.</p>

                  <div class="pix-copy-row">
                    <input type="text" id="pixCodeInput" class="form-control" value="00020126580014BR.GOV.BCB.PIX0136lojadomotoca-pagamentos-2026520400005303986" readonly>
                    <button type="button" class="btn-copy-pix" onclick="copyPixCode()">COPIAR</button>
                  </div>
                </div>
              </div>
            </div>

          </section>

        </div>

        <!-- COLUNA DIREITA: RESUMO DA COMPRA -->
        <aside class="checkout-summary-card" aria-label="Resumo da compra">
          <h2 class="summary-title">RESUMO DA COMPRA</h2>

          <ul class="summary-items-mini">
            @foreach($carts as $cart)
              <li class="summary-mini-item">
                <span class="mini-item-name">{{ $cart->quantity }}x {{ $cart->Product->name }}</span>
                <strong>R$ {{ number_format($cart->Product->price * $cart->quantity, 2, ',', '.') }}</strong>
              </li>
            @endforeach
          </ul>

          <div class="summary-rows">
            <div class="summary-line">
              <span>Subtotal ({{ $totalItems }} {{ $totalItems === 1 ? 'item' : 'itens' }})</span>
              <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong>
            </div>
            <div class="summary-line">
              <span>Frete</span>
              @if($shipping === 0)
                <strong class="shipping-free">GRÁTIS</strong>
              @else
                <strong>R$ 29,90</strong>
              @endif
            </div>
          </div>

          <div class="summary-total-block">
            <div class="summary-total-line">
              <span>Total a pagar</span>
              <strong class="total-value">R$ {{ number_format($finalTotal, 2, ',', '.') }}</strong>
            </div>
          </div>

          <button type="submit" class="btn-confirm-pay">
            CONFIRMAR PAGAMENTO
          </button>

        </aside>

      </form>

    </div>
  </main>

  <!-- ================= MODAL DE LOADING / PROCESSAMENTO ================= -->
  <div id="paymentLoadingOverlay" class="loading-overlay" aria-hidden="true">
    <div class="loading-modal">
      <div id="loadingSpinner" class="spinner"></div>
      <div id="loadingSuccessIcon" class="success-check" style="display: none;">✓</div>
      
      <h3 id="loadingTitle" class="loading-title">Processando pagamento...</h3>
      <p id="loadingSubtitle" class="loading-subtitle">Validando os dados da sua compra com segurança.</p>
    </div>
  </div>

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

  <!-- ================= SCRIPTS DE PAGAMENTO, MÁSCARAS E LOADING ================= -->
  <script>
    // 1. Alternar entre Cartão de Crédito e PIX
    function selectPayment(method, btnElement) {
      document.getElementById('paymentMethodInput').value = method;

      document.querySelectorAll('.payment-tab-btn').forEach(btn => btn.classList.remove('active'));
      btnElement.classList.add('active');

      document.querySelectorAll('.payment-method-box').forEach(box => box.classList.remove('active'));
      document.getElementById('box-' + method).classList.add('active');

      // Se escolher PIX, tira a obrigatoriedade dos inputs de cartão para o form enviar normalmente
      const cardInputs = document.querySelectorAll('.card-input');
      cardInputs.forEach(input => {
        if (method === 'pix') {
          input.removeAttribute('required');
        } else {
          input.setAttribute('required', 'required');
        }
      });
    }

    // 2. Copiar código PIX
    function copyPixCode() {
      const pixInput = document.getElementById('pixCodeInput');
      navigator.clipboard.writeText(pixInput.value);
      const btn = document.querySelector('.btn-copy-pix');
      btn.textContent = 'COPIADO!';
      setTimeout(() => btn.textContent = 'COPIAR', 2000);
    }

    // 3. Máscaras simples para CEP, Cartão e Validade
    document.getElementById('cep').addEventListener('input', function(e) {
      let v = e.target.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
      e.target.value = v;
    });

    document.getElementById('card_number').addEventListener('input', function(e) {
      let v = e.target.value.replace(/\D/g, '').slice(0, 16);
      e.target.value = v.replace(/(\d{4})(?=\d)/g, '$1 ');
    });

    document.getElementById('card_expiry').addEventListener('input', function(e) {
      let v = e.target.value.replace(/\D/g, '').slice(0, 4);
      if (v.length > 2) v = v.slice(0, 2) + '/' + v.slice(2);
      e.target.value = v;
    });

    // 4. Efeito de Loading e Aprovação ao enviar o formulário
    const checkoutForm = document.getElementById('checkoutForm');
    let isSubmitting = false;

    checkoutForm.addEventListener('submit', function(e) {
      if (isSubmitting) return;
      e.preventDefault();
      isSubmitting = true;

      const overlay = document.getElementById('paymentLoadingOverlay');
      const spinner = document.getElementById('loadingSpinner');
      const successIcon = document.getElementById('loadingSuccessIcon');
      const title = document.getElementById('loadingTitle');
      const subtitle = document.getElementById('loadingSubtitle');

      overlay.classList.add('active');

      // Após 1.8s girando, mostra "Pagamento Aprovado!"
      setTimeout(() => {
        spinner.style.display = 'none';
        successIcon.style.display = 'flex';
        title.textContent = 'Pagamento aprovado!';
        subtitle.textContent = 'Seu pedido está em preparação. Redirecionando...';
      }, 1800);

      // Após 3s no total, envia de fato para o Laravel criar o pedido e baixar o estoque
      setTimeout(() => {
        checkoutForm.submit();
      }, 3000);
    });
  </script>

</body>
</html>