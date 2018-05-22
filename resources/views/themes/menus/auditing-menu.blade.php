<li class="nav-item {{ active(['administrative.*'], 'start active open') }}">
    <a href="{{ route('administrative.user.registroIngreso') }}" class="nav-link nav-toggle">
        <i class="fa fa-globe"></i>
        <span class="title">Auditoria</span>
        <span class="arrow {{ active(['audits.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
        @permission('AUD_GENERAL')
        <li class="nav-item {{ active(['audits.*'], 'start active open') }}">
            <a href="{{ route('audits.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">General</span>
            </a>
        </li>
        @endpermission
    </ul>
</li>
