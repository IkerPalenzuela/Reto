<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <header class="barra-superior">
        <h1>Panel de Control de Administración</h1>
        <a href="{{ url('/') }}" style="color: white; text-decoration: none; font-weight: bold;">Volver al Inicio</a>
    </header>

    <main>
        <section class="intro-texto" style="text-align: center;">
            <h2>Resumen del Sistema</h2>
        </section>

        <section class="contenedor-perfil" style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; min-width: 200px;">
                <h4 style="color: #666; font-size: 0.8em; text-transform: uppercase;">Usuarios del Sistema</h4>
                <p style="font-size: 2em; font-weight: bold; color: #4f46e5;">{{ $totalUsers }}</p>
            </div>
            <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; min-width: 200px;">
                <h4 style="color: #666; font-size: 0.8em; text-transform: uppercase;">Juegos en BD</h4>
                <p style="font-size: 2em; font-weight: bold; color: #16a34a;">{{ $totalGames }}</p>
            </div>
            <div style="border: 2px solid #4f46e5; padding: 20px; border-radius: 8px; min-width: 200px;">
                <h4 style="color: #666; font-size: 0.8em; text-transform: uppercase;">Estado API</h4>
                <p style="font-size: 2em; font-weight: bold; color: #3b82f6;">Activa</p>
            </div>
        </section>

        <section class="contenedor-perfil">
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; color: #4338ca;">Gestión de Contenidos</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div>
                    <h4 class="font-bold">Últimos Usuarios</h4>
                    <ul style="list-style: none; padding: 0; margin-top: 10px;">
                        @forelse($latestUsers as $user)
                            <li style="border-bottom: 1px solid #eee; padding: 5px 0; display: flex; justify-content: space-between;">
                                <span>{{ $user->name }} <small style="color: #999;">({{ $user->email }})</small></span>
                                <span style="background: #eee; padding: 2px 6px; border-radius: 4px; font-size: 0.7em;">
                                    {{ $user->created_at->diffForHumans() }}
                                </span>
                            </li>
                        @empty
                            <li>No hay usuarios.</li>
                        @endforelse
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold">Mantenimiento de Datos</h4>
                    <p style="font-size: 0.8em; color: #666;">Control de videojuegos y empresas.</p>
                    <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 15px;">
                        <a href="{{ route('games') }}" style="color: #4f46e5;">→ Catálogo de juegos</a>
                        <a href="{{ route('companies.index') }}" style="color: #4f46e5;">→ Catálogo de empresas</a>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; padding: 15px; background: #fffbeb; border-left: 4px solid #facc15;">
                <p style="color: #854d0e; font-weight: bold;">Nota del Desarrollador:</p>
                <p style="color: #a16207; font-style: italic; font-size: 0.9em;">Sistema conectado a MariaDB/MySQL.</p>
            </div>
        </section>
    </main>

    <footer class="barra-inferior">
        <p>&copy; 2026 GameReviews - Panel Admin</p>
    </footer>

</body>
</html>