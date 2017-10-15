{{-- MENÚ DE EJEMPLO --}}


<li class="nav-item {{ active(['espacios.academicos.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Espacios Académicos</span>
        <span class="arrow {{ active(['espacios.academicos.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        @permission('formAcad')
        @permission('secret')
        <li class="nav-item {{ active(['espacios.academicos.formacad.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.formacad.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Formatos Academicos</span>
            </a>
        </li>
        @endpermission
        @permission('administ')
        <li class="nav-item {{ active(['espacios.academicos.formacad.listSol'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.formacad.listSol') }}" class="nav-link nav-toggle">
                <i class="fa fa-file-pdf-o"></i>
                <span class="title">Formatos Academicos</span>
            </a>
        </li>
        @endpermission
        @endpermission

        @permission('auxapoyo')
        <li class="nav-item {{ active(['espacios.academicos.aulas.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.aulas.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-university"></i>
                <span class="title">Aulas</span>
            </a>
        </li>
        <li class="nav-item {{ active(['espacios.academicos.soft.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.soft.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-tv"></i>
                <span class="title">Software</span>
            </a>
        </li>
        <li class="nav-item {{ active(['espacios.academicos.incidente.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.incidente.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-warning"></i>
                <span class="title">Incidentes</span>
            </a>
        </li>
        @endpermission
        @permission('docentes')
        <li class="nav-item {{ active(['espacios.academicos.solacad.indexDoc'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.solacad.indexDoc') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Mis solicitudes</span>
            </a>
        </li>
        @endpermission
        @permission('auxapoyo')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-pencil-square-o"></i>
                <span class="title">Solicitudes</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">

                @permission('auxapoyo')
                <li class="nav-item {{ active(['espacios.academicos.evalsol.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.evalsol.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-pencil"></i>
                        <span class="title">Gestionar solicitudes</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.evalsol.indexFinal'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.evalsol.indexFinal') }}" class="nav-link nav-toggle">
                        <i class="fa fa-check-square-o"></i>
                        <span class="title">Finalizadas</span>
                    </a>
                </li>


                @endpermission

            </ul>
        </li>
        @endpermission

        @permission('horarios')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-calendar-check-o"></i>
                <span class="title">Horario</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @permission('regisHorario')
                <li class="nav-item {{ active(['espacios.academicos.acadcalendar.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.acadcalendar.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="title">Gestionar eventos</span>
                    </a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('reportes')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-file-pdf-o"></i>
                <span class="title">Reportes</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.report.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.report.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Docentes</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.report.indexPrueba'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.report.indexPrueba') }}" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Estudiantes</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission
        @permission('public')
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-check-square-o"></i>
                <span class="title">Registrar asistencia</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.asist.asisEst'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.asist.asisEst') }}" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Estudiante</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.asist.asisDoc'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.asist.asisDoc') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Docente</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission
    </ul>
</li>
