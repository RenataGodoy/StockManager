@extends('Layouts.app')


@section('content')
    @vite('resources/css/app.css')
    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif
    <div class="logo-texto">ESTOCAAÍ</div>

    <div class="container-branco">
        <h1>Cadastrar Produto</h1>

        <form method="POST" action="{{ route('produtos.store') }}" class="form-container" onsubmit="return confirm('Tem certeza que deseja criar este produto?');">
            @csrf

            <label for="codigo">Código:</label>
            <input
                type="text"
                name="codigo"
                id="codigo"
                placeholder="Digite o código"
                required
            >

            <label for="nome">Nome:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                placeholder="Digite o nome do produto"
                required
            >

            <label for="descricao">Descrição:</label>
            <textarea
                name="descricao"
                id="descricao"
                placeholder="Digite a descrição do produto"
                required
            ></textarea>

            <label for="tipo">Tipo:</label>
            <input
                type="text"
                name="tipo"
                id="tipo"
                placeholder="Digite o tipo de produto"
                required
            >

            <label for="marca">Marca:</label>
            <input
                type="text"
                name="marca"
                id="marca"
                placeholder="Digite a marca do produto"
                required
            >

            <label for="preco">Preço:</label>
            <input
                type="number"
                name="preco"
                id="preco"
                step="0.01"
                placeholder="0,00"
                required
            >

            <label for="quantidade">Quantidade:</label>
            <input
                type="number"
                name="quantidade"
                id="quantidade"
                placeholder="0"
                required
            >

            <div class="button-container">
                <button type="submit" class="btn btn-submit">Cadastrar</button>
                <button type="reset" class="btn btn-reset">Cancelar</button>
            </div>
        </form>
    </div>


@endsection
<style>
    background-color:rgba(50, 2, 73, 0.7);
</style>
