<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Código</title>
</head>
<body>
    <h1>Ingresar Código</h1>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    <form action="{{ route('password.verify.code') }}" method="POST">
        @csrf
        <label for="code">Código de Recuperación:</label>
        <input type="text" name="codigo" id="code" maxlength="6" required>
        <input type="hidden" name="correo" value="{{ session('correo') }}">
        <button type="submit">Verificar Código</button>
    </form>
</body>
</html>
