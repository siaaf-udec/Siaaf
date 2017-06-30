{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['audiovisuales.*'], 'start active open') }}">
    <a href="{{ route('audiovisuales.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-desktop"></i>
        <span class="title">Audiovisuales</span>
    </a>
</li>