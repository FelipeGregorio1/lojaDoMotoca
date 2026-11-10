<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Política de Privacidade - Loja do Motoca</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/privacy.css') }}">
</head>
<body>

  <!-- NAVBAR PRINCIPAL -->
  <header class="navbar">
    <div class="container navbar-content">
      
      <a href="{{ route('client.home') }}" class="navbar-logo" aria-label="Página Inicial Loja do Motoca">
        <img class="logo-img" src="../../img/logoLDM.png" alt="Loja do Motoca">
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

    <!-- BARRA DE CATEGORIAS -->
    <nav class="category-bar" aria-label="Categorias de produtos">
      <div class="container">
        <ul class="category-list">
          <li><a href="#">CAPACETES</a></li>
          <li><a href="#">EQUIPAMENTOS</a></li>
          <li><a href="#">PEÇAS</a></li>
          <li><a href="#">PNEUS</a></li>
          <li><a href="#">ÓLEOS</a></li>
          <li><a href="#">FERRAMENTAS</a></li>
          <li><a href="#">OFERTAS</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="privacy-page">

    <!-- HERO CABEÇALHO -->
    <section class="privacy-hero">
      <div class="container">
        <nav aria-label="Breadcrumb" class="breadcrumb">
          <ol>
            <li><a href="{{ route('client.home') }}">Início</a></li>
            <li aria-current="page">Política de Privacidade</li>
          </ol>
        </nav>

        <h1 class="hero-title">
          POLÍTICA DE <span>PRIVACIDADE</span>
        </h1>

        <p class="hero-meta">
          Última atualização: <time datetime="2024-09-01">01 de setembro de 2024</time> · Versão 3.2
        </p>

        <p class="hero-subtitle">
          A Loja do Motoca respeita e protege a privacidade de todos os usuários, em conformidade com a Lei Geral de Proteção de Dados (LGPD — Lei nº 13.709/2018).
        </p>
      </div>
    </section>

    <!-- CONTAINER CENTRAL DOS CARDS -->
    <div class="privacy-container">

      <!-- ÍNDICE (NESTA PÁGINA) -->
      <nav class="toc-card" aria-labelledby="toc-heading">
        <h2 id="toc-heading" class="toc-title">NESTA PÁGINA</h2>
        <ol class="toc-list">
          <li><a href="#secao-1">1. Informações que coletamos</a></li>
          <li><a href="#secao-2">2. Como utilizamos suas informações</a></li>
          <li><a href="#secao-3">3. Compartilhamento de dados</a></li>
          <li><a href="#secao-4">4. Cookies e rastreamento</a></li>
          <li><a href="#secao-5">5. Segurança dos dados</a></li>
          <li><a href="#secao-6">6. Seus direitos (LGPD)</a></li>
          <li><a href="#secao-7">7. Retenção de dados</a></li>
          <li><a href="#secao-8">8. Atualizações desta política</a></li>
        </ol>
      </nav>

      <!-- SEÇÃO 1 -->
      <section id="secao-1" class="policy-card" aria-labelledby="heading-1">
        <h2 id="heading-1" class="policy-title">1. Informações que coletamos</h2>
        <ul class="policy-list">
          <li><strong>Dados de cadastro:</strong> nome completo, e-mail, CPF, data de nascimento, telefone e endereço fornecidos no momento do registro.</li>
          <li><strong>Dados de uso:</strong> páginas visitadas, produtos visualizados, itens adicionados ao carrinho e histórico de compras.</li>
          <li><strong>Dados de dispositivo:</strong> endereço IP, tipo de navegador, sistema operacional e cookies de sessão.</li>
          <li><strong>Dados de pagamento:</strong> processados exclusivamente por nossos parceiros certificados (PCI-DSS). Não armazenamos dados de cartão de crédito.</li>
        </ul>
      </section>

      <!-- SEÇÃO 2 -->
      <section id="secao-2" class="policy-card" aria-labelledby="heading-2">
        <h2 id="heading-2" class="policy-title">2. Como utilizamos suas informações</h2>
        <ul class="policy-list">
          <li>Processar e entregar seus pedidos.</li>
          <li>Enviar atualizações de status e confirmações via e-mail ou SMS.</li>
          <li>Personalizar sua experiência de compra com recomendações relevantes.</li>
          <li>Melhorar nossos produtos, serviços e plataforma.</li>
          <li>Prevenir fraudes e garantir a segurança da sua conta.</li>
          <li>Cumprir obrigações legais e regulatórias.</li>
        </ul>
      </section>

      <!-- SEÇÃO 3 -->
      <section id="secao-3" class="policy-card" aria-labelledby="heading-3">
        <h2 id="heading-3" class="policy-title">3. Compartilhamento de dados</h2>
        <ul class="policy-list">
          <li><strong>Transportadoras:</strong> nome, endereço e telefone são compartilhados exclusivamente para entrega do pedido.</li>
          <li><strong>Processadores de pagamento:</strong> dados financeiros são transmitidos de forma criptografada aos nossos parceiros de cobrança.</li>
          <li><strong>Autoridades:</strong> podemos divulgar dados quando exigido por lei, ordem judicial ou investigação de fraude.</li>
          <li>Nunca vendemos ou cedemos seus dados a terceiros para fins comerciais.</li>
        </ul>
      </section>

      <!-- SEÇÃO 4 -->
      <section id="secao-4" class="policy-card" aria-labelledby="heading-4">
        <h2 id="heading-4" class="policy-title">4. Cookies e rastreamento</h2>
        <ul class="policy-list">
          <li>Utilizamos cookies essenciais para o funcionamento do site (sessão, carrinho) e cookies analíticos (Google Analytics) para medir desempenho.</li>
          <li>Você pode desativar cookies não essenciais a qualquer momento nas configurações do seu navegador.</li>
          <li>O uso de cookies analíticos é realizado sob base legal de interesse legítimo, com minimização de dados.</li>
        </ul>
      </section>

      <!-- SEÇÃO 5 -->
      <section id="secao-5" class="policy-card" aria-labelledby="heading-5">
        <h2 id="heading-5" class="policy-title">5. Segurança dos dados</h2>
        <ul class="policy-list">
          <li>Trafegamos todos os dados via TLS 1.3 (HTTPS).</li>
          <li>Senhas são armazenadas com hash bcrypt — nunca em texto plano.</li>
          <li>Realizamos auditorias de segurança periódicas e testes de penetração anuais.</li>
          <li>Em caso de incidente, notificaremos os titulares afetados em até 72 horas, conforme a LGPD.</li>
        </ul>
      </section>

      <!-- SEÇÃO 6 -->
      <section id="secao-6" class="policy-card" aria-labelledby="heading-6">
        <h2 id="heading-6" class="policy-title">6. Seus direitos (LGPD)</h2>
        <ul class="policy-list">
          <li><strong>Acesso:</strong> solicitar uma cópia dos seus dados pessoais.</li>
          <li><strong>Correção:</strong> atualizar dados incorretos ou incompletos.</li>
          <li><strong>Exclusão:</strong> solicitar a remoção dos seus dados (quando não houver obrigação legal de retenção).</li>
          <li><strong>Portabilidade:</strong> receber seus dados em formato estruturado.</li>
          <li><strong>Revogação de consentimento:</strong> a qualquer momento, sem ônus.</li>
          <li>Para exercer qualquer direito, acesse: <strong>privacidade@lojadomotoca.com.br</strong></li>
        </ul>
      </section>

      <!-- SEÇÃO 7 -->
      <section id="secao-7" class="policy-card" aria-labelledby="heading-7">
        <h2 id="heading-7" class="policy-title">7. Retenção de dados</h2>
        <ul class="policy-list">
          <li>Dados de conta são mantidos enquanto houver vínculo ativo. Após encerramento, retemos dados por até 5 anos para fins fiscais e legais.</li>
          <li>Logs de acesso são mantidos por 6 meses, conforme o Marco Civil da Internet (Lei 12.965/2014).</li>
        </ul>
      </section>

      <!-- SEÇÃO 8 -->
      <section id="secao-8" class="policy-card" aria-labelledby="heading-8">
        <h2 id="heading-8" class="policy-title">8. Atualizações desta política</h2>
        <ul class="policy-list">
          <li>Esta política pode ser atualizada periodicamente. Alterações relevantes serão comunicadas por e-mail ou notificação no site.</li>
          <li>A data da última revisão está indicada no topo deste documento.</li>
        </ul>
      </section>

      <!-- CARD DE CONTATO DPO -->
      <aside class="dpo-card" aria-label="Contato do Encarregado de Proteção de Dados">
        <span class="dpo-icon" aria-hidden="true">📩</span>
        <div class="dpo-content">
          <h3>Dúvidas sobre privacidade?</h3>
          <p>Entre em contato com nosso Encarregado de Proteção de Dados (DPO):</p>
          <a href="mailto:privacidade@lojadomotoca.com.br" class="dpo-email">privacidade@lojadomotoca.com.br</a>
        </div>
      </aside>

    </div>
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