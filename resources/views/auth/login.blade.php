<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar - Loja do Motoca</title>
  <link rel="stylesheet" href="css/login.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  <main class="login-layout">
    
    <!-- ================= COLUNA ESQUERDA: BANNER VISUAL ================= -->
    <aside class="login-banner" aria-label="Destaque institucional">
      <a href="{{ url('/') }}" class="banner-logo-link" aria-label="Voltar para a página inicial">
        <!-- Substitua pelo caminho da sua logo oficial (ex: asset('images/logo.png')) -->
        <img 
          src="img/logoLDM.png" 
          alt="Loja do Motoca - Acessórios para quem vive duas rodas" 
          class="banner-logo-img"
        >
      </a>

      <h2 class="banner-headline">
        ACESSÓRIOS
        <span class="text-red">QUE VOCÊ</span>
        PRECISA
      </h2>
    </aside>

    <!-- ================= COLUNA DIREITA: FORMULÁRIO DE LOGIN ================= -->
    <section class="login-panel" aria-label="Formulário de autenticação">
      <div class="login-container">
        
        <header class="login-header">
          <h1 class="login-title">BEM-VINDO DE VOLTA</h1>
          <p class="login-subtitle">Entre na sua conta para continuar comprando</p>
        </header>

        <!-- Mensagem de sessão do Breeze (ex: confirmação de redefinição de senha) -->
        @if (session('status'))
          <div class="status-alert" role="alert">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
          @csrf

          <!-- Campo de E-mail -->
          <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <div class="input-wrapper">
              <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="form-control" 
                placeholder="email@email.com" 
                required 
                autofocus 
                autocomplete="username"
              >
            </div>
            @error('email')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Campo de Senha -->
          <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <div class="input-wrapper">
              <input 
                id="password" 
                type="password" 
                name="password" 
                class="form-control has-toggle" 
                placeholder="••••••••" 
                required 
                autocomplete="current-password"
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

          <!-- Link Esqueci minha senha (integrado com a rota do Breeze) -->
          <div class="forgot-password-row">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="forgot-password-link">
                Esqueci minha senha
              </a>
            @else
              <a href="#" class="forgot-password-link">
                Esqueci minha senha
              </a>
            @endif
          </div>

          <!-- Botão Principal -->
          <button type="submit" class="btn-submit">
            ENTRAR
          </button>

          <!-- Link para a tela de Registro do Breeze -->
          <p class="register-prompt">
            Não tem conta?
            <a href="{{ route('register') }}" class="register-link">Criar conta grátis</a>
          </p>
        </form>

        <!-- Rodapé de Termos -->
        <footer class="login-footer">
          <p class="terms-text">
            Ao continuar, você concorda com nossos <a href="#">Termos de Uso</a> e <a href="#">Política de Privacidade</a>
          </p>
        </footer>

      </div>
    </section>

  </main>

  <!-- Script para alternar a visualização da senha no botão "VER" -->
  <script>
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');

    toggleBtn.addEventListener('click', function () {
      const isPassword = passwordInput.getAttribute('type') === 'password';
      passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
      this.textContent = isPassword ? 'OCULTAR' : 'VER';
    });
  </script>

</body>
</html>