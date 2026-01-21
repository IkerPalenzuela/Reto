<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: {{ Auth::check() ? 'block' : 'none' }};">☰</div>
        
        <h1>Inicio</h1>

        @guest
            <div class="botones-auth" id="caja-botones-auth" style="display: flex;">
                <a href="/login" class="btn-login">Iniciar Sesión</a>
                <a href="/register" class="btn-register">Registrar</a>
            </div>
        @endguest

        @auth
            <div class="usuario-info" id="caja-usuario-info" style="display: flex; align-items: center; gap: 10px;">
                <span id="nombre-usuario" style="color: white; font-weight: bold;">
                    Hola, {{ Auth::user()->name }}
                </span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" id="btn-logout" class="btn-login" style="background-color: #ef4444; border:none; cursor:pointer;">
                        Salir
                    </button>
                </form>
            </div>
        @endauth
    </header>

    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('/games') }}">Videojuegos</a></li>
            <li><a href="{{ url('/profile') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reviews') }}">Reseñas</a></li>
        </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>Somos una plataforma digital dedicada al almacenamiento e información de videojuegos...</p>
        </section>

        <section class="carrusel-container">
            <div class="carrusel-slide">
                <img src="img/banner1.jpg" class="imagen-carrusel activa" alt="Elden Ring">
            </div>
            <button class="btn-prev" onclick="moverCarrusel(-1)"><</button>
            <button class="btn-next" onclick="moverCarrusel(1)">></button>
        </section>

        <section class="seccion-reseñas">
            <div id="contenedor-reseñas" class="lista-reseñas">
                <div class="spinner" role="search" aria-label="Cargando reseñas"></div>
            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2024 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>