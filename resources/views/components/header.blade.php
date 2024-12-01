<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/variable.css') }}">
<header class="header">
    <!-- Sección izquierda -->
    <div class="header__list left">
        <i class="fa-solid fa-bars header__icon" id="hamburger-icon"></i>
        <img src="{{ asset('assets/images/logoUncp.png') }}" alt="Logo UNCP" class="header__logo">
    </div>

    <!-- Sección derecha -->
    <div class="header__list right">
        <span class="header__username">Nombre de usuario</span>
        <i class="fa-regular fa-user header__icon"></i>
    </div>
</header>