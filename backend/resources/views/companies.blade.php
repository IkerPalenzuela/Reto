<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Empresas</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        
        <h1>Empresas</h1>

        <div class="usuario-info" id="caja-usuario-info" style="display: flex;">
            <span id="nombre-usuario" class="nombre-usuario">
                Hola, {{ $user->name }}
            </span>
            
            <form method="POST" action="/logout">
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
            <p>
                Listado de las empresas desarrolladoras y distribuidoras. 
                Selecciona una para ver sus videojuegos asociados.
            </p>
        </section>

        <section class="contenedor-perfil">
            <h2 style="margin-bottom: 20px;">Listado de Empresas</h2>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: white;">
                    <thead style="background-color: #333; color: white;">
                        <tr>
                            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Nombre</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Ubicación</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                {{ $company->id }}
                            </td>
                            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                {{ $company->name }}
                            </td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                {{ $company->location }}
                            </td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                <a href="{{ route('games', ['company_id' => $company->id]) }}" 
                                    style="display: inline-block; padding: 6px 12px; background-color: #0f3d2e; color: white; text-decoration: none; border-radius: 5px; font-size: 14px;">
                                    Ver Juegos
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews | <a href="/accesibilidad" style="color:white; text-decoration: underline;">Accesibilidad</a></p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>