<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Crear Reseña</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Publicar Reseña</h1>
        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            <span id="nombre-usuario" class="nombre-usuario">Hola, {{ Auth::user()->name }}</span>
            <form method="POST" action="/api/logout">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Salir</button>
            </form>
        </div>
    </header>
    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('/videojuegos') }}">Videojuegos</a></li>
            <li><a href="{{ url('/perfil') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reseñas') }}">Reseñas</a></li>
        </ul>
    </nav>

    <main>
        <section class="contenedor-perfil">
            <h2>Publicar Nueva Reseña</h2>
            <form id="form-review" style="display: flex; flex-direction: column; gap: 15px;">
                @csrf
                <label>Videojuego:</label>
                <select id="game_id" name="game_id" required>
                    @foreach($videojuegos as $juego)
                        <option value="{{ $juego->id }}">{{ $juego->name }}</option>
                    @endforeach
                </select>

                <label>Título:</label>
                <input type="text" id="title" name="title" required>

                <label>Puntuación (1-5):</label>
                <input type="number" id="evaluation" name="evaluation" min="1" max="5" value="5" required>

                <label>Tu opinión:</label>
                <textarea id="contenido" name="contenido" rows="5" required></textarea>

                <button type="submit" class="btn-tab activa">Enviar Reseña</button>
            </form>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>