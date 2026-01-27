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
            <span id="nombre-usuario" class="nombre-usuario">
                Hola, {{ Auth::user()->name }}
            </span>
            
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
            <p>
                Explora nuestro catálogo completo. Aquí puedes ver la relación entre desarrolladoras y las plataformas donde están disponibles.
            </p>
        </section>

        <section class="contenedor-perfil"> <h2 style="margin-bottom: 20px;">Lista de Videojuegos</h2>
            
        <div class="filtros" style="margin-bottom: 20px;">
            <span>Filtrar por empresa:</span>
            <a href="{{ url('/videojuegos') }}" class="btn-tab">Todas</a>
            <a href="{{ url('/videojuegos?company_id=1') }}" class="btn-tab">Nintendo</a>
            <a href="{{ url('/videojuegos?company_id=2') }}" class="btn-tab">Sony</a>
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
                <tbody>
                    @foreach($videojuegos as $juego)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <img src="{{ $juego->img }}" alt="{{ $juego->name }}" style="width: 80px; height: auto; border-radius: 5px;">
                        </td>
                        
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <strong>{{ $juego->name }}</strong> </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $juego->company->name ?? 'Sin empresa' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            @foreach($juego->platforms as $plataforma)
                                <span style="background: #eee; padding: 2px 5px; margin-right: 5px; border-radius: 3px; font-size: 0.8em;">
                                    {{ $plataforma->name }}
                                </span>
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

    <script>
        window.usuarioActual = "{{ Auth::user()->name }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>