
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
                <li class="nav-item {{ active(['forms.dropzone'], 'start active open') }}">
                    <a href="{{ route('forms.dropzone') }}" class="nav-link">
                        <i class="icon-wrench"></i>
                        <span class="title">Dropzone</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['forms.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-speech"></i>
                <span class="title">Socket</span>
                <span class="arrow {{ active(['socket.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['socket.socket.index'], 'start active open') }}">
                    <a href="{{ route('socket.socket.index') }}" class="nav-link">
                        <i class="icon-equalizer"></i>
                        <span class="title">Socket</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['socket.redis.index'], 'start active open') }}">
                    <a href="{{ route('socket.redis.index') }}" class="nav-link">
                        <i class="icon-equalizer"></i>
                        <span class="title">Redis</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>