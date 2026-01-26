<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        
        <h1>Inicio</h1>

        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            <span id="nombre-usuario" class="nombre-usuario">
                Hola, {{ Auth::user()->name }}
            </span>
            
            <form method="POST" action="/api/logout">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">
                    Salir
                </button>
            </form>
        </div>
    </header>

    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="/videojuegos.html">Videojuegos</a></li>
            <li><a href="/perfil.html">Editar Perfil</a></li>
            <li><a href="/reseñas.html">Reseñas</a></li>
        </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>
                Somos una plataforma digital dedicada al almacenamiento e información de videojuegos. 
                Aquí podrás consultar fichas técnicas detalladas y leer o publicar reseñas para compartir tu opinión con la comunidad.
            </p>
        </section>

        <section class="carrusel-container">
            <div class="carrusel-slide">
                <img src="{{ asset('img/banner1.jpg') }}" class="imagen-carrusel activa" alt="Elden Ring">
                <img src="{{ asset('img/banner2.jpg') }}" class="imagen-carrusel" alt="Cyberpunk 2077">
                <img src="{{ asset('img/banner3.jpg') }}" class="imagen-carrusel" alt="Red Dead Redemption 2">
                <img src="{{ asset('img/banner4.jpg') }}" class="imagen-carrusel" alt="Black Myth: Wukong">
                <img src="{{ asset('img/banner5.jpg') }}" class="imagen-carrusel" alt="God of War">
                <img src="{{ asset('img/banner6.jpg') }}" class="imagen-carrusel" alt="Baldurs Gate 3">
                <img src="{{ asset('img/banner7.jpg') }}" class="imagen-carrusel" alt="Spider-Man">
            </div>
            <button class="btn-prev" onclick="moverCarrusel(-1)"><</button>
            <button class="btn-next" onclick="moverCarrusel(1)">></button>
        </section>

        <section class="seccion-reseñas">
            <div class="tabs-filtro" style="text-align: center; margin-bottom: 20px;">
                <button onclick="cargarReseñas()" class="btn-tab">Todas</button>
                <button onclick="filtrarMejores()" class="btn-tab">Mejores Valoradas (5⭐)</button>
            </div>

            <div id="contenedor-reseñas" class="lista-reseñas">
                <div class="spinner" role="search" aria-label="Cargando reseñas"></div>
            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script>
        // Esta variable es vital para que app.js sepa que hay login
        window.usuarioActual = "{{ Auth::user()->name }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>