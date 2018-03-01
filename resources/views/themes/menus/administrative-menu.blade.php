<li class="nav-item {{ active(['administrative.*'], 'start active open') }}">
    <a href="{{ route('administrative.user.registroIngreso') }}" class="nav-link nav-toggle">
        <i class="fa fa-globe"></i>
        <span class="title">Administrativo</span>
        <span class="arrow {{ active(['administrative.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
        @permission('ADMIN_ADMINIS')
        <li class="nav-item {{ active(['administrative.user.*'], 'start active open') }}">
            <a href="{{ route('administrative.user.registroIngreso') }}" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>
        @endpermission
    </ul>
</li>
