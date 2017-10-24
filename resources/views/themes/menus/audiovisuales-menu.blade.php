{{-- MENÚ DE EJEMPLO Correcion--}}
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
        @permission('SUPER_ADMIN_AUDIOVISUALES')
        <li class="nav-item {{ active(['audiovisuales.articulo.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.articulo.index') }}">
                <i class="icon-screen-desktop">
                </i>
                <span class="title">
                    Gestion Articulos
                </span>
            </a>
        </li>
        <li class="nav-item {{ active(['audiovisuales.validaciones.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.validaciones.index') }}">
                <i class="icon-note">
                </i>
                <span class="title">
                    Tabla Validaciones
                </span>
            </a>
        </li>
        @endpermission
        @permission('ADMIN_AUDIOVISUALES')
        <li class="nav-item {{ active(['audiovisuales.gestionPrestamos.index'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">Gestión Prestamos</span>
                <span class="arrow {{ active(['audiovisuales.gestionPrestamos.index.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['audiovisuales.gestionPrestamos.index'], 'start active open') }}">
                    <a href="{{  route('audiovisuales.gestionPrestamos.index') }}" class="nav-link nav-toggle">
                        <i class="icon-plus"></i>
                        <span class="title">Realizar Prestamo</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['audiovisuales.ListarPrestamo.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.ListarPrestamo.index') }}" class="nav-link nav-toggle">
                        <i class="icon-book-open"></i>
                        <span class="title">Listar Prestamos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['audiovisuales.reportes.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.reportes.index') }}">
                <i class="icon-bar-chart">
                </i>
                <span class="title">
                    Reportes
                </span>
            </a>
        </li>
        @endpermission
        @permission('FUNC_AUDIOVISUALES')
        <li class="nav-item {{ active(['audiovisuales.reservas.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-wrench"></i>
                <span class="title">Gestión de Reservas</span>
                <span class="arrow {{ active(['audiovisuales.reservas.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['audiovisuales.reservas.articulos.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.reservas.articulos.index') }}" class="nav-link nav-toggle">
                        <i class="icon-screen-tablet"></i>
                        <span class="title">Reserva Por Articulo</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['audiovisuales.reservas.kits.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.reservas.kits.index') }}" class="nav-link nav-toggle">
                        <i class="icon-grid"></i>
                        <span class="title">Reserva Por Kit</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission


    </ul>
</li>