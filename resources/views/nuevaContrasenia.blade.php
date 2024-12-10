<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
</head>
<body>
    <h1>Restablecer Contraseña</h1>
    <form action="{{ route('password.update.custom') }}" method="POST">
        @csrf
        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <input type="hidden" name="email" value="{{ session('email') }}">
        <button type="submit">Actualizar Contraseña</button>
    </form>
</body>
</html>
