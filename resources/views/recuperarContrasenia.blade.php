<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <h1>Recuperar Contraseña</h1>
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="correo" id="email" required>
        @error('correo')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Enviar Código</button>
    </form>
</body>
</html>
