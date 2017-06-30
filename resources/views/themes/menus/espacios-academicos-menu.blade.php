{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['espacios.academicos.*'], 'start active open') }}">
    <a href="{{ route('espacios.academicos.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-graduation-cap"></i>
        <span class="title">Espacios Académicos</span>
    </a>
</li>