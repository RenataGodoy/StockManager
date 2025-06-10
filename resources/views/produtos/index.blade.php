@extends('Layouts.app')

@section('content')
    @vite('resources/css/app.css')

    <style>

        /* Estilo para os botões */


        .btn-editar {
            background-color: #4CAF50; /* verde */
            color: white;
        }

        .btn-inativar {
            background-color: #f44336; /* vermelho */
            color: white;
        }

        /* Estilo para o cabeçalho */
        .logo-texto {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Estilo para o título da lista */
        h1 {
            margin-top: 20px;
            font-size: 22px;
        }

        /* Estilo para o link de cadastro */
        a.btn-cad {
            display: inline-block;
            margin: 10px 0;
            padding: 8px 16px;
            background-color: #8951b0;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #201738;
        }
    </style>

    <div class="logo-texto">ESTOCAAÍ</div>

    <div class="lista">
        <h1>Lista de Produtos</h1>
        @if(session('success'))
            <div style="color: green;">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="btn-cad"><a href="{{ route('produtos.create') }}">Cadastrar Produto</a></div>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Status</th>
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
                    <td>{{ $produto->status }}</td>
                    <td>
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-editar">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-inativar">Inativar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
