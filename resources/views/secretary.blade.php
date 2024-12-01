<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/user.css?v=1') }}">
</head>
<body>
    <!--Cabecera-->
    <x-header></x-header>
    <!--Menu de la derecha-->
    <div class="menu open" id="menu"> 
        <ul>
            <!-- Botón Registrar -->
            <li class="menu-item">
                <a class="button-register">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span class="menu-text">Registrar</span>
                </a>
            </li>
    
            <!-- Ítems del menú -->
            <li class="menu-item">
                <i class="fa-regular fa-envelope"></i>
                <span class="menu-text">Recibidos</span>
            </li>
            <li class="menu-item">
                <i class="fa-regular fa-paper-plane"></i>
                <span class="menu-text">Enviados</span>
            </li>
            <li class="menu-item">
                <i class="fa-regular fa-folder"></i>
                <span class="menu-text">Archivados</span>
            </li>
            <li class="menu-item">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span class="menu-text">Flujo</span>
            </li>
            <li class="menu-item">
                <i class="fa-solid fa-user"></i>
                <span class="menu-text">Asignar</span>
            </li>
        </ul>
    </div>
    
    
    

    <script src="{{asset("js/header.js?v=1'")}}"></script>
</body>
</html>



