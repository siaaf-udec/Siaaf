{{-- MENÚ DE EJEMPLO --}}


<li class="nav-item {{ active(['espacios.academicos.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Espacios Académicos</span>
        <span class="arrow {{ active(['espacios.academicos.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        @permission('ACAD_FORMATOS')
        @permission('ACAD_REGISTRAR_FORMATOS')
        <li class="nav-item {{ active(['espacios.academicos.formacad.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.formacad.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Formatos Académicos</span>
            </a>
        </li>
        @endpermission
        @permission('ACAD_GESTION_FORMATOS')
        <li class="nav-item {{ active(['espacios.academicos.formacad.listSol'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.formacad.listSol') }}" class="nav-link nav-toggle">
                <i class="fa fa-file-pdf-o"></i>
                <span class="title">Formatos Académicos</span>
            </a>
        </li>
        @endpermission
        @endpermission

        @permission('ACAD_AULAS')
        <li class="nav-item {{ active(['espacios.academicos.aulas.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.aulas.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-university"></i>
                <span class="title">Aulas</span>
            </a>
        </li>
        @endpermission
        @permission('ACAD_SOFTWARE')
        <li class="nav-item {{ active(['espacios.academicos.soft.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.soft.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-tv"></i>
                <span class="title">Software</span>
            </a>
        </li>
        @endpermission
        @permission('ACAD_INCIDENTES')
        <li class="nav-item {{ active(['espacios.academicos.incidente.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.incidente.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-warning"></i>
                <span class="title">Incidentes</span>
            </a>
        </li>
        @endpermission
        @permission('ACAD_SOLICITUDES')
        @permission('ACAD_REALIZAR_SOLICITUDES')
        <li class="nav-item {{ active(['espacios.academicos.solacad.indexDoc'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.solacad.indexDoc') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Mis solicitudes</span>
            </a>
        </li>
        @endpermission
        @permission('ACAD_GESTION_SOLICITUDES')
        <li class="nav-item {{ active(['espacios.academicos.evalsol.*' ], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-pencil-square-o"></i>
                <span class="title">Solicitudes</span>
                <span class="arrow {{ active(['espacios.academicos.evalsol.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">


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
            </ul>
        </li>
        @endpermission
        @endpermission

        @permission('ACAD_EVENTOS')
        <li class="nav-item {{ active(['espacios.academicos.acadcalendar.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.acadcalendar.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-calendar-plus-o"></i>
                <span class="title">Horario y eventos</span>
            </a>
        </li>
        @endpermission

        @permission('ACAD_REPORTES')
        <li class="nav-item {{ active(['espacios.academicos.report.*' ], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-file-pdf-o"></i>
                <span class="title">Reportes</span>
                <span class="arrow {{ active(['espacios.academicos.report.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['espacios.academicos.report.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.report.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Docentes</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.report.indexEst'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.report.indexEst') }}" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Estudiantes</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['espacios.academicos.report.indexCarr'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.report.indexCarr') }}" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="title">Carreras</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission
        @permission('ACAD_PUBLICO')
        <li class="nav-item {{ active(['espacios.academicos.asist.*' ], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-check-square-o"></i>
                <span class="title">Registrar ingreso</span>
                <span class="arrow {{ active(['espacios.academicos.asist.*'], 'open') }}"></span>
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
                <li class="nav-item {{ active(['espacios.academicos.asist.asisInv'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.asist.asisInv') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Externo</span>
                    </a>
                </li>
            </ul>
            @endpermission
        </li>
    </ul>
</li>
