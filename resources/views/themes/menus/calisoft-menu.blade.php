{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['calisoft.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-archive"></i>
        <span class="title">Calisoft</span>
        <span class="arrow {{ active(['calisoft.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['calisoft.index'], 'start active open') }}">
            <a href="{{ route('calisoft.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Registrar Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link">
                <i class="fa fa-university"></i>
                <span class="title">Peticiones</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link">
                <i class="fa fa-folder-open"></i>
                <span class="title">Proyectos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link">
                <i class="fa fa-pie-chart"></i>
                <span class="title">Categorías</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link">
                <i class="fa fa-book"></i>
                <span class="title">Documentos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link">
                <i class="fa fa-gears"></i>
                <span class="title">Semilleros</span>
            </a>
        </li>
    </ul>
</li>