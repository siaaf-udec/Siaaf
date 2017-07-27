<li class="nav-item {{ active(['home', 'root'], 'start active open') }}">
    <a href="{{ route('home') }}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">Home</span>
    </a>
</li>

<li class="nav-item {{ active(['components.*', 'forms.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-building-o"></i>
        <span class="title">Elementos</span>
        <span class="arrow {{ active(['components.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">Componentes</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Botones</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['components.icons'], 'start active open') }}">
                    <a href="{{ route('components.icons') }}" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Íconos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['components.portlet'], 'start active open') }}">
            <a href="{{ route('components.portlet') }}" class="nav-link">
                <i class="icon-frame"></i>
                <span class="title">Portlets</span>
            </a>
        </li>
        <li class="nav-item {{ active(['components.sidebar'], 'start active open') }}">
            <a href="{{ route('components.sidebar') }}" class="nav-link">
                <i class="fa fa-bars"></i>
                <span class="title">Sidebar</span>
            </a>
        </li>
        <li class="nav-item {{ active(['components.datatables'], 'start active open') }}">
            <a href="{{ route('components.datatables') }}" class="nav-link">
                <i class="icon-grid"></i>
                <span class="title">DataTables</span>
            </a>
        </li>
        <li class="nav-item {{ active(['forms.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-speech"></i>
                <span class="title">Formularios</span>
                <span class="arrow {{ active(['forms.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['forms.fields'], 'start active open') }}">
                    <a href="{{ route('forms.fields') }}" class="nav-link">
                        <i class="icon-equalizer"></i>
                        <span class="title">Fields</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['forms.validation'], 'start active open') }}">
                    <a href="{{ route('forms.validation') }}" class="nav-link">
                        <i class="icon-wrench"></i>
                        <span class="title">Validaciones</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
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
<li class="nav-item {{ active(['access-control.*','roles.permissions.index'], 'start active open') }}">
    <a href="{{ route('users.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title">Usuarios</span>
    </a>
</li>