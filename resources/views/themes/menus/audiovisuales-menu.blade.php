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
        <li class="nav-item {{ active(['audiovisuales.reservas.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-files-o"></i>
                <span class="title">Gestión de Reservas</span>
                <span class="arrow {{ active(['audiovisuales.reservas.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['audiovisuales.reservas.articulos.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.reservas.articulos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="title">Reserva Por Articulo</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['financial.files.request.index'], 'start active open') }}">
                    <a href="{{ route('financial.files.request.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-check"></i>
                        <span class="title">Reserva Por Kit</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['audiovisuales.autenticacion.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.autenticacion.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Menu Administrador
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
        <li class="nav-item {{ active(['audiovisuales.validaciones.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.validaciones.index') }}">
                <i class="fa fa-users">
                </i>
                <span class="title">
                    Tabla Validaciones
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.articulo.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.articulo.index') }}">
                <i class="fa fa-television">
                </i>
                <span class="title">
                    Gestion Articulos
                </span>
            </a>
        </li>
    </ul>
</li>