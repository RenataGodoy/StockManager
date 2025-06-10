@extends('layouts.app')

@section('title', 'Editar Produto')
    {{-- Início do CSS embutido (somente para teste rápido) --}}

@section('content')
    <style>
        body {
            background-color: #322030;
            color: #fcfdeb;
        }
        .container-branco {
            background-color: #fcfdeb;
            border-radius: 20px;
            width: 320px;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
            margin: 2rem auto;
        }
        .container-branco h1 {
            background-color: #322030;
            color: #fcfdeb;
            border-radius: 10px 10px 0 0;
            margin: -1.5rem -1.5rem 1rem -1.5rem;
            padding: 0.8rem 0;
            font-size: 1.2rem;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            margin-top: 0.5rem;
        }
        .form-container label {
            font-weight: bold;
            color: #322030;
            text-align: left;
            margin-left: 10px;
            font-size: 0.95rem;
        }
        .form-container input,
        .form-container textarea {
            background-color: #322030;
            border: none;
            border-radius: 20px;
            color: #fcfdeb;
            padding: 0.6rem 1rem;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
            font-size: 1rem;
        }
        .form-container input::placeholder,
        .form-container textarea::placeholder {
            color: #ddd2e0;
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }
        .btn {
            border: none;
            border-radius: 20px;
            padding: 0.7rem 1.3rem;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.95rem;
        }
        .btn-submit {
            background-color: #705972;
            color: #fcfdeb;
        }
        .btn-submit:hover {
            background-color: #563d5f;
        }
        .btn-reset {
            background-color: #ddd2e0;
            color: #322030;
        }
        .btn-reset:hover {
            background-color: #c0b5c0;
        }
    </style>
    @vite('resources/css/app.css')

    <div class="container-branco">
        <div class="logo-texto">ESTOCAAÍ</div>

        <h1>Editar Produto</h1>

        <form method="POST" action="{{ route('produtos.update', $produto->id) }}" class="form-container" onsubmit="return confirm('Tem certeza que deseja editar este produto?');">
            @csrf
            @method('PUT')

            <label for="nome">Nome:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ $produto->nome }}"
                required
            >

            <label for="descricao">Descrição:</label>
            <textarea
                name="descricao"
                id="descricao"
                required
            >{{ $produto->descricao }}</textarea>

            <label for="preco">Preço:</label>
            <input
                type="number"
                name="preco"
                id="preco"
                value="{{ $produto->preco }}"
                step="0.01"
                required
            >

            <label for="quantidade">Quantidade:</label>
            <input
                type="number"
                name="quantidade"
                id="quantidade"
                value="{{ $produto->quantidade }}"
                required
            >

            <div class="button-container">
                <button type="submit" class="btn btn-submit">Atualizar</button>
                <button type="reset" class="btn btn-reset">Cancelar</button>
            </div>
        </form>
    </div>
@endsection

