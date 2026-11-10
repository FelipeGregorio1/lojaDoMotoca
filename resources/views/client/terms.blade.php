<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Termos de Uso - Loja do Motoca</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/terms.css') }}">
</head>
<body>

  <!-- NAVBAR PRINCIPAL -->
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
  <main class="terms-page">

    <!-- HERO CABEÇALHO -->
    <section class="terms-hero">
      <div class="container">
        <nav aria-label="Breadcrumb" class="breadcrumb">
          <ol>
            <li><a href="{{ route('client.home') }}">Início</a></li>
            <li aria-current="page">Termos de Uso</li>
          </ol>
        </nav>

        <h1 class="hero-title">
          TERMOS DE <span>USO</span>
        </h1>

        <p class="hero-meta">
          Última atualização: <time datetime="2024-09-01">01 de setembro de 2024</time> · Versão 2.5
        </p>

        <p class="hero-subtitle">
          Leia atentamente antes de utilizar nossa plataforma. Estes termos regem a relação entre você e a Loja do Motoca Comércio de Acessórios Ltda.
        </p>
      </div>
    </section>

    <!-- CONTAINER CENTRAL DOS CARDS -->
    <div class="terms-container">

      <!-- ÍNDICE (NESTA PÁGINA - 2 COLUNAS) -->
      <nav class="toc-card" aria-labelledby="toc-heading">
        <h2 id="toc-heading" class="toc-title">NESTA PÁGINA</h2>
        <ol class="toc-grid">
          <li><a href="#termo-1">1. Aceitação dos Termos</a></li>
          <li><a href="#termo-2">2. Cadastro e Conta</a></li>
          <li><a href="#termo-3">3. Produtos e Preços</a></li>
          <li><a href="#termo-4">4. Pedidos e Pagamento</a></li>
          <li><a href="#termo-5">5. Entrega</a></li>
          <li><a href="#termo-6">6. Troca e Devolução</a></li>
          <li><a href="#termo-7">7. Propriedade Intelectual</a></li>
          <li><a href="#termo-8">8. Limitação de Responsabilidade</a></li>
          <li><a href="#termo-9">9. Legislação Aplicável</a></li>
        </ol>
      </nav>

      <!-- SEÇÃO 1 -->
      <section id="termo-1" class="terms-card" aria-labelledby="heading-1">
        <h2 id="heading-1" class="terms-title">1. Aceitação dos Termos</h2>
        <ul class="terms-list">
          <li>Ao acessar e utilizar a plataforma da Loja do Motoca (site, aplicativo e demais canais), você declara ter lido, compreendido e concordado com estes Termos de Uso.</li>
          <li>Caso não concorde com qualquer disposição, pedimos que não utilize nossos serviços.</li>
          <li>Estes Termos podem ser atualizados a qualquer momento. A versão vigente estará sempre disponível nesta página.</li>
        </ul>
      </section>

      <!-- SEÇÃO 2 -->
      <section id="termo-2" class="terms-card" aria-labelledby="heading-2">
        <h2 id="heading-2" class="terms-title">2. Cadastro e Conta</h2>
        <ul class="terms-list">
          <li>O cadastro é gratuito e exige informações verdadeiras, precisas e atualizadas.</li>
          <li>Você é responsável pela confidencialidade da sua senha e por todas as atividades realizadas na sua conta.</li>
          <li>É proibido criar contas com dados falsos, de terceiros sem autorização ou com fins fraudulentos.</li>
          <li>Reservamo-nos o direito de suspender ou excluir contas que violem estes Termos.</li>
        </ul>
      </section>

      <!-- SEÇÃO 3 -->
      <section id="termo-3" class="terms-card" aria-labelledby="heading-3">
        <h2 id="heading-3" class="terms-title">3. Produtos e Preços</h2>
        <ul class="terms-list">
          <li>As informações de produtos (descrição, imagens, especificações) são fornecidas pelos fabricantes e podem sofrer alterações sem aviso prévio.</li>
          <li>Preços são expressos em Reais (R$) e incluem tributos federais. Frete é calculado no checkout.</li>
          <li>Em caso de erro de preço por falha técnica, entraremos em contato antes de processar o pedido.</li>
          <li>Promoções e descontos são válidos enquanto durarem os estoques ou conforme indicado.</li>
        </ul>
      </section>

      <!-- SEÇÃO 4 -->
      <section id="termo-4" class="terms-card" aria-labelledby="heading-4">
        <h2 id="heading-4" class="terms-title">4. Pedidos e Pagamento</h2>
        <ul class="terms-list">
          <li>O pedido é confirmado apenas após aprovação do pagamento pela operadora.</li>
          <li>Aceitamos cartões de crédito (Visa, Mastercard, Amex, Elo), boleto bancário e Pix.</li>
          <li>Parcelamentos sem juros estão sujeitos às condições do cartão e aos valores mínimos por parcela.</li>
          <li>Em caso de suspeita de fraude, podemos solicitar documentação adicional ou cancelar o pedido.</li>
        </ul>
      </section>

      <!-- SEÇÃO 5 -->
      <section id="termo-5" class="terms-card" aria-labelledby="heading-5">
        <h2 id="heading-5" class="terms-title">5. Entrega</h2>
        <ul class="terms-list">
          <li>Prazos de entrega são estimados a partir da confirmação do pagamento e variam conforme a região.</li>
          <li>Entregas são realizadas via transportadoras parceiras. O prazo pode ser afetado por greves, desastres naturais ou situações de força maior.</li>
          <li>Frete grátis para pedidos acima de R$ 299,00 para todo o Brasil (exceto regiões remotas).</li>
          <li>Na ausência no momento da entrega, a transportadora fará até 3 tentativas em dias úteis.</li>
        </ul>
      </section>

      <!-- SEÇÃO 6 -->
      <section id="termo-6" class="terms-card" aria-labelledby="heading-6">
        <h2 id="heading-6" class="terms-title">6. Troca e Devolução</h2>
        <ul class="terms-list">
          <li>Seguimos o Código de Defesa do Consumidor (Lei 8.078/90). Você tem direito à troca ou devolução em até 7 dias corridos após o recebimento.</li>
          <li>Para trocas por defeito, o prazo é de 90 dias (produtos duráveis).</li>
          <li>O produto deve ser devolvido em embalagem original, sem uso e com nota fiscal.</li>
          <li>O reembolso é realizado na mesma forma de pagamento em até 10 dias úteis após o recebimento do item.</li>
        </ul>
      </section>

      <!-- SEÇÃO 7 -->
      <section id="termo-7" class="terms-card" aria-labelledby="heading-7">
        <h2 id="heading-7" class="terms-title">7. Propriedade Intelectual</h2>
        <ul class="terms-list">
          <li>Todo o conteúdo da plataforma (textos, imagens, marca, logotipo, layout) é propriedade da Loja do Motoca ou de seus licenciadores.</li>
          <li>É proibida a reprodução, distribuição ou uso comercial sem autorização expressa por escrito.</li>
          <li>Marcas de fabricantes exibidas nos produtos pertencem a seus respectivos titulares.</li>
        </ul>
      </section>

      <!-- SEÇÃO 8 -->
      <section id="termo-8" class="terms-card" aria-labelledby="heading-8">
        <h2 id="heading-8" class="terms-title">8. Limitação de Responsabilidade</h2>
        <ul class="terms-list">
          <li>A Loja do Motoca não se responsabiliza por danos indiretos, consequenciais ou lucros cessantes.</li>
          <li>Nossa responsabilidade é limitada ao valor pago pelo produto/serviço que originou a reclamação.</li>
          <li>Não garantimos a disponibilidade ininterrupta da plataforma, podendo ocorrer manutenções programadas.</li>
        </ul>
      </section>

      <!-- SEÇÃO 9 -->
      <section id="termo-9" class="terms-card" aria-labelledby="heading-9">
        <h2 id="heading-9" class="terms-title">9. Legislação Aplicável</h2>
        <ul class="terms-list">
          <li>Estes Termos são regidos pelas leis da República Federativa do Brasil.</li>
          <li>Eventuais conflitos serão dirimidos no Foro da Comarca de São Paulo — SP, com exclusão de qualquer outro.</li>
        </ul>
      </section>

      <!-- CARD DE DÚVIDAS / SUPORTE JURÍDICO -->
      <aside class="support-card" aria-label="Suporte jurídico e atendimento">
        <p>
          Dúvidas sobre nossos termos? Entre em contato: 
          <a href="mailto:juridico@lojadomotoca.com.br">juridico@lojadomotoca.com.br</a>
        </p>
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