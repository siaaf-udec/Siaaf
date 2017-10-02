<li class="nav-item {{ active(['gesap.*'], 'start active open') }}">
    <a class="nav-link nav-toggle" href="javascript:;">
        <i class="fa fa-cube">
        </i>
        <span class="title">
            Gesap
        </span>
        <span class="arrow {{ active(['gesap.*'], 'open') }}">
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
        @endpermission
        @permission('Create_Project_Gesap')
            <li class="nav-item {{ active(['min.create'], 'start active open') }}">
                <a class="nav-link nav-toggle" href="{{ route('min.create') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">Registrar Anteproyecto</span>
                </a>
            </li>
        @endpermission
        @permission('Director_List_Gesap')
            <li class="nav-item">
                <a href="{{ route('anteproyecto.index.directorList') }}" class="nav-link nav-toggle">
                    <i class="fa fa-book"></i>
                    <span class="title">Director de Proyecto</span>
                </a>
            </li>
        @endpermission
        @permission('Jury_List_Gesap')
            <li class="nav-item">
                <a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.juryList') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Jurado de Proyecto</span>
                </a>
            </li>
        @endpermission
        @permission('See_Observations_Gesap')
                <li class="nav-item">
                    <a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.studentList') }}">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Proyectos
                        </span>
                    </a>
                </li>
        @endpermission
        @permission('Update_Final_Project_Gesap')
                <!--<li class="nav-item">
                    <a class="nav-link nav-toggle" href="anteproyecto.index.studentList">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Actividadess
                        </span>
                    </a>
                </li> -->
        @endpermission
    </ul>
</li>
