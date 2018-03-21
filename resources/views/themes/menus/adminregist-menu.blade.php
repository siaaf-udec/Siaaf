{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['adminRegist.*'], 'start active open') }}">
    <a href="#" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">Admisiones y Registro</span>
        <span class="arrow {{ active(['adminRegist.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        <li class="nav-item {{ active(['adminRegist.users.*'], 'start active open') }}">
            <a href="{{route('adminRegist.users.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Usuarios</span>
            </a>
        </li>

        <li class="nav-item {{ active(['adminRegist.registros.*'], 'start active open') }}">
            <a href="{{route('adminRegist.registros.history')}}" class="nav-link nav-toggle">
                <i class="fa fa-desktop"></i>
                <span class="title">Historial Novedades</span>
            </a>
        </li>

        <li class="nav-item {{ active(['adminRegist.help.*'], 'start active open') }}">
            <a href="{{route('adminRegist.help.index')}}" class="nav-link nav-toggle">
                <i class="fa fa-support"></i>
                <span class="title">Preguntas</span>
            </a>
        </li>

        <li class="nav-item {{ active(['adminRegist.help.*'], 'start active open') }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-line-chart"></i>
                <span class="title">Reportes</span>
            </a>
        </li>

    </ul>
</li>
