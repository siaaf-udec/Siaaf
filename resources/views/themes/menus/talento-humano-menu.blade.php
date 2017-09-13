<li class="nav-item {{ active(['talento.humano.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Talento Humano</span>
        <span class="arrow {{ active(['talento.humano.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">


        {{-- INICIO MENÚ ITEM ES SOLO DE EJEMPLO DE CÓMO SE DEBE CREAR EL MENÚ --}}
        <li class="nav-item {{ active(['talento.humano.index'], 'start active open') }}">
            <a href="{{ route('talento.humano.notificaciones.notificar') }}" class="nav-link">
                <i class="icon-frame"></i>
                <span class="title">Ejemplo</span>
            </a>
        </li>
        {{--
                En el archivo de rutas específicamente para las rutas
                de tipo resource añadir una alias con el prefijo

                'talento.humano.'

                como se muestra en el siguiente ejemplo con el fin de
                usar correctamente este menú:


                 Route::resource('rrhh', 'GameController', [
                  'names' => [
                          'index' => 'talento.humano.rrhh.index',
                          'create' => 'talento.humano.rrhh.create',
                   ]
                 ]);

        --}}
        {{-- FIN MENÚ ITEM ES SOLO DE EJEMPLO DE CÓMO SE DEBE CREAR EL MENÚ --}}
        @permission('FUNC_RRHH')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Personal</span>
                <span class="arrow"></span>
            </a>

            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.empleado.create'], 'start active open') }}">
                    <a href="{{ route('talento.humano.empleado.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Registrar Empleado</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.empleado.regisArchivo'], 'start active open') }}">
                    <a href="{{ route('talento.humano.empleado.regisArchivo') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Registro por archivo</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.empleado.index'], 'start active open') }} ">
                    <a href="{{ route('talento.humano.empleado.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Consultar Empleados</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.buscarRadicar'], 'start active open') }}">
                    <a href="{{ route('talento.humano.buscarRadicar') }}" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Radicar Documentos</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Documentación</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.document.create'], 'start active open') }}">
                    <a href="{{ route('talento.humano.document.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Registrar Documento</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.document.index'], 'start active open') }}">
                    <a href="{{ route('talento.humano.document.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Consultar Documentos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Eventos</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.evento.create'], 'start active open') }}">
                    <a href="{{ route('talento.humano.evento.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Registrar Evento</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['talento.humano.evento.index'], 'start active open') }}">
                    <a href="{{ route('talento.humano.evento.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Consultar Eventos</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Historial</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.historialDocumentos.empleados'], 'start active open') }}">
                    <a href="{{ route('talento.humano.historialDocumentos.empleados') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Historial de la documentación</span>
                    </a>
                </li>
                <li class="nav-item" {{ active(['talento.humano.empleado.tablaEmpleadosRetirados'], 'start active open') }}>
                    <a href="{{ route('talento.humano.empleado.tablaEmpleadosRetirados') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Historial Empleados</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('talento.humano.Tinduccion') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Inducción</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('talento.humano.permisos.listaEmpleados') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Permisos</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route( 'talento.humano.calendario.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Calendario</span>
                <span class="arrow"></span>
            </a>
        </li>
        @endpermission

    </ul>
</li>