<li class="nav-item {{ active(['access-control.*','roles.permissions.index'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-lock"></i>
        <span class="title">Permisos</span>
        <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['roles.permissions.index'], 'start active open') }}">
            <a href="{{ route('roles.permission.index') }}" class="nav-link">
                <i class="fa fa-clone"></i>
                <span class="title">Asignaciones</span>
            </a>
        </li>
        <li class="nav-item {{ active(['permissions.index'], 'start active open') }}">
            <a href="{{ route('permissions.index') }}" class="nav-link">
                <i class="fa fa-get-pocket"></i>
                <span class="title">Gestion de Permisos</span>
            </a>
        </li>
        <li class="nav-item {{ active(['access-control.roles'], 'start active open') }}">
            <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="fa fa-map-signs"></i>
                <span class="title">Gestion de Roles</span>
            </a>
        </li>
        <li class="nav-item {{ active(['access-control.modules'], 'start active open') }}">
            <a href="{{ route('modules.index') }}" class="nav-link">
                <i class="fa fa-genderless"></i>
                <span class="title">Gestion de Modulos</span>
            </a>
        </li>
    </ul>
</li>
