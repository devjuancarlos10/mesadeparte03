<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/iniciarsesion.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/images/logoUncp.png')}}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/bcbc7e64e4.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <img src="{{asset('assets/images/logoUncp.png')}}" class="logoUncp" alt="" srcset="">
        <h1>Mesa de Partes - UNCP</h1>
    </nav>
    <div class="contenedorFormIniciarSesion">
        <form method="POST" action="{{ route('login') }}" class="formularioIniciarSesion" id="loginForm">
            @csrf
            <h3 class="tituloIniciarSesion"><hr>Iniciar Sesión<hr></h3>
            <input type="email" name="correo" placeholder="Correo Electrónico" required class="inputCorreo">
            <div class="boxInputContrasenia">
                <input type="password" name="contrasenia" placeholder="Contraseña" required class="inputContrasenia">
                <i class="fa-solid fa-eye-slash"></i>
                <i class="fa-solid fa-eye"></i>
            </div>
            <button type="submit" class="btnIniciarSesion">Iniciar Sesión</button>
            <p class="cajaOlvidoContrasenia">
                <a href="{{ route('password.email.view') }}">¿Te olvidaste tu contraseña?</a>
            </p>
            <p class="cajaCrearCuenta">
                ¿No tienes una cuenta? <a href="{{ route('registro.correo') }}">Crear una</a>
            </p>
        </form>        
    </div>
    <script src="{{ asset('js/iniciarsesion.js') }}"></script>
</body>
</html>
