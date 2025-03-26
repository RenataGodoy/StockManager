@extends('Layouts.app')

@section('content')
    <h1>Venda de Produtos</h1>

    @if(session('success'))
        <div style="color: green;">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div style="color: red;">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade em Estoque</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->preco }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td>
                    <form action="{{ route('vendas.store', $produto->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantidade_vendida" min="1" max="{{ $produto->quantidade }}" required>
                        <button type="submit">Vender</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
