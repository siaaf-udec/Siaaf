{{-- MENÚ DE EJEMPLO --}}


<li class="nav-item {{ active(['espacios.academicos.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Espacios Académicos</span>
        <span class="arrow {{ active(['espacios.academicos.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        @permission('formAcad')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Formato Academico</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.formacad.create'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.formacad.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Solicitar</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.formacad.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.formacad.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Consultar</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission

        @permission('solicitudes')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Solicitudes</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.espacad.create'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.espacad.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Registrar</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.mostrarSolicitudes'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.mostrarSolicitudes') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Consultar</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission

        @permission('horarios')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Horario</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @permission('regisHorario')
                <li class="nav-item {{ active(['espacios.academicos.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Registrar</span>
                    </a>
                </li>
                @endpermission
                <li class="nav-item {{ active(['espacios.academicos.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Consultar</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission

        @permission('reportes')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Reportes</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Docentes</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Estudiantes</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission

    </ul>

</li>
