@extends('Layouts.app')

@section('content')
    <title>Estocaaí - Início</title>

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #322030;
            color: #fcfdeb;
        }
        .logo {
            font-family: 'Arial Black', Impact, sans-serif;
            font-style: italic;
            font-weight: 900;
            font-size: 2.5rem;
            color: #322030;
            text-shadow: 2px 2px #000;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3rem 5%;
            background-color: #322030;
        }

        .main-text {
            max-width: 50%;
        }

        .main-text h1 {
            font-size: 2.5rem;
            line-height: 1.3;
            color: #fcfdeb;
            text-shadow: 2px 2px #000;
        }

        .btn-cadastrar {
            margin-top: 30px; /* Adiciona espaço entre o texto e o botão */
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            background-color: transparent;
            border: 2px solid #fcfdeb;
            border-radius: 30px;
            color: #fcfdeb;
            cursor: pointer;
        }

        .btn-cadastrar:hover {
            background-color: #fcfdeb;
            color: #322030;
        }

        image-container img {
            width: 120%; /* Aumenta o tamanho da imagem */
            max-width: 700px; /* Tamanho máximo para evitar exageros */
            border-radius: 15px; /* Mantém as bordas arredondadas */
        }
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .main-text, .image-container {
                max-width: 200%;
            }

            .image-container img {
                width: 700%;
            }
        }
    </style>
    </head>
    <body>



    <main class="main-content">
        <div class="main-text">
            <h1>Bem vindo ao melhor <br>gerenciador de estoque<br> e venda do Brasil</h1>
            <button class="btn-cadastrar" onclick="window.location.href='{{ url('/register') }}'">CADASTRE SUA EMPRESA!</button>
        </div>
        <div class="image-container">
            <img src="https://blog.dellys.com.br/wp-content/uploads/2022/09/controle-de-estoque-topo.jpg" alt="Pessoa com caixas">
        </div>
    </main>

    </body>



@endsection
