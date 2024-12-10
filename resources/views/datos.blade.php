<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/registroDatos.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logoUncp.png') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/bcbc7e64e4.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <img src="{{ asset('assets/images/logoUncp.png') }}" class="logoUncp" alt="">
        <h1>Mesa de Partes - UNCP</h1>
    </nav>
    
    <div class="contenedorFormRegistro">
        <form id="formRegistro" class="formularioRegistro" method="POST" action="{{ route('registro.datos') }}">
            @csrf
            <h3 class="tituloCrearCuenta"><hr>Registro de Usuario<hr></h3>
            
            <!-- Campos del formulario -->
            <input type="text" id="nombre" name="nombres" placeholder="Nombre" required class="inputCampo">
            <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required class="inputCampo">
            
            <div class="campoGrupo">
                <label for="fechaNacimiento" class="labelCampo">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fechaNacimiento" required class="inputCampo">
            </div>
            
            <div class="campoGrupo">
                <label for="genero" class="labelCampo">Género:</label>
                
                <select id="genero" name="genero" required class="inputCampo" required>
                    <option value="">Seleccione su género</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            
            <div class="contenedorBtnRegistro">
                <button type="submit" id="btnRegistrar" class="btnValidar">Siguiente</button>
            </div>
        </form>
    </div>
</body>
</html>
