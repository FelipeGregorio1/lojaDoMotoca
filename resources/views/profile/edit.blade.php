<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minha Conta - Loja do Motoca</title>
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/homeClient.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  @php
    // Recupera o usuário autenticado do Laravel Breeze (ou usa fallback visual caso teste sem login)
    $currentUser =$user ?? auth()->user();
    $fullName =$currentUser?->name ?? 'Nome Sobrenome';
    $email =$currentUser?->email ?? 'email@email.com';
    $phone =$currentUser?->phone ?? '(xx) x xxxx-xxxx';

    // Divide o nome completo em Nome e Sobrenome
    $nameParts = explode(' ', trim($fullName), 2);$firstName = $nameParts[0] ?? 'Nome';$lastName = $currentUser?->last_name ?? ($nameParts[1] ?? 'Sobrenome');

    // Gera as 2 iniciais para o avatar (ex: "NS")
    $firstInitial = mb_substr($firstName, 0, 1);$secondInitial = $lastName !== '' ? mb_substr($lastName, 0, 1) : mb_substr($firstName, 1, 1);$initials = mb_strtoupper($firstInitial .$secondInitial);
  @endphp

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

  <div class="profile-wrapper">
    
    <!-- Breadcrumb de Navegação -->
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="{{ url('/') }}">Início</a>
      <span class="breadcrumb-separator" aria-hidden="true">/</span>
      <span class="breadcrumb-current">Minha Conta</span>
    </nav>

    <div class="account-grid">
      
      <!-- ================= COLUNA ESQUERDA: SIDEBAR ================= -->
      <aside class="account-sidebar" aria-label="Menu da conta">
        
        <!-- Card Superior: Avatar e Nome -->
        <div class="user-summary-card">
          <div class="user-avatar" id="avatarInitials" aria-hidden="true">
            {{ $initials ?: 'NS' }}
          </div>
          <h2 class="user-fullname" id="sidebarFullName">{{ $firstName }} {{$lastName }}</h2>
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
      <main class="profile-content-card">

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

        <!-- ABA 1: MEU PERFIL (Padrão idêntico à imagem) -->
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
                  class="form-control profile-input" 
                  value="{{ old('last_name', $lastName) }}" 
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
                  class="form-control profile-input" 
                  value="{{ old('phone', $phone) }}" 
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
          <p class="empty-tab-text">Você ainda não realizou nenhum pedido.</p>
        </section>

        <!-- ABA 3: ENDEREÇOS -->
        <section id="tab-enderecos" class="tab-section" aria-labelledby="heading-enderecos">
          <header class="content-header">
            <h2 class="content-title" id="heading-enderecos">ENDEREÇOS</h2>
          </header>
          <p class="empty-tab-text">Nenhum endereço cadastrado até o momento.</p>
        </section>

        <!-- ABA 4: FAVORITOS -->
        <section id="tab-favoritos" class="tab-section" aria-labelledby="heading-favoritos">
          <header class="content-header">
            <h2 class="content-title" id="heading-favoritos">FAVORITOS</h2>
          </header>
          <p class="empty-tab-text">Sua lista de produtos favoritos está vazia.</p>
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

      </main>

    </div>
  </div>

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