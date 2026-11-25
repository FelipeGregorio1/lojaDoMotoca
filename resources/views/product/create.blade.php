<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Novo Produto - Admin Loja do Motoca</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/newProduct.css') }}">
</head>
<body>
    <!-- ================= NAVBAR ADMINISTRATIVA ================= -->
    <header class="admin-header">
        <div class="admin-header__container">
            
=======
    <title>Novo Produto</title>
    <link rel="stylesheet" href="../css/newProduct.css">
</head>
<body class="admin-container">
    <header class="admin-header">
        <div class="admin-header__container">
            
            <!-- Esquerda: Logo + Badge ADMIN -->
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
            <div class="admin-brand">
                <a href="{{ url('/') }}" class="admin-brand__logo-link" title="Loja do Motoca">
                    <img src="{{ asset('img/logoLDM.png') }}" alt="Logo Loja do Motoca" class="admin-brand__logo">
                </a>
                <span class="admin-brand__badge">ADMIN</span>
            </div>

<<<<<<< HEAD
            <nav class="admin-nav" aria-label="Menu Administrativo">
                <ul class="admin-nav__list">
                    
=======
            <!-- Centro: Navegação Principal -->
            <nav class="admin-nav" aria-label="Menu Administrativo">
                <ul class="admin-nav__list">
                    
                    <!-- Visão Geral -->
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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

<<<<<<< HEAD
=======
                    <!-- Categorias (Ativo em index, create, edit, etc.) -->
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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

<<<<<<< HEAD
=======
                    <!-- Produtos (Ativo em index, create, edit, etc.) -->
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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

<<<<<<< HEAD
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('*orders*') ? 'is-active' : '' }}">
=======
                    <!-- Pedidos -->
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('*pedidos*') ? 'is-active' : '' }}">
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
                            <svg class="admin-nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span>Pedidos</span>
                        </a>
                    </li>

<<<<<<< HEAD
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.clients.index') }}" class="admin-nav__link {{ request()->routeIs('*clients*') ? 'is-active' : '' }}">
=======
                    <!-- Clientes -->
                    <li class="admin-nav__item">
                        <a href="{{ route('admin.clients.index') }}" class="admin-nav__link {{ request()->routeIs('*clientes*') ? 'is-active' : '' }}">
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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

<<<<<<< HEAD
=======
            <!-- Direita: Ações (Ver Loja e Sair) -->
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
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

<<<<<<< HEAD
    <main class="admin-container">

        <header class="page-header">
            <span class="badge">PAINEL ADMINISTRATIVO</span>
            <h1>Novo produto</h1>
            <p>Preencha as informações comerciais, estoque, tamanhos e ficha técnica do produto.</p>
        </header>

        <form action="/product" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <!-- COLUNA ESQUERDA -->
            <div class="form-column">
                <section class="card">
                    <h2 class="card-title">Informações do produto</h2>
                    <p class="card-subtitle">Dados principais exibidos no catálogo da loja.</p>
                    <hr class="divider">

                    <label class="form-group">
                        <span>Nome do produto *</span>
                        <input type="text" name="name" placeholder="Ex: Capacete LS2 FF358" required>
                    </label>

                    <label class="form-group">
                        <span>Categoria *</span>
                        <select name="category_id" required>
                            <option value="">Selecione</option>
                            @foreach(\App\Models\Category::all() as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="form-group">
                        <span>Descrição do produto</span>
                        <textarea name="description" rows="4" placeholder="Descreva os detalhes, diferenciais, materiais e indicação de uso do produto..."></textarea>
                    </label>
                </section>

                <section class="card">
                    <h2 class="card-title">Ficha técnica</h2>
                    <p class="card-subtitle">A categoria é preenchida automaticamente conforme a selecionada acima.</p>
                    <hr class="divider">

                    <div class="specs-grid">
                        <label class="form-group">
                            <span>Marca</span>
                            <input type="text" name="brand" placeholder="Ex: LS2, AGV, Norisk">
                        </label>

                        <label class="form-group">
                            <span>Garantia</span>
                            <input type="text" name="warranty" placeholder="Ex: 12 meses">
                        </label>

                        <label class="form-group">
                            <span>Disponibilidade</span>
                            <input type="text" name="availability" placeholder="Ex: Pronta entrega">
                        </label>

                        <label class="form-group">
                            <span>Origem</span>
                            <input type="text" name="origin" placeholder="Ex: Produto original / Nacional">
                        </label>
                    </div>
                </section>
            </div>

            <!-- COLUNA DIREITA -->
            <div class="form-column">
                <section class="card">
                    <h2 class="card-title">Venda, estoque e tamanhos</h2>
                    <p class="card-subtitle">Valores e disponibilidade usados na operação da loja.</p>
                    <hr class="divider">

                    <label class="form-group">
                        <span>Preço (R$) *</span>
                        <input type="text" name="price" placeholder="0,00" required>
                    </label>

                    <!-- Pergunta sobre outros tamanhos -->
                    <div class="form-group">
                        <span>Haverá outros tamanhos?</span>
                        <input type="hidden" name="has_sizes" id="hasSizesInput" value="0">
                        <div class="toggle-group">
                            <button type="button" class="toggle-btn active" data-sizes="0">NÃO</button>
                            <button type="button" class="toggle-btn" data-sizes="1">SIM</button>
                        </div>
                    </div>

                    <!-- Estoque único (quando NÃO tiver tamanhos) -->
                    <label class="form-group" id="singleStockGroup">
                        <span>Estoque *</span>
                        <input type="number" name="stock" id="singleStockInput" min="0" placeholder="0" required>
                    </label>

                    <!-- Tamanhos + estoque por tamanho (quando SIM) -->
                    <div class="sizes-wrapper" id="sizesWrapper" style="display: none;">
                        <div class="sizes-header">
                            <span>Tamanhos e estoque</span>
                            <button type="button" id="btnAddSize" class="btn-add-size">+ ADICIONAR TAMANHO</button>
                        </div>
                        <div id="sizesList" class="sizes-list"></div>
                    </div>

                    <!-- Upload de imagem estilizado -->
                    <div class="form-group" style="margin-top: 20px;">
                        <span>Imagem do produto *</span>
                        <label for="image" class="file-upload-box">
                            <input type="file" name="image" id="image" accept="image/*" class="file-upload-input" required>
                            <span class="file-upload-btn">ESCOLHER IMAGEM</span>
                            <span class="file-upload-name" id="fileNameText">Nenhum arquivo selecionado</span>
                        </label>
                        <img id="imagePreview" class="file-preview" style="display: none;" alt="Prévia da imagem">
                    </div>
                </section>
            </div>
=======
    <header class="page-header">
        <span class="badge">PAINEL ADMINISTRATIVO</span>
        <h1>Novo produto</h1>
        <p>Preencha as informações comerciais e de estoque para manter o catálogo atualizado.</p>
    </header>

    <main>
        <form action="/product" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            
            <section class="card">
                <legend class="card-title">Informações do produto</legend>
                <p class="card-subtitle">Dados principais exibidos no catálogo da loja.</p>
                
                <hr class="divider">
                
                <label class="form-group">
                    <span>Nome do produto *</span>
                    <input type="text" name="name" required>
                </label>

                <label class="form-group">
                    <span>Categoria *</span>
                    <select name="category_id" required>
                        <option value="">Selecione</option>
                        @foreach(\App\Models\Category::all() as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </label>
            </section>

            <section class="card">
                <legend class="card-title">Venda e estoque</legend>
                <p class="card-subtitle">Valores usados na operação da loja.</p>
                
                <hr class="divider">
                
                <label class="form-group">
                    <span>Preço (R$) *</span>
                    <input type="text" name="price" placeholder="0,00" required>
                </label>

                <label class="form-group">
                    <span>Estoque *</span>
                    <input type="number" name="stock" placeholder="0" required>
                </label>

                <label for="image">
                    <span>Imagem do produto *</span>
                    <input type="file" name="image" id="image" accept="image/*" required>
                </label>
            </section>
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01

            <footer class="form-actions">
                <nav class="actions-container">
                    <a href="/product" class="btn btn-cancel">CANCELAR</a>
                    <button type="submit" class="btn btn-submit">CRIAR PRODUTO</button>
                </nav>
            </footer>
        </form>
    </main>

<<<<<<< HEAD
    <script>
        // Toggle de tamanhos
        const toggleButtons = document.querySelectorAll('.toggle-btn');
        const hasSizesInput = document.getElementById('hasSizesInput');
        const singleStockGroup = document.getElementById('singleStockGroup');
        const singleStockInput = document.getElementById('singleStockInput');
        const sizesWrapper = document.getElementById('sizesWrapper');
        const sizesList = document.getElementById('sizesList');
        const btnAddSize = document.getElementById('btnAddSize');

        function createSizeRow(sizeValue = '', stockValue = '') {
            const row = document.createElement('div');
            row.className = 'size-row';
            row.innerHTML = `
                <input type="text" name="size_names[]" placeholder="Tamanho (ex: P, M, 58)" value="${sizeValue}" required>
                <input type="number" name="size_stocks[]" min="0" placeholder="Estoque" value="${stockValue}" required>
                <button type="button" class="btn-remove-size" title="Remover tamanho">✕</button>
            `;
            row.querySelector('.btn-remove-size').addEventListener('click', () => {
                row.remove();
            });
            sizesList.appendChild(row);
        }

        toggleButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const useSizes = btn.dataset.sizes === '1';
                hasSizesInput.value = useSizes ? '1' : '0';

                toggleButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                if (useSizes) {
                    singleStockGroup.style.display = 'none';
                    singleStockInput.removeAttribute('required');
                    sizesWrapper.style.display = 'block';
                    if (sizesList.children.length === 0) {
                        createSizeRow();
                    }
                } else {
                    singleStockGroup.style.display = 'flex';
                    singleStockInput.setAttribute('required', 'required');
                    sizesWrapper.style.display = 'none';
                    sizesList.innerHTML = '';
                }
            });
        });

        btnAddSize.addEventListener('click', () => createSizeRow());

        // Preview e nome do arquivo no upload
        const imageInput = document.getElementById('image');
        const fileNameText = document.getElementById('fileNameText');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                fileNameText.textContent = file.name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileNameText.textContent = 'Nenhum arquivo selecionado';
                imagePreview.style.display = 'none';
            }
        });
    </script>
=======
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
</body>
</html>