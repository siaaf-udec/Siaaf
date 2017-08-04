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
        
        @role('Coordinator_Gesap')
            <li class="nav-item {{ active(['min.index'], 'start active open') }}">
                <a href="{{ route('min.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Listar Anteproyectos</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['min.create'], 'start active open') }}">
                    <a class="nav-link nav-toggle" href="{{ route('min.create') }}">
                        <i class="fa fa-user">
                        </i>
                        <span class="title">
                            Registrar Anteproyecto
                        </span>
                    </a>
                </li>
        @endrole
        <li class="nav-item">
                    <a href="{{ route('anteproyecto.index.listdirector') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Director de Proyecto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.listjurado') }}">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Jurado de Proyecto
                        </span>
                    </a>
                </li>
        
        @role('Student_Gesap')
                <li class="nav-item">
                    <a class="nav-link nav-toggle" href="javascript:;">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Observaciones
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-toggle" href="javascript:;">
                        <i class="fa fa-book">
                        </i>
                        <span class="title">
                            Actividades
                        </span>
                    </a>
                </li>
        @endrole

    </ul>
</li>
