<nav class="barra-superior">
    
    <div class="icono-menu">☰</div>

    <h1>
        <a href="{{ route('dashboard') }}" style="text-decoration:none; color:white;">
            GameReviews Panel
        </a>
    </h1>

    <div class="botones-auth" style="align-items: center;">
        
        <a href="{{ route('dashboard') }}">Inicio</a>
        
        <a href="/games">Juegos</a>

        <a href="{{ route('profile.edit') }}">Mi Perfil</a>

        <span style="margin-left: 10px; font-size: 0.8rem; opacity: 0.8;">
            Hola, {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-left: 10px;">
            @csrf
            <button type="submit" style="background: none; border: 1px solid white; color: white; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                Salir
            </button>
        </form>
    </div>
</nav>