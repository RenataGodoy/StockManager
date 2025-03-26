@extends('Layouts.app')

@section('content')
    <h1>Relatório de Vendas</h1>

    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade Vendida</th>
            <th>Preço Unitário</th>
            <th>Valor Total</th>
            <th>Data da Venda</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->produto->nome }}</td>
                <td>{{ $venda->quantidade_vendida }}</td>
                <td>{{ $venda->preco_unitario }}</td>
                <td>{{ $venda->valor_total }}</td>
                <td>{{ $venda->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
