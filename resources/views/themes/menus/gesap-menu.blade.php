{{-- MENÚ DE EJEMPLO --}}
<li class="nav-item {{ active(['audiovisuales.*'], 'start active open') }}">
    <a class="nav-link nav-toggle" href="javascript:;">
        <i class="fa fa-cube">
        </i>
        <span class="title">
            Gesap
        </span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}">
        </span>
    </a>
    <ul class="sub-menu">
        @permission('See_All_Project_Gesap')
            <li class="nav-item {{ active(['min.index'], 'start active open') }}">
                <a href="{{ route('min.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Listar Anteproyectos</span>
                </a>
            </li>
            <li class="nav-item {{ active(['project.index'], 'start active open') }}">
                <a href="{{ route('project.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Listar Proyectos</span>
                </a>
            </li>
        @endpermission
        @permission('Director_List_Gesap')
            <li class="nav-item {{ active(['anteproyecto.index.directorList'], 'start active open') }}">
                <a href="{{ route('anteproyecto.index.directorList') }}" class="nav-link nav-toggle">
                    <i class="fa fa-book"></i>
                    <span class="title">Director de Proyecto</span>
                </a>
            </li>
        @endpermission
        @permission('Jury_List_Gesap')
            <li class="nav-item {{ active(['anteproyecto.index.juryList'], 'start active open') }}">
                <a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.juryList') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Jurado de Proyecto</span>
                </a>
            </li>
        @endpermission


        @permission('Report_Gesap')
            <li class="nav-item {{ active(['report.index'], 'start active open') }}">
                <a class="nav-link nav-toggle" href="{{ route('report.index') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Reportes</span>
                </a>
            </li>
            <li class="nav-item {{ active(['graficos'], 'start active open') }}">
                <a class="nav-link nav-toggle" href="{{ route('graficos') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Graficos</span>
                </a>
            </li>
        @endpermission
        @role('Student_Gesap')
                <li class="nav-item {{ active(['anteproyecto.index.studentList'], 'start active open') }}">
                    <a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.studentList') }}">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Proyectos
                        </span>
                    </a>
                </li>
        @endrole
    </ul>
</li>