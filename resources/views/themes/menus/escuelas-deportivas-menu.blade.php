{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['sportcit.*'], 'start active open') }}">
    <a href="{{ route('sportcit.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-futbol-o"></i>
        <span class="title">Escuelas Deportivas</span>
    </a>
</li>