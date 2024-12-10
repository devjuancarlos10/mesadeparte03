<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="{{ asset('css/correo.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoUncp.png') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/bcbc7e64e4.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <img src="{{ asset('assets/images/logoUncp.png') }}" class="logoUncp" alt="" srcset="">
        <h1>Mesa de Partes - UNCP</h1>
    </nav>
    
    <div class="contenedorFormRegistro">
        <form id="formRegistro" class="formularioRegistro" method="POST" action="{{route('enviar.codigo')}}">
            @csrf
            <h3 class="tituloCrearCuenta"><hr>Crear cuenta<hr></h3>
            <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required class="inputCorreo">
            <p id="mensajeAdvertencia" class="advertenciaSegundos">Enviar código (60 segundos)</p>
            <div class="contenedorBtnRegistro">
                <button type="submit" id="btnValidar" class="btnValidar">Validar</button>
            </div>
        </form>
    </div>

    <!-- Loader -->
    <div class="loader" id="loader"></div>
    <div class="loader-text" id="loaderText">Enviando código...</div>
    <script>
        const verificarCorreoUrl = "{{ route('verificar.correo') }}";
        const enviarCodigoUrl = "{{ route('enviar.codigo') }}";
        const rutaVerificarCodigo = "{{ route('verificar.codigo') }}";  
        const rutaCorreo = "{{ route('registro.correo') }}";  
    </script>
    <script src="{{asset('js/correo.js')}}"></script>
</body>
</html>
