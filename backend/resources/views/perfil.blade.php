<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Editar Perfil</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <header class="barra-superior">
        <div class="icono-menu" id="btn-menu" onclick="menu()" style="display: block;">☰</div>
        
        <h1>Editar Perfil</h1>

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
            <li><a href="{{ url('/videojuegos') }}">Videojuegos</a></li>
            <li><a href="{{ url('/perfil') }}">Editar Perfil</a></li>
            <li><a href="{{ url('/reseñas') }}">Reseñas</a></li>
        </ul>
    </nav>

    <main>
        <section class="intro-texto">
            <p>Gestiona aquí tu información personal. Puedes actualizar tus datos de contacto.</p>
        </section>

        <div class="contenedor-perfil">
            <h2>Mis Datos</h2>
            
            <form id="form-perfil" class="formulario-perfil" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="grupo-input">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="grupo-input">
                    <label for="surname">Apellido</label>
                    <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}" required>
                </div>

                <div class="grupo-input">
                    <label for="phone">Teléfono</label>
                    <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <button type="submit" class="btn-guardar">Guardar Cambios</button>
            </form>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #ddd;">

            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro?')">
                @csrf
                @method('DELETE')
                <button type="submit" id="btn-borrar-cuenta" class="btn-logout" style="width: 100%;">Borrar Cuenta</button>
            </form>
        </div>
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