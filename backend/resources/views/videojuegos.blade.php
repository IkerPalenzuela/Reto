<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Catálogo de Videojuegos</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Catálogo de Videojuegos</h1>

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
        <section class="intro-texto">
            <p>Explora nuestro catálogo. Usa las pestañas para filtrar por plataforma.</p>
        </section>

        <section class="contenedor-perfil">
            <h2 style="margin-bottom: 20px;">Lista de Videojuegos</h2>
            
            <div class="tabs-filtro" style="text-align: center; margin-bottom: 20px;">
                <button onclick="filtrarPlataforma('todas', this)" class="btn-tab activa">Todas</button>
                <button onclick="filtrarPlataforma('PC', this)" class="btn-tab">PC</button>
                <button onclick="filtrarPlataforma('PlayStation 5', this)" class="btn-tab">PS5</button>
                <button onclick="filtrarPlataforma('Nintendo Switch', this)" class="btn-tab">Switch</button>
                <button onclick="filtrarPlataforma('Xbox Series X', this)" class="btn-tab">Xbox</button>
            </div>

            <table style="width:100%; border-collapse: collapse; background: white; color: black;">
                <thead style="background-color: #333; color: white;">
                    <tr>
                        <th style="padding: 10px; border: 1px solid #ddd;">Imagen</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Videojuego</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Empresa</th>
                        <th style="padding: 10px; border: 1px solid #ddd;">Plataformas</th>
                    </tr>
                </thead>
                <tbody id="tabla-videojuegos">
                    @foreach($videojuegos as $juego)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <img src="{{ $juego->img }}" alt="{{ $juego->name }}" style="width: 80px; height: auto; border-radius: 5px;">
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><strong>{{ $juego->name }}</strong></td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $juego->company->name ?? 'Sin empresa' }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            @foreach($juego->platforms as $plataforma)
                                <span class="badge-plataforma">{{ $plataforma->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>