{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['adminRegist.*'], 'start active open') }}">
    <a href="#" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">Admisiones y Registro</span>
        <span class="arrow {{ active(['adminRegist.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
        @permission('ADMINREGIST_USER')
        <li class="nav-item {{ active(['adminRegist.users.*'], 'start active open') }}">
            <a href="{{route('adminRegist.users.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>
        @endpermission
        @permission('ADMINREGIST_HISNOV')
        <li class="nav-item {{ active(['adminRegist.registros.*'], 'start active open') }}">
            <a href="{{route('adminRegist.registros.history')}}" class="nav-link nav-toggle">
                <i class="fa fa-desktop"></i>
                <span class="title">Historial Novedades</span>
            </a>
        </li>
        @endpermission
        @permission('ADMINREGIST_REINGRE')
        <li class="nav-item {{ active(['adminRegist.registros.registro.index'], 'start active open') }}">
            <a href="{{route('adminRegist.registros.registro.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-newspaper-o"></i>
                <span class="title">Registrar Ingreso</span>
            </a>
        </li>
        @endpermission
        @permission('ADMINREGIST_ADPREG')
        <li class="nav-item {{ active(['adminRegist.help.*'], 'start active open') }}">
            <a href="{{route('adminRegist.help.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-gears"></i>
                <span class="title">Administrar Preguntas</span>
            </a>
        </li>
        @endpermission
        @permission('ADMINREGIST_PREFRE')
        <li class="nav-item {{ active(['adminRegist.help.index*'], 'start active open') }}">
            <a href="{{route('adminRegist.help.index.preguntas')}}" class="nav-link nav-toggle">
                <i class="fa fa-support"></i>
                <span class="title">Preguntas Frecuentes</span>
            </a>
        </li>
        @endpermission
        @permission('ADMINREGIST_REPORT')
        <li class="nav-item {{ active(['adminRegist.report.*'], 'start active open') }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-file-pdf-o"></i>
                <span class="title">Reportes</span>
                <span class="arrow {{ active(['adminRegist.report.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                @permission('ADMINREGIST_REPORT_NOVE')
                <li class="nav-item {{ active(['adminRegist.report.novedad.index'], 'start active open') }}">
                    <a href="{{route('adminRegist.report.novedad.index')}}" class="nav-link nav-toggle">
                        <i class="fa fa-bullhorn"></i>
                        <span class="title">Novedades</span>
                    </a>
                </li>
                @endpermission
                @permission('ADMINREGIST_REPORT_DATE')
                <li class="nav-item {{ active(['adminRegist.report.index.fecha'], 'start active open') }}">
                    <a href="{{route('adminRegist.report.index.fecha')}}" class="nav-link nav-toggle">
                        <i class="fa fa-calendar"></i>
                        <span class="title">Fechas</span>
                    </a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission
        @permission('ADMINREGIST_CHART')
        <li class="nav-item {{ active(['adminRegist.chart.*'], 'start active open') }}">
            <a href="{{route('adminRegist.chart.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-line-chart"></i>
                <span class="title">Gráficos</span>
            </a>
        </li>
        @endpermission
    </ul>
</li>
