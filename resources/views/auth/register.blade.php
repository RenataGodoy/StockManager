<!DOCTYPE html>
<html lang="pt-br">
<head>
    @vite('resources/css/app.css')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #322030;
            color: #fcfdeb;
        }

        .container-branco {
            background-color: #fcfdeb;
            border-radius: 20px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            margin: 3rem auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }

        .container-branco h1 {
            font-size: 1.8rem;
            color: #322030;
            margin-bottom: 1.5rem;
            font-family: 'Zing Rust Base', sans-serif;
        }

        label {
            font-weight: bold;
            color: #000000;
            text-align: center;
            display: block;
            margin: 0.3rem 0 0.2rem 0;
            font-size: 0.95rem;
        }

        input {
            background-color: #322030;
            color: #fcfdeb;
            border: none;
            border-radius: 20px;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 0.2rem; /* Reduzido */
        }

        input::placeholder {
            color: #ccc;
        }

        button {
            background-color: #705972;
            color: #fcfdeb;
            border: none;
            border-radius: 20px;
            padding: 0.7rem 1.5rem;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.95rem;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #563d5f;
        }

        .erro, .sucesso {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .erro {
            color: red;
        }

        .sucesso {
            color: green;
        }

        p {
            color: #322030;
            margin-top: 1rem;
        }

        p a {
            color: #705972;
            font-weight: bold;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
        .login-link {
             margin-top: 1.5rem;
             font-size: 0.95rem;
             color: #322030;
         }

        .btn-entre {
            display: inline-block;
            margin-left: 0.5rem;
            background-color: #705972;
            color: #fcfdeb;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .btn-entre:hover {
            background-color: #563d5f;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
<div class="logo-texto">ESTOCAAÍ</div>

<div class="container-branco">
    <h1>Cadastro de Estabelecimento</h1>

    {{-- Exibir erros de validação --}}
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Exibir mensagem de sucesso --}}
    @if(session('success'))
        <div style="color: green;">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <label style="color: #000000; for="nome">Nome:</label>
        <input style="color: #000000; type="text" name="nome" id="nome" " placeholder="Digite o nome" value="{{ old('nome') }}" required><br><br>

        <label style="color: #000000; for="email">E-mail:</label>
        <input style="color: #000000; type="email" name="email" id="email"  placeholder="Digite o Email" value="{{ old('email') }}" required><br><br>

        <label style="color: #000000; for="cnpj">CNPJ:</label>
        <input style="color: #000000; type="text" name="cnpj" id="cnpj" placeholder="Digite o CNPJ "value="{{ old('cnpj') }}" required><br><br>

        <label style="color: #000000; for="nome_empresa">Nome da Empresa:</label>
        <input style="color: #000000; type="text" name="nome_empresa" id="nome_empresa" placeholder="Digite o nome da empresa" value="{{ old('nome_empresa') }}" required><br><br>

        <label style="color: #000000; for="telefone">Telefone:</label>
        <input style="color: #000000; type="text" name="telefone" id="telefone" placeholder="Digite o telefome" value="{{ old('telefone') }}" required><br><br>

        <label style="color: #000000; for="password">Senha:</label>
        <input style="color: #000000; type="password" name="password" id="password" placeholder="Digite a senha" required><br><br>

        <label style="color: #000000; for="password_confirmation">Confirmar Senha:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme a senha" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <div class="login-link">
        Já tem login?
        <a href="{{ url('/login') }}" class="btn-entre">Entre aqui</a>
    </div>
</div>
</body>
</html>
