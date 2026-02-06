<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Ofertas de Juegos</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        <h1>Buscador de Ofertas</h1>
        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            <span id="nombre-usuario" class="nombre-usuario">Hola, {{ $user->name }}</span>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Salir</button>
            </form>
        </div>
    </header>

    <nav id="menu-principal" class="menu-oculto">
        <ul>
            <li><a href="{{ url('/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('/companies') }}">Empresas</a></li>
            <li><a href="{{ url('/games') }}">Videojuegos</a></li>
            <li><a href="{{ url('/profile') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reviews') }}">Reseñas</a></li>
            <li><a href="{{ url('/offers') }}">Ofertas API</a></li>
            <li><a href="{{ url('/favorites') }}">Mis Favoritos</a></li>
        </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>Busca juegos en oferta a tiempo real usando la API de CheapShark.</p>
        </section>

        <section class="contenedor-perfil" style="max-width: 1200px;">
            <h2 style="margin-bottom: 20px;">Explora las mejores ofertas</h2>
            
            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <input type="text" id="buscador-ofertas" placeholder="Buscar juego (ej: Star Wars)..." 
                    style="flex-grow: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <button id="btn-buscar" class="btn-guardar" style="margin-top:0;">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>

            <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #333; color: white;">
                            <th style="padding: 12px; text-align: center; border: 1px solid #ddd;">Imagen</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Título</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Precio Normal</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Oferta</th>
                            <th style="padding: 12px; border: 1px solid #ddd;">Calidad</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-ofertas-body">
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 50px;">
                                <div class="typing">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                    <button id="btn-anterior" class="btn-guardar" style="background-color: #666; margin-top:0;">Anterior</button>
                    <span id="texto-ofertas" style="font-weight: bold;">Página 1</span>
                    <button id="btn-siguiente" class="btn-guardar" style="margin-top:0;">Siguiente</button>
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