@extends('Layouts.app')

@section('content')
    <h1>Editar Produto</h1>

    <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $produto->nome }}" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required>{{ $produto->descricao }}</textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" value="{{ $produto->preco }}" step="0.01" required><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" value="{{ $produto->quantidade }}" required><br><br>

        <button type="submit">Atualizar</button>
    </form>
@endsection
