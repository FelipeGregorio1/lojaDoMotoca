<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificar Código - Loja do Motoca</title>
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
        CONFIRME <span class="text-red">SEU CÓDIGO</span> DE ACESSO
      </h2>
    </aside>

    <section class="login-panel">
      <div class="login-container">
        <header class="login-header">
          <h1 class="login-title">DIGITE O CÓDIGO</h1>
          <p class="login-subtitle">Enviamos um código de 6 números para <strong>{{ $email }}</strong></p>
        </header>

        @if (session('status'))
          <div class="status-alert" role="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.code.verify') }}" class="login-form">
          @csrf
          <input type="hidden" name="email" value="{{ $email }}">

          <div class="form-group">
            <label for="code" class="form-label">Código de verificação (6 dígitos)</label>
            <input
              id="code"
              type="text"
              name="code"
              maxlength="6"
              inputmode="numeric"
              class="form-control"
              placeholder="000000"
              style="text-align: center; font-size: 20px; font-weight: 800; letter-spacing: 8px;"
              required
              autofocus
            >
            @error('code')
              <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn-submit">VERIFICAR E ACESSAR PERFIL</button>
        </form>

        <form method="POST" action="{{ route('password.email') }}" style="margin-top: 14px; text-align: center;">
          @csrf
          <input type="hidden" name="email" value="{{ $email }}">
          <button type="submit" style="background: none; border: none; color: #e50914; font-size: 12px; font-weight: 700; cursor: pointer;">
            Reenviar código para o e-mail
          </button>
        </form>
      </div>
    </section>
  </main>
</body>
</html>