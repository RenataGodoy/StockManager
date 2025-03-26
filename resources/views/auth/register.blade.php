<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<h1>Cadastro de Estabelecimento</h1>

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ url('/register') }}">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required><br><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="password_confirmation">Confirmar Senha:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

@if(session('success'))
    <div style="color: green;">
        <p>{{ session('success') }}</p>
    </div>
@endif

</body>
</html>
