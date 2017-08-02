{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['parqueaderos.*'], 'start active open') }}">
    <a href="{{ route('parqueaderos.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-car"></i>
        <span class="title">Parqueaderos</span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu"l>
        <li class="nav-item {{ active(['parqueaderos.*'], 'start active open') }}">
            <a class="nav-link" href="{{ route('usuariosCK.create') }}">
                <i class="fa fa-users"></i><span class="title">Registro Usuarios</span>
            </a>
        </li>

    </ul>
</li>
