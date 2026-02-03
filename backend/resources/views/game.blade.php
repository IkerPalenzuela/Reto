<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Catálogo de Videojuegos</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Catálogo de Videojuegos</h1>

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
        </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>Explora nuestro catálogo. Arrastra los juegos a la caja de favoritos o usa las pestañas para filtrar.</p>
        </section>

        <section class="contenedor-perfil">
            <h2 style="margin-bottom: 20px;">Lista de Videojuegos</h2>
            
            <div style="display: flex; gap: 20px; align-items: flex-start;">

                <div style="flex: 1; min-width: 0;">
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
                            @foreach($game as $juego)
                            <tr draggable="true" 
                                class="fila-juego"
                                data-id="{{ $juego->id }}" 
                                data-name="{{ $juego->name }}" 
                                data-img="{{ $juego->img }}"
                                style="cursor: grab;">
                                
                                <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">
                                    <img src="{{ $juego->img }}" alt="{{ $juego->name }}" style="width: 50px; height: auto; border-radius: 5px;">
                                </td>
                                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ $juego->name }}</strong></td>
                                <td style="padding: 8px; border: 1px solid #ddd;">{{ $juego->company->name ?? 'Sin empresa' }}</td>
                                <td style="padding: 8px; border: 1px solid #ddd;">
                                    @foreach($juego->platforms as $plataforma)
                                        <span class="badge-plataforma">{{ $plataforma->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="width: 250px; position: sticky; top: 20px;">
                    <div id="zona-favoritos" class="caja-favoritos">
                        <p style="margin: 0 0 10px 0; font-weight: bold; color: #333;">Favoritos</p>
                        <p id="texto-instruccion" style="margin: 0; color: #888; font-size: 14px;">Arrastra juegos aquí</p>
                        <div id="lista-visual-favoritos" class="grid-favoritos" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;"></div>
                        <button id="btn-guardar-fav" style="display:none; margin-top:10px; cursor:pointer; padding: 6px 12px; background: #333; color: white; border: none; border-radius: 5px;">
                            Guardar Favoritos
                        </button>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>