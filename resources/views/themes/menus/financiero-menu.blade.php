{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['financial.*'], 'start active open') }}">
    <a href="{{ route('financial.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-industry"></i>
        <span class="title">Financiero</span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['min.index'], 'start active open') }}">
            <a href="{{ route('min.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Registrar Documentos</span>
            </a>
        </li>
        <li class="nav-item {{ active(['icetex.index'], 'start active open') }}">
            <a href="{{ route('icetex.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Icetex</span>
            </a>
        </li>
      </ul>
</li>
