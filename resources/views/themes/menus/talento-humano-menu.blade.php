<li class="nav-item {{ active(['talento.humano.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Talento Humano</span>
        <span class="arrow {{ active(['talento.humano.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">


        {{-- INICIO MENÚ ITEM ES SOLO DE EJEMPLO DE CÓMO SE DEBE CREAR EL MENÚ --}}
        <li class="nav-item {{ active(['talento.humano.index'], 'start active open') }}">
            <a href="{{ route('talento.humano.index') }}" class="nav-link">
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

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Personal</span>
                <span class="arrow"></span>
            </a>

            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.rrhh.create'], 'start active open') }}">
                    <a href="{{ route('talento.humano.rrhh.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Registrar Empleado</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Consultar Empleados</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ active(['talento.humano.rrhh.index'], 'start active open') }}">
                            <a href="{{ route('talento.humano.rrhh.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-address-book"></i>
                                <span class="title">Listar todos los empleados</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active(['talento.humano.docentesList'], 'start active open') }}">
                            <a href="{{ route('talento.humano.docentesList') }}" class="nav-link nav-toggle">
                                <i class="fa fa-address-book"></i>
                                <span class="title">Listar Docentes</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active(['talento.humano.funcList'], 'start active open') }}">
                            <a href="{{ route('talento.humano.funcList') }}" class="nav-link nav-toggle">
                                <i class="fa fa-address-book"></i>
                                <span class="title">Listar Funcionarios</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active(['talento.humano.searchById'], 'start active open') }}">
                            <a href="{{ route('talento.humano.searchById') }}" class="nav-link nav-toggle">
                                <i class="fa fa-address-book"></i>
                                <span class="title">Buscar por cedula</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title">Requisitos</span>
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
                        <span class="title">Consultar Documento</span>
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
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Historial de la documentación</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Historial de la información</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Inducción</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Proceso de inducción</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Proceso de re-inducción</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Reportes</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Generar reportes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Enviar reportes</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Calendario</span>
                <span class="arrow"></span>
            </a>


        </li>


    </ul>
</li>