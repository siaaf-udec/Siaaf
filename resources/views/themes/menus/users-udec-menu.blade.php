<li class="nav-item {{ active(['usersUdec.*'], 'start active open') }}">
    <a href="{{ route('usersUdec.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-graduation-cap"></i>
        <span class="title">Usuarios Udec</span>
        <span class="arrow {{ active(['usersUdec.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
        @permission('USER_UDEC')
        <li class="nav-item {{ active(['usersUdec.user.*'], 'start active open') }}">
            <a href="{{ route('usersUdec.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>
        @endpermission
        @permission('USER_UDEC_REGIS')
        <li class="nav-item {{ active(['usersUdec.user.*'], 'start active open') }}">
            <a href="{{ route('usersUdec.register') }}" class="nav-link nav-toggle">
                <i class="fa fa-user-plus"></i>
                <span class="title">Registrar Usuario</span>
            </a>
        </li>
        @endpermission
    </ul>
</li>
