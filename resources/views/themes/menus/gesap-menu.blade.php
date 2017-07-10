
<li class="nav-item {{ active(['gesap.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-cube"></i>
        <span class="title">Gesap</span>
        <span class="arrow {{ active(['gesap.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Coordinador</span>
                <span class="arrow"></span>
            </a>

            <ul class="sub-menu">
                <li class="nav-item {{ active(['min.index'], 'start active open') }}">
                    <a href="{{ route('min.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Listar Anteproyectos</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['min.create'], 'start active open') }}">
                    <a href="{{ route('min.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Registrar Anteproyecto</span>
                    </a>
                </li>
                <!--<li class="nav-item ">
                    <a href="javascript:" class="nav-link nav-toggle">
                        <i class="fa fa-address-book"></i>
                        <span class="title"> Empleados</span>
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
                </li>!-->
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Administrador</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['talento.humano.document.create'], 'start active open') }}">
                    <a href="{{ route('talento.humano.document.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Asignar Rol</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Evaluador</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Evaluar Proyecto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Estadisticas</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Estudiante</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Observaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Actividades</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</li>