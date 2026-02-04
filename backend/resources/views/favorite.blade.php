<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Mis Favoritos</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Mis Favoritos</h1>
        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            <span id="nombre-usuario" class="nombre-usuario">Hola, {{ Auth::user()->name }}</span>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Salir</button>
            </form>
        </div>
    </header>

    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('/games') }}">Videojuegos</a></li>
            <li><a href="{{ url('/profile') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reviews') }}">Reseñas</a></li>
            <li><a href="{{ url('/offers') }}">Ofertas API</a></li>
            <li><a href="{{ url('/favorites') }}">Mis Favoritos</a></li>
        </ul>
    </nav>

    <main>
        <section class="contenedor-perfil">
            <h2 style="margin-bottom: 20px;">Mis Juegos Favoritos</h2>

            @if($games->count() > 0)
                <div id="lista-favoritos" style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                    @foreach($games as $game)
                        <div class="tarjeta-favorito" 
                            style="width: 200px; border: 2px solid #ddd; border-radius: 8px; padding: 10px; background: white;">
                            
                            <img src="{{ $game->img }}" 
                                alt="{{ $game->name }}" 
                                style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                            
                            <h4 style="margin: 0; text-align: center; color: #333;">{{ $game->name }}</h4>
                            
                            </div>
                    @endforeach
                </div>
                @else
                <p style="text-align: center; color: #666; padding: 40px;">
                    No tienes juegos favoritos aún. 
                    <a href="{{ url('/games') }}" style="color: #0f3d2e; font-weight: bold;">Ve al catálogo</a> 
                    para añadir algunos.
                </p>
            @endif
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>