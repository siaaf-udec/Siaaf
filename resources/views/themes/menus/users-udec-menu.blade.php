<li class="nav-item {{ active(['usersUdec.*'], 'start active open') }}">
    <a href="{{ route('usersUdec.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-graduation-cap"></i>
        <span class="title">Usuarios Udec</span>
        <span class="arrow {{ active(['usersUdec.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
        <li class="nav-item {{ active(['usersUdec.user.*'], 'start active open') }}">
            <a href="{{ route('usersUdec.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>
    </ul>
</li>
