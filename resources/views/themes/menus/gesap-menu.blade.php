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
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-book"></i>
                <span class="title">Administrador</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item ">
                    <a href="{{ route('admin.index') }}" class="nav-link nav-toggle">
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
                    <a href="{{ route('anteproyecto.index.listdirector') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Director de Proyecto</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('anteproyecto.index.listjurado') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Jurado de Proyecto</span>
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