<<<<<<< Updated upstream
<li class="nav-item {{ active(['components.*', 'forms.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-building-o"></i>
        <span class="title">Autoevaluacion</span>
        <span class="arrow {{ active(['components.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">Administrador</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Botones</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">Fuentes Primarias</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Gestionar Encuestas</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Gestionar Preguntas</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Gestionar Tipo de Respuestas</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['components.portlet'], 'start active open') }}">
            <a href="{{ route('components.portlet') }}" class="nav-link">
                <i class="icon-frame"></i>
                <span class="title">Fuentes Secundarias</span>
            </a>
        </li>
    </ul>
</li>
=======
@permission('AUTOEVALUACION')
<li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-lock"></i>
            <span class="title">Autoevaluacion</span>
            <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
        </a>
        <ul class="sub-menu">
                <li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
                    <a href="{{ route('autoevaluacion.cna.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-lock"></i>
                        <span class="title">CNA</span>
                        <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
                            <a href="{{ route('autoevaluacion.cna.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-lock"></i>
                                <span class="title">Factor</span>
                                <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
                            </a>
                        </li>
                 </ul> 
                </li>
         </ul>       
</li>
@endpermission
>>>>>>> Stashed changes
