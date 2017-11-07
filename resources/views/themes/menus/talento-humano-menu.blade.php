<li class="nav-item {{ active(['talento.humano.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Talento Humano</span>
        <span class="arrow {{ active(['talento.humano.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        @permission('TAL_MODULE')
        <li class="nav-item {{ active(['talento.humano.empleado.index','talento.humano.empleado.regisArchivo',
                                'talento.humano.buscarRadicar', 'talento.humano.empleado.email'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-group"></i>
                <span class="title">Personal</span>
                <span class="arrow {{ active(['talento.humano.empleado.index','talento.humano.empleado.regisArchivo',
                                            'talento.humano.buscarRadicar', 'talento.humano.empleado.email'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.empleado.index'], 'start active open') }} ">
                    <a href="{{ route('talento.humano.empleado.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Empleados</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.empleado.regisArchivo'], 'start active open') }} ">
                    <a href="{{ route('talento.humano.empleado.regisArchivo') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Registro por archivo</span>
                    </a>
                </li>
                @permission('TAL_RAD_DOC')
                <li class="nav-item {{ active(['talento.humano.buscarRadicar'], 'start active open') }} ">
                    <a href="{{ route('talento.humano.buscarRadicar') }}" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Radicar Documentos</span>
                    </a>
                </li>
                @endpermission
                @permission('TAL_SEND_EMAIL')
                <li class="nav-item {{ active(['talento.humano.empleado.email'], 'start active open') }} ">
                    <a href="{{ route('talento.humano.empleado.email') }}" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Enviar Correo</span>
                    </a>
                </li>
                @endpermission
            </ul>
        </li>

        <li class="nav-item {{ active(['talento.humano.document.*', 'talento.humano.notificaciones.*' ], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Documentación</span>
                <span class="arrow {{ active(['talento.humano.document.*','talento.humano.notificaciones.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.document.index'], 'start active open') }}">
                    <a href="{{ route('talento.humano.document.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Documentos</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.notificaciones.empleadosDocumentosCompletos'], 'start active open') }}">
                    <a href="{{ route('talento.humano.notificaciones.empleadosDocumentosCompletos') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Documentos Completos</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.notificaciones.empleadosDocumentosIncompletos'], 'start active open') }}">
                    <a href="{{ route('talento.humano.notificaciones.empleadosDocumentosIncompletos') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Documentos Incompletos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <li class="nav-item {{ active(['talento.humano.evento.index'], 'start active open') }}">
                <a href="{{ route('talento.humano.evento.index') }}" class="nav-link">
                    <i class="fa fa-book"></i>
                    <span class="title">Eventos</span>
                </a>
            </li>
        </li>

        <li class="nav-item {{ active(['talento.humano.historialDocumentos.empleados', 'talento.humano.empleado.tablaEmpleadosRetirados'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-folder-o"></i>
                <span class="title">Historial</span>
                <span class="arrow {{ active(['talento.humano.historialDocumentos.empleados', 'talento.humano.empleado.tablaEmpleadosRetirados'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.historialDocumentos.empleados'], 'start active open') }}">
                    <a href="{{ route('talento.humano.historialDocumentos.empleados') }}" class="nav-link nav-toggle">
                        <i class="fa fa-file-text-o"></i>
                        <span class="title">Historial de la documentación</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.empleado.tablaEmpleadosRetirados'], 'start active open') }}">
                    <a href="{{ route('talento.humano.empleado.tablaEmpleadosRetirados') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Historial Empleados</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ active(['talento.humano.Tinduccion'], 'start active open') }}">
            <a href="{{ route('talento.humano.Tinduccion') }}" class="nav-link">
                <i class="fa fa-newspaper-o"></i>
                <span class="title">Inducción</span>
            </a>
        </li>
        <li class="nav-item {{ active(['talento.humano.permisos.listaEmpleados'], 'start active open') }}">
            <a href="{{ route('talento.humano.permisos.listaEmpleados') }}" class="nav-link">
                <i class="fa fa-file-o"></i>
                <span class="title">Permisos</span>
            </a>
        </li>

        <li class="nav-item {{ active(['talento.humano.calendario.index'], 'start active open') }}">
            <a href="{{ route( 'talento.humano.calendario.index') }}" class="nav-link">
                <i class="fa fa-calendar"></i>
                <span class="title">Calendario</span>

            </a>
        </li>
        <li class="nav-item {{ active(['talento.humano.empleado.Reportes'], 'start active open') }}">
            <a href="{{ route( 'talento.humano.empleado.Reportes') }}" class="nav-link">
                <i class="fa fa-bar-chart"></i>
                <span class="title">Reportes</span>
            </a>
        </li>
        @endpermission
    </ul>
</li>