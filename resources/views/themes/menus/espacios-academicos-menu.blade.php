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
        <li class="nav-item {{ active(['espacios.academicos.formacad.listAdmin'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.formacad.listAdmin') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Formatos Academicos</span>
            </a>
        </li>
        @endpermission
        @endpermission

        @permission('auxapoyo')
        <li class="nav-item {{ active(['espacios.academicos.soft.index'], 'start active open') }}">
            <a href="{{ route('espacios.academicos.soft.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Software</span>
            </a>
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
                @permission('docentes')
                <li class="nav-item {{ active(['espacios.academicos.espacad.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.espacad.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Mis solicitudes</span>
                    </a>
                </li>
               @endpermission
                @permission('auxapoyo')
                <li class="nav-item {{ active(['espacios.academicos.evalsol.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.evalsol.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Gestionar solicitudes</span>
                    </a>
                </li>


                @endpermission

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
                <li class="nav-item {{ active(['espacios.academicos.acadcalendar.index'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.acadcalendar.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Gestionar eventos</span>
                    </a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('reportes')
                <li class="nav-item {{ active(['espacios.academicos.reportes'], 'start active open') }}">
                    <a href="{{ route('espacios.academicos.reportes') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Reportes</span>
                    </a>
                </li>
        @endpermission

    </ul>

</li>
