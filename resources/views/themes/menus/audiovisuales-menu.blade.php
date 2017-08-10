{{-- MENÚ DE EJEMPLO --}}
<li class="nav-item {{ active(['audiovisuales.*'], 'start active open') }}">
    <a class="nav-link nav-toggle" href="javascript:;">
        <i class="fa fa-desktop">
        </i>
        <span class="title">
            Audiovisuales
        </span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}">
        </span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['audiovisuales.autenticacion.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.autenticacion.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Menu Administrador
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.funcionario.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.funcionario.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Gestion Funcionarios
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.administrador.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.administrador.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Gestion Administradores
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.articulo.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.articulo.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Gestion Articulos
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.superAdmin.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.superAdmin.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Gestion SuperAdmin
                </span>
            </a>
        </li>
    </ul>
</li>