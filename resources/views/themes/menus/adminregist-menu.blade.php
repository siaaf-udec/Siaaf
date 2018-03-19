{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['adminregist.*'], 'start active open') }}">
    <a href="#" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">Admisiones y Registro</span>
        <span class="arrow {{ active(['adminregist.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        <li class="nav-item {{ active(['adminregist.User.*'], 'start active open') }}">
            <a href="{{route('adminRegist.users.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>

        <li class="nav-item {{ active(['adminregist.Registro.*'], 'start active open') }}">
            <a href="{{route('adminRegist.registros.history')}}" class="nav-link nav-toggle">
                <i class="fa fa-desktop"></i>
                <span class="title">Historial Novedades</span>
            </a>
        </li>

    </ul>
</li>
