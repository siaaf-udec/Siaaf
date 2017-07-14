{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['audiovisuales.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-desktop"></i>
        <span class="title">Audiovisuales</span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['funcionario.index'], 'start active open') }}">
            <a href="{{ route('funcionario.index') }}" class="nav-link">
                <i class="fa fa-users"></i>
                <span class="title">Gestionar Funcionarios</span>
            </a>
        </li>
       
    </ul>
</li>