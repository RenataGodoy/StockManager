<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EstocAI - Sistema de Gerenciamento de Estoque</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<!-- BOTÃƒO HAMBURGER -->
<button class="menu-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- OVERLAY -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>ESTOCAAI</h2>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <h4>Principal</h4>
            <div class="menu-item">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Inicio
                </a>
            </div>
        </div>

        @guest
            <div class="menu-section">
                <h4>Acesso</h4>
                <div class="menu-item">
                    <a href="{{ url('/login') }}" class="{{ request()->is('login') ? 'active' : '' }}">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('/register') }}" class="{{ request()->is('register') ? 'active' : '' }}">
                        <i class="fas fa-user-plus"></i> Cadastrar
                    </a>
                </div>
            </div>
        @endguest

        @auth
            <div class="menu-section">
                <h4>Gerenciamento</h4>
                <div class="menu-item">
                    <a href="{{ route('produtos.create') }}" class="{{ request()->is('produtos/create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> Cadastrar Produtos
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('produtos.index') }}" class="{{ request()->routeIs('produtos.index') ? 'active' : '' }}">
                        <i class="fas fa-box"></i> Produtos
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('vendas.index') }}" class="{{ request()->routeIs('vendas.index') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Vender
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('vendas.relatorio') }}" class="{{ request()->routeIs('vendas.relatorio') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i> Relatório de Vendas
                    </a>
                </div>
            </div>
        @endauth
    </div>

    @auth
        <div class="user-section">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div>{{ auth()->user()->nome }}</div>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </form>
        </div>
    @endauth
</nav>

<!-- CONTEÃšDO PRINCIPAL -->
<main class="main-content">
    <div class="content-header">
        <h1>Sistema de Gerenciamento de Estoque</h1>
    </div>

    @yield('content')

    <footer style="margin-top: 40px; padding: 20px; text-align: center; color: #666; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <p>&copy; 2025 EstocAI - Todos os direitos reservados a Renata Godoy</p>
    </footer>
</main>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.querySelector('.sidebar-overlay').classList.toggle('active');
    }

    // Fechar ao clicar fora (mobile)
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.querySelector('.menu-toggle');

        if (!sidebar.contains(e.target) && !toggle.contains(e.target) && window.innerWidth < 768) {
            sidebar.classList.remove('active');
            document.querySelector('.sidebar-overlay').classList.remove('active');
        }
    });

    // Ajustar no redimensionamento
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            document.getElementById('sidebar').classList.remove('active');
            document.querySelector('.sidebar-overlay').classList.remove('active');
        }
    });
</script>
</body>
</html>


<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f5f5;
    }

    .sidebar {
        background-color: #f0eef5;
        width: 220px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        padding-top: 1.5rem;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
        z-index: 999;
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar-header {
        text-align: center;
        margin-bottom: 2rem;
        color: #322030;
        font-weight: bold;
        font-size: 1rem;
    }

    .sidebar-menu ul {
        list-style: none;
        padding-left: 0;
    }

    .sidebar-menu li {
        margin-bottom: 0.8rem;
        text-align: center;
    }

    .sidebar-menu a {
        text-decoration: none;
        color: #322030;
        padding: 0.5rem 1.2rem;
        display: inline-block;
        border-radius: 15px;
        transition: 0.3s ease;
        font-weight: 500;
    }

    .sidebar-menu a:hover {
        background-color: #36044f;
        color: #322030;
    }

    .sidebar-menu a.active {
        background-color: #725b75;
        color: #000000;
    }
    .menu-section h4 {
        color: rgba(50, 2, 73, 0.7); font-size: 0.8rem; text-transform: uppercase;
        margin: 0 20px 10px; font-weight: 600; letter-spacing: 0.5px;
    }
    .menu-item a {
        display: flex; align-items: center; padding: 12px 20px;
        color: #26024f; text-decoration: none; transition: 0.3s ease;
    }
    .menu-item a:hover { background: rgba(255,255,255,0.1); transform: translateX(5px); }
    .menu-item a.active { background: rgba(98, 73, 208, 0.63); border-right: 3px solid #4b09ad; }
    .menu-item a i { width: 20px; margin-right: 15px; font-size: 1.1rem; }

    /* USER SECTION */
    .user-section {
        position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;
        background: rgba(0,0,0,0.2); border-top: 1px solid rgba(255,255,255,0.1);
    }
    .user-info { display: flex; align-items: center; margin-bottom: 15px; }
    .user-avatar {
        width: 40px; height: 40px; background: rgba(255,255,255,0.2);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin-right: 12px;
    }
    .logout-btn {
        width: 100%; padding: 8px 12px; background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2); color: white; border-radius: 4px;
        cursor: pointer; transition: 0.3s ease; font-size: 0.9rem;
    }
    .logout-btn:hover { background: rgba(255,255,255,0.2); }

    /* HAMBURGER */
    .menu-toggle {
        position: fixed; top: 20px; left: 20px; z-index: 1001;
        background: #667eea; border: none; color: white; padding: 12px;
        border-radius: 6px; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .menu-toggle:hover { background: #764ba2; }

    /* OVERLAY */
    .sidebar-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5); z-index: 999; opacity: 0; visibility: hidden;
        transition: 0.3s ease;
    }
    .sidebar-overlay.active { opacity: 1; visibility: visible; }

    /* MAIN CONTENT */
    .main-content { margin-left: 0; padding: 80px 20px 20px; min-height: 100vh; }
    .content-header {
        background: #68448d; padding: 20px; border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 20px;
    }

    /* RESPONSIVE */
    @media (min-width: 768px) {
        .sidebar { transform: translateX(0); }
        .menu-toggle { display: none; }
        .sidebar-overlay { display: none; }
        .main-content { margin-left: 250px; padding: 20px; }
    }
</style>
