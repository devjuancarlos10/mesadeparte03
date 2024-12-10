<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="{{ asset('css/verificarCodigo.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoUncp.png') }}" type="image/x-icon">
</head>
<body>
    <nav>
        <img src="{{ asset('assets/images/logoUncp.png') }}" class="logoUncp" alt="" srcset="">
        <h1>Mesa de Partes - UNCP</h1>
    </nav>

    <div class="contenedorFormRegistro">
        <form method="POST" action="{{ route('verificar.codigo') }}" class="formularioCodigo">
            @csrf
            <h3 class="tituloCrearCuenta"><hr>Crear cuenta<hr></h3>
            <p class="textCorreo">Inserte el código que recibió en su correo</p>
            
            <div class="box_digit_input">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo1">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo2">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo3">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo4">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo5">
                <input type="text" name="codigo[]" maxlength="1" class="digit-input" required id="codigo6">
            </div>

            <div id="timer" class="timer">
                Reenviar en <span id="countdown">60</span> segundos
            </div>
            <div class="contenedorBtnRegistro">
                <button type="submit" id="btnValidar" class="btnValidar">Validar</button>
            </div>
        </form>
        <p id="mensajeValidacion" class="hidden"></p> <!-- Mensaje de validación -->
        <p id="mensajeError" class="hidden"></p>
        <div id="resend-container" class="hidden">
            <form method="POST" action="{{ route('enviar.codigo') }}">
                @csrf
                <input type="hidden" name="correo" value="{{ session('correo') }}">
                <button type="submit" class="btnReenviar">Reenviar código</button>
            </form>
        </div>
    </div>
    <script>
       const rutaVerificarCodigo = "{{ route('verificar.codigo') }}";
       const rutaRegistrarDatos = "{{ route('registro.datos') }}";
    </script>
    <script src="{{asset('js/verificarCodigo.js')}}"></script>
</body>
</html>
