<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/crearContrasenia.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoUncp.png') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/bcbc7e64e4.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <img src="{{ asset('assets/images/logoUncp.png') }}" class="logoUncp" alt="Logo UNCP">
        <h1>Mesa de Partes - UNCP</h1>
    </nav>
    <div class="contenedorFormRegistro">
        <form id="formCrearContrasenia" class="formularioRegistro" method="POST" action="{{ route('crear.contrasenia')}}">
            @csrf
            <h3 class="tituloCrearCuenta"><hr>Crear Contraseña<hr></h3>
            <div class="campoGrupo">
                <label for="contrasenia" class="labelCampo">Contraseña:</label>
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Ingresa tu contraseña" required class="inputCampo" onkeyup="validarContrasenia()">
                <div id="lineaSeguridad" class="lineaSeguridad">
                    <div id="progresoSeguridad" class="progresoSeguridad"></div>
                </div>
                <div id="mensajeSeguridad" class="mensajeSeguridad"></div>
            </div>
            <div class="campoGrupo">
                <label for="confirmar_contrasenia" class="labelCampo">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contrasenia" name="contrasenia_confirmation" placeholder="Confirma tu contraseña" required class="inputCampo" onkeyup="validarCoincidencia()">
                <div id="mensajeCoincidencia" class="mensajeCoincidencia"></div>
                <ul id="criteriosFaltantes" class="criteriosFaltantes"></ul> <!-- Lista de criterios faltantes -->
            </div>

            <div class="contenedorBtnRegistro">
                <input type="submit" value="Crear cuenta"  id="btnCrearCuenta" class="btnValidar">
                
            </div>
        </form>
    </div>
    <script src="{{ asset('js/crearContrasenia.js') }}"></script>
</body>
</html>
