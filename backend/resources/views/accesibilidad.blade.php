<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaración de Accesibilidad - GameReviews</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <header class="barra-superior">
        <h1>Accesibilidad</h1>
        
        @auth
            <a href="{{ url('/dashboard') }}" style="color: white; text-decoration: none; font-weight: bold;">
                Volver al inicio
            </a>
        @else
            <a href="{{ url('/') }}" style="color: white; text-decoration: none; font-weight: bold;">
                Volver al Inicio
            </a>
        @endauth
    </header>

    <main>
        <section class="intro-texto" style="text-align: center;">
            <h2>Declaración de Accesibilidad</h2>
        </section>

        <section class="contenedor-perfil">
            <p><strong>GameReviews</strong> se compromete a hacer accesible su sitio web de conformidad con el Real Decreto 1112/2018, de 7 de septiembre, sobre accesibilidad de los sitios web y aplicaciones para dispositivos móviles del sector público.</p>
            <br>
            
            <h3>Situación de cumplimiento</h3>
            <p>Este sitio web es <strong>parcialmente conforme</strong> con el nivel AA de las Pautas de Accesibilidad al Contenido en la Web (WCAG) 2.1 debido a las excepciones que se indican a continuación.</p>
            <br>

            <h3>Contenido no accesible</h3>
            <p>El contenido que se recoge a continuación no es accesible por lo siguiente:</p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li><strong>Falta de conformidad con las WCAG 2.1:</strong> Algunas imágenes antiguas de la base de datos de videojuegos podrían no tener texto alternativo (alt) descriptivo.</li>
                <li><strong>Carga desproporcionada:</strong> No aplica.</li>
            </ul>
            <br>

            <h3>Preparación de la declaración</h3>
            <p>La presente declaración fue preparada el <strong>10 de febrero de 2026</strong>.</p>
            <p>El método empleado para preparar la declaración ha sido una autoevaluación llevada a cabo por el propio desarrollador.</p>
            <br>

            <h3>Observaciones y datos de contacto</h3>
            <p>Puede realizar comunicaciones sobre requisitos de accesibilidad (artículo 10.2.a del RD 1112/2018) como, por ejemplo:</p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>Informar sobre cualquier posible incumplimiento por parte de este sitio web.</li>
                <li>Transmitir otras dificultades de acceso al contenido.</li>
                <li>Formular cualquier otra consulta o sugerencia de mejora relativa a la accesibilidad del sitio web.</li>
            </ul>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews</p>
    </footer>

</body>
</html>