<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameReviews - Dashboard</title>
    
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>

    <header class="barra-superior">
        <div class="icono-menu">☰</div>
        
        <h1><a href="{{ route('dashboard') }}" style="text-decoration:none; color:inherit;">Dashboard</a></h1>
        
        <div class="botones-auth">
            <span style="color: white; margin-right: 15px;">
                Hola, {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-register" style="background-color: #dc3545; border:none; cursor:pointer;">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </header>

    <main>
        <section class="intro-texto">
            <p>
                <strong>¡Bienvenido a tu zona privada!</strong><br>
                Aquí podrás consultar fichas técnicas detalladas y leer o publicar reseñas.
                Como usuario registrado, ahora tienes acceso completo a la comunidad.
            </p>
            <div style="margin-top: 15px; text-align: center;">
                <a href="{{ route('profile.edit') }}" class="btn-login" style="text-decoration:none;">Editar Mi Perfil</a>
            </div>
        </section>

        <section class="carrusel-container">
            <div class="carrusel-slide">
                <img src="https://placehold.co/600x300/png?text=Imagen+Carrusel" alt="Imagen destacada">
            </div>
        </section>

        <section class="seccion-reseñas">
            <div id="contenedor-reseñas" class="lista-reseñas">
                <p>Cargando reseñas de la comunidad...</p>
            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2024 GameReviews</p>
    </footer>

    <script src="/app.js"></script>

</body>
</html>