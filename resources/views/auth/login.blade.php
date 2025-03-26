<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Login de Estabelecimento</h1>

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div style="color: red;">
        <p>{{ session('error') }}</p>
    </div>
@endif

@if(session('success'))
    <div style="color: green;">
        <p>{{ session('success') }}</p>
    </div>
@endif

<form method="POST" action="{{ url('/login') }}">
    @csrf
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" required><br><br>

    <button type="submit">Entrar</button>
</form>

</body>
</html>
