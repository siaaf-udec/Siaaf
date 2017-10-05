{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['parqueaderos.*'], 'start active open') }}">
    <a href="{{ route('parqueaderos.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-car"></i>
        <span class="title">Parqueaderos</span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}"></span>
    </a>
</li>
