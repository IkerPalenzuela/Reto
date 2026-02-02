<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Ofertas</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Ofertas y Descuentos</h1>

        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            @if(Auth::check())
                <span id="nombre-usuario" class="nombre-usuario">Hola, {{ Auth::user()->name }}</span>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" id="btn-logout" class="btn-logout">Salir</button>
                </form>
            @else
                <span class="nombre-usuario">Invitado</span>
            @endif
        </div>
    </header>

    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('/games') }}">Videojuegos</a></li>
            <li><a href="{{ url('/profile') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reviews') }}">Reseñas</a></li>
            <li><a href="{{ url('/offers') }}">Ofertas API</a></li> </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>Busca las mejores ofertas de Steam en tiempo real gracias a la API de CheapShark.</p>
        </section>

        <section class="contenedor-perfil">
            <h2 style="margin-bottom: 20px;">Buscador de Ofertas</h2>
            
            <div class="buscador-zona" style="text-align: center; margin-bottom: 20px;">
                <input type="text" id="buscador-ofertas" placeholder="Ej: Batman, Lego, Star Wars..." 
                        style="padding: 10px; width: 60%; max-width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                
                <button id="btn-buscar" style="padding: 10px 20px; background-color: #333; color: white; border: none; cursor: pointer; border-radius: 5px;">
                    🔍 Buscar
                </button>
            </div>

            <div style="overflow-x: auto;">
                <table style="width:100%; border-collapse: collapse; background: white; color: black;">
                    <thead style="background-color: #333; color: white;">
                        <tr>
                            <th style="padding: 10px; border: 1px solid #ddd;">Imagen</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Videojuego</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Precio Normal</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Precio Oferta</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Nota</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-ofertas-body">
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px;">Cargando ofertas...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: center; align-items: center; gap: 15px;">
                <button id="btn-anterior" style="padding: 8px 15px; background-color: #eee; border: 1px solid #ccc; cursor: pointer;">
                    ⬅️ Anterior
                </button>

                <span id="texto-ofertas" style="font-weight: bold; font-size: 1.1em;">Página 1</span>

                <button id="btn-siguiente" style="padding: 8px 15px; background-color: #eee; border: 1px solid #ccc; cursor: pointer;">
                    Siguiente ➡️
                </button>
            </div>

        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>