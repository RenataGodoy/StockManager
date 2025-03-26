<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstocAI - Sistema de Gerenciamento de Estoque</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Início</a></li>
            <li><a href="{{ route('produtos.create') }}">Cadastrar produtos</a></li>
            <li><a href="{{ route('produtos.index') }}">Produtos</a></li>
            <li><a href="{{ route('vendas.index') }}">Vender</a></li>
            <li><a href="{{ route('vendas.relatorio') }}">Relatorio de vendas</a></li>
            <li><a href="">Sair</a></li>
        </ul>
    </nav>
</header>

<main>
    @yield('content')  <!-- Aqui vai o conteúdo da página específica -->
</main>

<footer>
    <p>&copy; 2025 EstocAI - Todos os direitos reservados a Renata Godoy</p>
</footer>
</body>
</html>
