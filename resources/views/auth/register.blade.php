<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Conta - Loja do Motoca</title>
  <link rel="stylesheet" href="css/register.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  <main class="register-layout">
    
    <!-- ================= COLUNA ESQUERDA: BANNER VISUAL ================= -->
    <aside class="register-banner" aria-label="Destaque institucional">
      <a href="{{ url('/') }}" class="banner-logo-link" aria-label="Voltar para a página inicial">
        <!-- Substitua pelo caminho da sua logo oficial (ex: asset('images/logo.png')) -->
        <img 
          src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=300" 
          alt="Loja do Motoca - Acessórios para quem vive duas rodas" 
          class="banner-logo-img"
        >
      </a>

      <h2 class="banner-headline">
        JUNTE-SE A
        <span class="text-red">MILHARES DE</span>
        MOTOCICLISTAS
      </h2>
    </aside>

    <!-- ================= COLUNA DIREITA: FORMULÁRIO DE CADASTRO ================= -->
    <section class="register-panel" aria-label="Formulário de criação de conta">
      <div class="register-container">
        
        <header class="register-header">
          <h1 class="register-title">CRIAR CONTA</h1>
          <p class="register-subtitle">
            Já tem conta?
            <a href="{{ route('login') }}" class="login-redirect-link">Fazer login</a>
          </p>
        </header>

        <form method="POST" action="{{ route('register') }}" class="register-form" id="registerForm">
          @csrf

          <!-- Linha 1: Nome e Sobrenome lado a lado -->
          <div class="form-row-2col">
            <div class="form-group">
              <label for="name" class="form-label">
                Nome <span class="required-star">*</span>
              </label>
              <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                class="form-control" 
                placeholder="Nome" 
                required 
                autofocus 
                autocomplete="given-name"
              >
              @error('name')
                <span class="error-message">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="last_name" class="form-label">
                Sobrenome <span class="required-star">*</span>
              </label>
              <input 
                id="last_name" 
                type="text" 
                name="last_name" 
                value="{{ old('last_name') }}" 
                class="form-control" 
                placeholder="Sobrenome" 
                required 
                autocomplete="family-name"
              >
            </div>
          </div>

          <!-- Linha 2: E-mail -->
          <div class="form-group">
            <label for="email" class="form-label">
              E-mail <span class="required-star">*</span>
            </label>
            <input 
              id="email" 
              type="email" 
              name="email" 
              value="{{ old('email') }}" 
              class="form-control" 
              placeholder="email@email.com" 
              required 
              autocomplete="username"
            >
            @error('email')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Linha 3: Telefone -->
          <div class="form-group">
            <label for="phone" class="form-label">
              Telefone <span class="required-star">*</span>
            </label>
            <input 
              id="phone" 
              type="tel" 
              name="phone" 
              value="{{ old('phone') }}" 
              class="form-control" 
              placeholder="(11) 9 9999-9999" 
              required 
              autocomplete="tel"
            >
            @error('phone')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Linha 4: Senha -->
          <div class="form-group">
            <label for="password" class="form-label">
              Senha <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
              <input 
                id="password" 
                type="password" 
                name="password" 
                class="form-control has-toggle" 
                placeholder="Mínimo 8 caracteres" 
                required 
                autocomplete="new-password"
              >
              <button 
                type="button" 
                class="btn-toggle-password" 
                id="togglePassword" 
                aria-label="Mostrar ou ocultar senha"
              >
                VER
              </button>
            </div>
            @error('password')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Linha 5: Confirmar Senha -->
          <div class="form-group">
            <label for="password_confirmation" class="form-label">
              Confirmar senha <span class="required-star">*</span>
            </label>
            <input 
              id="password_confirmation" 
              type="password" 
              name="password_confirmation" 
              class="form-control" 
              placeholder="Repita a senha" 
              required 
              autocomplete="new-password"
            >
            @error('password_confirmation')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Linha 6: Aceite de Termos e Política de Privacidade -->
          <label class="terms-agreement" for="terms">
            <input 
              type="checkbox" 
              id="terms" 
              name="terms" 
              class="terms-checkbox" 
              required
            >
            <span class="terms-label-text">
              Li e aceito os <a href="#">Termos de Uso</a> e a <a href="#">Política de Privacidade</a>. Estou ciente sobre o tratamento dos meus dados pessoais.
            </span>
          </label>

          <!-- Botão Principal -->
          <button type="submit" class="btn-submit">
            CRIAR CONTA GRÁTIS
          </button>

        </form>

      </div>
    </section>

  </main>

  <script>
    // 1. Alternar visualização da senha no botão "VER"
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');

    toggleBtn.addEventListener('click', function () {
      const isPassword = passwordInput.getAttribute('type') === 'password';
      passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
      this.textContent = isPassword ? 'OCULTAR' : 'VER';
    });

    // 2. Máscara automática para o campo de Telefone: (11) 9 9999-9999
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function (e) {
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
  </script>

</body>
</html>