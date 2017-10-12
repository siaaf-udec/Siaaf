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
                <li class="nav-item {{ active(['audiovisuales.reservas.kits.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.reservas.kits.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-check"></i>
                        <span class="title">Reserva Por Kit</span>
                    </a>
                </li>
            </ul>
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
        <li class="nav-item {{ active(['audiovisuales.gestionPrestamos.index'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-files-o"></i>
                <span class="title">Gestión Prestamos</span>
                <span class="arrow {{ active(['audiovisuales.gestionPrestamos.index.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['audiovisuales.gestionPrestamos.index'], 'start active open') }}">
                    <a href="{{  route('audiovisuales.gestionPrestamos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="title">Realizar Prestamo</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['audiovisuales.ListarPrestamo.index'], 'start active open') }}">
                    <a href="{{ route('audiovisuales.ListarPrestamo.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-check"></i>
                        <span class="title">Listar Prestamos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['audiovisuales.validaciones.index'], 'start active open') }}">
            <a class="nav-link" href="{{ route('audiovisuales.validaciones.index') }}">
                <i class="fa fa-lock">
                </i>
                <span class="title">
                    Tabla Validaciones
                </span>
            </a>
        </li>
    </ul>
</li>