@extends('Layouts.app')

@section('content')
    <h1>Cadastrar Produto</h1>

    <form method="POST" action="{{ route('produtos.store') }}">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" required><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
@endsection
