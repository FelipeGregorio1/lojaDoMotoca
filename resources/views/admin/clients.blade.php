<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes - Admin Loja do Motoca</title>

    <!-- Fonte Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="{{ asset('css/adminClients.css') }}">
</head>
<body>

    <!-- ================= NAVBAR ADMINISTRATIVA ================= -->
    <header class="admin-header">
        <div class="admin-header__container">
            
            <!-- Esquerda: Logo + Badge ADMIN -->
            <div class="admin-brand">
                <a href="{{ url('/') }}" class="admin-brand__logo-link" title="Loja do Motoca">
                    <img src="{{ asset('img/logoLDM.png') }}" alt="Logo Loja do Motoca" class="admin-brand__logo">
                </a>
                <span class="admin-brand__badge">ADMIN</span>
            </div>

            <!-- Centro: Navegação Principal -->
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
                        <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('*pedidos*') ? 'is-active' : '' }}">
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span>Pedidos</span>
                        </a>
                    </li>

                    <li class="admin-nav__item">
                        <a href="{{ route('admin.clients.index') }}" class="admin-nav__link {{ request()->routeIs('*clients*') || request()->is('clientes*') ? 'is-active' : '' }}">
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

            <!-- Direita: Ações (Ver Loja e Sair) -->
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

    <!-- ================= CONTEÚDO PRINCIPAL ================= -->
    <main class="admin-container">
        
        <section class="card" aria-labelledby="clients-heading">
            
            <!-- Cabeçalho do Card -->
            <header class="card-header">
                <h1 id="clients-heading">Clientes</h1>
                <p>{{ $clients->count() }} {{ $clients->count() === 1 ? 'cliente encontrado' : 'clientes encontrados' }}</p>
            </header>

            <!-- Lista de Clientes -->
            <ul class="clients-list">
                @forelse($clients as $client)
                    @php
                        // Pega a 1ª letra do nome em maiúsculo para o avatar redondo
                        $initial = mb_strtoupper(mb_substr(trim($client->name), 0, 1)) ?: 'C';

                        // Busca todos os pedidos finalizados deste cliente na tabela orders
                        $userOrders = \App\Models\Order::where('user_id', $client->id)->get();
                        $totalSpent = $userOrders->sum('total');
                        $ordersCount = $userOrders->count();
                    @endphp

                    <li class="client-row">
                        
                        <!-- Esquerda: Avatar + Nome e E-mail -->
                        <div class="client-info">
                            <div class="client-avatar" aria-hidden="true">
                                {{ $initial }}
                            </div>
                            <div class="client-details">
                                <h2 class="client-name">
                                    {{ $client->name }}
                                    @if($client->is_admin)
                                        <span class="client-admin-tag">ADM</span>
                                    @endif
                                </h2>
                                <span class="client-email">{{ $client->email }}</span>
                            </div>
                        </div>

                        <!-- Direita: Botões de Ação + Resumo Financeiro -->
                        <div class="client-actions-group">
                            
                            <!-- 1. Botão GERENCIAR PEDIDOS (Borda vermelha, preparado para filtrar por cliente) -->
                            <a href="{{ url('/pedidos?user_id=' . $client->id) }}" class="btn-client-outline">
                                GERENCIAR PEDIDOS
                            </a>

                            <!-- 2. Botão TORNAR ADM (Borda vermelha) -->
                            <form action="{{ route('admin.clients.toggle', $client->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-client-outline">
                                    {{ $client->is_admin ? 'REMOVER ADM' : 'TORNAR ADM' }}
                                </button>
                            </form>

                            <!-- 3. Botão EXCLUIR CONTA (Fundo vermelho sólido) -->
                            <a href="{{ route('admin.clients.destroy', $client->id) }}" 
                               class="btn-client-red"
                               onclick="return confirm('Tem certeza que deseja excluir a conta de {{ $client->name }}?')">
                                EXCLUIR CONTA
                            </a>

                            <!-- 4. Resumo Financeiro do Cliente -->
                            <div class="client-stats">
                                <strong class="client-total-spent">
                                    R$ {{ number_format($totalSpent, 2, ',', '.') }}
                                </strong>
                                <span class="client-orders-count">
                                    {{ $ordersCount }} {{ $ordersCount === 1 ? 'pedido' : 'pedidos' }}
                                </span>
                            </div>

                        </div>

                    </li>
                @empty
                    <li class="clients-empty">
                        Nenhum cliente cadastrado até o momento.
                    </li>
                @endforelse
            </ul>

        </section>

    </main>

</body>
</html>