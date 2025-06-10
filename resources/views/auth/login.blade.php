@extends('Layouts.app')


@section('content')
</head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
    body{ background-color: #68448d;}
        /* MAIN CONTENT */
        .main-content {
            margin-left: 220px; /* isso compensa a largura da sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            width: calc(100% - 220px);
            min-height: 100vh;
            flex-direction: column;
        }


        .login-wrapper {
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .content-header {
            background: #68448d;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        /* RESPONSIVE */
        @media (min-width: 768px) {
            .sidebar { transform: translateX(0); }
            .menu-toggle { display: none; }
            .sidebar-overlay { display: none; }
            .main-content { margin-left: 250px; padding: 20px; }
        }

        /* LOGO */
        .logo-texto {
            font-family: 'Arial Black', Impact, sans-serif;
            font-style: italic;
            font-weight: 900;
            font-size: 2.2rem;
            text-align: center;
            color: #fcfdeb;
            margin: 2rem auto 1rem;
            text-transform: uppercase;
            width: 100%;
        }

        .container-branco {
            background-color: #fcfdeb;
            border-radius: 20px;
            padding: 2rem;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            color: #322030;
            text-align: center;
        }

        .container-branco h1 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-family: 'Zing Rust Base', sans-serif;
        }

        label {
            font-weight: bold;
            color: #000;
            display: block;
            margin-bottom: 0.3rem;
            text-align: center;
        }

        input {
            background-color: #322030;
            color: #fcfdeb;
            border: none;
            border-radius: 20px;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            text-align: center;
            width: 100%;
            margin-bottom: 1rem;
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
        }

        button:hover {
            background-color: #563d5f;
        }

        p a {
            color: #705972;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        .erro, .sucesso {
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }

        .erro { color: red; }
        .sucesso { color: green; }
    </style>


<body>
    <!-- Conteúdo principal -->
    <div class="main-content">
        <div class="login-wrapper">
            <div class="logo-texto">ESTOCAAÍ</div>

            <div class="container-branco">
                <h1>Login de Estabelecimento</h1>

                @if($errors->any())
                    <div class="erro">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="erro">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if(session('success'))
                    <div class="sucesso">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Digite o email" value="{{ old('email') }}" required>

                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" placeholder="Digite a senha" required>

                    <button type="submit">Entrar</button>
                </form>

                <p>Ainda não tem conta? <a href="{{ url('/register') }}">Cadastre-se aqui</a></p>
            </div>
        </div>
    </div>
</body>

@endsection
