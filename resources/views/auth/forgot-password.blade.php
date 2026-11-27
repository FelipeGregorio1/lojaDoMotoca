<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha - Loja do Motoca</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
  <main class="login-layout">
    <aside class="login-banner" aria-label="Destaque institucional">
      <a href="{{ url('/') }}" class="banner-logo-link">
        <img src="{{ asset('img/logoLDM.png') }}" alt="Loja do Motoca" class="banner-logo-img">
      </a>
      <h2 class="banner-headline">
        RECUPERE <span class="text-red">SEU ACESSO</span> RAPIDAMENTE
      </h2>
    </aside>

    <section class="login-panel">
      <div class="login-container">
        <header class="login-header">
          <h1 class="login-title">ESQUECI MINHA SENHA</h1>
          <p class="login-subtitle">Digite seu e-mail para receber um código de 6 dígitos</p>
        </header>

        @if (session('status'))
          <div class="status-alert" role="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="login-form">
          @csrf

          <div class="form-group">
            <label for="email" class="form-label">E-mail cadastrado</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="email@email.com" required autofocus>
            @error('email')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn-submit">ENVIAR CÓDIGO DE 6 DÍGITOS</button>

          <p class="register-prompt">
            Lembrou a senha? <a href="{{ route('login') }}" class="register-link">Voltar ao login</a>
          </p>
        </form>
      </div>
    </section>
  </main>
</body>
</html>
