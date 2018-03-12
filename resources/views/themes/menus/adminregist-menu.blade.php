{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['adminregist.*'], 'start active open') }}">
    <a href="#" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">Admisiones y Registro</span>
        <span class="arrow {{ active(['adminregist.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        <li class="nav-item {{ active(['adminregist.User.*'], 'start active open') }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>

    </ul>
</li>
