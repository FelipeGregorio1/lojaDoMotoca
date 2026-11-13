<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visão Geral - Admin Loja do Motoca</title>

    <!-- Fonte Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/adminDashboard.css') }}">
</head>
<body>

    @php
        // Pega apenas o primeiro nome do Admin logado (ex: "Felipe")
        $adminFirstName = explode(' ', trim(auth()->user()->name ?? 'Admin'))[0];
    @endphp

    <!-- ================= NAVBAR ADMINISTRATIVA ================= -->
    <header class="admin-header">
        <div class="admin-header__container">
            
            <div class="admin-brand">
                <a href="{{ url('/') }}" class="admin-brand__logo-link" title="Loja do Motoca">
                    <img src="{{ asset('img/logoLDM.png') }}" alt="Logo Loja do Motoca" class="admin-brand__logo">
                </a>
                <span class="admin-brand__badge">ADMIN</span>
            </div>

            <nav class="admin-nav" aria-label="Menu Administrativo">
                <ul class="admin-nav__list">
                    
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.dashboard') }}" class="admin-nav__link {{ request()->routeIs('admin.dashboard*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                                <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                            </svg>
                            <span>Visão geral</span>
                        </a>
                    </li>

                    <li class="admin-nav__item">
                        <a href="{{ route('category.index') }}" class="admin-nav__link {{ request()->routeIs('*category.*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Categorias</span>
                        </a>
                    </li>

                    <li class="admin-nav__item">
                        <a href="{{ route('product.index') }}" class="admin-nav__link {{ request()->routeIs('*product.*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <span>Produtos</span>
                        </a>
                    </li>

                    <li class="admin-nav__item">
                        <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('*orders*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span>Pedidos</span>
                        </a>
                    </li>

                    <li class="admin-nav__item">
                        <a href="{{ route('admin.clients.index') }}" class="admin-nav__link {{ request()->routeIs('*clients*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Clientes</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="admin-actions">
                <a href="{{ url('/') }}" class="admin-actions__btn admin-actions__btn--outline">
                    VER LOJA
                </a>

                <form action="{{ route('logout') }}" method="POST" class="admin-actions__form">
                    @csrf
                    <button type="submit" class="admin-actions__btn admin-actions__btn--dark">
                        SAIR
                    </button>
                </form>
            </div>

        </div>
    </header>

    <!-- ================= CONTEÚDO PRINCIPAL (DASHBOARD) ================= -->
    <main class="admin-container">

        <!-- 1. BANNER DE BOAS-VINDAS -->
        <section class="welcome-banner" aria-label="Resumo de hoje">
            <span class="welcome-banner__badge">RESUMO DE HOJE</span>
            <h1 class="welcome-banner__title">Olá, {{ $adminFirstName }}!</h1>
            <p class="welcome-banner__subtitle">
                Sua loja recebeu {{ $ordersToday }} {{ $ordersToday === 1 ? 'novo pedido' : 'novos pedidos' }} hoje. Acompanhe o desempenho abaixo.
            </p>
        </section>

        <!-- 2. GRID DE 4 INDICADORES (KPI CARDS) -->
        <section class="kpi-grid" aria-label="Indicadores principais">
            
            <!-- Card 1: Vendas hoje -->
            <article class="kpi-card">
                <div class="kpi-icon-box">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <span class="kpi-label">Vendas hoje</span>
                <strong class="kpi-value">R$ {{ number_format($salesToday, 0, ',', '.') }}</strong>
                <span class="kpi-meta">+12,5%</span>
            </article>

            <!-- Card 2: Novos pedidos -->
            <article class="kpi-card">
                <div class="kpi-icon-box">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <span class="kpi-label">Novos pedidos</span>
                <strong class="kpi-value">{{ $totalOrders }}</strong>
                <span class="kpi-meta">+{{ $ordersToday }} hoje</span>
            </article>

            <!-- Card 3: Produtos ativos -->
            <article class="kpi-card">
                <div class="kpi-icon-box">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <span class="kpi-label">Produtos ativos</span>
                <strong class="kpi-value">{{ $totalProducts }}</strong>
                <span class="kpi-meta">{{ $totalCategories }} categorias</span>
            </article>

        </section>

        <!-- 3. GRÁFICO DE VENDAS EM CSS PURO (ÚLTIMOS 7 DIAS) -->
        <section class="panel-card chart-section" aria-labelledby="chart-heading">
            <header class="panel-header">
                <div>
                    <h2 id="chart-heading" class="panel-title">Desempenho de vendas (Últimos 7 dias)</h2>
                    <p class="panel-subtitle">Volume diário de pedidos faturados na loja</p>
                </div>
            </header>

            <div class="css-bar-chart">
                @foreach($chartData as $day)
                    @php
                        // Calcula a altura percentual da barra (mínimo de 8% para visualização estética)
                        $heightPercent = $maxSale > 0 ? max(round(($day['total'] / $maxSale) * 100), 8) : 8;
                        $isToday = $loop->last;
                    @endphp
                    <div class="chart-column">
                        <span class="chart-value">R$ {{ number_format($day['total'], 0, ',', '.') }}</span>
                        <div class="chart-bar-track">
                            <div class="chart-bar-fill {{ $isToday ? 'is-today' : '' }}" style="height: {{ $heightPercent }}%;"></div>
                        </div>
                        <span class="chart-label">{{ $day['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 4. GRID INFERIOR: PEDIDOS RECENTES + AÇÕES RÁPIDAS -->
        <div class="dashboard-bottom-grid">
            
            <!-- Coluna Esquerda: Pedidos Recentes -->
            <section class="panel-card" aria-labelledby="recent-orders-heading">
                <header class="panel-header">
                    <div>
                        <h2 id="recent-orders-heading" class="panel-title">Pedidos recentes</h2>
                        <p class="panel-subtitle">Últimas movimentações da loja</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="panel-link-red">VER TODOS</a>
                </header>

                <ul class="recent-orders-list">
                    @forelse($recentOrders as $order)
                        @php
                            $orderCode = 45827 + $order->id;
                            if ($order->created_at->isToday()) {
                                $dateText = 'Hoje, ' . $order->created_at->format('H:i');
                            } elseif ($order->created_at->isYesterday()) {
                                $dateText = 'Ontem, ' . $order->created_at->format('H:i');
                            } else {
                                $dateText = $order->created_at->format('d/m/Y, H:i');
                            }
                            $statusUpper = mb_strtoupper($order->status);
                            $badgeClass = $statusUpper === 'ENTREGUE' ? 'badge-green' : ($statusUpper === 'CANCELADO' ? 'badge-red' : 'badge-amber');
                        @endphp

                        <li class="recent-order-item">
                            <div class="recent-order-left">
                                <div class="recent-order-icon">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="recent-order-name">#{{ $orderCode }} · {{ $order->User?->name ?? 'Cliente' }}</h3>
                                    <span class="recent-order-time">{{ $dateText }}</span>
                                </div>
                            </div>

                            <div class="recent-order-right">
                                <strong class="recent-order-total">R$ {{ number_format((float) $order->total, 2, ',', '.') }}</strong>
                                <span class="recent-order-badge {{ $badgeClass }}">{{ $statusUpper }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="empty-message">Nenhum pedido recente registrado.</li>
                    @endforelse
                </ul>
            </section>

            <!-- Coluna Direita: Ações Rápidas -->
            <aside class="panel-card" aria-labelledby="quick-actions-heading">
                <header class="panel-header">
                    <div>
                        <h2 id="quick-actions-heading" class="panel-title">Ações rápidas</h2>
                        <p class="panel-subtitle">Atalhos para tarefas frequentes</p>
                    </div>
                </header>

                <nav class="quick-actions-list" aria-label="Atalhos rápidos">
                    <a href="{{ route('product.create') }}" class="quick-action-item">
                        <div class="quick-action-left">
                            <div class="quick-action-icon">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                            </div>
                            <strong>Adicionar novo produto</strong>
                        </div>
                        <span class="quick-action-arrow">›</span>
                    </a>

                    <a href="{{ route('category.create') }}" class="quick-action-item">
                        <div class="quick-action-left">
                            <div class="quick-action-icon">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                </svg>
                            </div>
                            <strong>Criar nova categoria</strong>
                        </div>
                        <span class="quick-action-arrow">›</span>
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="quick-action-item">
                        <div class="quick-action-left">
                            <div class="quick-action-icon">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                            </div>
                            <strong>Gerenciar pedidos</strong>
                        </div>
                        <span class="quick-action-arrow">›</span>
                    </a>
                </nav>
            </aside>

        </div>

    </main>

</body>
</html>