{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['audiovisuales.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-desktop"></i>
        <span class="title">Audiovisuales</span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['funcionario.index'], 'start active open') }}">
            <a href="{{ route('funcionario.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Gestion Funcionarios</span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.administrador.index'], 'start active open') }}">
            <a href="{{ route('audiovisuales.administrador.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Gestion Administradores</span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.articulo.index'], 'start active open') }}">
            <a href="{{ route('audiovisuales.articulo.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Gestion Articulos</span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.superAdmin.index'], 'start active open') }}">
            <a href="{{ route('audiovisuales.superAdmin.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Gestion SuperAdmin</span>
            </a>
        </li>         
    </ul>
</li>