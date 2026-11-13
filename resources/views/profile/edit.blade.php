<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minha Conta - Loja do Motoca</title>

  <!-- Fonte Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS Principal da Loja + CSS do Perfil -->
  <link rel="stylesheet" href="{{ asset('css/client.css') }}">
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

  @php
    // Recupera o usuário autenticado do Laravel Breeze (ou usa fallback visual caso teste sem login)
    $currentUser = $user ?? auth()->user();
    $fullName = $currentUser?->name ?? 'Nome Sobrenome';
    $email = $currentUser?->email ?? 'email@email.com';
    $phone = $currentUser?->phone ?? '(xx) x xxxx-xxxx';

    // Divide o nome completo em Nome e Sobrenome
    $firstName = $currentUser?->name ?? 'Cliente';
    $lastName  = $currentUser?->last_name ?? '';
    $displayName = trim($firstName . ' ' . $lastName);

    $firstInitial = mb_strtoupper(mb_substr($firstName, 0, 1)) ?: 'C';
    $lastInitial  = $lastName ? mb_strtoupper(mb_substr($lastName, 0, 1)) : '';
    $initials = $firstInitial . $lastInitial;

    // Garante que as categorias existam nesta tela para a navbar funcionar
    $categories = $categories ?? \App\Models\Category::all();
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
          $userOrders = \App\Models\Order::where('user_id', $currentUser?->id)->latest()->get();
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

  <!-- ================= CONTEÚDO PRINCIPAL ================= -->
  <main class="profile-main">
    <div class="container">

      <div class="account-grid">
        
        <!-- ================= COLUNA ESQUERDA: SIDEBAR ================= -->
        <aside class="account-sidebar" aria-label="Menu da conta">
          
          <!-- Card Superior: Avatar e Nome -->
          <div class="user-summary-card">
            <div class="user-avatar" id="avatarInitials" aria-hidden="true">
              {{ $initials ?: 'NS' }}
            </div>
            <h2 class="user-fullname" id="sidebarFullName">{{ $firstName }} {{ $lastName }}</h2>
            <p class="user-email" id="sidebarEmail">{{ $email }}</p>
          </div>

          <!-- Card Inferior: Menu de Opções -->
          <nav class="account-nav-card" aria-label="Seções da conta">
            <ul class="account-nav-list">
              <li class="account-nav-item">
                <button type="button" class="account-nav-btn active" data-target="tab-perfil">
                  <span class="nav-emoji" aria-hidden="true">👤</span>
                  <span>Meu Perfil</span>
                </button>
              </li>
              <li class="account-nav-item">
                <button type="button" class="account-nav-btn" data-target="tab-pedidos">
                  <span class="nav-emoji" aria-hidden="true">📦</span>
                  <span>Meus Pedidos</span>
                </button>
              </li>
              <li class="account-nav-item">
                <button type="button" class="account-nav-btn" data-target="tab-enderecos">
                  <span class="nav-emoji" aria-hidden="true">📍</span>
                  <span>Endereços</span>
                </button>
              </li>
              <li class="account-nav-item">
                <button type="button" class="account-nav-btn" data-target="tab-favoritos">
                  <span class="nav-emoji" aria-hidden="true">🖤</span>
                  <span>Favoritos</span>
                </button>
              </li>
              <li class="account-nav-item">
                <button type="button" class="account-nav-btn" data-target="tab-seguranca">
                  <span class="nav-emoji" aria-hidden="true">🔒</span>
                  <span>Segurança</span>
                </button>
              </li>
              <li class="account-nav-item">
                <!-- Logout integrado ao Laravel Breeze -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="account-nav-btn logout-btn">
                    <span class="nav-emoji" aria-hidden="true">🚪</span>
                    <span>Sair da conta</span>
                  </button>
                </form>
              </li>
            </ul>
          </nav>

        </aside>

        <!-- ================= COLUNA DIREITA: CONTEÚDO ================= -->
        <div class="profile-content-card">

          <!-- Mensagem de Sucesso do Breeze -->
          @if (session('status') === 'profile-updated')
            <div class="alert-success" role="status">
              Perfil atualizado com sucesso!
            </div>
          @elseif (session('status') === 'password-updated')
            <div class="alert-success" role="status">
              Senha atualizada com sucesso!
            </div>
          @endif

          <!-- ABA 1: MEU PERFIL -->
          <section id="tab-perfil" class="tab-section active" aria-labelledby="heading-perfil">
            <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
              @csrf
              @method('patch')

              <!-- Campo oculto 'name' que une Nome + Sobrenome para o ProfileUpdateRequest do Breeze -->
              <input type="hidden" name="name" id="combinedNameInput" value="{{ $fullName }}">

              <header class="content-header">
                <h1 class="content-title" id="heading-perfil">MEU PERFIL</h1>
                
                <div class="header-actions">
                  <button type="button" id="btnCancelEdit" class="btn-cancel-edit">
                    CANCELAR
                  </button>
                  <button type="button" id="btnEditSave" class="btn-action-red">
                    EDITAR
                  </button>
                </div>
              </header>

              <div class="profile-form-grid">
                <!-- Nome -->
                <div class="form-group">
                  <label for="first_name" class="form-label">Nome</label>
                  <input 
                    type="text" 
                    id="first_name" 
                    name="first_name" 
                    class="form-control profile-input" 
                    value="{{ old('first_name', $firstName) }}" 
                    placeholder="Nome"
                    readonly 
                    required
                  >
                  @error('name')
                    <span class="error-msg">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Sobrenome -->
                <div class="form-group">
                  <label for="last_name" class="form-label">Sobrenome</label>
                  <input 
                    type="text" 
                    id="last_name" 
                    name="last_name" 
                    class="form-control profile-editable" 
                    value="{{ old('last_name', $currentUser?->last_name) }}" 
                    placeholder="Sobrenome"
                    readonly
                  >
                </div>

                <!-- E-mail -->
                <div class="form-group">
                  <label for="email" class="form-label">E-mail</label>
                  <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control profile-input" 
                    value="{{ old('email', $email) }}" 
                    placeholder="email@email.com"
                    readonly 
                    required
                  >
                  @error('email')
                    <span class="error-msg">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Telefone -->
                <div class="form-group">
                  <label for="phone" class="form-label">Telefone</label>
                  <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    class="form-control profile-editable" 
                    value="{{ old('phone', $currentUser?->phone) }}"
                    placeholder="(xx) x xxxx-xxxx"
                    readonly
                  >
                </div>
              </div>
            </form>
          </section>

          <!-- ABA 2: MEUS PEDIDOS -->
          <section id="tab-pedidos" class="tab-section" aria-labelledby="heading-pedidos">
            <header class="content-header">
              <h2 class="content-title" id="heading-pedidos">MEUS PEDIDOS</h2>
            </header>

            @if($userOrders->count() > 0)
              <ul class="user-orders-list">
                @foreach($userOrders as $order)
                  @php
                    $orderCode = 45827 + $order->id;
                    $statusUpper = mb_strtoupper($order->status);

                    // Regra de cores: Verde só no ENTREGUE, Vermelho no CANCELADO, Laranja no resto
                    if ($statusUpper === 'ENTREGUE') {
                        $badgeClass = 'order-badge--green';
                    } elseif ($statusUpper === 'CANCELADO') {
                        $badgeClass = 'order-badge--red';
                    } else {
                        $badgeClass = 'order-badge--amber';
                    }
                  @endphp

                  <li class="user-order-card">
                    <div class="user-order-left">
                      <div class="user-order-icon" aria-hidden="true">📦</div>
                      <div class="user-order-info">
                        <strong class="user-order-number">Pedido #{{ $orderCode }}</strong>
                        <span class="user-order-date">
                          Realizado em {{ $order->created_at->format('d/m/Y \à\s H:i') }}
                        </span>
                      </div>
                    </div>

                    <div class="user-order-right">
                      <strong class="user-order-total">
                        R$ {{ number_format((float) $order->total, 2, ',', '.') }}
                      </strong>

                      <div class="user-order-actions">
                        <span class="user-order-badge {{ $badgeClass }}">
                          {{ $statusUpper }}
                        </span>

                        <!-- Botão Cancelar Compra (aparece se não estiver entregue nem cancelado) -->
                        @if(!in_array($statusUpper, ['ENTREGUE', 'CANCELADO']))
                          <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-cancel-order">
                              Cancelar compra
                            </button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            @else
              <p class="empty-tab-text">Você ainda não realizou nenhum pedido.</p>
            @endif
          </section>

          <!-- ABA 3: ENDEREÇOS -->
          <section id="tab-enderecos" class="tab-section" aria-labelledby="heading-enderecos">
            <header class="content-header">
              <h2 class="content-title" id="heading-enderecos">ENDEREÇOS</h2>
              <button type="button" id="btnEnableAddressEdit" class="btn-edit-red">
                {{ $currentUser?->cep ? 'EDITAR' : 'ADICIONAR' }}
              </button>
            </header>

            @if (session('status') === 'address-updated')
              <div class="alert-success" role="status">
                Endereço atualizado com sucesso! Ele será preenchido automaticamente nas suas compras.
              </div>
            @endif

            @if(!$currentUser?->cep)
              <p id="emptyAddressText" class="empty-tab-text" style="margin-bottom: 16px;">
                Nenhum endereço cadastrado até o momento. Clique em <strong>ADICIONAR</strong> acima para cadastrar.
              </p>
            @endif

            <form id="addressUpdateForm" method="POST" action="{{ route('profile.address.update') }}" style="{{ !$currentUser?->cep ? 'display: none;' : '' }}">
              @csrf
              @method('PATCH')

              <div class="profile-form-grid">
                <div class="form-group">
                  <label for="addr_cep" class="form-label">CEP</label>
                  <input type="text" id="addr_cep" name="cep" class="form-control address-editable" value="{{ old('cep', $currentUser?->cep) }}" placeholder="00000-000" readonly required>
                </div>

                <div class="form-group">
                  <label for="addr_street" class="form-label">Rua / Avenida</label>
                  <input type="text" id="addr_street" name="street" class="form-control address-editable" value="{{ old('street', $currentUser?->street) }}" placeholder="Ex: Av. Interlagos" readonly required>
                </div>

                <div class="form-group">
                  <label for="addr_number" class="form-label">Número</label>
                  <input type="text" id="addr_number" name="number" class="form-control address-editable" value="{{ old('number', $currentUser?->number) }}" placeholder="Ex: 1250" readonly required>
                </div>

                <div class="form-group">
                  <label for="addr_complement" class="form-label">Complemento (Opcional)</label>
                  <input type="text" id="addr_complement" name="complement" class="form-control address-editable" value="{{ old('complement', $currentUser?->complement) }}" placeholder="Apto, Bloco, Casa..." readonly>
                </div>

                <div class="form-group">
                  <label for="addr_neighborhood" class="form-label">Bairro</label>
                  <input type="text" id="addr_neighborhood" name="neighborhood" class="form-control address-editable" value="{{ old('neighborhood', $currentUser?->neighborhood) }}" placeholder="Seu bairro" readonly required>
                </div>

                <div class="form-group" style="display: grid; grid-template-columns: 2fr 1fr; gap: 12px;">
                  <div>
                    <label for="addr_city" class="form-label">Cidade</label>
                    <input type="text" id="addr_city" name="city" class="form-control address-editable" value="{{ old('city', $currentUser?->city) }}" placeholder="São Paulo" readonly required>
                  </div>
                  <div>
                    <label for="addr_state" class="form-label">UF</label>
                    <input type="text" id="addr_state" name="state" class="form-control address-editable" maxlength="2" value="{{ old('state', $currentUser?->state) }}" placeholder="SP" readonly required>
                  </div>
                </div>
              </div>

              <div id="addressEditActions" class="edit-actions-bar" hidden>
                <button type="button" id="btnCancelAddressEdit" class="btn-cancel-gray">CANCELAR</button>
                <button type="submit" class="btn-save-red">SALVAR ENDEREÇO</button>
              </div>
            </form>
          </section>

          <!-- ABA 4: FAVORITOS -->
          <section id="tab-favoritos" class="tab-section" aria-labelledby="heading-favoritos">
            <header class="content-header">
              <h2 class="content-title" id="heading-favoritos">FAVORITOS</h2>
            </header>

            @php
              $meusFavoritos = \App\Models\Favorite::where('user_id', auth()->id())->with('Product')->latest()->get();
            @endphp

            @if($meusFavoritos->count() > 0)
              <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px;">
                @foreach($meusFavoritos as $fav)
                  @if($fav->Product)
                    <article style="display: flex; align-items: center; gap: 14px; padding: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                      
                      <!-- Foto do Produto -->
                      <a href="{{ route('client.product.show', $fav->Product->id) }}" style="width: 76px; height: 76px; border-radius: 10px; overflow: hidden; background: #111827; flex-shrink: 0; display: block;">
                        <img src="{{ $fav->Product->image ? asset('storage/' . $fav->Product->image) : '' }}" alt="{{ $fav->Product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                      </a>

                      <!-- Dados e Botões -->
                      <div style="flex: 1; min-width: 0;">
                        <h3 style="font-size: 14px; font-weight: 800; color: #0f172a; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                          <a href="{{ route('client.product.show', $fav->Product->id) }}" style="color: inherit; text-decoration: none;">
                            {{ $fav->Product->name }}
                          </a>
                        </h3>

                        <strong style="display: block; font-size: 14px; font-weight: 900; color: #e60012; margin-bottom: 10px;">
                          R$ {{ number_format((float) $fav->Product->price, 2, ',', '.') }}
                        </strong>

                        <div style="display: flex; align-items: center; gap: 8px;">
                          <!-- Botão Adicionar ao Carrinho -->
                          <form action="{{ route('cart.store', $fav->Product->id) }}" method="POST" style="flex: 1;">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" style="width: 100%; background: #e60012; color: #fff; border: none; border-radius: 7px; padding: 7px 10px; font-size: 10.5px; font-weight: 800; cursor: pointer;">
                              + CARRINHO
                            </button>
                          </form>

                          <!-- Botão Remover dos Favoritos -->
                          <a href="{{ route('favorites.destroy', $fav->id) }}" title="Remover dos favoritos" style="width: 28px; height: 28px; border-radius: 7px; border: 1px solid #fecaca; background: #fef2f2; color: #dc2626; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 800; text-decoration: none;">
                            ✕
                          </a>
                        </div>
                      </div>

                    </article>
                  @endif
                @endforeach
              </div>
            @else
              <p class="empty-tab-text">Sua lista de produtos favoritos está vazia.</p>
            @endif
          </section>

          <!-- ABA 5: SEGURANÇA (Troca de senha integrada ao Breeze) -->
          <section id="tab-seguranca" class="tab-section" aria-labelledby="heading-seguranca">
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              @method('put')

              <header class="content-header">
                <h2 class="content-title" id="heading-seguranca">SEGURANÇA</h2>
                <button type="submit" class="btn-action-red">SALVAR SENHA</button>
              </header>

              <div class="profile-form-grid">
                <div class="form-group">
                  <label for="current_password" class="form-label">Senha Atual</label>
                  <input type="password" id="current_password" name="current_password" class="form-control" placeholder="••••••••" required>
                  @error('current_password', 'updatePassword')
                    <span class="error-msg">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="new_password" class="form-label">Nova Senha</label>
                  <input type="password" id="new_password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                  @error('password', 'updatePassword')
                    <span class="error-msg">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita a nova senha" required>
                </div>
              </div>
            </form>
          </section>

        </div>

      </div>
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

  <script>
    // ================= 1. ALTERNAR MODO VISUALIZAÇÃO / EDIÇÃO DO PERFIL =================
    const btnEditSave = document.getElementById('btnEditSave');
    const btnCancelEdit = document.getElementById('btnCancelEdit');
    const profileForm = document.getElementById('profileForm');
    const profileInputs = document.querySelectorAll('.profile-input');
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput = document.getElementById('last_name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const combinedNameInput = document.getElementById('combinedNameInput');

    let isEditing = false;
    const initialValues = {};

    // Salva os valores originais para restaurar caso clique em CANCELAR
    profileInputs.forEach(input => {
      initialValues[input.id] = input.value;
    });

    btnEditSave.addEventListener('click', function () {
      if (!isEditing) {
        // Ativa o modo de edição
        isEditing = true;
        profileInputs.forEach(input => input.removeAttribute('readonly'));
        btnEditSave.textContent = 'SALVAR';
        btnCancelEdit.style.display = 'inline-block';
        firstNameInput.focus();
      } else {
        // Une Nome e Sobrenome no campo 'name' do Breeze e envia o formulário
        combinedNameInput.value = (firstNameInput.value.trim() + ' ' + lastNameInput.value.trim()).trim();
        profileForm.submit();
      }
    });

    btnCancelEdit.addEventListener('click', function () {
      isEditing = false;
      profileInputs.forEach(input => {
        input.value = initialValues[input.id];
        input.setAttribute('readonly', true);
      });
      btnEditSave.textContent = 'EDITAR';
      btnCancelEdit.style.display = 'none';
      updateSidebarPreview();
    });

    const btnEnableAddressEdit = document.getElementById('btnEnableAddressEdit');
    const btnCancelAddressEdit = document.getElementById('btnCancelAddressEdit');
    const addressEditActions = document.getElementById('addressEditActions');
    const addressEditableInputs = document.querySelectorAll('.address-editable');
    const addressUpdateForm = document.getElementById('addressUpdateForm');
    const emptyAddressText = document.getElementById('emptyAddressText');

    btnEnableAddressEdit?.addEventListener('click', () => {
      if (emptyAddressText) emptyAddressText.style.display = 'none';
      if (addressUpdateForm) addressUpdateForm.style.display = 'block';

      addressEditableInputs.forEach(input => input.removeAttribute('readonly'));
      addressEditActions.hidden = false;
      btnEnableAddressEdit.hidden = true;
      document.getElementById('addr_cep')?.focus();
    });

    btnCancelAddressEdit?.addEventListener('click', () => {
      addressEditableInputs.forEach(input => input.setAttribute('readonly', 'readonly'));
      addressEditActions.hidden = true;
      btnEnableAddressEdit.hidden = false;
      addressUpdateForm.reset();

      if (emptyAddressText) {
        emptyAddressText.style.display = 'block';
        addressUpdateForm.style.display = 'none';
      }
    });

    // 4. Abre automaticamente a aba Meus Pedidos ou Endereços quando vier na URL (?tab=...)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'pedidos') {
      document.querySelector('[data-target="tab-pedidos"]')?.click();
    } else if (urlParams.get('tab') === 'enderecos') {
      document.querySelector('[data-target="tab-enderecos"]')?.click();
    } else if (urlParams.get('tab') === 'favoritos') {
      document.querySelector('[data-target="tab-favoritos"]')?.click();
    }

    // Atualiza o nome e as iniciais do card lateral em tempo real enquanto edita
    function updateSidebarPreview() {
      const fName = firstNameInput.value.trim() || 'Nome';
      const lName = lastNameInput.value.trim() || '';
      document.getElementById('sidebarFullName').textContent = (fName + ' ' + lName).trim();
      document.getElementById('sidebarEmail').textContent = emailInput.value.trim() || 'email@email.com';

      const firstChar = fName.charAt(0);
      const secondChar = lName ? lName.charAt(0) : fName.charAt(1);
      document.getElementById('avatarInitials').textContent = (firstChar + secondChar).toUpperCase();
    }

    firstNameInput.addEventListener('input', updateSidebarPreview);
    lastNameInput.addEventListener('input', updateSidebarPreview);
    emailInput.addEventListener('input', updateSidebarPreview);

    // Máscara de telefone (xx) x xxxx-xxxx
    phoneInput.addEventListener('input', function (e) {
      if (this.hasAttribute('readonly')) return;
      let v = e.target.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 7) {
        v = `(${v.slice(0, 2)}) ${v.slice(2, 3)} ${v.slice(3, 7)}-${v.slice(7)}`;
      } else if (v.length > 3) {
        v = `(${v.slice(0, 2)}) ${v.slice(2, 3)} ${v.slice(3)}`;
      } else if (v.length > 2) {
        v = `(${v.slice(0, 2)}) ${v.slice(2)}`;
      }
      e.target.value = v;
    });

    // ================= 2. NAVEGAÇÃO ENTRE AS ABAS DO MENU LATERAL =================
    const navButtons = document.querySelectorAll('.account-nav-btn[data-target]');
    const tabSections = document.querySelectorAll('.tab-section');

    navButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');

        navButtons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        tabSections.forEach(sec => {
          sec.classList.toggle('active', sec.id === targetId);
        });
      });
    });
  </script>

</body>
</html>